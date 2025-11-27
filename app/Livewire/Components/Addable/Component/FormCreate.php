<?php

namespace App\Livewire\Components\Addable\Component;

use Livewire\Component;
use Livewire\Attributes\Computed;

use App\Models\Componente;
use App\Models\GrupoEquipamento as GE;

class FormCreate extends Component
{
    public $message;

    public $name;
    public $group;

    public function rules()
    {
        return [
            'name'=>'required',
            'group'=>'required|exists:tbl_GrupoEquipamento,Grupo de Equipamentos',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'O campo nome é obrigatório.',

            'group.required' => 'O campo grupo é obrigatório.',
            'group.exists'   => 'O grupo informado não existe em nosso cadastro.',
        ];
    }

    public function render()
    {
        return view('livewire.components.addable.component.form-create');
    }

    #[Computed]
    public function equipGroups()
    {
        $query = GE::query();

        return $query->orderBy('Grupo de Equipamentos','asc')->get();
    }

    public function storeNewComponent()
    {
        $this->validate();

        if($this->verifyComponentGrupoEquip($this->name,$this->group)){
            return $this->message = [
                'message'=>'Componente com grupo de equipamento ja registrado',
                'severity'=>'danger'
            ];
        }

        $newCompnente = Componente::create([
            'Grupo de Equipamentos'=>$this->pull('group'),
            'Componente'=>$this->pull('name')
        ]);

        $this->message = [
            'message'=>'Componente criado com sucesso',
            'severity'=>'success'
        ];

        return $this->dispatch('componente-created');
    }

    public function verifyComponentGrupoEquip($componente,$group)
    {
        return Componente::where('Componente',$componente)->where('Grupo de Equipamentos',$group)->exists();
    }
}
