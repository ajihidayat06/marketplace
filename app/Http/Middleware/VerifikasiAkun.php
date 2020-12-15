<?php

namespace App\Http\Middleware;

use Closure;

class VerifikasiAkun
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $verif = null)
    {
        // jika dia super admin
        if($request->user()->akun_verified_at == $verif ){
            return redirect('/')->with('verifikasi','Silahkan verifikasi akun terlebih dahulu');
        }
        return $next($request);
    }
}