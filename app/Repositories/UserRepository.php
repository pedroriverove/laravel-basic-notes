<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserRepository
{
    /**
     * @param int $id
     * @return int
     */
    public function getDepartment(int $id): int
    {
        return DB::table('users')->where('id', $id)->value('department_id');
    }

    /**
     * @return mixed
     */
    public function selectDatatable(): mixed
    {
        $query = User::query()
            ->join('roles', 'users.role_id', '=', 'roles.id')
            ->join('departments', 'users.department_id', '=', 'departments.id')
            ->select([
                'users.id',
                'users.name',
                'email',
                'users.created_at',
                'users.updated_at',
                'roles.name as role',
                'departments.name as department',
            ]);

        $query->orderBy('users.id', 'asc');

        return $query;
    }
}
