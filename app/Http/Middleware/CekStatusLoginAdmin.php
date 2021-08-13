<?php

namespace App\Http\Middleware;

use Closure;

class CekStatusLoginAdmin
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
        if (session('level')!='admin') {
            // kalau belum login , lemparkan ke halaman login
          return redirect('login')->with('gagal', 'Anda belum login.');
        }

        return $next($request);
    }
}