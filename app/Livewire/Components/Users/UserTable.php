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

    public $filterName;
    public $filterLogin;
    public $filterRole;

    public function render()
    {
        return view('livewire.components.users.user-table');
    }

    #[On('login-created')]
    #[Computed]
    public function logins()
    {
        $query = Login::query();

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

    public function resetSearch()
    {
        $this->reset();
    }
}
