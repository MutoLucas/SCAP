<?php

namespace App\Livewire\Components\Addable\Equipamento;

use Livewire\Component;
use Livewire\Attributes\Computed;

use App\Models\Processo;
use App\Models\Sistema;
use App\Models\Equipamento;
use App\Models\GrupoEquipamento;

class ModalEdit extends Component
{
    public $equipamentId;

    public $message = [];

    public $processo;
    public $sistema;
    public $equipamento;
    public $group;

    public function rules()
    {
        return [
            'processo'=>'required|exists:tbl_Processos,Processo',
            'sistema'=>'required|exists:tbl_Sistemas,Sistema',
            'equipamento'=>'required|unique:tbl_Equipamento,Equipamento,'.$this->equipamentId,
            'group'=>'required|exists:tbl_GrupoEquipamento,Grupo de Equipamentos',
        ];
    }

    public function messages()
    {
        return [
            'processo.required' => 'O campo processo é obrigatório.',
            'processo.exists' => 'O processo selecionado não existe na base de dados.',

            'sistema.required' => 'O campo sistema é obrigatório.',
            'sistema.exists' => 'O sistema selecionado não existe na base de dados.',

            'equipamento.required' => 'O campo equipamento é obrigatório.',
            'equipamento.unique' => 'Este equipamento já está cadastrado.',

            'group.required' => 'O campo grupo é obrigatório.',
            'group.exists' => 'O grupo selecionado não existe na base de dados.',
        ];
    }

    public function mount()
    {
        $this->processo = $this->equipament->Processo;
        $this->sistema = $this->equipament->Sistema;
        $this->equipamento = $this->equipament->Equipamento;
        $this->group = $this->equipament['Grupo de Equipamentos'];
    }

    public function render()
    {
        return view('livewire.components.addable.equipamento.modal-edit');
    }

    #[Computed]
    public function processos()
    {
        $query = Processo::query();

        return $query->orderBy('Processo','asc')->get();
    }

    #[Computed]
    public function equipGroups()
    {
        $query = GrupoEquipamento::query();

        return $query->orderBy('Grupo de Equipamentos','asc')->get();
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
    public function equipament()
    {
        return Equipamento::find($this->equipamentId);
    }

    public function updatedProcesso()
    {
        $this->sistema = null;
    }

    public function updateEquipament()
    {
        $this->validate();

        if($this->verifyExistsEquipament()){
            return $this->message[$this->equipamentId] = [
                'message'=>'Equipamento com essas especificações ja cadastrado',
                'severity'=>'danger',
                'icon'=>'bi bi-x-circle'
            ];
        }

        $this->equipament->Processo = $this->processo;
        $this->equipament->Sistema = $this->sistema;
        $this->equipament->Equipamento = $this->equipamento;
        $this->equipament['Grupo de Equipamentos'] = $this->group;
        $this->equipament->save();

        $this->message[$this->equipamentId] = [
            'message'=>'Equipamento alterado com sucesso',
            'severity'=>'success',
            'icon'=>'bi bi-check-circle'
        ];

        return $this->dispatch('equipament-updated');
    }

    public function verifyExistsEquipament()
    {
        return Equipamento::where('Processo',$this->processo)
            ->where('Sistema',$this->sistema)
            ->where('Equipamento',$this->equipamento)
            ->where('Grupo de Equipamentos',$this->group)
            ->where('id','!=',$this->equipamentId)
            ->exists();
    }
}
