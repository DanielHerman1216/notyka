@extends('layouts.app')

@section('title', 'Recherche de Résultats - Notyka MEN')

@section('content')
<div class="container">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Accueil</a></li>
            <li class="breadcrumb-item active">Recherche de Résultats</li>
        </ol>
    </nav>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h4 class="mb-0">
                        <i class="fas fa-search me-2"></i>Recherche de Résultats
                    </h4>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-4">
                        Entrez votre numéro d'identifiant et sélectionnez le type d'examen pour consulter vos résultats.
                    </p>

                    <form action="{{ route('resultats.search') }}" method="GET" id="search-form">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="identifiant" class="form-label">
                                    <i class="fas fa-id-card me-1"></i>Numéro d'identifiant *
                                </label>
                                <input type="text" class="form-control" id="identifiant" name="identifiant" 
                                       value="{{ request('identifiant') }}" 
                                       placeholder="Ex: 123456" required>
                            </div>
                            
                            <div class="col-md-6">
                                <label for="examen" class="form-label">
                                    <i class="fas fa-graduation-cap me-1"></i>Type d'examen *
                                </label>
                                <select class="form-select" id="examen" name="examen" required>
                                    <option value="">Sélectionnez un examen</option>
                                    @foreach($examens as $examen)
                                        <option value="{{ $examen->id }}" {{ request('examen') == $examen->id ? 'selected' : '' }}>
                                            {{ $examen->nom }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="col-12 text-center">
                                <button type="submit" class="btn btn-success btn-lg">
                                    <i class="fas fa-search me-2"></i>Rechercher
                                </button>
                                <a href="{{ route('home') }}" class="btn btn-secondary btn-lg ms-2">
                                    <i class="fas fa-times me-2"></i>Annuler
                                </a>
                            </div>
                        </div>
                    </form>

                    @if(isset($resultat))
                        <hr class="my-4">
                        
                        @if($resultat)
                            <div class="alert alert-success">
                                <i class="fas fa-check-circle me-2"></i>
                                <strong>Résultat trouvé !</strong> Voici les détails de votre résultat.
                            </div>
                            
                            <div class="card result-card {{ strtolower($resultat->resultat) == 'admis' ? 'admis' : 'non-admis' }}">
                                <div class="card-header">
                                    <h5 class="mb-0">
                                        <i class="fas fa-user-graduate me-2"></i>
                                        {{ $resultat->candidat->nom }}
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <strong>Identifiant :</strong> {{ $resultat->candidat->identifiant }}
                                        </div>
                                        <div class="col-md-6">
                                            <strong>Établissement :</strong> {{ $resultat->candidat->etablissement->nom }}
                                        </div>
                                    </div>
                                    
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <strong>Examen :</strong> {{ $resultat->examen->nom }}
                                            @if($resultat->serie)
                                                ({{ $resultat->serie->nom }})
                                            @endif
                                        </div>
                                        <div class="col-md-6">
                                            <strong>Année scolaire :</strong> {{ $resultat->annee_scolaire }}
                                        </div>
                                    </div>
                                    
                                    <div class="row mb-3">
                                        <div class="col-md-4">
                                            <strong>Résultat :</strong>
                                            @if(strtolower($resultat->resultat) == 'admis')
                                                <span class="badge bg-success">{{ $resultat->resultat }}</span>
                                            @else
                                                <span class="badge bg-danger">{{ $resultat->resultat }}</span>
                                            @endif
                                        </div>
                                        <div class="col-md-4">
                                            <strong>Moyenne :</strong> {{ $resultat->moyenne }}/20
                                        </div>
                                        <div class="col-md-4">
                                            <strong>Mention :</strong>
                                            @if($resultat->mention)
                                                <span class="badge bg-warning text-dark">{{ $resultat->mention }}</span>
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </div>
                                    </div>
                                    
                                    @if($resultat->notes->count() > 0)
                                        <div class="mb-3">
                                            <strong>Notes détaillées :</strong>
                                            <div class="table-responsive mt-2">
                                                <table class="table table-sm table-bordered">
                                                    <thead class="table-light">
                                                        <tr>
                                                            <th>Matière</th>
                                                            <th>Note</th>
                                                            <th>Coefficient</th>
                                                            <th>Note pondérée</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($resultat->notes as $note)
                                                            <tr>
                                                                <td>{{ $note->matiere->nom }}</td>
                                                                <td>{{ $note->note }}/20</td>
                                                                <td>{{ $note->coefficient }}</td>
                                                                <td>{{ $note->note_ponderee }}/20</td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    @endif
                                    
                                    <div class="text-center">
                                        <button type="button" class="btn btn-primary btn-print">
                                            <i class="fas fa-print me-2"></i>Imprimer le Résultat
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="alert alert-warning">
                                <i class="fas fa-exclamation-triangle me-2"></i>
                                <strong>Aucun résultat trouvé.</strong> Vérifiez votre numéro d'identifiant et le type d'examen sélectionné.
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Validation du formulaire
    const form = document.getElementById('search-form');
    form.addEventListener('submit', function(e) {
        const identifiant = document.getElementById('identifiant').value.trim();
        const examen = document.getElementById('examen').value;
        
        if (!identifiant || !examen) {
            e.preventDefault();
            alert('Veuillez remplir tous les champs requis.');
        }
    });
    
    // Fonctionnalité d'impression
    const printButtons = document.querySelectorAll('.btn-print');
    printButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            window.print();
        });
    });
});
</script>
@endpush
@endsection
