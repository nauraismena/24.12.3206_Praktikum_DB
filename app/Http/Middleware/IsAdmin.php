<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Cek apakah user sudah login DAN apakah role-nya adalah 'admin'
        // (Sesuaikan kata 'admin' dengan string role yang ada di database kamu)
        if (Auth::check() && Auth::user()->role === 'admin') {
            return $next($request);
        }

        // Jika bukan admin, tendang kembali ke halaman utama user dengan pesan error
        return redirect('/')->with('error', 'Anda tidak memiliki hak akses Administrator.');
    }
}