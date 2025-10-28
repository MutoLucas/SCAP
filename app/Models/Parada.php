<?php

namespace App\Models;

use Carbon\Carbon;

use Illuminate\Database\Eloquent\Model;

class Parada extends Model
{
    protected $table = 'tbl_Paradas';

    public function getDataInicialAttribute()
    {
        return Carbon::parse($this->DataInicio);
    }

    public function getDataFinalAttribute()
    {
        return Carbon::parse($this->DataFim);
    }
}
