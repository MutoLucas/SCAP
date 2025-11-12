<?php

namespace App\Livewire\Components\Users;

use Livewire\Component;

use App\Models\Login;

class Create extends Component
{
    public $name;
    public $login;
    public $role;

    public $message = [];

    public function rules()
    {
        return [
            'name'=>'required',
            'login'=>'required|unique:login,Login',
            'role'=>'required|exists:login,NivelAcesso',
        ];
    }

    public function messages()
    {
        return [
            'name.required'=>'É necessário informar um Nome',
            'login.required'=>'É necessário informar um Login',
            'login.unique'=>'Login já existente',
            'role.required'=>'É necessário selecionar um Nivel de Acesso',
            'role.exists'=>'É necessário selecionar um Nivel de Acesso existente',
        ];
    }

    public function mount()
    {
        $this->name = null;
        $this->login = null;
        $this->role = null;
    }

    public function render()
    {
        return view('livewire.components.users.create');
    }

    public function storeLogin()
    {
        $this->validate();

        $password = str_replace(' ','',$this->login).'@'.'scap';

        $newLogin = Login::create([
            'Login'=>$this->pull('login'),
            'Nome'=>$this->pull('name'),
            'NivelAcesso'=>$this->pull('role'),
            'Senha'=>$password
        ]);

        return $this->message = [
            'message'=>'Login: '.$newLogin->Login.' criado com sucesso',
            'severity'=>'alert-success',
            'icon'=>'bi bi-check-circle'
        ];
    }
}
