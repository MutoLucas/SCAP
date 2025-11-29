<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class EquipamentoExport implements FromArray,WithHeadings
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
            'Processo',
            'Sistema',
            'Equipamento',
            'Grupo de Equipamento',
        ];
    }
}
