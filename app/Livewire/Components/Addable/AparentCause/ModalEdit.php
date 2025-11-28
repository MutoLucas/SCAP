<?php

namespace App\Livewire\Components\Addable\AparentCause;

use Livewire\Component;
use Livewire\Attributes\Computed;

use App\Models\CodigoFalha;
use App\Models\CausaAparente;

class ModalEdit extends Component
{
    public $causeId;

    public $message = [];

    public $falCod;
    public $causaAparente;

    public function mount()
    {
        $this->falCod = $this->cause->CodigoFalha;
        $this->causaAparente = $this->cause->CausaAparente;
    }

    public function rules()
    {
        return [
            'falCod'=>'required|exists:tbl_CódigoDasFalhas,Código das Falhas',
            'causaAparente'=>'required',
        ];
    }

    public function messages()
    {
        return [
            'falCod.required' => 'O campo código de falha é obrigatório.',
            'falCod.exists'   => 'O código de falha selecionado não existe na base de dados.',

            'causaAparente.required' => 'O campo causa aparente é obrigatório.',
        ];
    }


    public function render()
    {
        return view('livewire.components.addable.aparent-cause.modal-edit');
    }

    #[Computed]
    public function falCods()
    {
        $query = CodigoFalha::query();

        return $query->orderBy('Código das Falhas','asc')->get();
    }

    #[Computed]
    public function cause()
    {
        return CausaAparente::find($this->causeId);
    }

    public function updateCause()
    {
        $this->validate();

        if($this->verifyExistsCause()){
            return $this->message[$this->causeId] = [
                'message'=>'Causa Aparente ja registrada',
                'severity'=>'danger',
                'icon'=>'bi bi-x-circle'
            ];
        }

        $this->cause->CodigoFalha = $this->falCod;
        $this->cause->CausaAparente = $this->causaAparente;
        $this->cause->save();

        $this->message[$this->causeId] = [
            'message'=>'Causa Aparente registrada',
            'severity'=>'success',
            'icon'=>'bi bi-check-circle'
        ];

        return $this->dispatch('cause-updated');
    }

    public function verifyExistsCause()
    {
        return CausaAparente::where('CodigoFalha',$this->falCod)
            ->where('CausaAparente',$this->causaAparente)
            ->where('Id','!=',$this->causeId)
            ->exists();
    }
}
