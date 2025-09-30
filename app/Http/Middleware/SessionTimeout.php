<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class SessionTimeout
{
    // Waktu maksimal session dalam menit
    protected $timeout = 2;

    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            $lastActivity = session('last_activity_time');

            if ($lastActivity && now()->diffInMinutes($lastActivity) >= $this->timeout) {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                return redirect('/login')->with('message', 'Session habis, silakan login lagi.');
            }

            // update waktu terakhir aktivitas
            session(['last_activity_time' => now()]);
        }

        return $next($request);
    }
}
