<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Feedback;

class FeedbacksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Données des feedbacks depuis le JSON
        $feedbacksData = [
            [
                'nom' => 'Alice Raharison',
                'email' => 'alice@example.com',
                'sujet' => 'Amélioration de l\'interface',
                'message' => 'L\'application est très utile, mais il serait bien d\'ajouter une fonction de recherche par établissement.',
                'date' => '2025-08-20',
                'statut' => 'nouveau',
                'actif' => true
            ],
            [
                'nom' => 'Bob Randria',
                'email' => 'bob@example.com',
                'sujet' => 'Problème d\'affichage',
                'message' => 'Les résultats ne s\'affichent pas correctement sur mobile.',
                'date' => '2025-08-19',
                'statut' => 'en_cours',
                'actif' => true
            ],
            [
                'nom' => 'Claire Razafy',
                'email' => 'claire@example.com',
                'sujet' => 'Félicitations',
                'message' => 'Merci pour cette plateforme qui nous facilite vraiment la vie pour consulter les résultats.',
                'date' => '2025-08-18',
                'statut' => 'traite',
                'actif' => true
            ]
        ];

        foreach ($feedbacksData as $feedbackData) {
            Feedback::create($feedbackData);
        }

        $this->command->info('Feedbacks créés avec succès !');
    }
}
