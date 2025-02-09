<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class SessionTimeout
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        $timeout = config('session.lifetime') * 60; // Dalam detik
        $lastActivity = Session::get('lastActivityTime');

        if ($lastActivity && (time() - $lastActivity > $timeout)) {
            Auth::logout();
            Session::flush();
            
            if ($request->ajax()) {
                return response()->json(['logout' => true]);
            }

            return redirect('/login')->withErrors(['message' => 'Sesi telah habis, silakan login kembali.']);
        }

        // Jika request adalah AJAX, hanya perbarui sesi tanpa mereset timer logout
        if ($request->ajax()) {
            Session::put('lastActivityTime', time());
            return response()->json(['sessionUpdated' => true]);
        }

        // Jika request bukan AJAX, perbarui waktu sesi
        Session::put('lastActivityTime', time());
        Session::put('sessionExpiresAt', time() + $timeout);

        return $next($request);
    }

}
