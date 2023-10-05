<?php

namespace Database\Seeders;

use Carbon\Carbon as Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleTableSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
                'name' => 'manager',
                'title' => 'Manager',
                'guard_name' => 'web',
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'supervisor',
                'title' => 'Supervisor',
                'guard_name' => 'web',
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'employee',
                'title' => 'Employee',
                'guard_name' => 'web',
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        DB::table('roles')->insert($roles);
    }
}
