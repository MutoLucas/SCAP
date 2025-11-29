<?php

namespace App\Livewire\Components\Addable\FalCod;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use Livewire\Attributes\Computed;

use App\Exports\CodigoFalhaExport;
use Maatwebsite\Excel\Facades\Excel;

use App\Models\CodigoFalha as CF;
use App\Models\GrupoCodigo as GC;

class MainTable extends Component
{
    use WithPagination;

    public $message = [];

    public $messageDelete = [];
    public $falCodSelected;

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

    public function selectFalCod($id)
    {
        if(!$this->getFalCod($id)){
            return $this->messageDelete = [
                'message'=>'Erro ao tentar encontrar Código de Falha',
                'severity'=>'danger',
                'icon'=>'bi bi-x-circle',
            ];
        }

        $this->falCodSelected = $this->getFalCod($id);
    }

    public function deleteFalCod()
    {
        $falCodDeleted = $this->falCodSelected['Código das Falhas'];
        $this->falCodSelected->delete();
        $this->falCodSelected = null;

        $this->messageDelete = [
            'message'=>'Código de Falha: '.$falCodDeleted.' deletada com sucesso',
            'severity'=>'success',
            'icon'=>'bi bi-check-circle',
        ];
    }

    public function getFalCod($id)
    {
        return CF::find($id);
    }

    public function exportToExcel()
    {
        $query = CF::query();

        if($this->filterGroup){
            $query->where('Grupo de Código',$this->filterGroup);
        }

        if($this->filterName){
            $query->where('Código das Falhas','like','%'.$this->filterName.'%');
        }

        if($query->count() > 2000){
            return $this->message = [
                'message'=>'Numero de linhas excedeu 2000, favor entrar em contato com admin para aumentar.',
                'severity'=>'danger',
                'icon'=>'bi bi-x-circle',
            ];
        }

        $this->message = [
            'message'=>'Documento .xlsx carregado com sucesso.',
            'severity'=>'success',
            'icon'=>'bi bi-check-circle',
        ];
        
        return Excel::download(new CodigoFalhaExport($query->orderBy('Código das Falhas')->get()->toArray()), 'teste.xlsx');
    }
}
