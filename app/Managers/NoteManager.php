<?php

namespace App\Managers;

use App\Models\Note;
use App\Repositories\ClientRepository;
use Illuminate\Support\Facades\Auth;

class NoteManager
{
    private ClientRepository $clientRepository;

    /**
     * @param ClientRepository $clientRepository
     */
    public function __construct(ClientRepository $clientRepository)
    {
        $this->clientRepository = $clientRepository;
    }

    /**
     * @param array $data
     * @return void
     */
    public function create(array $data): void
    {
        $client = $this->clientRepository->create($data);

        $data['user_id'] = (Auth::user())->id;
        $data['client_id'] = $client->id;

        Note::create($data);
    }

    /**
     * @param array $data
     * @param int $note_id
     * @return void
     */
    public function update(array $data, int $note_id): void
    {
        $note = Note::findOrFail($note_id);
        $note->update($data);
    }
}
