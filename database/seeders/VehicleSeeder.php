<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Vehicle;

class VehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all users with an "approved" status
        $users = User::where('status', 'approved')->get();

        // Check if users exist
        if ($users->isEmpty()) {
            $this->command->info('No approved users found. Please add some users first.');
            return;
        }

        // Seed vehicles for each approved user
        foreach ($users as $user) {
            Vehicle::create([
                'fk_owner_id' => $user->pk_id,
                'fk_owner_model' => User::class,
                'type' => 'Toyota Corolla', // Example vehicle name
                'uk_vehicle_number' => 'ABC-' . rand(1000, 9999), // Randomized plate number
            ]);
        }

        $this->command->info('Vehicles seeded successfully!');
    }
}
