<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CausaAparente extends Model
{
    protected $table = 'tbl_CausaAparente';
    public $timestamps = false;
    public $primarykey = 'Id';

    protected $fillable = [
        'CodigoFalha',
        'CausaAparente'
    ];
}
