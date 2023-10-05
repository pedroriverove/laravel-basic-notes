<?php

namespace App\Managers;

use App\Models\Department;
use App\Models\Role;
use App\Models\User;
use Carbon\Carbon as Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class UserManager
{
    /**
     * @param array $data
     * @return void
     */
    public function register(array $data): void
    {
        $data['email_verified_at'] = Carbon::now();
        $data['password'] = bcrypt($data['password']);
        $data['role_id'] = Role::all()->random()->id;
        $data['department_id'] = Department::all()->random()->id;
        $data['remember_token'] = Str::random(10);
        $data['last_activity'] = Carbon::now();

        $user = User::create($data);

        Auth::login($user);
    }

    /**
     * @param array $data
     * @return void
     */
    public function create(array $data): void
    {
        $data['password'] = bcrypt($data['password']);
        $data['email_verified_at'] = Carbon::now();

        User::create($data);
    }

    /**
     * @param array $data
     * @param int $user_id
     * @return void
     */
    public function update(array $data, int $user_id): void
    {
        $user = User::findOrFail($user_id);

        $user->name = $data['name'];
        $user->email = $data['email'];

        if ($data['password']) {
            $user->password = bcrypt($data['password']);
        }

        $user->save();
    }

    /**
     * @param array $data
     * @return void
     */
    public function profile(array $data): void
    {
        $user = auth()->user();

        $insert = [
            'password' => $data['password'] ? bcrypt($data['password']) : $user->password
        ];

        $result = array_merge($data, $insert);

        $user->update($result);
    }
}
