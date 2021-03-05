<?php

namespace App\Http\Middleware;

use Closure;

class esCuentaValidada
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (auth()->user()->cuenta_validada == 'N')
            return redirect()->route('usuarios.editarMiPerfil');

        return $next($request);
    }
}
