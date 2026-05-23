<?php

namespace App\Console\Commands;

use Database\Seeders\DefaultUserSeeder;
use Illuminate\Console\Command;

class EnsureDefaultUsersCommand extends Command
{
    protected $signature = 'users:ensure-defaults';

    protected $description = 'Buat atau reset akun admin & user bawaan (password: password)';

    public function handle(): int
    {
        $this->call('db:seed', ['--class' => DefaultUserSeeder::class, '--force' => true]);

        $this->newLine();
        $this->info('Akun bawaan siap dipakai:');
        $this->table(
            ['Peran', 'Email', 'Password'],
            [
                ['Admin', DefaultUserSeeder::ADMIN_EMAIL, DefaultUserSeeder::DEFAULT_PASSWORD],
                ['User', DefaultUserSeeder::USER_EMAIL, DefaultUserSeeder::DEFAULT_PASSWORD],
            ]
        );

        return self::SUCCESS;
    }
}
