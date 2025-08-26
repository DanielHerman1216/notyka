<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Candidat;
use App\Models\Resultat;
use App\Models\Examen;
use Illuminate\Support\Facades\DB;

class ResultatController extends Controller
{
    /**
     * Recherche de résultats par identifiant
     */
    public function search(Request $request)
    {
        $request->validate([
            'identifiant' => 'required|string|max:20',
            'examen' => 'required|exists:examens,id'
        ]);

        $identifiant = $request->identifiant;
        $examenId = $request->examen;

        // Rechercher le candidat
        $candidat = Candidat::where('identifiant', $identifiant)
            ->where('actif', true)
            ->with(['etablissement.cisco.dren'])
            ->first();

        if (!$candidat) {
            return back()->withErrors(['identifiant' => 'Aucun candidat trouvé avec cet identifiant.']);
        }

        // Rechercher le résultat
        $resultat = Resultat::where('candidat_id', $candidat->id)
            ->where('examen_id', $examenId)
            ->where('actif', true)
            ->with(['examen', 'serie', 'notes.matiere'])
            ->first();

        if (!$resultat) {
            return back()->withErrors(['identifiant' => 'Aucun résultat trouvé pour cet examen.']);
        }

        return view('resultats.show', compact('candidat', 'resultat'));
    }

    /**
     * Affiche un résultat par identifiant
     */
    public function show($identifiant)
    {
        $candidat = Candidat::where('identifiant', $identifiant)
            ->where('actif', true)
            ->with(['etablissement.cisco.dren'])
            ->first();

        if (!$candidat) {
            abort(404, 'Candidat non trouvé');
        }

        $resultats = $candidat->resultats()
            ->where('actif', true)
            ->with(['examen', 'serie', 'notes.matiere'])
            ->orderBy('annee_scolaire', 'desc')
            ->get();

        return view('resultats.candidat', compact('candidat', 'resultats'));
    }

    /**
     * Génère un PDF du résultat
     */
    public function pdf($identifiant)
    {
        $candidat = Candidat::where('identifiant', $identifiant)
            ->where('actif', true)
            ->with(['etablissement.cisco.dren'])
            ->first();

        if (!$candidat) {
            abort(404, 'Candidat non trouvé');
        }

        $resultat = Resultat::where('candidat_id', $candidat->id)
            ->where('actif', true)
            ->with(['examen', 'serie', 'notes.matiere'])
            ->first();

        if (!$resultat) {
            abort(404, 'Résultat non trouvé');
        }

        // TODO: Implémenter la génération PDF
        // Pour l'instant, on redirige vers la vue
        return view('resultats.pdf', compact('candidat', 'resultat'));
    }
}
