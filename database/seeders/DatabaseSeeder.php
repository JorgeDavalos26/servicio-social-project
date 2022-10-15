<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        //------------------------------------ users

        $user1 = User::factory()->create([
            "email" => "user1@gmail.com"
        ]);

        $user2 = User::factory()->create([
            "email" => "user2@gmail.com"
        ]);

        $user3 = User::factory()->create([
            "email" => "user3@gmail.com"
        ]);

        $user4 = User::factory()->create([
            "email" => "user4@gmail.com"
        ]);
        
    }
}
