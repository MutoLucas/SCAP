<?php

namespace App\Livewire\Components\Addable\AparentCause;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Computed;

use App\Models\CodigoFalha;
use App\Models\CausaAparente;

class MainTable extends Component
{
    use WithPagination;

    public $filterFalCod;
    public $filterName;

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
}
