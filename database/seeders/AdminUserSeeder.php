<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Cek apakah admin sudah ada
        $adminExists = User::where('email', 'admin@radjatiket.com')->first();

        if (!$adminExists) {
            User::create([
                'name' => 'Admin RADJATIKET',
                'email' => 'admin@radjatiket.com',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
                'email_verified_at' => now(),
            ]);

            $this->command->info('✓ Admin user created successfully!');
            $this->command->info('  Email: admin@radjatiket.com');
            $this->command->info('  Password: admin123');
        } else {
            $this->command->info('✓ Admin user already exists!');
        }
    }
}
