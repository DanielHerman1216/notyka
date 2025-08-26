<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Examen;
use App\Models\Serie;
use App\Models\Matiere;
use App\Models\Mention;

class ExamensSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Données des examens depuis le JSON
        $examensData = [
            [
                'nom' => 'CEPE',
                'description' => 'Certificat d\'Études Primaires Élémentaires - Examen de fin d\'études primaires permettant l\'accès au collège.',
                'date' => '15 juin 2025',
                'niveau' => 'Primaire',
                'duree' => '2 jours',
                'note_eliminatoire' => 8.0,
                'moyenne_admission' => 10.0,
                'actif' => true,
                'matieres' => [
                    'Malagasy',
                    'Français',
                    'Mathématiques',
                    'Sciences d\'Observation',
                    'Histoire et Géographie'
                ]
            ],
            [
                'nom' => 'BEPC',
                'description' => 'Brevet d\'Études du Premier Cycle - Diplôme sanctionnant la fin du premier cycle de l\'enseignement secondaire.',
                'date' => '20 juillet 2025',
                'niveau' => 'Collège',
                'duree' => '3 jours',
                'note_eliminatoire' => 8.0,
                'moyenne_admission' => 10.0,
                'actif' => true,
                'matieres' => [
                    'Malagasy',
                    'Français',
                    'Mathématiques',
                    'Sciences Physiques',
                    'Sciences Naturelles',
                    'Histoire et Géographie',
                    'Anglais'
                ]
            ],
            [
                'nom' => 'BACC',
                'description' => 'Baccalauréat - Diplôme national sanctionnant la fin des études secondaires et donnant accès à l\'enseignement supérieur.',
                'date' => '25 août 2025',
                'niveau' => 'Lycée',
                'duree' => '5 jours',
                'note_eliminatoire' => 8.0,
                'moyenne_admission' => 10.0,
                'actif' => true,
                'series' => [
                    [
                        'nom' => 'Série A',
                        'description' => 'Série Littéraire',
                        'matieres' => ['Malagasy', 'Français', 'Philosophie', 'Histoire-Géographie', 'Anglais', 'Mathématiques', 'Sciences Physiques']
                    ],
                    [
                        'nom' => 'Série C',
                        'description' => 'Série Scientifique',
                        'matieres' => ['Malagasy', 'Français', 'Mathématiques', 'Sciences Physiques', 'Sciences Naturelles', 'Anglais', 'Philosophie']
                    ],
                    [
                        'nom' => 'Série D',
                        'description' => 'Série Sciences et Techniques',
                        'matieres' => ['Malagasy', 'Français', 'Mathématiques', 'Sciences Physiques', 'Sciences de l\'Ingénieur', 'Anglais', 'Philosophie']
                    ]
                ]
            ]
        ];

        // Mentions communes pour tous les examens
        $mentions = [
            ['nom' => 'Passable', 'note_min' => 10.0, 'note_max' => 11.99, 'description' => '10 à 11.99'],
            ['nom' => 'Assez Bien', 'note_min' => 12.0, 'note_max' => 13.99, 'description' => '12 à 13.99'],
            ['nom' => 'Bien', 'note_min' => 14.0, 'note_max' => 15.99, 'description' => '14 à 15.99'],
            ['nom' => 'Très Bien', 'note_min' => 16.0, 'note_max' => 20.0, 'description' => '16 à 20']
        ];

        foreach ($examensData as $examenData) {
            // Créer l'examen
            $examen = Examen::create([
                'nom' => $examenData['nom'],
                'description' => $examenData['description'],
                'date' => $examenData['date'],
                'niveau' => $examenData['niveau'],
                'duree' => $examenData['duree'],
                'note_eliminatoire' => $examenData['note_eliminatoire'],
                'moyenne_admission' => $examenData['moyenne_admission'],
                'actif' => $examenData['actif']
            ]);

            // Créer les mentions pour cet examen
            foreach ($mentions as $mentionData) {
                Mention::create([
                    'examen_id' => $examen->id,
                    'nom' => $mentionData['nom'],
                    'note_min' => $mentionData['note_min'],
                    'note_max' => $mentionData['note_max'],
                    'description' => $mentionData['description'],
                    'actif' => true
                ]);
            }

            // Gérer les matières selon le type d'examen
            if (isset($examenData['matieres'])) {
                // Examens sans séries (CEPE, BEPC)
                foreach ($examenData['matieres'] as $matiereNom) {
                    Matiere::create([
                        'examen_id' => $examen->id,
                        'serie_id' => null,
                        'nom' => $matiereNom,
                        'code' => strtolower(str_replace([' ', '\''], ['_', ''], $matiereNom)),
                        'coefficient' => 1,
                        'actif' => true
                    ]);
                }
            } elseif (isset($examenData['series'])) {
                // Examen avec séries (BACC)
                foreach ($examenData['series'] as $serieData) {
                    $serie = Serie::create([
                        'examen_id' => $examen->id,
                        'nom' => $serieData['nom'],
                        'description' => $serieData['description'],
                        'actif' => true
                    ]);

                    // Créer les matières pour cette série
                    foreach ($serieData['matieres'] as $matiereNom) {
                        Matiere::create([
                            'examen_id' => $examen->id,
                            'serie_id' => $serie->id,
                            'nom' => $matiereNom,
                            'code' => strtolower(str_replace([' ', '\''], ['_', ''], $matiereNom)),
                            'coefficient' => 1,
                            'actif' => true
                        ]);
                    }
                }
            }
        }

        $this->command->info('Examens, séries, matières et mentions créés avec succès !');
    }
}
