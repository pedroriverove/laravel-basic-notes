<?php

namespace Database\Seeders;

use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class ClientTableSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        // Create 10 random clients
        Client::factory()
            ->count(10)
            ->create();
    }
}
