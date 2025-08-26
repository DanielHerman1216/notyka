@extends('layouts.app')

@section('title', 'Établissements - ' . $cisco->nom . ' - Notyka MEN')

@section('content')
<div class="container">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Accueil</a></li>
            <li class="breadcrumb-item"><a href="{{ route('visitor.index') }}">Espace Visiteur</a></li>
            <li class="breadcrumb-item"><a href="{{ route('visitor.dren', $cisco->dren) }}">{{ $cisco->dren->nom }}</a></li>
            <li class="breadcrumb-item active">{{ $cisco->nom }}</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-12">
            <h2 class="mb-4">
                <i class="fas fa-building me-2"></i>{{ $cisco->nom }}
            </h2>
            
            <!-- Informations sur la CISCO -->
            <div class="card mb-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <strong>DREN :</strong> {{ $cisco->dren->nom }}
                        </div>
                        <div class="col-md-6">
                            <strong>Code :</strong> {{ $cisco->code ?? 'Non défini' }}
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Établissements -->
            <div class="row mb-5">
                <div class="col-12">
                    <h4 class="mb-3">
                        <i class="fas fa-school me-2"></i>Établissements de cette CISCO
                    </h4>
                    <div class="row g-3">
                        @forelse($etablissements as $etablissement)
                            <div class="col-md-6 col-lg-4">
                                <div class="card etablissement-card" style="cursor:pointer" onclick="window.location='{{ route('visitor.etablissement.resultats', $etablissement) }}'">
                                    <div class="card-body text-center">
                                        <i class="fas fa-school fa-2x mb-3 text-primary"></i>
                                        <h5>{{ $etablissement->nom }}</h5>
                                        <p class="text-muted mb-2">
                                            <strong>Type :</strong> {{ $etablissement->type ?? 'Non défini' }}
                                        </p>
                                        @if($etablissement->code)
                                            <p class="text-muted mb-2">
                                                <strong>Code :</strong> {{ $etablissement->code }}
                                            </p>
                                        @endif
                                        @if($etablissement->adresse)
                                            <p class="text-muted mb-2">
                                                <strong>Adresse :</strong> {{ $etablissement->adresse }}
                                            </p>
                                        @endif
                                        @if($etablissement->telephone)
                                            <p class="text-muted mb-2">
                                                <strong>Téléphone :</strong> {{ $etablissement->telephone }}
                                            </p>
                                        @endif
                                        <span class="badge bg-success">Actif</span>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12">
                                <div class="alert alert-info">
                                    <i class="fas fa-info-circle me-2"></i>
                                    Aucun établissement disponible pour cette CISCO.
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
            
            <!-- Actions -->
            <div class="row g-3">
                <div class="col-md-4">
                    <a href="{{ route('resultats.search') }}" class="btn btn-success w-100">
                        <i class="fas fa-search me-2"></i>Rechercher des Résultats
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="{{ route('visitor.examens') }}" class="btn btn-info w-100">
                        <i class="fas fa-book me-2"></i>Informations sur les Examens
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="{{ route('feedback.create') }}" class="btn btn-warning w-100">
                        <i class="fas fa-comments me-2"></i>Envoyer un Feedback
                    </a>
                </div>
            </div>
            
            <!-- Retour -->
            <div class="text-center mt-4">
                <a href="{{ route('visitor.dren', $cisco->dren) }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-2"></i>Retour à {{ $cisco->dren->nom }}
                </a>
            </div>
        </div>
    </div>
</div>

<style>
.etablissement-card {
    transition: all 0.3s ease;
    cursor: pointer;
}

.etablissement-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}
</style>
@endsection
