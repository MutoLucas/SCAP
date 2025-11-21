<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OcorrenciaTurno extends Model
{
    protected $table = 'tbl_OcorrenciaTurno';
    public $primaryKey = 'Id';
    public $timestamps = false;

    protected $fillable = [
        'Processo',
        'Sistema',
        'Equipamento',
        'DataOcorrencia',
        'Turno',
        'Operador',
        'DescricaoOcorrencia',
    ];
}
