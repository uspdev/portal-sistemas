<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $attributes = [
        'exibir' => false,
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'itens';

    /**
     * Relacionamento com grupo
     */
    public function grupo()
    {
        return $this->belongsTo(Grupo::class);
    }

}
