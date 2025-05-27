<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        // n пользователей
        \App\Models\User::factory(7)->create()->each(function ($user) {
            // n постов для каждого пользователя
            \App\Models\Posts::factory(6)->create([
                'user_id' => $user->id,
            ]);
        });
    }
}
