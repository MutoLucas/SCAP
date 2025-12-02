<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use App\Models\Parada;

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

    public function parada(): BelongsTo
    {
        return $this->hasMany(Parada::class,'EqpGerador','Equipamento');
    }
}
