<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use App\Managers\UserManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Registers a new user.
     */
    public function register()
    {
        return view('auth.register');
    }

    /**
     * Stores a new user in the database.
     *
     * @param AuthRequest $request The request containing the user's registration data.
     */
    public function storeUser(AuthRequest $request)
    {
        $validatedData = $request->validated();

        $userManager = new UserManager();
        $userManager->register($validatedData);

        return redirect()->route('dashboard')->with('success', 'Su cuenta se ha creado correctamente.');
    }

    /**
     * Logs in a user.
     */
    public function login()
    {
        return view('auth.login');
    }

    /**
     * Authenticates a user.
     *
     * @param Request $request The request containing the user's authentication credentials.
     */
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        if (Auth::attempt($credentials)) {

            $request->session()->regenerate();

            Auth::user()->setLastActivity();

            return redirect()->intended(route('dashboard'))->with('success', 'Se ha conectado correctamente, ¡Bienvenido de nuevo!');
        }

        return redirect()->route('login')->withErrors([
            'Las credenciales proporcionadas no coinciden con nuestros registros.'
        ])->onlyInput('email');
    }

    /**
     * Logs out a user.
     *
     * @param Request $request The request containing the user's logout request.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Se ha cerrado la sesión.');
    }
}
