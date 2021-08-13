<?php

namespace App\Http\Middleware;

use Closure;

class CekStatusLoginMember
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
        // dd(session('level'));
        if (session('level')!='member') {
            $redirect = urlencode($request->fullUrl());
            // $redirect = url()->current();
            // dd($redirect);
            // kalau belum , lemparkan ke halaman login
          return redirect('login?redirect='.$redirect)->with('gagal', 'Anda belum login.');
        }else{
            
        }
        return $next($request);
    }
}
