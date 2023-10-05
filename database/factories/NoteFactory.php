<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\Department;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Note>
 */
class NoteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'description' => fake()->paragraph(),
            'user_id' => User::query()->where('department_id', 1)->get()->shuffle()->first(),
            'department_id' => Department::all()->random(),
            'client_id' => Client::all()->random(),
        ];
    }
}
