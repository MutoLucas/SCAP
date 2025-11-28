<?php

namespace App\Livewire\Components\Addable\Equipamento;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;

use App\Models\Sistema;
use App\Models\Processo;
use App\Models\Equipamento;
use App\Models\GrupoEquipamento;

class MainTable extends Component
{
    use WithPagination;

    public $processo;
    public $sistema;
    public $name;
    public $group;

    public function render()
    {
        return view('livewire.components.addable.equipamento.main-table');
    }

    #[Computed]
    public function processos()
    {
        $query = Processo::query();

        return $query->orderBy('Processo','asc')->get();
    }

    #[Computed]
    public function sistemas()
    {
        $query = Sistema::query();

        return $query->orderBy('Sistema','asc')->get();
    }

    #[Computed]
    public function groupEquips()
    {
        $query = GrupoEquipamento::query();

        return $query->orderBy('Grupo de Equipamentos','asc')->get();
    }

    #[On(['equipamento-created','equipament-updated'])]
    #[Computed]
    public function equipaments()
    {
        $query = Equipamento::query();

        if($this->processo){
            $query->where('Processo',$this->processo);
        }

        if($this->sistema){
            $query->where('Sistema',$this->sistema);
        }

        if($this->group){
            $query->where('Grupo de Equipamentos',$this->group);
        }

        if($this->name){
            $query->where('Equipamento','like','%'.$this->name.'%');
        }

        return $query->orderBy('Equipamento','asc')->paginate(6,'*','equipaments');
    }

    public function resetSearch()
    {
        $this->reset();
    }
}
