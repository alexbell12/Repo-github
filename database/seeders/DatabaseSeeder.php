<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(DefaultUserSeeder::class);

        $events = [
            [
                'title' => 'Seminar Teknologi 2024',
                'slug' => 'seminar-teknologi-2024',
                'description' => 'Seminar tentang perkembangan teknologi terbaru',
                'start_time' => now()->addDays(6)->setHour(9)->setMinute(0),
                'end_time' => now()->addDays(6)->setHour(17)->setMinute(0),
                'location' => 'Aula Utama Universitas',
            ],
            [
                'title' => 'Workshop Digital Marketing',
                'slug' => 'workshop-digital-marketing',
                'description' => 'Workshop praktis tentang digital marketing',
                'start_time' => now()->addDays(13)->setHour(10)->setMinute(0),
                'end_time' => now()->addDays(13)->setHour(16)->setMinute(0),
                'location' => 'Ruang Seminar A',
            ],
            [
                'title' => 'Konferensi AI & Machine Learning',
                'slug' => 'konferensi-ai-machine-learning',
                'description' => 'Konferensi tentang Artificial Intelligence dan Machine Learning',
                'start_time' => now()->addDays(20)->setHour(8)->setMinute(30),
                'end_time' => now()->addDays(20)->setHour(18)->setMinute(0),
                'location' => 'Convention Center',
            ],
        ];

        foreach ($events as $event) {
            Event::updateOrCreate(
                ['slug' => $event['slug']],
                array_merge($event, ['is_active' => true])
            );
        }
    }
}
