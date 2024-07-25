<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureProfileCompleted
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Cek apakah pengguna telah menyelesaikan profil
        if ($request->user()->role !== 'admin' && !$request->user()->is_completed) {
            // Redirect pengguna ke halaman untuk menyelesaikan profil
            return redirect()->route('complete-profile')->with(['status' => 'error', 'message' => 'Silakan lengkapi profil Anda terlebih dahulu.']);
        }
        return $next($request);
    }
}
