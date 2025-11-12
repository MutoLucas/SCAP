<?php

namespace App\Exports;

use App\Models\Parada;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ParadasExport implements FromArray, WithHeadings
{
    protected $array;

    public function __construct(array $array)
    {
        $this->array = $array;
    }

    public function array(): array
    {
        return $this->array;
    }

    public function headings(): array
    {
        return [
            'Id',
            'validade',
            'Producao',
            'Sistema',
            'Equipamento',
            'DataInicio',
            'DataFim',
            'Duracao(min)',
            'EqpGerador',
            'TipoCodigo',
            'GrupoCodigo',
            'CodigoFalha',
            'Turno',
            'CausaAparente',
            'Operador',
            'Observacao',
            'Componente',
            'Apropriador',
            'NumeroParada',
        ];
    }
}
