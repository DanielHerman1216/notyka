<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;
use App\Models\Examen;

class HomeController extends Controller
{
    /**
     * Affiche la page d'accueil de Notyka
     */
    public function index()
    {
        // Récupérer les notifications actives
        $notifications = Notification::where('actif', true)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Récupérer les examens actifs
        $examens = Examen::where('actif', true)
            ->orderBy('date', 'asc')
            ->get();

        return view('home', compact('notifications', 'examens'));
    }
}
