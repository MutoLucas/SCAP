<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CodigoFalha extends Model
{
    protected $table = 'tbl_CódigoDasFalhas';
    public $timestamps = false;

    protected $fillable = [
        'Código das Falhas',
        'Grupo de Código'
    ];
}
