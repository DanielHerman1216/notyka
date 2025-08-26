<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Ordre d'exécution important pour respecter les clés étrangères
        $this->call([
            ExamensSeeder::class,
            DrensSeeder::class,
            NotificationsSeeder::class,
            ResultatsSeeder::class,
            FeedbacksSeeder::class,
        ]);
    }
}
