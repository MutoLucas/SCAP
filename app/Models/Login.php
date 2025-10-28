<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Login extends Authenticatable
{
    protected $table = 'Login';
    protected $primaryKey = 'Login';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'Login',
        'Senha',
        'Nome',
        'NivelAcesso'
    ];

    public function getAuthPassword()
    {
        return $this->Senha;
    }
}
