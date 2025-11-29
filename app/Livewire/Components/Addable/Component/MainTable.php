<?php

namespace App\Livewire\Components\Addable\Component;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;
use Livewire\Attributes\Computed;

use App\Exports\ComponenteExport;
use Maatwebsite\Excel\Facades\Excel;

use App\Models\Componente;
use App\Models\GrupoEquipamento as GE;

class MainTable extends Component
{
    use WithPagination;

    public $message = [];

    public $messageDelete = [];
    public $componentSelected;

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

    #[On(['componente-created','comp-updated'])]
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

    public function selectComponent($id)
    {
        if(!$this->getComponent($id)){
            $this->messageDelete = [
                'message'=>'Erro ao tentar encontrar componente',
                'severity'=>'danger',
                'icon'=>'bi bi-x-cirlce'
            ];
        }

        $this->componentSelected = $this->getComponent($id);
    }

    public function deleteComponent()
    {
        $componentDeleted = $this->componentSelected->Componente;
        $this->componentSelected->delete();
        $this->componentSelected = null;

        $this->messageDelete = [
            'message'=>'Componente: '.$componentDeleted.' deletado com sucesso',
            'severity'=>'success',
            'icon'=>'bi bi-check-cirlce'
        ];
    }

    public function getComponent($id)
    {
        return Componente::find($id);
    }

    public function exportToExcel()
    {
        $query = Componente::query();

        if($this->filterGroup){
            $query->where('Grupo de Equipamentos',$this->filterGroup);
        }

        if($this->filterName){
            $query->where('Componente','like','%'.$this->filterName.'%');
        }

        if($query->count() > 2000){
            return $this->message = [
                'message'=>'Numero de linhas excedeu 2000, favor entrar em contato com admin para aumentar.',
                'severity'=>'danger',
                'icon'=>'bi bi-x-circle',
            ];
        }

        $this->message = [
            'message'=>'Documento.xlsx exportado com sucesso',
            'severity'=>'success',
            'icon'=>'bi bi-check-circle',
        ];

        return Excel::download(new ComponenteExport($query->orderBy('Componente','asc')->get()->toArray()),'componentes_'.now()->format('d_m_Y').'.xlsx');
    }
}
