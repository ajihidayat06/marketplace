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
        // jika belum verif
        if ($request->user()->akun_verified_at == $verif && $request->user()->user_info->user_foto_ktp == null) {
            return redirect('/')->with('verifikasi', 'Silahkan verifikasi akun terlebih dahulu pada menu pengaturan');
        }
        if ($request->user()->akun_verified_at == $verif && $request->user()->user_info->user_foto_ktp != null) {
            return redirect('/')->with('sedang_verifikasi', 'Akun anda sedang dalam proses verifikasi oleh Admin');
        }
        return $next($request);
    }
}
