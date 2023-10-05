<?php

namespace App\Http\Middleware;

use App\Repositories\UserRepository;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CustomerServiceMiddleware
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

        $department_id = (new UserRepository())->getDepartment($user->id);

        if ($user->isSuperAdmin() || $department_id === 1) {
            return $next($request);
        } else {
            return redirect()->route('notes.index')->with('error', 'No tiene permiso para acceder a esta ruta');
        }
    }
}
