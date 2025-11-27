<?php

namespace App\Livewire\Components\Addable\FalCod;

use Livewire\Component;
use Livewire\Attributes\Computed;

use App\Models\CodigoFalha as CF;
use App\Models\GrupoCodigo as GC;

class FormCreate extends Component
{
    public $name;
    public $group;

    public $message = [];

    public function rules()
    {
        return [
            'name'=>'required',
            'group'=>'required|exists:tbl_GrupoDeCódigo,Grupo de Código'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'O campo Código das Falhas é obrigatório.',

            'group.required' => 'O campo Grupo de Código é obrigatório.',
            'group.exists'   => 'O Grupo de Código informado não foi encontrado.',
        ];
    }

    public function render()
    {
       return view('livewire.components.addable.fal-cod.form-create');
    }

    #[Computed]
    public function groups()
    {
        $query = GC::query();

        return $query->orderBy('Grupo de Código','asc')->get();
    }

    public function storeNewFalCod()
    {
        $this->validate();

        if($this->verifyCodGroup($this->name,$this->group)){
            return $this->message = [
                'message'=>'Combinação de Código e Grupo já existente',
                'severity'=>'danger'
            ];
        }

        $newCf = CF::create([
            'Código das Falhas'=>$this->pull('name'),
            'Grupo de Código'=>$this->pull('group'),
        ]);

        $this->message = [
            'message'=>'Código de Falha criado com sucesso',
            'severity'=>'success'
        ];

        return $this->dispatch('cod-created');
    }

    public function verifyCodGroup($cod, $group)
    {
        return CF::where('Código das Falhas',$cod)->where('Grupo de Código',$group)->exists();
    }
}
