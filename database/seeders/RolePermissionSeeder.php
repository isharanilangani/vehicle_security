<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {
        // Define permissions
        $permissions = [
            // Admin Permissions
            'view pending users', 'approve user registration',
            'create authorized vehicle', 'edit authorized vehicle', 'delete authorized vehicle', 'view authorized vehicle',
            'create unauthorized vehicle', 'edit unauthorized vehicle', 'delete unauthorized vehicle', 'view unauthorized vehicle',
            'view monthly reports',

            // Security Personnel Permissions
            'view authorized vehicle', 'view unauthorized vehicle', 'create unauthorized vehicle', 'edit unauthorized vehicle',
            'register own vehicle', 'edit own vehicle', 'delete own vehicle', 'view own vehicle',

            // Vehicle Owner Permissions
            'register own vehicle', 'edit own vehicle', 'delete own vehicle', 'view own vehicle'
        ];

        // Create permissions
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Create roles
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $securityRole = Role::firstOrCreate(['name' => 'security_personnel']);
        $vehicleOwnerRole = Role::firstOrCreate(['name' => 'vehicle_owner']);

        // Assign permissions to roles
        $adminRole->givePermissionTo([
            'view pending users', 'approve user registration',
            'create authorized vehicle', 'edit authorized vehicle', 'delete authorized vehicle', 'view authorized vehicle',
            'create unauthorized vehicle', 'edit unauthorized vehicle', 'delete unauthorized vehicle', 'view unauthorized vehicle',
            'view monthly reports'
        ]);

        $securityRole->givePermissionTo([
            'view authorized vehicle', 'view unauthorized vehicle', 'create unauthorized vehicle', 'edit unauthorized vehicle',
            'register own vehicle', 'edit own vehicle', 'delete own vehicle', 'view own vehicle'
        ]);

        $vehicleOwnerRole->givePermissionTo([
            'register own vehicle', 'edit own vehicle', 'delete own vehicle', 'view own vehicle'
        ]);

        // Create test users with roles and permissions
        $this->createTestUsers();

        $this->command->info('Roles and permissions created successfully!');
    }

    private function createTestUsers()
    {
        // Admin User
        $admin = User::firstOrCreate([
            'full_name' => 'Admin User',
            'uk_NIC' => '123456789012',
            'email' => 'admin@example.com',
            'uk_password' => bcrypt('admin123'),
            'phone_number' => '0712345678',
            'status' => 'approved'
        ]);
        $admin->assignRole('admin');

        // Security Personnel User
        $securityPersonnel = User::firstOrCreate([
            'full_name' => 'Security Personnel',
            'uk_NIC' => '234567890123',
            'email' => 'security@example.com',
            'uk_password' => bcrypt('security123'),
            'phone_number' => '0712345679',
            'status' => 'approved'
        ]);
        $securityPersonnel->assignRole('security_personnel');

        // Vehicle Owner User
        $vehicleOwner = User::firstOrCreate([
            'full_name' => 'Vehicle Owner',
            'uk_NIC' => '345678901234',
            'email' => 'owner@example.com',
            'uk_password' => bcrypt('owner123'),
            'phone_number' => '0712345680',
            'status' => 'approved'
        ]);
        $vehicleOwner->assignRole('vehicle_owner');

        $pendingUser = User::firstOrCreate([
            'full_name' => 'Pending User',
            'uk_NIC' => '456789012345',
            'email' => 'pending@example.com',
            'uk_password' => bcrypt('pending123'),
            'phone_number' => '0712345681',
            'status' => 'pending'
        ]);
        $pendingUser->assignRole('vehicle_owner');
    }
}
