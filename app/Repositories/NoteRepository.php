<?php

namespace App\Repositories;

use App\Models\Note;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Collection;

class NoteRepository
{
    /**
     * @param int $id
     * @return Note|null
     */
    public function getNote(int $id): ?Note
    {
        $note = Note::query()->where('id', $id)->withTrashed()->first();

        /** @var Note $note */
        return $note;
    }

    /**
     * @return Collection
     */
    public function getNotes(): Collection
    {
        $user = Auth::user();

        $query = Note::query();

        if ($user->isEmployee() || $user->department_id != 1) {
            $query->where('department_id', '=', $user->department_id);
        }

        return $query->get();
    }

    /**
     * @return mixed
     */
    public function selectDatatable(): mixed
    {
        $query = Note::query()
            ->join('departments', 'notes.department_id', '=', 'departments.id')
            ->join('users', 'notes.user_id', '=', 'users.id')
            ->join('clients', 'notes.client_id', '=', 'clients.id')
            ->select([
                'notes.id',
                'code',
                'description',
                'status',
                'notes.status as state',
                'notes.created_at',
                'notes.deleted_at',
                'departments.name as department',
                'users.name as user',
                'clients.name as client_name',
            ])
            ->withTrashed('notes.deleted_at');

        $user = Auth::user();
        if (!$user->isSuperAdmin() && ($user->isEmployee() || $user->department_id != 1)) {
            $query->where('notes.department_id', '=', $user->department_id);
        }

        $query->orderBy('notes.created_at', 'desc');

        return $query;
    }
}
