<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NoteDestroyMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->method() === 'PUT') {
            $user = Auth::user();

            if ($user->department_id != 1 || !in_array($user->role->name, ['manager', 'supervisor'])) {
                return response()->json(['error' => true, 'message' => 'No tiene permiso para acceder a esta ruta.'], 403);
            }
        }

        return $next($request);
    }
}
