<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Notification;

class NotificationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Données des notifications depuis le JSON
        $notificationsData = [
            [
                'titre' => 'Résultats CEPE 2025',
                'message' => 'Les résultats du CEPE 2025 sont maintenant disponibles pour la DREN Analamanga.',
                'type' => 'success',
                'date' => '2025-06-20',
                'actif' => true,
                'lu' => false
            ],
            [
                'titre' => 'Publication BEPC',
                'message' => 'Les résultats du BEPC seront publiés le 25 juillet 2025.',
                'type' => 'info',
                'date' => '2025-07-15',
                'actif' => true,
                'lu' => false
            ]
        ];

        foreach ($notificationsData as $notificationData) {
            Notification::create($notificationData);
        }

        $this->command->info('Notifications créées avec succès !');
    }
}
