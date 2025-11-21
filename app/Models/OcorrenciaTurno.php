<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;

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

    public function getDataAttribute()
    {
        return Carbon::parse($this->DataOcorrencia);
    }
}
