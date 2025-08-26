<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Dren;
use App\Models\Cisco;
use App\Models\Etablissement;

class DrensSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Données des DRENs depuis le JSON
        $drensData = [
            [
                'nom' => 'Analamanga',
                'code' => 'ANALAMANGA',
                'disponible' => true,
                'actif' => true,
                'ciscos' => [
                    [
                        'nom' => 'Antananarivo Ville',
                        'code' => 'TANA_VILLE',
                        'disponible' => true,
                        'actif' => true,
                        'etablissements' => [
                            ['nom' => 'EPP Ampefiloha', 'type' => 'EPP', 'actif' => true],
                            ['nom' => 'EPP Analakely', 'type' => 'EPP', 'actif' => true],
                            ['nom' => 'CEG Faravohitra', 'type' => 'CEG', 'actif' => true],
                            ['nom' => 'CEG Isotry', 'type' => 'CEG', 'actif' => true],
                            ['nom' => 'Lycée Andohalo', 'type' => 'Lycée', 'actif' => true]
                        ]
                    ],
                    [
                        'nom' => 'Antananarivo Atsimondrano',
                        'code' => 'TANA_ATSIMONDRANO',
                        'disponible' => true,
                        'actif' => true,
                        'etablissements' => [
                            ['nom' => 'CEG Ambohimangakely', 'type' => 'CEG', 'actif' => true],
                            ['nom' => 'Lycée Nanisana', 'type' => 'Lycée', 'actif' => true]
                        ]
                    ],
                    [
                        'nom' => 'Antananarivo Avaradrano',
                        'code' => 'TANA_AVARADRANO',
                        'disponible' => true,
                        'actif' => true,
                        'etablissements' => [
                            ['nom' => 'EPP Ambohidratrimo', 'type' => 'EPP', 'actif' => true]
                        ]
                    ],
                    [
                        'nom' => 'Anjozorobe',
                        'code' => 'ANJOZOROBE',
                        'disponible' => false,
                        'actif' => true,
                        'etablissements' => []
                    ],
                    [
                        'nom' => 'Manjakandriana',
                        'code' => 'MANJAKANDRIANA',
                        'disponible' => false,
                        'actif' => true,
                        'etablissements' => []
                    ]
                ]
            ],
            [
                'nom' => 'Itasy',
                'code' => 'ITASY',
                'disponible' => false,
                'actif' => true,
                'ciscos' => []
            ],
            [
                'nom' => 'Bongolava',
                'code' => 'BONGOLAVA',
                'disponible' => false,
                'actif' => true,
                'ciscos' => []
            ]
        ];

        foreach ($drensData as $drenData) {
            // Créer la DREN
            $dren = Dren::create([
                'nom' => $drenData['nom'],
                'code' => $drenData['code'],
                'disponible' => $drenData['disponible'],
                'actif' => $drenData['actif']
            ]);

            // Créer les CISCOs pour cette DREN
            foreach ($drenData['ciscos'] as $ciscoData) {
                $cisco = Cisco::create([
                    'dren_id' => $dren->id,
                    'nom' => $ciscoData['nom'],
                    'code' => $ciscoData['code'],
                    'disponible' => $ciscoData['disponible'],
                    'actif' => $ciscoData['actif']
                ]);

                // Créer les établissements pour cette CISCO
                foreach ($ciscoData['etablissements'] as $etablissementData) {
                    Etablissement::create([
                        'cisco_id' => $cisco->id,
                        'nom' => $etablissementData['nom'],
                        'code' => strtoupper(str_replace([' ', '-'], ['_', '_'], $etablissementData['nom'])),
                        'type' => $etablissementData['type'],
                        'actif' => $etablissementData['actif']
                    ]);
                }
            }
        }

        $this->command->info('DRENs, CISCOs et établissements créés avec succès !');
    }
}
