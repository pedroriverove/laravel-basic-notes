<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoteAccessMiddleware
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
        $user = Auth::user();
        $department_id = (int)$request->route()->parameter('note');

        if (!$user->isSuperAdmin()
            && $user->department_id != $department_id
            && !in_array($user->role->name, ['manager', 'supervisor'])
        ) {
            return redirect()->route('notes.index')->with('error', 'No tiene permiso para acceder a esta ruta');
        }

        return $next($request);
    }
}
