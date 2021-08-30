<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Grupo extends Model
{
    use HasFactory;

    /**
     * Relacionamento com sistemna
     */
    public function sistemas()
    {
        return $this->belongsToMany(Sistema::class, 'sistema_grupo');
    }
}
