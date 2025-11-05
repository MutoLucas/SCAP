<?php

namespace App\Livewire\Components\Parada;

use Livewire\Component;
use Livewire\Attributes\Computed;

use App\Models\Parada;
use App\Models\TipoCodigo;
use App\Models\GrupoCodigo;
use App\Models\CodigoFalha;
use App\Models\Equipamento;
use App\Models\CausaAparente;
use App\Models\Componente;

class CopyLine extends Component
{
    public $lineId;

    public $observacao;
    public $tagGerador;
    public $grupCod;
    public $tipCod;
    public $falCod;
    public $causaAparente;
    public $componente;

    public function mount()
    {
        $parada = Parada::find($this->lineId);
        $this->observacao = $parada->Observacao;
        $this->tagGerador = $parada->EqpGerador;
        $this->tipCod = $parada->TipoCodigo;
        $this->grupCod = $parada->GrupoCodigo;
        $this->falCod = $parada->CodigoFalha;
        $this->causaAparente = $parada->CausaAparente;
        $this->componente = $parada->Componente;
    }

    public function render()
    {
        return view('livewire.components.parada.copy-line');
    }

    #[Computed]
    public function equipamentos()
    {
        return Equipamento::get()->all();
    }

    #[Computed]
    public function tipoCodigos()
    {
        return TipoCodigo::get()->all();
    }

    #[Computed]
    public function grupoCodigos()
    {
        return GrupoCodigo::get()->all();
    }

    #[Computed]
    public function codigoFalhas()
    {
        return CodigoFalha::get()->all();
    }

    #[Computed]
    public function causasAparentes()
    {
        return CausaAparente::get()->all();
    }

    #[Computed]
    public function componentes()
    {
        return Componente::get()->all();
    }
}
