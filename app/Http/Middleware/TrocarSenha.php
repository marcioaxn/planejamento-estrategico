<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Auth;

class TrocarSenha {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        // dd(Auth::user()->trocarsenha);
        if (!Auth::guest() && Auth::user()->trocarsenha === 1) {
            return redirect()->action('UsersController@paginaTrocarSenha');
        }

        return $next($request);
    }

}
