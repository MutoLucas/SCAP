<?php

namespace App\Livewire\Components\Addable\AparentCause;

use Livewire\Component;
use Livewire\Attributes\Computed;

use App\Models\CodigoFalha;
use App\Models\CausaAparente;

class FormCreate extends Component
{
    public $message = [];

    public $name;
    public $falCod;

    public function rules()
    {
        return [
            'name'=>'required',
            'falCod'=>'required|exists:tbl_CódigoDasFalhas,Código das Falhas'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'O campo Código da Falha é obrigatório.',
            'name.unique'   => 'Este Código da Falha já está cadastrado.',

            'falCod.required' => 'O campo Causa Aparente é obrigatório.',
            'falCod.exists'   => 'A Causa Aparente informada não existe na tabela correspondente.',
        ];
    }


    public function render()
    {
        return view('livewire.components.addable.aparent-cause.form-create');
    }

    #[Computed]
    public function falCods()
    {
        $query = CodigoFalha::query();

        return $query->orderBy('Código das Falhas','asc')->get();
    }

    public function storeNewAparentCause()
    {
        $this->validate();

        if($this->verifyCauseFalCod($this->name,$this->falCod)){
            return $this->message = [
                'message'=>'Causa Aparente ja registrada',
                'severity'=>'danger'
            ];
        }

        $newCause = CausaAparente::create([
            'CodigoFalha'=>$this->pull('falCod'),
            'CausaAparente'=>$this->pull('name')
        ]);

        $this->message = [
            'message'=>'Causa Aparente registrada',
            'severity'=>'success'
        ];

        return $this->dispatch('cause-created');
    }

    public function verifyCauseFalCod($causaAparente,$codigoFalha)
    {
        return CausaAparente::where('CausaAparente',$causaAparente)->where('CodigoFalha',$codigoFalha)->exists();
    }
}
