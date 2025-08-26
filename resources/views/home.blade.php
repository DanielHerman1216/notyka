@extends('layouts.app')

@section('title', 'Notyka - Plateforme Officielle MEN | Consultation des Résultats d\'Examens')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="text-center mb-5">
            <div class="official-seal mb-4">
                <img src="{{ asset('assets/images/logos/LOGO.jpg') }}" alt="Sceau Officiel" class="official-seal-img">
            </div>
            <h1 class="display-4 text-primary mb-3">
                <i class="fas fa-graduation-cap"></i> Notyka
            </h1>
            <p class="lead text-muted mb-2">
                Plateforme Officielle de Consultation des Résultats d'Examens
            </p>
            <p class="text-secondary mb-3">
                Consultez facilement vos résultats CEPE, BEPC et BACC
            </p>
            <div class="ministry-badge">
                <span class="badge bg-primary px-3 py-2">
                    <i class="fas fa-shield-alt me-2"></i>PLATEFORME OFFICIELLE - MEN
                </span>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-md-6">
                <div class="card h-100 shadow-sm border-0">
                    <div class="card-body text-center p-4">
                        <div class="mb-3">
                            <i class="fas fa-user-graduate fa-3x text-success"></i>
                        </div>
                        <h5 class="card-title">Espace Visiteur</h5>
                        <p class="card-text text-muted">
                            Consultez les résultats d'examens, accédez aux informations officielles et envoyez vos suggestions.
                        </p>
                        <a href="{{ route('visitor.index') }}" class="btn btn-success btn-lg">
                            <i class="fas fa-search me-2"></i>Consulter les Résultats
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card h-100 shadow-sm border-0">
                    <div class="card-body text-center p-4">
                        <div class="mb-3">
                            <i class="fas fa-user-shield fa-3x text-warning"></i>
                        </div>
                        <h5 class="card-title">Espace Administrateur</h5>
                        <p class="card-text text-muted">
                            Accédez au tableau de bord, consultez les statistiques et gérez les commentaires des utilisateurs.
                        </p>
                        <a href="{{ route('login') }}" class="btn btn-warning btn-lg">
                            <i class="fas fa-sign-in-alt me-2"></i>Connexion Admin
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
