<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback;

class FeedbackController extends Controller
{
    /**
     * Affiche le formulaire de feedback
     */
    public function create()
    {
        return view('feedback.create');
    }

    /**
     * Enregistre un nouveau feedback
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'sujet' => 'required|string|max:255',
            'message' => 'required|string|max:1000'
        ]);

        Feedback::create([
            'nom' => $request->nom,
            'email' => $request->email,
            'sujet' => $request->sujet,
            'message' => $request->message,
            'date' => now()->toDateString(),
            'statut' => 'nouveau',
            'actif' => true
        ]);

        return redirect()->route('feedback.success');
    }

    /**
     * Affiche la page de succès après envoi du feedback
     */
    public function success()
    {
        return view('feedback.success');
    }
}
