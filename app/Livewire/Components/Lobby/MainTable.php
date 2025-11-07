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
    public $filterId;

    public $messageCopyLine = [];
    public $messageDeleteLine = [];

    public $selectedToDelete;

    public function mount()
    {
        $this->filterProcesso = null;
        $this->filterSistema = null;
        $this->filterEquipamento = null;
        $this->filterDataInicio = Carbon::today()->subDays(3)->format('Y-m-d\TH:i');
        $this->filterDataFim = Carbon::today()->format('Y-m-d\TH:i');
        $this->filterId = null;

        $this->selectedToDelete = null;
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

        if ($this->filterDataInicio) {
            $data = Carbon::parse($this->filterDataInicio)->format('Y-m-d H:i:s');
            $query->whereRaw("CONVERT(datetime, DataInicio, 120) >= CONVERT(datetime, ?, 120)", [$data]);
        }

        if ($this->filterDataFim) {
            $data = Carbon::parse($this->filterDataFim)->format('Y-m-d H:i:s');
            $query->whereRaw("CONVERT(datetime, DataFim, 120) <= CONVERT(datetime, ?, 120)", [$data]);
        }

        if ($this->filterId){
            $query->where('Id',$this->filterId);
        }

        return $query->orderBy('DataInicio','desc')->paginate(8,'*','paradas');
    }

    public function insertSameLine($linhaId)
    {
        $parada = $this->getParada($linhaId);

        if(!$parada){
            return $this->messageCopyLine[$linhaId] = ['message'=>'Erro ao tentar encontrar linha: '.$linhaId, 'severity'=>'danger'];
        }

        return redirect()->route('copyLine.index',['lineId'=>$parada->Id]);
    }

    public function getParada($id)
    {
        return Parada::find($id);
    }

    public function selectToDelete($id)
    {
        $this->selectedToDelete = $this->getParada($id);
    }

    public function deleteParada($id)
    {
        $parada = $this->getParada($id);

        if(!$parada){
            return $this->messageDeleteLine = ['message'=>'Erro ao tentar encontra linha: '.$id,'severity'=>'danger','icon'=>'bi bi-x-circle'];
        }

        $parada->delete();
        $this->reset('selectedToDelete');
        return $this->messageDeleteLine = ['message'=>'Linha: '.$id.' deletada com sucesso','severity'=>'success','icon'=>'bi bi-check2-circle'];
    }

    public function editLine($lineId)
    {
        $parada = $this->getParada($lineId);

        if(!$parada){
            return session()->flash('errorEditLine','Erro ao tentar encontrar linha: '.$lineId);
        }

        return redirect()->route('editLine.index',['lineId'=>$lineId]);
    }

    public function refreshFilters()
    {
        $this->reset();
    }
}
