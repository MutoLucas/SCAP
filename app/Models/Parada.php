<?php

namespace App\Models;

use Carbon\Carbon;

use Illuminate\Database\Eloquent\Model;

class Parada extends Model
{
    protected $table = 'tbl_Paradas';
    protected $primaryKey = 'Id';
    public $timestamps = false;

    protected $fillable = [
        'Id',
        'Validade',
        'Producao',
        'Sistema',
        'Equipamento',
        'DataInicio',
        'DataFim',
        'Duracao',
        'EqpGerador',
        'TipoCodigo',
        'GrupoCodigo',
        'CodigoFalha',
        'Turno',
        'CausaAparente',
        'Operador',
        'Observacao',
        'Componente',
        'ModoFalha',
        'Apropriador',
        'NumeroParada'
    ];



    public function getDataInicialAttribute()
    {
        return Carbon::parse($this->DataInicio);
    }

    public function getDataFinalAttribute()
    {
        return Carbon::parse($this->DataFim);
    }
}
