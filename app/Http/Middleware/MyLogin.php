<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class MyLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        // Cek apakah user sudah terautentikasi atau belum
        if (Auth::guard($guard)->check()) {
            return redirect('/profile');
        }
        // Jika belum terautentikasi, redirect ke halaman login
        return redirect('/login');
    }
}