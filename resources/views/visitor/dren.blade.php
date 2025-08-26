@extends('layouts.app')

@section('title', 'DREN ' . $dren->nom . ' - Notyka MEN')

@section('content')
<div class="row">
    <div class="col-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Accueil</a></li>
                <li class="breadcrumb-item"><a href="{{ route('visitor.index') }}">Espace Visiteur</a></li>
                <li class="breadcrumb-item active">DREN {{ $dren->nom }}</li>
            </ol>
        </nav>
        
        <h2 class="mb-4"><i class="fas fa-map-marker-alt me-2"></i>DREN {{ $dren->nom }}</h2>
        
        <!-- CISCO Selection -->
        <div class="card mb-4">
            <div class="card-header">
                <h5><i class="fas fa-building me-2"></i>Sélection CISCO</h5>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    @foreach($ciscos as $cisco)
                        <div class="col-md-6 col-lg-4">
                            <a href="{{ route('visitor.cisco', $cisco) }}" class="btn btn-outline-primary w-100">
                                {{ $cisco->nom }}
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        
        <!-- Quick Actions -->
        <div class="row g-4 justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body text-center">
                        <i class="fas fa-search fa-2x mb-3 text-primary"></i>
                        <h5>Recherche Rapide</h5>
                        <p class="text-muted">Rechercher un résultat par nom ou identifiant</p>
                        <a href="{{ route('resultats.search') }}" class="btn btn-primary">
                            Rechercher
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Feedback Section -->
        <div class="mt-5">
            <div class="card">
                <div class="card-header">
                    <h5><i class="fas fa-comments me-2"></i>Commentaires et Suggestions</h5>
                </div>
                <div class="card-body">
                    <p class="text-muted">Votre avis nous intéresse ! Envoyez-nous vos commentaires et suggestions pour améliorer notre service.</p>
                    <a href="{{ route('feedback.create') }}" class="btn btn-warning">
                        <i class="fas fa-paper-plane me-2"></i>Envoyer un Commentaire
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
