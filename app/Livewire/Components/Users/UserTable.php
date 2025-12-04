<?php

namespace App\Livewire\Components\Users;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;

use App\Models\Login;

class UserTable extends Component
{
    use WithPagination;

    public $messageDelete = [];
    public $userSelected;

    public $filterName;
    public $filterLogin;
    public $filterRole;

    public $messageModalEdit = [];
    public $userToEdit;
    public $editRole;

    public function render()
    {
        return view('livewire.components.users.user-table');
    }

    #[On('login-created')]
    #[Computed]
    public function logins()
    {
        $query = Login::query();
        $query->where('Login','!=',auth()->user()->Login);

        if($this->filterLogin){
            $query->where('Login','like','%'.$this->filterLogin.'%');
        }

        if($this->filterName){
            $query->where('Nome','like','%'.$this->filterName.'%');
        }

        if($this->filterRole){
            $query->where('NivelAcesso',$this->filterRole);
        }

        return $query->paginate(5,'*','logins');
    }

    public function setUserToEdit($login)
    {
        $this->userToEdit = Login::find($login);
        $this->editRole = $this->userToEdit->NivelAcesso;
    }

    public function updateRole()
    {
        $this->validate([
            'editRole'=>'required|exists:login,NivelAcesso'
        ],[
            'editRole.required' => 'O campo nível de acesso é obrigatório.',
            'editRole.exists'   => 'O nível de acesso informado não é válido.',
        ]);

        $this->userToEdit->NivelAcesso = $this->editRole;
        $this->userToEdit->save();

        return $this->messageModalEdit = [
            'message'=>'Nivel de Acesso alterado com sucesso',
            'severity'=>'alert-success',
            'icon'=>'bi bi-check-circle'
        ];
    }

    public function resetPassword()
    {
        $password = str_replace(' ','',$this->userToEdit->Login).'@'.'scap';
        $this->userToEdit->Senha = $password;
        $this->userToEdit->save();

        return $this->messageModalEdit = [
            'message'=>'Senha resetada com sucesso',
            'severity'=>'alert-success',
            'icon'=>'bi bi-lock'
        ];
    }

    public function resetSearch()
    {
        $this->reset();
    }

    public function selectUser($login)
    {
        $this->userSelected = $this->getUser($login);
    }

    public function deleteUser()
    {
        if($this->userSelected){
            $user = [
                'nome'=>$this->userSelected->Nome,
                'login'=>$this->userSelected->Login
            ];

            $this->userSelected->delete();
            $this->userSelected = null;

            $this->messageDelete = [
                'message'=>'Usuário: '.$user['nome'].' - '.$user['login'].' deletado com sucesso',
                'severity'=>'success',
                'icon'=>'bi bi-check-circle',
            ];
        }
    }

    public function getUser($login)
    {
        return Login::find($login);
    }
}
