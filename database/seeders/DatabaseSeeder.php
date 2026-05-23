<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'is_admin' => true,
        ]);

        User::factory()->create([
            'name' => 'User',
            'email' => 'user@example.com',
            'is_admin' => false,
        ]);

        Event::create([
            'title' => 'Seminar Teknologi 2024',
            'slug' => 'seminar-teknologi-2024-' . strtolower(\Illuminate\Support\Str::random(6)),
            'description' => 'Seminar tentang perkembangan teknologi terbaru',
            'start_time' => now()->addDays(6)->setHour(9)->setMinute(0),
            'end_time' => now()->addDays(6)->setHour(17)->setMinute(0),
            'location' => 'Aula Utama Universitas',
            'is_active' => true,
        ]);

        Event::create([
            'title' => 'Workshop Digital Marketing',
            'slug' => 'workshop-digital-marketing-' . strtolower(\Illuminate\Support\Str::random(6)),
            'description' => 'Workshop praktis tentang digital marketing',
            'start_time' => now()->addDays(13)->setHour(10)->setMinute(0),
            'end_time' => now()->addDays(13)->setHour(16)->setMinute(0),
            'location' => 'Ruang Seminar A',
            'is_active' => true,
        ]);

        Event::create([
            'title' => 'Konferensi AI & Machine Learning',
            'slug' => 'konferensi-ai-machine-learning-' . strtolower(\Illuminate\Support\Str::random(6)),
            'description' => 'Konferensi tentang Artificial Intelligence dan Machine Learning',
            'start_time' => now()->addDays(20)->setHour(8)->setMinute(30),
            'end_time' => now()->addDays(20)->setHour(18)->setMinute(0),
            'location' => 'Convention Center',
            'is_active' => true,
        ]);
    }
}
