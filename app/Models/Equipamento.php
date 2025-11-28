<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Equipamento extends Model
{
    protected $table = 'tbl_Equipamento';
    public $timestamps = false;

    protected $fillable = [
        'Processo',
        'Sistema',
        'Equipamento',
        'Grupo de Equipamentos'
    ];
}
