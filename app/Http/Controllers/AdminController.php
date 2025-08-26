<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Resultat;
use App\Models\Feedback;
use App\Models\Notification;
use App\Models\Examen;
use App\Models\Dren;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    /**
     * Affiche la page de configuration système
     */
    public function config()
    {
        // À compléter plus tard avec les données dynamiques si besoin
        return view('admin.config');
    }

    /**
     * Affiche le tableau de bord administrateur
     */
    public function dashboard()
    {
        // Statistiques générales (préservation des données)
        $totalResults = Resultat::count();
        $admisCount = Resultat::where('resultat', 'Admis')->count();
        $nonAdmisCount = Resultat::where('resultat', 'Non Admis')->count();
        $successRate = $totalResults > 0 ? round(($admisCount / $totalResults) * 100, 1) : 0;
        $totalFeedback = Feedback::count();

        // Feedbacks récents pour l'activité récente
        $recentFeedbacks = Feedback::orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        return view('admin.dashboard', compact(
            'totalResults',
            'admisCount',
            'nonAdmisCount',
            'successRate',
            'totalFeedback',
            'recentFeedbacks'
        ));
    }

    /**
     * Affiche la liste des résultats
     */
    public function resultats(Request $request)
    {
        $query = Resultat::where('actif', true)
            ->with(['candidat.etablissement.cisco.dren', 'examen', 'serie']);

        // Filtres
        if ($request->filled('examen')) {
            $query->where('examen_id', $request->examen);
        }

        if ($request->filled('resultat')) {
            $query->where('resultat', $request->resultat);
        }

        if ($request->filled('dren')) {
            $query->whereHas('candidat.etablissement.cisco', function($q) use ($request) {
                $q->where('dren_id', $request->dren);
            });
        }

        $resultats = $query->orderBy('created_at', 'desc')->paginate(20);
        $examens = Examen::where('actif', true)->get();
        $drens = Dren::where('actif', true)->get();

        return view('admin.resultats', compact('resultats', 'examens', 'drens'));
    }

    /**
     * Affiche la liste des feedbacks
     */
    public function feedbacks(Request $request)
    {
        $query = Feedback::where('actif', true);

        // Filtres
        if ($request->filled('statut')) {
            $query->where('statut', $request->statut);
        }

        $feedbacks = $query->orderBy('created_at', 'desc')->paginate(20);

        return view('admin.feedbacks', compact('feedbacks'));
    }

    /**
     * Met à jour le statut d'un feedback
     */
    public function updateFeedbackStatus(Request $request, Feedback $feedback)
    {
        $request->validate([
            'statut' => 'required|in:nouveau,en_cours,traite'
        ]);

        $feedback->update(['statut' => $request->statut]);

        return back()->with('success', 'Statut du feedback mis à jour avec succès.');
    }

    /**
     * Répond à un feedback
     */
    public function repondreFeedback(Request $request, Feedback $feedback)
    {
        $request->validate([
            'reponse' => 'required|string|max:1000'
        ]);

        $feedback->update([
            'reponse' => $request->reponse,
            'statut' => 'traite'
        ]);

        return back()->with('success', 'Réponse envoyée avec succès.');
    }

    /**
     * Affiche les statistiques détaillées
     */
    public function statistics()
    {
        $stats = [
            'total_results' => Resultat::count(),
            'admis_count' => Resultat::where('resultat', 'Admis')->count(),
            'non_admis_count' => Resultat::where('resultat', 'Non Admis')->count(),
            'total_feedbacks' => Feedback::count(),
            'new_feedbacks' => Feedback::where('statut', 'nouveau')->count(),
        ];

        return view('admin.statistics', compact('stats'));
    }

    /**
     * Affiche la gestion des notifications
     */
    public function notifications()
    {
        $notifications = Notification::orderBy('created_at', 'desc')->paginate(20);

        return view('admin.notifications', compact('notifications'));
    }

    /**
     * Crée une nouvelle notification
     */
    public function storeNotification(Request $request)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'message' => 'required|string|max:1000',
            'type' => 'required|in:success,warning,info,error',
            'date' => 'required|date'
        ]);

        Notification::create([
            'titre' => $request->titre,
            'message' => $request->message,
            'type' => $request->type,
            'date' => $request->date,
            'actif' => true,
            'lu' => false
        ]);

        return back()->with('success', 'Notification créée avec succès.');
    }

    /**
     * Met à jour une notification
     */
    public function updateNotification(Request $request, Notification $notification)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'message' => 'required|string|max:1000',
            'type' => 'required|in:success,warning,info,error',
            'actif' => 'boolean'
        ]);

        $notification->update($request->all());

        return back()->with('success', 'Notification mise à jour avec succès.');
    }

    /**
     * Supprime une notification
     */
    public function deleteNotification(Notification $notification)
    {
        $notification->delete();

        return back()->with('success', 'Notification supprimée avec succès.');
    }
}
