<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class ForceSessionTimeout
{
    // Waktu maksimal session dalam menit
    protected $timeout = 2;

    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            // Simpan waktu login pertama kali
            if (!session()->has('login_start_time')) {
                session(['login_start_time' => now()]);
            }

            $loginStart = session('login_start_time');

            // Hitung selisih waktu sejak login pertama
            if (now()->diffInMinutes($loginStart) >= $this->timeout) {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                return redirect('/login')->with('message', 'Session habis, silakan login lagi.');
            }
        }

        return $next($request);
    }
}
