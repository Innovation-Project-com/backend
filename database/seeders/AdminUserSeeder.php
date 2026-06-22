<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

/**
 * AdminUserSeeder
 *
 * Creates the default Filament admin user.
 * Credentials:
 *   Email    : admin@innovationproject.id
 *   Password : Admin@1234!
 *
 * ⚠️  Change the password after first login!
 */
class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@innovationproject.id'],
            [
                'name'              => 'Innovation Admin',
                'email'             => 'admin@innovationproject.id',
                'password'          => Hash::make('Admin@1234!'),
                'email_verified_at' => now(),
            ]
        );

        $this->command->info('✅ Admin user created: admin@innovationproject.id / Admin@1234!');
        $this->command->warn('⚠️  Please change the password after first login!');
    }
}
