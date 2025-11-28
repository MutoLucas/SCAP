<?php

namespace App\Livewire\Components\Addable\Equipamento;

use Livewire\Component;
use Livewire\Attributes\Computed;

use App\Models\Sistema;
use App\Models\Processo;
use App\Models\Equipamento;
use App\Models\GrupoEquipamento;

class FormCreate extends Component
{
    public $message = [];

    public $processo;
    public $sistema;
    public $name;
    public $group;

    public function rules()
    {
        return [
            'name'=>'required|unique:tbl_Equipamento,Equipamento',
            'processo'=>'required|exists:tbl_Processos,Processo',
            'sistema'=>'required|exists:tbl_Sistemas,Sistema',
            'group'=>'required|exists:tbl_GrupoEquipamento,Grupo de Equipamentos',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'O campo nome é obrigatório.',
            'name.unique' => 'Este equipamento já está cadastrado.',

            'processo.required' => 'O campo processo é obrigatório.',
            'processo.exists' => 'O processo selecionado não é válido.',

            'sistema.required' => 'O campo sistema é obrigatório.',
            'sistema.exists' => 'O sistema selecionado não é válido.',

            'group.required' => 'O campo grupo é obrigatório.',
            'group.exists' => 'O grupo selecionado não é válido.',
        ];
    }

    public function render()
    {
        return view('livewire.components.addable.equipamento.form-create');
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
        if($this->processo){
            $query = Sistema::query();

            $query->where('Processo',$this->processo);

            return $query->orderBy('Sistema','asc')->get();
        }

        return false;
    }

    #[Computed]
    public function groupEquips()
    {
        $query = GrupoEquipamento::query();

        return $query->orderBy('Grupo de Equipamentos','asc')->get();
    }

    public function storeNewEquipament()
    {
        $this->validate();

        if($this->verifyExistsEquipament($this->processo,$this->sistema,$this->name,$this->group)){
            return $this->message = [
                'message'=>'Equipamento ja registrado',
                'severity'=>'danger'
            ];
        }

        $newEquipament = Equipamento::create([
            'Processo'=>$this->pull('processo'),
            'Sistema'=>$this->pull('sistema'),
            'Equipamento'=>$this->pull('name'),
            'Grupo de Equipamentos'=>$this->pull('group')
        ]);

        $this->message = [
            'message'=>'Novo Equipamento registrado com sucesso',
            'severity'=>'success'
        ];

        return $this->dispatch('equipamento-created');
    }

    public function verifyExistsEquipament($processo,$sistema,$equipamento,$group)
    {
        return Equipamento::where('Processo',$processo)->where('Sistema',$sistema)->where('Equipamento',$equipamento)->where('Grupo de Equipamentos',$group)->exists();
    }
}
