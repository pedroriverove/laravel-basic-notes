<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Managers\UserManager;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();

        return view('admin.profile.index', compact([
            'user',
        ]));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProfileRequest $request)
    {
        $validatedData = $request->validated();

        $userManager = new UserManager();
        $userManager->profile($validatedData);

        return redirect()->back()->with('success', 'Perfil actualizado correctamente');
    }
}
