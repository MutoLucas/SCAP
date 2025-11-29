<?php

namespace App\Exports;

use App\Models\CodigoFalha;

use Maatwebsite\Excel\Concerns\FromArray;

use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class CodigoFalhaExport implements FromArray, WithHeadings
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
            'Grupo de Codigo',
            'Codigo das Falhas'
        ];
    }
}
