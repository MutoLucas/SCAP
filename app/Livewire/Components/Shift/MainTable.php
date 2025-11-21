<?php

namespace App\Livewire\Components\Shift;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Computed;

use Carbon\Carbon;

use App\Models\Processo;
use App\Models\Sistema;
use App\Models\Equipamento;
use App\Models\OcorrenciaTurno;

class MainTable extends Component
{
    use WithPagination;

    public $filterSistema;
    public $filterDataFim;
    public $filterProcesso;
    public $filterDataInicio;
    public $filterEquipamento;

    public function mount()
    {
        $this->filterDataInicio = Carbon::today()->subDays(3)->format('Y-m-d\TH:i');
        $this->filterDataFim = Carbon::today()->setTime(23,59)->format('Y-m-d\TH:i');
    }

    public function render()
    {
        return view('livewire.components.shift.main-table');
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
    public function ocorrencias()
    {
        if($this->filterDataInicio && $this->filterDataFim){
            $query = OcorrenciaTurno::query();
            $dataInicio = Carbon::parse($this->filterDataInicio)->format('Y-m-d H:i:s');
            $query->whereRaw("CONVERT(datetime, DataOcorrencia, 120) >= CONVERT(datetime, ?, 120)", [$dataInicio]);

            $dataFim = Carbon::parse($this->filterDataFim)->format('Y-m-d H:i:s');
            $query->whereRaw("CONVERT(datetime, DataOcorrencia, 120) <= CONVERT(datetime, ?, 120)", [$dataFim]);

            if($this->filterProcesso){
                $query->where('Processo',$this->filterProcesso);
            }

            if($this->filterSistema){
                $query->where('Sistema',$this->filterSistema);
            }

            if($this->filterEquipamento){
                $query->where('Equipamento',$this->filterEquipamento);
            }

            return $query->orderBy('DataOcorrencia','desc')->paginate(4,'*','ocorrencias');
        }

        return false;
    }

    public function refreshFilters()
    {
        $this->reset();
    }
}
