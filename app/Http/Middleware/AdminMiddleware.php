<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class AdminMiddleware
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
        # Preg si esta logueado(check) y si es director.. 
        if (Auth::check() && Auth::user()->esDirector())
            return $next($request);
        else
            # si no es director
            # return back()->withToastError('No tiene suficientes Privilegios para acceder a esta seccion.');
            return response()->json(['message'=>'No tiene suficientes Privilegios para acceder a esta seccion.'],403);
            
        
    }
}
