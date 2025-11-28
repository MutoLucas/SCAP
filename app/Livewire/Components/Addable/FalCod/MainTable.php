<?php

namespace App\Livewire\Components\Addable\FalCod;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use Livewire\Attributes\Computed;

use App\Models\CodigoFalha as CF;
use App\Models\GrupoCodigo as GC;

class MainTable extends Component
{
    use WithPagination;

    public $filterGroup;
    public $filterName;

    public function render()
    {
        return view('livewire.components.addable.fal-cod.main-table');
    }

    #[On(['cod-created','fal-updated'])]
    #[Computed]
    public function falCods()
    {
        $query = CF::query();

        if($this->filterGroup){
            $query->where('Grupo de Código',$this->filterGroup);
        }

        if($this->filterName){
            $query->where('Código das Falhas','like','%'.$this->filterName.'%');
        }

        return $query->orderBy('Código das Falhas')->paginate(5,'*','falcods');
    }

    #[Computed]
    public function groups()
    {
        $query = GC::query();

        return $query->orderBy('Grupo de Código','asc')->get();
    }

    public function resetSearch()
    {
        $this->reset();
    }
}
