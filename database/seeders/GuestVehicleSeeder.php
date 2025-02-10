<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Guest;
use App\Models\Vehicle;

class GuestVehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all guests from the database
        $guests = Guest::all();

        // Seed vehicles for each approved user
        foreach ($guests as $guest) {
            Vehicle::create([
                'fk_owner_id' => $guest->pk_id,
                'fk_owner_model' => Guest::class,
                'type' => 'car', // Example vehicle name
                'uk_vehicle_number' => 'ABC-' . rand(1000, 9999), // Randomized plate number
            ]);
        }

        $this->command->info('Vehicles seeded successfully!');
    }
}
