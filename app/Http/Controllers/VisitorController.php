<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dren;
use App\Models\Cisco;
use App\Models\Examen;
use App\Models\Serie;

class VisitorController extends Controller
{
    /**
     * Affiche l'interface visiteur
     */
    public function index()
    {
        $drens = Dren::where('actif', true)
            ->orderBy('nom', 'asc')
            ->get();

        return view('visitor.index', compact('drens'));
    }

    /**
     * Affiche les CISCOs d'une DREN
     */
    public function showDren(Dren $dren)
    {
        $ciscos = $dren->ciscos()
            ->where('actif', true)
            ->orderBy('nom', 'asc')
            ->get();

        return view('visitor.dren', compact('dren', 'ciscos'));
    }

    /**
     * Affiche les établissements d'une CISCO
     */
    public function showCisco(Cisco $cisco)
    {
        $etablissements = $cisco->etablissements()
            ->where('actif', true)
            ->orderBy('nom', 'asc')
            ->get();

    $examens = \App\Models\Examen::where('actif', true)->orderBy('date', 'asc')->get();
    return view('visitor.cisco', compact('cisco', 'etablissements', 'examens'));
    }

    /**
     * Affiche les informations sur les examens
     */
    public function examens()
    {
        $examens = Examen::where('actif', true)
            ->with(['series', 'mentions'])
            ->orderBy('date', 'asc')
            ->get();

        return view('visitor.examens', compact('examens'));
    }

    /**
     * Recherche de résultats
     */
    public function search(Request $request)
    {
        $request->validate([
            'identifiant' => 'required|string|max:20',
            'examen' => 'required|exists:examens,id'
        ]);

        // La logique de recherche sera implémentée dans ResultatController
        return redirect()->route('resultats.search', $request->all());
    }
    /**
     * Affiche la liste des admis et non admis d'un établissement
     */
    public function etablissementResultats(\App\Models\Etablissement $etablissement)
    {
        $admis = $etablissement->resultats()->where('resultat', 'Admis')->get();
        $nonAdmis = $etablissement->resultats()->where('resultat', 'Non Admis')->get();
        return view('visitor.etablissement-resultats', compact('etablissement', 'admis', 'nonAdmis'));
    }
}