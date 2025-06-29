<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Option 1: Create a specific test user
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            // Add other required fields if your User model has them and they are not nullable
            // e.g., 'password' => bcrypt('password'), 'phone' => '1234567890', etc.
            'password' => bcrypt('password'), // It's good practice to always hash passwords
            'phone' => '0712345678', // Example phone
            'student_id' => '123456', // Example student ID
        ]);

        // Option 2: Create multiple random users using the factory
        // Uncomment the line below if you want more than just the 'Test User'
        // User::factory(9)->create(); // Creates 9 more random users, totaling 10 if combined with the above

        // Call the ItemSeeder AFTER users have been created
        $this->call([
            ItemSeeder::class,
        ]);

        // You can also add a confirmation message here
        $this->command->info('Database seeding completed, including users and items!');
    }
}
