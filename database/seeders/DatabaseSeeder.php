<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\{Question, User};
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'name'     => 'Gabriel',
            'email'    => 'azevedo@email.com',
            'password' => 'coberto97',
        ]);

        Question::factory()->count(10)->create();
    }
}
