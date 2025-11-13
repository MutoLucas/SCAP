<?php

namespace App\Livewire\Components\Users;

use Livewire\Component;
use Livewire\Attributes\Computed;

use App\Models\Login;

class EditProfile extends Component
{
    public $nome;
    public $login;
    public $password;
    public $checkPassword;

    public $message = [];

    public function rules()
    {
        return [
            'nome'=>'required',
            'login'=>'required|unique:login,Login,'.auth()->user()->Login.',Login',
            'password'=>'nullable',
            'checkPassword'=>'nullable|same:password',
        ];
    }

    public function messages()
    {
        return [
            'nome.required' => 'O campo nome é obrigatório.',

            'login.required' => 'O campo login é obrigatório.',
            'login.unique' => 'Este login já está sendo utilizado por outro usuário.',

            'checkPassword.same' => 'As senhas não coincidem.',
        ];
    }


    public function mount()
    {
        $user = $this->user;

        $this->nome = $user->Nome;
        $this->login = $user->Login;
        $this->password = null;
        $this->checkPassword = null;
    }

    public function render()
    {
        return view('livewire.components.users.edit-profile');
    }

    #[Computed]
    public function user()
    {
        return Login::find(auth()->user()->Login);
    }

    public function update()
    {
        $this->validate();
        $this->user->Nome = $this->nome;
        $this->user->Login = $this->login;

        if($this->password){
            $this->user->Senha = $this->pull('password');
        }
        $this->user->save();
        return $this->message = [
            'message'=>'Alteracoes salvas com sucesso',
            'severity'=>'alert-success',
            'icon'=>'bi bi-check-circle'
        ];
    }
}
