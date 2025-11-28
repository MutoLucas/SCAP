<?php

namespace App\Livewire\Components\Addable\FalCod;

use Livewire\Component;
use Livewire\Attributes\Computed;

use App\Models\GrupoCodigo;
use App\Models\CodigoFalha;

class ModalEdit extends Component
{
    public $falCodId;

    public $message = [];

    public $falCod;
    public $group;

    public function mount()
    {
        $this->falCod = $this->fal['Código das Falhas'];
        $this->group = $this->fal['Grupo de Código'];
    }

    public function rules()
    {
        return [
            'falCod'=>'required',
            'group'=>'required|exists:tbl_GrupoDeCódigo,Grupo de Código',
        ];
    }

    public function messages()
    {
        return [
            'falCod.required' => 'O campo Código da Falha é obrigatório.',

            'group.required' => 'O campo Grupo de Código é obrigatório.',
            'group.exists'   => 'O Grupo de Código informado não existe na base de dados.',
        ];
    }


    public function render()
    {
        return view('livewire.components.addable.fal-cod.modal-edit');
    }

    #[Computed]
    public function groupCods()
    {
        $query = GrupoCodigo::query();

        return $query->orderBy('Grupo de Código','asc')->get();
    }

    #[Computed]
    public function fal()
    {
        return  CodigoFalha::find($this->falCodId);
    }

    public function updateFal()
    {
        $this->validate();

        if($this->verifyFalCodExists()){
            return $this->message[$this->falCodId] = [
                'message'=>'Código de Falha com este nome e grupo ja registrado',
                'severity'=>'danger',
                'icon'=>'bi bi-x-circle'
            ];
        }

        $this->fal['Código das Falhas'] = $this->falCod;
        $this->fal['Grupo de Código'] = $this->group;
        $this->fal->save();

        $this->message[$this->falCodId] = [
            'message'=>'Alteração registrada com sucesso',
            'severity'=>'success',
            'icon'=>'bi bi-check-circle'
        ];

        return $this->dispatch('fal-updated');
    }

    public function verifyFalCodExists()
    {
        return CodigoFalha::where('Grupo de Código',$this->group)->where('Código das Falhas',$this->falCod)->where('id','!=',$this->falCodId)->exists();
    }
}
