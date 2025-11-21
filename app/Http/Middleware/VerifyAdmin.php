<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerifyAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        if(auth()->user()->NivelAcesso != 'Administrador'){
            return redirect()->route('login.index')->with('error','Você não tem acesso a esta área do sistema.');
        }
        return $next($request);
    }
}
