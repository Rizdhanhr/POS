<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class CekLevel
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::check()) {
            if(Auth::user()->level == '1'){
                return $next($request);
            }else{
                toastr()->error('Anda tidak memiliki akses!');
                return redirect('/dashboard');
            }
        }else{
            toastr()->error('Silahkan Login!');
            return redirect('/dashboard');
        }
        return $next($request);
    }
}
