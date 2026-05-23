<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DefaultUserSeeder extends Seeder
{
    public const ADMIN_EMAIL = 'admin@example.com';

    public const USER_EMAIL = 'user@example.com';

    public const DEFAULT_PASSWORD = 'password';

    public function run(): void
    {
        User::updateOrCreate(
            ['email' => self::ADMIN_EMAIL],
            [
                'name' => 'Admin',
                'password' => self::DEFAULT_PASSWORD,
                'is_admin' => true,
                'email_verified_at' => now(),
            ]
        );

        User::updateOrCreate(
            ['email' => self::USER_EMAIL],
            [
                'name' => 'User Demo',
                'password' => self::DEFAULT_PASSWORD,
                'is_admin' => false,
                'email_verified_at' => now(),
            ]
        );
    }
}
