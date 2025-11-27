<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Componente extends Model
{
    protected $table = 'tbl_Componente';
    public $timestamps = false;

    protected $fillable = [
        'Grupo de Equipamentos',
        'Componente'
    ];
}
