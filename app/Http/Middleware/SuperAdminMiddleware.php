<?php

namespace App\Http\Middleware;

use App\Repositories\UserRepository;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class SuperAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        if ($user->isSuperAdmin()) {
            return $next($request);
        } else {
            return redirect()->route('dashboard')->with('error', 'No tiene permiso para acceder a esta ruta');
        }
    }
}
