@extends('layouts.app')

@section('title', 'Espace Visiteur - Notyka MEN')

@section('content')
<div class="row">
    <div class="col-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Accueil</a></li>
                <li class="breadcrumb-item active">Espace Visiteur</li>
            </ol>
        </nav>
        
        <h2 class="mb-4"><i class="fas fa-user-graduate me-2"></i>Espace Visiteur</h2>
        
        <div class="row g-4">
            <!-- DREN Selection -->
            <div class="col-12">
                <h4>Sélectionnez votre DREN</h4>
                <div class="row g-3">
                    @foreach($drens as $dren)
                        <div class="col-md-4">
                            <div class="card dren-card {{ !$dren->disponible ? 'disabled' : '' }}" 
                                 onclick="{{ $dren->disponible ? "window.location.href='".route('visitor.dren', $dren)."'" : '' }}">
                                <div class="card-body text-center">
                                    <i class="fas fa-map-marker-alt fa-2x mb-3 text-primary"></i>
                                    <h5>{{ $dren->nom }}</h5>
                                    @if($dren->disponible)
                                        <span class="badge bg-success">Disponible</span>
                                    @else
                                        <span class="badge bg-secondary">Indisponible</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            
            <!-- Quick Links -->
            <div class="col-12">
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body text-center">
                                <i class="fas fa-info-circle fa-2x mb-3 text-info"></i>
                                <h5>Informations sur les Examens</h5>
                                <p class="text-muted">Consultez les détails des examens CEPE, BEPC et BACC</p>
                                <a href="{{ route('visitor.examens') }}" class="btn btn-info">
                                    <i class="fas fa-book me-2"></i>Voir les Informations
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body text-center">
                                <i class="fas fa-comments fa-2x mb-3 text-warning"></i>
                                <h5>Feedback et Suggestions</h5>
                                <p class="text-muted">Envoyez-nous vos commentaires et suggestions</p>
                                <a href="{{ route('feedback.create') }}" class="btn btn-warning">
                                    <i class="fas fa-paper-plane me-2"></i>Envoyer un Feedback
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.dren-card {
    transition: all 0.3s ease;
    cursor: pointer;
}

.dren-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}

.dren-card.disabled {
    opacity: 0.6;
    background-color: #f8f9fa;
    cursor: not-allowed;
}
</style>
@endsection
