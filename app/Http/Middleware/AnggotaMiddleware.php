<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AnggotaMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!session()->has('anggota')) {
            return redirect()->route('anggota.login');
        }

        return $next($request);
    }
}