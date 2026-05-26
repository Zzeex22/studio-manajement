<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        // 1. Cek dulu apakah user sudah login
        if (!Auth::check()) {
            abort(403, 'Akses ditolak! Anda belum login.');
        }

        // 2. Ambil data user yang sedang login (kasih tahu VS Code ini adalah Model User)
        /** @var \App\Models\User $user */
        $user = Auth::user();

        // 3. Cek apakah role user tersebut ada di dalam daftar role yang diizinkan ($roles)
        if (!in_array($user->role, $roles)) {
            abort(403, 'Akses ditolak! Halaman ini bukan untuk role Anda.');
        }

        return $next($request);
    }
}