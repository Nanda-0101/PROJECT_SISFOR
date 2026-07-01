<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PanitiaMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // Cek apakah sudah login sebagai panitia
        if (!session()->has('panitia')) {
            return redirect()->route('panitia.login')
                ->withErrors([
                    'login' => 'Silakan login sebagai panitia terlebih dahulu.'
                ]);
        }

        return $next($request);
    }
}