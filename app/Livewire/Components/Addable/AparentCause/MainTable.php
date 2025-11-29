<?php

namespace App\Livewire\Components\Addable\AparentCause;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use Livewire\Attributes\Computed;

use App\Models\CodigoFalha;
use App\Models\CausaAparente;

class MainTable extends Component
{
    use WithPagination;

    public $filterFalCod;
    public $filterName;

    public $messageDelete = [];
    public $causeSelected;

    public function render()
    {
        return view('livewire.components.addable.aparent-cause.main-table');
    }

    #[Computed]
    public function falCods()
    {
        $query = CodigoFalha::query();

        return $query->orderBy('Código das Falhas','asc')->get();
    }

    #[On(['cause-created','cause-updated'])]
    #[Computed]
    public function aparentCauses()
    {
        $query = CausaAparente::query();

        if($this->filterFalCod){
            $query->where('CodigoFalha',$this->filterFalCod);
        }

        if($this->filterName){
            $query->where('CausaAparente','like','%'.$this->filterName.'%');
        }

        return $query->orderBy('CausaAparente','asc')->paginate(6,'*','causas');
    }

    public function resetSearch()
    {
        $this->reset();
    }

    public function selectCause($id)
    {
        if(!$this->getCause($id)){
            return $this->messageDelete = [
                'message'=>'Erro ao tentar encontrar Causa Aparente',
                'severity'=>'danger',
                'icon'=>'bi bi-x-circle',
            ];
        }

        $this->causeSelected = $this->getCause($id);
    }

    public function deleteCause()
    {
        $causeDeleted = $this->causeSelected->CausaAparente;
        $this->causeSelected->delete();

        $this->messageDelete = [
            'message'=>'Causa Aparente: '.$causeDeleted.' deleteada com sucesso',
            'severity'=>'success',
            'icon'=>'bi bi-check-circle',
        ];

        $this->causeSelected = null;
    }

    public function getCause($id)
    {
        return CausaAparente::find($id);
    }
}
