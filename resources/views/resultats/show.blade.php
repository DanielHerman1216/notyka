@extends('layouts.app')

@section('title', 'Résultat de la Recherche - Notyka MEN')

@section('content')
<div class="container">
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Accueil</a></li>
            <li class="breadcrumb-item"><a href="{{ route('resultats.search') }}">Recherche de Résultats</a></li>
            <li class="breadcrumb-item active">Résultat</li>
        </ol>
    </nav>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h4 class="mb-0">
                        <i class="fas fa-user-graduate me-2"></i>Résultat de la Recherche
                    </h4>
                </div>
                <div class="card-body">
                    <h5 class="mb-3">{{ $candidat->nom }} ({{ $candidat->identifiant }})</h5>
                    <p><strong>Établissement :</strong> {{ $candidat->etablissement->nom ?? 'N/A' }}</p>
                    <p><strong>Examen :</strong> {{ $resultat->examen->nom }} @if($resultat->serie) ({{ $resultat->serie->nom }}) @endif</p>
                    <p><strong>Résultat :</strong> <span class="badge {{ strtolower($resultat->resultat) == 'admis' ? 'bg-success' : 'bg-danger' }}">{{ $resultat->resultat }}</span></p>
                    <p><strong>Moyenne :</strong> {{ $resultat->moyenne }}</p>
                    <p><strong>Mention :</strong> {{ $resultat->mention ?? 'Aucune' }}</p>
                    <p><strong>Année scolaire :</strong> {{ $resultat->annee_scolaire }}</p>
                    <a href="{{ route('resultats.search') }}" class="btn btn-secondary mt-3"><i class="fas fa-arrow-left me-2"></i>Nouvelle recherche</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
