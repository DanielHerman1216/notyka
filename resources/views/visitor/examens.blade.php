@extends('layouts.app')

@section('title', 'Informations sur les Examens - Notyka MEN')

@section('content')
<div class="container">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Accueil</a></li>
            <li class="breadcrumb-item active">Informations sur les Examens</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-12">
            <h2 class="mb-4">
                <i class="fas fa-book me-2"></i>Informations sur les Examens
            </h2>
            
            <!-- Examens disponibles -->
            <div class="row g-4">
                @foreach($examens as $examen)
                    <div class="col-lg-6">
                        <div class="card h-100">
                            <div class="card-header bg-primary text-white">
                                <h4 class="mb-0">
                                    <i class="fas fa-graduation-cap me-2"></i>{{ $examen->nom }}
                                </h4>
                            </div>
                            <div class="card-body">
                                <p class="card-text">{{ $examen->description }}</p>
                                
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <strong><i class="fas fa-calendar me-1"></i>Date :</strong>
                                        <p>{{ $examen->date }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <strong><i class="fas fa-level-up-alt me-1"></i>Niveau :</strong>
                                        <p>{{ $examen->niveau }}</p>
                                    </div>
                                </div>
                                
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <strong><i class="fas fa-clock me-1"></i>Durée :</strong>
                                        <p>{{ $examen->duree }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <strong><i class="fas fa-percentage me-1"></i>Note éliminatoire :</strong>
                                        <p>{{ $examen->note_eliminatoire }}/20</p>
                                    </div>
                                </div>
                                
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <strong><i class="fas fa-check-circle me-1"></i>Moyenne d'admission :</strong>
                                        <p>{{ $examen->moyenne_admission }}/20</p>
                                    </div>
                                    <div class="col-md-6">
                                        <strong><i class="fas fa-star me-1"></i>Statut :</strong>
                                        @if($examen->actif)
                                            <span class="badge bg-success">Actif</span>
                                        @else
                                            <span class="badge bg-secondary">Inactif</span>
                                        @endif
                                    </div>
                                </div>
                                
                                <!-- Matières -->
                                <div class="mb-3">
                                    <strong><i class="fas fa-list me-1"></i>Matières :</strong>
                                    <div class="mt-2">
                                        @if($examen->series->count() > 0)
                                            <!-- Examens avec séries (BACC) -->
                                            @foreach($examen->series as $serie)
                                                <div class="mb-2">
                                                    <strong class="text-info">{{ $serie->nom }} :</strong>
                                                    <div class="ms-3">
                                                        @foreach($serie->matieres as $matiere)
                                                            <span class="badge bg-light text-dark me-1 mb-1">
                                                                {{ $matiere->nom }}
                                                            </span>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                            <!-- Examens sans séries (CEPE, BEPC) -->
                                            @foreach($examen->matieres as $matiere)
                                                <span class="badge bg-light text-dark me-1 mb-1">
                                                    {{ $matiere->nom }}
                                                </span>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                                
                                <!-- Mentions -->
                                <div class="mb-3">
                                    <strong><i class="fas fa-trophy me-1"></i>Mentions :</strong>
                                    <div class="mt-2">
                                        @foreach($examen->mentions as $mention)
                                            <span class="badge bg-warning text-dark me-1 mb-1">
                                                {{ $mention->nom }} ({{ $mention->description }})
                                            </span>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-center">
                                <a href="{{ route('resultats.search') }}" class="btn btn-primary">
                                    <i class="fas fa-search me-2"></i>Consulter les Résultats
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            
            <!-- Retour -->
            <div class="text-center mt-4">
                <a href="{{ route('home') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-2"></i>Retour à l'Accueil
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
