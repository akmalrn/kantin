<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class PembeliMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->user() || $request->user()->role !== 'pembeli') {
            return redirect()->route('login'); // Redirect ke halaman login jika belum masuk atau bukan pembeli
        }

        return $next($request); // Lanjutkan permintaan jika pengguna telah masuk dan adalah pembeli
    }
}
