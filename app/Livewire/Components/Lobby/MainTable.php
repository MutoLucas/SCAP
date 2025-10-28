<?php

namespace App\Livewire\Components\Lobby;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Computed;

use Illuminate\Support\Facades\DB;

use Carbon\Carbon;

use App\Models\Processo;
use App\Models\Sistema;
use App\Models\Equipamento;
use App\Models\Parada;

class MainTable extends Component
{
    use WithPagination;

    public $filterProcesso;
    public $filterSistema;
    public $filterEquipamento;
    public $filterDataInicio;
    public $filterDataFim;

    public function mount()
    {
        $this->filterProcesso = null;
        $this->filterSistema = null;
        $this->filterEquipamento = null;
        $this->filterDataInicio = null;
        $this->filterDataFim = null;
    }

    public function render()
    {
        return view('livewire.components.lobby.main-table');
    }

    #[Computed]
    public function processos()
    {
        return Processo::get()->all();
    }

    #[Computed]
    public function sistemas()
    {
        if($this->filterProcesso){
            return Sistema::where('Processo',$this->filterProcesso)->get();
        }
        return Sistema::get()->all();
    }

    #[Computed]
    public function equipamentos()
    {
        if($this->filterSistema){
            return Equipamento::where('Sistema',$this->filterSistema)->get();
        }
        return Equipamento::get()->all();
    }

    #[Computed]
    public function paradas()
    {
        $query = Parada::query();

        if($this->filterProcesso){
            $query->where('Producao',$this->filterProcesso);
        }

        if($this->filterSistema){
            $query->where('Sistema',$this->filterSistema);
        }

        if($this->filterEquipamento){
            $query->where('Equipamento',$this->filterEquipamento);
        }

        return $query->orderBy('DataInicio','desc')->paginate(8,'*','paradas');
    }

    public function refreshFilters()
    {
        $this->reset();
    }
}
