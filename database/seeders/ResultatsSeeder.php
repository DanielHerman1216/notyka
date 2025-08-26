<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Candidat;
use App\Models\Resultat;
use App\Models\Note;
use App\Models\Examen;
use App\Models\Serie;
use App\Models\Matiere;
use App\Models\Etablissement;

class ResultatsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Données des résultats depuis le JSON
        $resultatsData = [
            [
                'nom' => 'MAHAVONJY Herman Daniel',
                'identifiant' => '123456',
                'examen' => 'CEPE',
                'resultat' => 'Admis',
                'dren' => 'Analamanga',
                'cisco' => 'Antananarivo Ville',
                'etablissement' => 'EPP Ampefiloha',
                'notes' => [
                    'malagasy' => 15.5,
                    'français' => 14.0,
                    'mathématiques' => 16.5,
                    'sciences_dobservation' => 15.0,
                    'histoire_et_géographie' => 13.5
                ],
                'moyenne' => 14.9,
                'mention' => 'Assez Bien'
            ],
            [
                'nom' => 'Marie Rasoanaivo',
                'identifiant' => '654321',
                'examen' => 'BEPC',
                'resultat' => 'Non Admis',
                'dren' => 'Analamanga',
                'cisco' => 'Antananarivo Atsimondrano',
                'etablissement' => 'CEG Ambohimangakely',
                'notes' => [
                    'malagasy' => 9.5,
                    'français' => 8.0,
                    'mathématiques' => 7.5,
                    'sciences_physiques' => 8.5,
                    'sciences_naturelles' => 9.0,
                    'histoire_et_géographie' => 10.0,
                    'anglais' => 8.5
                ],
                'moyenne' => 8.7,
                'mention' => null
            ],
            [
                'nom' => 'Paul Rakoto',
                'identifiant' => '789123',
                'examen' => 'BACC',
                'resultat' => 'Admis',
                'dren' => 'Analamanga',
                'cisco' => 'Antananarivo Ville',
                'etablissement' => 'Lycée Andohalo',
                'serie' => 'Série A',
                'notes' => [
                    'malagasy' => 14.0,
                    'français' => 15.5,
                    'philosophie' => 13.0,
                    'histoire-géographie' => 14.5,
                    'anglais' => 16.0,
                    'mathématiques' => 12.0,
                    'sciences_physiques' => 13.5
                ],
                'moyenne' => 14.1,
                'mention' => 'Assez Bien'
            ],
            [
                'nom' => 'Hery Andriamanalina',
                'identifiant' => '456789',
                'examen' => 'CEPE',
                'resultat' => 'Admis',
                'dren' => 'Analamanga',
                'cisco' => 'Antananarivo Ville',
                'etablissement' => 'EPP Analakely',
                'notes' => [
                    'malagasy' => 18.0,
                    'français' => 17.5,
                    'mathématiques' => 19.0,
                    'sciences_dobservation' => 18.5,
                    'histoire_et_géographie' => 17.0
                ],
                'moyenne' => 18.0,
                'mention' => 'Très Bien'
            ],
            [
                'nom' => 'Fara Razafy',
                'identifiant' => '321654',
                'examen' => 'BEPC',
                'resultat' => 'Admis',
                'dren' => 'Analamanga',
                'cisco' => 'Antananarivo Ville',
                'etablissement' => 'CEG Faravohitra',
                'notes' => [
                    'malagasy' => 16.0,
                    'français' => 15.5,
                    'mathématiques' => 17.0,
                    'sciences_physiques' => 16.5,
                    'sciences_naturelles' => 15.0,
                    'histoire_et_géographie' => 14.5,
                    'anglais' => 16.0
                ],
                'moyenne' => 15.8,
                'mention' => 'Bien'
            ],
            [
                'nom' => 'Nirina Rajaonarison',
                'identifiant' => '987654',
                'examen' => 'BACC',
                'resultat' => 'Admis',
                'dren' => 'Analamanga',
                'cisco' => 'Antananarivo Atsimondrano',
                'etablissement' => 'Lycée Nanisana',
                'serie' => 'Série C',
                'notes' => [
                    'malagasy' => 13.5,
                    'français' => 14.0,
                    'mathématiques' => 17.5,
                    'sciences_physiques' => 18.0,
                    'sciences_naturelles' => 16.5,
                    'anglais' => 15.0,
                    'philosophie' => 12.5
                ],
                'moyenne' => 15.3,
                'mention' => 'Bien'
            ],
            [
                'nom' => 'Soa Razafimahatratra',
                'identifiant' => '147258',
                'examen' => 'CEPE',
                'resultat' => 'Admis',
                'dren' => 'Analamanga',
                'cisco' => 'Antananarivo Avaradrano',
                'etablissement' => 'EPP Ambohidratrimo',
                'notes' => [
                    'malagasy' => 12.0,
                    'français' => 13.5,
                    'mathématiques' => 14.0,
                    'sciences_dobservation' => 13.0,
                    'histoire_et_géographie' => 12.5
                ],
                'moyenne' => 13.0,
                'mention' => 'Passable'
            ],
            [
                'nom' => 'Tiana Randriamampionona',
                'identifiant' => '852963',
                'examen' => 'BEPC',
                'resultat' => 'Non Admis',
                'dren' => 'Analamanga',
                'cisco' => 'Antananarivo Ville',
                'etablissement' => 'CEG Isotry',
                'notes' => [
                    'malagasy' => 8.0,
                    'français' => 7.5,
                    'mathématiques' => 6.5,
                    'sciences_physiques' => 9.0,
                    'sciences_naturelles' => 8.5,
                    'histoire_et_géographie' => 9.5,
                    'anglais' => 7.0
                ],
                'moyenne' => 8.0,
                'mention' => null
            ]
        ];

        foreach ($resultatsData as $resultatData) {
            // Trouver l'établissement
            $etablissement = Etablissement::where('nom', $resultatData['etablissement'])->first();
            if (!$etablissement) {
                $this->command->warn("Établissement non trouvé: {$resultatData['etablissement']}");
                continue;
            }

            // Créer ou récupérer le candidat
            $candidat = Candidat::firstOrCreate(
                ['identifiant' => $resultatData['identifiant']],
                [
                    'nom' => $resultatData['nom'],
                    'etablissement_id' => $etablissement->id,
                    'actif' => true
                ]
            );

            // Trouver l'examen
            $examen = Examen::where('nom', $resultatData['examen'])->first();
            if (!$examen) {
                $this->command->warn("Examen non trouvé: {$resultatData['examen']}");
                continue;
            }

            // Trouver la série si applicable
            $serie = null;
            if (isset($resultatData['serie'])) {
                $serie = Serie::where('nom', $resultatData['serie'])
                    ->where('examen_id', $examen->id)
                    ->first();
            }

            // Créer le résultat
            $resultat = Resultat::create([
                'candidat_id' => $candidat->id,
                'examen_id' => $examen->id,
                'serie_id' => $serie ? $serie->id : null,
                'resultat' => $resultatData['resultat'],
                'moyenne' => $resultatData['moyenne'],
                'mention' => $resultatData['mention'],
                'annee_scolaire' => 2025,
                'actif' => true
            ]);

            // Créer les notes
            foreach ($resultatData['notes'] as $matiereCode => $note) {
                // Trouver la matière
                $matiere = Matiere::where('examen_id', $examen->id)
                    ->where('code', $matiereCode)
                    ->first();

                if ($serie) {
                    // Pour les examens avec séries, chercher dans la série
                    $matiere = Matiere::where('examen_id', $examen->id)
                        ->where('serie_id', $serie->id)
                        ->where('code', $matiereCode)
                        ->first();
                }

                if ($matiere) {
                    Note::create([
                        'resultat_id' => $resultat->id,
                        'matiere_id' => $matiere->id,
                        'note' => $note,
                        'coefficient' => 1,
                        'note_ponderee' => $note
                    ]);
                } else {
                    $this->command->warn("Matière non trouvée: {$matiereCode} pour l'examen {$examen->nom}");
                }
            }
        }

        $this->command->info('Candidats, résultats et notes créés avec succès !');
    }
}
