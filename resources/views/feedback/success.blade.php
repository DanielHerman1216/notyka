@extends('layouts.app')

@section('title', 'Feedback Envoyé - Notyka MEN')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body text-center py-5">
                    <div class="mb-4">
                        <i class="fas fa-check-circle text-success" style="font-size: 4rem;"></i>
                    </div>
                    
                    <h2 class="text-success mb-3">Feedback Envoyé avec Succès !</h2>
                    
                    <p class="lead text-muted mb-4">
                        Merci pour votre feedback ! Nous avons bien reçu votre message et nous l'examinerons attentivement.
                    </p>
                    
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i>
                        <strong>Que se passe-t-il maintenant ?</strong><br>
                        Notre équipe va analyser votre feedback et vous répondre dans les plus brefs délais si nécessaire.
                    </div>
                    
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <a href="{{ route('home') }}" class="btn btn-primary btn-lg w-100">
                                <i class="fas fa-home me-2"></i>Retour à l'Accueil
                            </a>
                        </div>
                        <div class="col-md-6">
                            <a href="{{ route('feedback.create') }}" class="btn btn-outline-warning btn-lg w-100">
                                <i class="fas fa-plus me-2"></i>Nouveau Feedback
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
