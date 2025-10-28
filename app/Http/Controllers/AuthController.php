<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Login;

class AuthController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function auth(Request $request)
    {
        $request->validate([
            'login'=>'required',
            'senha'=>'required'
        ],[
            'login.required'=>'Necessario informar Login',
            'senha.required'=>'Necessario informar Senha',
        ]);

        $dados = $request->except('_token');
        $login = Login::where('Login',$dados['login'])->first();

        if($login && $login->Senha === $dados['senha']){
            auth()->login($login);
            $request->session()->regenerate();
            return redirect()->route('lobby');
        }

        return redirect()->back()->withErrors(['errorLogin'=>'Credenciais invalidas']);
    }

    public function logout(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login.index')->with('success','Sessao finalizada');
    }
}
