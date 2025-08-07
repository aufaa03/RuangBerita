<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        //periksa apakah user sudah login dan role nya cocok?
        if (!Auth::check() || !in_array(Auth::user()->role, $roles)) {
            //jika tidak maka arahkan kehalaman utama 
            return redirect('/')->with('error', 'Anda tidak memiliki akses untuk halaman ini');
        }
        return $next($request);
    }
}
