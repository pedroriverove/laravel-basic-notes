<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\Department;
use App\Models\Note;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class NoteTableSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        // Create 50 random notes
        Note::factory()
            ->count(50)
            ->create();
    }
}
