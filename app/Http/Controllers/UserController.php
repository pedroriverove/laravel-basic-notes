<?php

namespace App\Http\Controllers;

use App\DataTables\UsersDataTable;
use App\Http\Requests\UserRequest;
use App\Managers\UserManager;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
    /**
     * Lists all users.
     *
     * @param Request $request The request containing the pagination parameters.
     */
    public function index(Request $request)
    {
        return view('admin.users.index');
    }

    /**
     * Creates a new user.
     */
    public function create()
    {
        $user = new User();

        return view('admin.users.create', compact([
            'user',
        ]));
    }

    /**
     * Stores a new user in the database.
     *
     * @param UserRequest $request The request containing the new user data.
     */
    public function store(UserRequest $request)
    {
        $validatedData = $request->validated();

        $userManager = new UserManager();
        $userManager->create($validatedData);

        return redirect()->route('users.index')->with('success', 'Nota creada exitosamente');
    }

    /**
     * Edits a specific user.
     *
     * @param int $id The ID of the user.
     */
    public function edit(int $id)
    {
        $user = User::findOrFail($id);

        return view('admin.users.edit', compact([
            'user',
        ]));
    }

    /**
     * Updates a specific user in the database.
     *
     * @param UserRequest $request The request containing the updated user data.
     * @param int $id The ID of the user.
     */
    public function update(UserRequest $request, int $id)
    {
        $validatedData = $request->validated();

        $userManager = new UserManager();
        $userManager->update($validatedData, $id);

        return redirect()->route('users.index')->with('success', 'Actualizado exitosamente');
    }

    /**
     * Deletes a specific user from the database.
     *
     * @param int $id The ID of the user.
     */
    public function destroy(int $id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json(['success' => true, 'message' => 'Eliminado con éxito'], 200);
    }

    /**
     * Returns the data for the users datatable.
     *
     * @param Request $request The request containing the datatable parameters.
     */
    public function datatable(Request $request)
    {
        return UsersDataTable::datatable($request);
    }
}
