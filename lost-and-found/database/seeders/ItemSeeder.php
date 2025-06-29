<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Item;
use App\Models\User;
use Faker\Factory as Faker;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $users = User::all();

        if ($users->isEmpty()) {
            $this->command->warn('No users found. Please run UserSeeder first.');
            return;
        }

        $categories = [
            'electronics', 'clothing', 'accessories', 'books', 'keys', 
            'wallet', 'phone', 'bag', 'jewelry', 'documents', 'sports', 'other'
        ];

        $locations = [
            'Library', 'Student Center', 'Cafeteria', 'Lecture Hall A', 
            'Lecture Hall B', 'Computer Lab', 'Sports Complex', 'Parking Lot', 
            'Administration Block', 'Dormitory', 'Chapel'
        ];

        $lostItems = [
            ['name' => 'iPhone 13 Pro', 'category' => 'phone', 'description' => 'Black iPhone 13 Pro with cracked screen protector'],
            ['name' => 'Blue Backpack', 'category' => 'bag', 'description' => 'Navy blue Jansport backpack with laptop compartment'],
            ['name' => 'Car Keys', 'category' => 'keys', 'description' => 'Toyota car keys with red keychain'],
            ['name' => 'Brown Wallet', 'category' => 'wallet', 'description' => 'Leather brown wallet with student ID'],
            ['name' => 'MacBook Air', 'category' => 'electronics', 'description' => 'Silver MacBook Air 13-inch with stickers'],
        ];

        $foundItems = [
            ['name' => 'Silver Watch', 'category' => 'accessories', 'description' => 'Silver digital watch with black strap'],
            ['name' => 'Red Hoodie', 'category' => 'clothing', 'description' => 'Red pullover hoodie, size M'],
            ['name' => 'Textbook', 'category' => 'books', 'description' => 'Introduction to Psychology textbook'],
            ['name' => 'Bluetooth Earbuds', 'category' => 'electronics', 'description' => 'White wireless earbuds in charging case'],
            ['name' => 'Student ID Card', 'category' => 'documents', 'description' => 'Strathmore University student ID card'],
        ];

        // Create lost items
        foreach ($lostItems as $item) {
            Item::create([
                'user_id' => $users->random()->id,
                'name' => $item['name'],
                'description' => $item['description'],
                'category' => $item['category'],
                'location' => $faker->randomElement($locations),
                'date_lost_found' => $faker->dateTimeBetween('-30 days', 'now'),
                'type' => 'lost',
                'status' => $faker->randomElement(['active', 'active', 'active', 'returned']), // More active items
                'contact_info' => $faker->phoneNumber,
                'reward_offered' => $faker->boolean(30), // 30% chance of reward
                'reward_amount' => $faker->boolean(30) ? $faker->randomFloat(2, 10, 500) : null,
            ]);
        }

        // Create found items
        foreach ($foundItems as $item) {
            Item::create([
                'user_id' => $users->random()->id,
                'name' => $item['name'],
                'description' => $item['description'],
                'category' => $item['category'],
                'location' => $faker->randomElement($locations),
                'date_lost_found' => $faker->dateTimeBetween('-30 days', 'now'),
                'type' => 'found',
                'status' => $faker->randomElement(['active', 'active', 'returned']), // More active items
                'contact_info' => $faker->phoneNumber,
            ]);
        }

        // Create additional random items
        for ($i = 0; $i < 20; $i++) {
            $type = $faker->randomElement(['lost', 'found']);
            Item::create([
                'user_id' => $users->random()->id,
                'name' => $faker->words(2, true),
                'description' => $faker->sentence(10),
                'category' => $faker->randomElement($categories),
                'location' => $faker->randomElement($locations),
                'date_lost_found' => $faker->dateTimeBetween('-60 days', 'now'),
                'type' => $type,
                'status' => $faker->randomElement(['active', 'active', 'active', 'returned']),
                'contact_info' => $faker->optional(0.7)->phoneNumber,
                'reward_offered' => $type === 'lost' ? $faker->boolean(25) : false,
                'reward_amount' => $type === 'lost' && $faker->boolean(25) ? $faker->randomFloat(2, 5, 200) : null,
            ]);
        }

        $this->command->info('Items seeded successfully!');
    }
}