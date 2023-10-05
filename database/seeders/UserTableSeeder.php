<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        // if default user is needed : admin@example.com
        if (User::where('email', 'admin@example.com')->doesntExist()) {
            \App\Models\User::factory()->create([
                'name' => 'Admin',
                'email' => 'admin@example.com',
                'password' => bcrypt('password'),
                'is_super_admin' => true,
                'role_id' => Role::whereName('manager')->first(),
                'department_id' => Department::whereSlug('customer_service')->first(),
            ]);
        }

        // Create 25 random users
        User::factory()
            ->count(25)
            ->create();
    }
}
