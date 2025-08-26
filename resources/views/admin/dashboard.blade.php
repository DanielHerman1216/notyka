@extends('layouts.app')

@section('title', 'Tableau de Bord Admin - Notyka MEN')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="ministry-page-header text-center mb-4">
            <div class="row align-items-center">
                <div class="col-md-2">
                    <img src="{{ asset('assets/images/logos/LOGO.jpg') }}" alt="Logo MEN" class="admin-header-logo">
                </div>
                <div class="col-md-8">
                    <h3 class="ministry-page-title mb-1">MINISTÈRE DE L'ÉDUCATION NATIONALE</h3>
                    <p class="ministry-page-subtitle mb-0">Espace Administrateur - Gestion des Résultats</p>
                </div>
                <div class="col-md-2">
                    <img src="{{ asset('assets/images/logos/SAINA.png') }}" alt="SAINA" class="admin-header-emblem">
                </div>
            </div>
        </div>
        
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Accueil</a></li>
                        <li class="breadcrumb-item active">Tableau de Bord Admin</li>
                    </ol>
                </nav>
                <h2><i class="fas fa-tachometer-alt me-2"></i>Tableau de Bord Administrateur</h2>
            </div>
            <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                @csrf
                <button type="submit" class="btn btn-outline-danger">
                    <i class="fas fa-sign-out-alt me-2"></i>Déconnexion
                </button>
            </form>
        </div>
        
        <!-- Statistics Cards -->
        <div class="row g-4 mb-4">
            <div class="col-md-3">
                <div class="card dashboard-card">
                    <div class="card-body text-center">
                        <i class="fas fa-users fa-2x text-primary mb-2"></i>
                        <div class="stats-number">{{ $totalResults }}</div>
                        <p class="text-muted mb-0">Total Résultats</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card dashboard-card">
                    <div class="card-body text-center">
                        <i class="fas fa-check-circle fa-2x text-success mb-2"></i>
                        <div class="stats-number">{{ $admisCount }}</div>
                        <p class="text-muted mb-0">Admis</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card dashboard-card">
                    <div class="card-body text-center">
                        <i class="fas fa-times-circle fa-2x text-danger mb-2"></i>
                        <div class="stats-number">{{ $nonAdmisCount }}</div>
                        <p class="text-muted mb-0">Non Admis</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card dashboard-card">
                    <div class="card-body text-center">
                        <i class="fas fa-percentage fa-2x text-warning mb-2"></i>
                        <div class="stats-number">{{ $successRate }}%</div>
                        <p class="text-muted mb-0">Taux de Réussite</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Quick Actions -->
        <div class="row g-4 mb-4">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body text-center">
                        <i class="fas fa-comments fa-2x text-info mb-3"></i>
                        <h5>Gestion des Commentaires</h5>
                        <p class="text-muted">Consulter et répondre aux feedbacks</p>
                        <span class="badge bg-info mb-2">{{ $totalFeedback }} commentaire(s)</span><br>
                        <a href="{{ route('admin.feedbacks') }}" class="btn btn-info">
                            Voir les Commentaires
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body text-center">
                        <i class="fas fa-chart-bar fa-2x text-success mb-3"></i>
                        <h5>Statistiques Détaillées</h5>
                        <p class="text-muted">Voir les statistiques par examen</p>
                        <a href="{{ route('admin.statistics') }}" class="btn btn-success">
                            Voir Statistiques
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body text-center">
                        <i class="fas fa-cog fa-2x text-secondary mb-3"></i>
                        <h5>Configuration</h5>
                        <p class="text-muted">Gérer les paramètres système</p>
                        <a href="{{ route('admin.config') }}" class="btn btn-secondary">
                            <i class="fas fa-cog me-2"></i>Configuration
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Recent Activity -->
        <div class="card">
            <div class="card-header">
                <h5><i class="fas fa-clock me-2"></i>Activité Récente</h5>
            </div>
            <div class="card-body">
                <div class="list-group list-group-flush">
                    @forelse($recentFeedbacks->take(5) as $feedback)
                        <div class="list-group-item">
                            <div class="d-flex w-100 justify-content-between">
                                <h6 class="mb-1">{{ $feedback->nom }}</h6>
                                <small>{{ $feedback->date }}</small>
                            </div>
                            <p class="mb-1">{{ $feedback->sujet }}</p>
                            <small class="text-muted">{{ Str::limit($feedback->message, 100) }}...</small>
                        </div>
                    @empty
                        <div class="list-group-item text-center text-muted">
                            <i class="fas fa-inbox fa-2x mb-2"></i>
                            <p>Aucune activité récente</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.ministry-page-header {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    border-radius: 15px;
    padding: 2rem;
    margin-bottom: 2rem;
}

.ministry-page-title {
    font-size: 1.5rem;
    font-weight: 700;
    color: #1a1a1a;
}

.ministry-page-subtitle {
    font-size: 1rem;
    font-weight: 600;
    color: #6c757d;
}

.admin-header-logo, .admin-header-emblem {
    max-width: 60px;
    max-height: 60px;
}

.dashboard-card {
    border: none;
    border-radius: 15px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease;
}

.dashboard-card:hover {
    transform: translateY(-5px);
}

.stats-number {
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
}
</style>
@endsection
