<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    use HasFactory;

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'coluna' => 1,
        'exibir' => true,
    ];

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::creating(function ($grupo) {
            $grupo->linha = $grupo->getMaxLinha() + 1;
        });

        static::saving(function ($grupo) {

            if (empty($grupo->id)) {
                return true;
            }

            if ($grupo->isDirty('coluna')) {
                static::removeLinha($grupo);
                static::insereLinha($grupo);
                // inserindo novo na coluna e na linha

            } elseif ($grupo->isDirty('linha')) {
                static::moveLinha($grupo);
            }
        });

        static::deleting(function ($grupo) {
            //
        });
    }

    public static function removeLinha($model)
    {
        // ajustar linhas da coluna antiga
        static::where('coluna', $model->getOriginal('coluna'))
            ->where('linha', '>', $model->getOriginal('linha'))
            ->decrement('linha');
    }

    public static function insereLinha($model)
    {
        $linhaOriginal = $model->getOriginal('linha');
        $linhaNova = $model->linha;
        $max = $model->getMaxLinha($model->coluna) + 1;

        if ($linhaNova < 0 || $linhaNova > $max + 1) {
            //novo no final
            $model->linha = $max + 1;

        } elseif ($linhaNova == $linhaOriginal) {
            static::where('coluna', $model->coluna)
                ->where('linha', '>=', $linhaOriginal)
                ->increment('linha');

        } elseif ($linhaNova > $linhaOriginal) { // subindo
            static::where('coluna', $model->coluna)
                ->where('linha', '>', $linhaOriginal)
                ->where('linha', '<=', $linhaNova)
                ->decrement('linha');

        } elseif ($linhaNova < $linhaOriginal) { // descendo
            static::where('coluna', $model->coluna)
                ->where('linha', '<', $linhaOriginal)
                ->where('linha', '>=', $linhaNova)
                ->increment('linha');
        }
    }

    public static function moveLinha($grupo)
    {
        $linhaOriginal = $grupo->getOriginal('linha');
        $linhaNova = $grupo->linha;
        $max = $grupo->getMaxLinha($grupo->coluna);

        if ($linhaNova == 0) {
            //novo no final
            $grupo->linha = $max + 1;
        } elseif ($linhaNova == $linhaOriginal) {
            // faz nada
        } elseif ($linhaNova > $linhaOriginal) {
            if ($linhaNova > $max + 1) {
                $grupo->linha = $max + 1;
            } else {
                static::where('coluna', $grupo->coluna)
                    ->where('linha', '>', $linhaOriginal)
                    ->where('linha', '<=', $linhaNova)
                    ->decrement('linha');
            }
        } elseif ($linhaNova < $linhaOriginal) {
            static::where('coluna', $grupo->coluna)
                ->where('linha', '<', $linhaOriginal)
                ->where('linha', '>=', $linhaNova)
                ->increment('linha');
        }

        //
    }

    public function getMaxLinha($coluna = null)
    {
        return Grupo::where('coluna', $coluna ?? $this->coluna)->max('linha');
    }

    public function moveToPosition($position)
    {
        $firstModel = $this->buildSortQuery()->limit(1)
            ->ordered()
            ->first();

        if ($firstModel->getKey() === $this->getKey()) {
            return $this;
        }

        $orderColumnName = $this->determineOrderColumnName();

        $this->$orderColumnName = $firstModel->$orderColumnName;
        $this->save();

        $this->buildSortQuery()->where($this->getKeyName(), '!=', $this->getKey())->increment($orderColumnName);

        return $this;
    }

    public function colunaArray()
    {
        $range = range(1, config('portal-sistemas.num_cols'));
        return array_combine($range, $range);
    }

    public function ordemArray($coluna = null)
    {
        if ($coluna) {
            $max = Grupo::where('coluna', $coluna)->max('linha');
        } else {
            $max = Grupo::where('coluna', $this->coluna)->max('linha');
        }
        $range = range(1, $max);
        return array_combine($range, $range);
    }

    /**
     * Relacionamento com sistemna
     */
    public function sistemas()
    {
        return $this->belongsToMany(Sistema::class, 'sistema_grupo');
    }
}
