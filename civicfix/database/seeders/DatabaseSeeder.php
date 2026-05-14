<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        if (!User::where('email', 'test@example.com')->exists()) {
            User::factory()->create([
                'name' => 'Test User',
                'email' => 'test@example.com',
            ]);
        }

        if (!User::where('email', 'admin@example.com')->exists()) {
            User::factory()->create([
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'is_admin' => true,
            ]);
        }

        if (!User::where('email', 'rohan.admin@gmail.com')->exists()) {
            User::create([
                'name' => 'Rohan Admin',
                'email' => 'rohan.admin@gmail.com',
                'password' => bcrypt('password123'),
                'is_admin' => true,
                'email_verified_at' => now(),
            ]);
        }

        $this->call(IssueSeeder::class);
    }
}
