<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Reason;  // Assuming you have a Reason model
use App\Models\Guest;   // Assuming you have a Guest model
use Faker\Factory as Faker; // Using Faker for random data generation

class ReasonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        // Get all guest ids
        $guests = Guest::all();

        foreach ($guests as $guest) {
            // Create a reason for each guest
            Reason::create([
                'fk_guest_id' => $guest->pk_id,  // Foreign key to guests table
                'reason' => $faker->sentence,  // Random reason sentence
                'created_at' => now(),
            ]);
        }

        // Output message to the console
        $this->command->info('Reasons table has been seeded.');
    }
}
