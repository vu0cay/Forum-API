<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Hash;
use Illuminate\Container\Attributes\Tag;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'student_id' => 'B2203594',
            'password' => Hash::make("123123123"),
            'email' => 'test@example.com',
        ]);
        // $this->call(PostSeeder::class);
    }
}
