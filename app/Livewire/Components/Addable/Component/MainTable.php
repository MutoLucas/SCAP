<?php

namespace App\Livewire\Components\Addable\Component;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;
use Livewire\Attributes\Computed;

use App\Models\Componente;
use App\Models\GrupoEquipamento as GE;

class MainTable extends Component
{
    use WithPagination;

    public $filterGroup;
    public $filterName;

    public function render()
    {
        return view('livewire.components.addable.component.main-table');
    }

    #[Computed]
    public function equipGroups()
    {
        $query = GE::query();

        return $query->orderBy('Grupo de Equipamentos','asc')->get();
    }

    #[On('componente-created')]
    #[Computed]
    public function components()
    {
        $query = Componente::query();

        if($this->filterGroup){
            $query->where('Grupo de Equipamentos',$this->filterGroup);
        }

        if($this->filterName){
            $query->where('Componente','like','%'.$this->filterName.'%');
        }

            return $query->orderBy('Componente','asc')->paginate(6,'*','components');
    }

    public function resetSearch()
    {
        $this->reset();
    }
}
