<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Guest;  // Assuming you have a Guest model
use Faker\Factory as Faker; // Using Faker for random data generation

class GuestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        // Generate 20 guest records (you can change the number as needed)
            Guest::create([
                'full_name' => $faker->name,
                'address' => $faker->address,
                'uk_NIC' => $faker->numerify('###########'),
                'phone_number' => ('0712345678'),
            ]);

        // Output message to the console
        $this->command->info('Guests table has been seeded.');
    }
}
