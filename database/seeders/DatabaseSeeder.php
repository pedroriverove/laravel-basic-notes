<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->truncateTables([
            'departments',
            'roles',
            'users',
            'clients',
            'notes',
        ]);

        $this->call([
            DepartmentTableSeeder::class,
            RoleTableSeeder::class,
            UserTableSeeder::class,
            ClientTableSeeder::class,
            NoteTableSeeder::class,
        ]);
    }

    /**
     * @param array $tables
     * @return void
     */
    public function truncateTables(array $tables): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');

        foreach ($tables as $table) {
            DB::table($table)->truncate();
        }

        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
    }
}
