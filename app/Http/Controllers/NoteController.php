<?php

namespace App\Http\Controllers;

use App\DataTables\NotesDataTable;
use App\Http\Requests\NoteRequest;
use App\Managers\NoteManager;
use App\Models\Department;
use App\Models\Note;
use App\Repositories\ClientRepository;
use App\Repositories\NoteRepository;
use Carbon\Carbon as Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class NoteController extends Controller
{
    /**
     * Lists all notes.
     *
     * @param Request $request The request containing the pagination parameters.
     */
    public function index(Request $request)
    {
        return view('admin.notes.index');
    }

    /**
     * Creates a new note.
     */
    public function create()
    {
        $note = new Note();
        $departments = Department::all();

        return view('admin.notes.create', compact([
            'note',
            'departments',
        ]));
    }

    /**
     * Stores a new note in the database.
     *
     * @param NoteRequest $request The request containing the new note data.
     */
    public function store(NoteRequest $request)
    {
        $validatedData = $request->validated();

        $noteManager = new NoteManager(new ClientRepository());
        $noteManager->create($validatedData);

        return redirect()->route('notes.index')->with('success', 'Nota creada exitosamente');
    }

    /**
     * Edits a specific note.
     *
     * @param int $id The ID of the note.
     */
    public function edit(int $id)
    {
        $note = (new NoteRepository())->getNote($id);

        if (is_null($note)) {
            throw new ModelNotFoundException();
        }

        $departments = Department::all();

        return view('admin.notes.edit', compact([
            'note',
            'departments',
        ]));
    }

    /**
     * Updates a specific note in the database.
     *
     * @param NoteRequest $request The request containing the updated note data.
     * @param int $id The ID of the note.
     */
    public function update(NoteRequest $request, int $id)
    {
        $validatedData = $request->validated();

        $noteManager = new NoteManager(new ClientRepository());
        $noteManager->update($validatedData, $id);

        return redirect()->route('notes.index')->with('success', 'Actualizada exitosamente');
    }

    /**
     * Deletes a specific note from the database.
     *
     * @param int $id The ID of the note.
     */
    public function destroy(int $id)
    {
        $note = (new NoteRepository())->getNote($id);

        if (is_null($note)) {
            throw new ModelNotFoundException();
        }

        $note->delete();

        return response()->json(['success' => true, 'message' => 'Eliminado con éxito'], 200);
    }

    /**
     * Reactivates a specific note from the database.
     *
     * @param int $id The ID of the note.
     */
    public function reactivate(int $id)
    {
        $note = (new NoteRepository())->getNote($id);

        if (is_null($note)) {
            throw new ModelNotFoundException();
        }

        $note->reactivated_at = Carbon::now();
        $note->deleted_at = null;
        $note->save();

        return response()->json(['success' => true, 'message' => 'Reactivado con éxito'], 200);
    }

    /**
     * Returns the data for the notes datatable.
     *
     * @param Request $request The request containing the datatable parameters.
     */
    public function datatable(Request $request)
    {
        return NotesDataTable::datatable($request);
    }
}
