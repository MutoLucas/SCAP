<?php

namespace App\Livewire\Components\Addable\Component;

use Livewire\Component;
use Livewire\Attributes\Computed;

use App\Models\Componente;
use App\Models\GrupoEquipamento;

class ModalEdit extends Component
{
    public $compId;

    public $message = [];

    public $compName;
    public $group;

    public function mount()
    {
        $this->compName = $this->comp->Componente;
        $this->group = $this->comp['Grupo de Equipamentos'];
    }

    public function rules()
    {
        return [
            'compName'=>'required',
            'group'=>'required|exists:tbl_GrupoEquipamento,Grupo de Equipamentos',
        ];
    }

    public function messages()
    {
        return [
            'compName.required' => 'O campo Nome do Componente é obrigatório.',

            'group.required' => 'O campo Grupo de Equipamentos é obrigatório.',
            'group.exists'   => 'O Grupo de Equipamentos informado não existe na base de dados.',
        ];
    }


    public function render()
    {
        return view('livewire.components.addable.component.modal-edit');
    }

    #[Computed]
    public function groups()
    {
        $query = GrupoEquipamento::query();

        return $query->orderBy('Grupo de Equipamentos','asc')->get();
    }

    #[Computed]
    public function comp()
    {
        return Componente::find($this->compId);
    }

    public function updateComp()
    {
        $this->validate();

        if($this->verifyExistsComp()){
            return $this->message[$this->compId] = [
                'message'=>'Componente com este grupo ja registrado',
                'severity'=>'danger',
                'icon'=>'bi bi-x-circle'
            ];
        }

        $this->comp->Componente = $this->compName;
        $this->comp['Grupo de Equipamentos'] = $this->group;
        $this->comp->save();

        $this->message[$this->compId] = [
            'message'=>'Componente registrado com sucesso',
            'severity'=>'success',
            'icon'=>'bi bi-circle-circle'
        ];

        return $this->dispatch('comp-updated');
    }

    public function verifyExistsComp()
    {
        return Componente::where('Componente',$this->compName)->where('Grupo de Equipamentos',$this->group)->where('id','!=',$this->compId)->exists();
    }
}
