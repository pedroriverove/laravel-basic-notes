<?php

namespace App\Repositories;

use App\Models\Client;
use App\Models\Note;

class ClientRepository
{
    /**
     * @param array $data
     * @return Client
     */
    public function create(array $data): Client
    {
        $client = new Client();
        $client->name = $data['client_name'];
        $client->company = $data['client_company'];
        $client->phone_number = $data['client_phone_number'];
        $client->save();

        return $client;
    }
}
