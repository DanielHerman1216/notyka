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
            


            <!-- Choix du type d'établissement (boutons) -->
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-filter me-2"></i>Choisissez le type d'établissement</h5>
                </div>
                <div class="card-body text-center">
                    <div class="btn-group" role="group" aria-label="Choix type etablissement">
                        <button type="button" class="btn btn-outline-primary type-btn" data-type="CEPE">Établissements CEPE</button>
                        <button type="button" class="btn btn-outline-primary type-btn" data-type="BEPC">Établissements BEPC</button>
                        <button type="button" class="btn btn-outline-primary type-btn" data-type="BACC">Établissements BACC</button>
                    </div>
                </div>
            </div>

            <!-- Établissements filtrés -->

            <div class="row mb-5" id="etablissements-list" style="display:none;">
                <div class="col-12">
                    <h4 class="mb-3">
                        <i class="fas fa-school me-2"></i>Établissements de cette CISCO
                    </h4>
                    <div class="row g-3">
                        @forelse($etablissements as $etablissement)
                            @php
                                $dataType = '';
                                if(stripos($etablissement->nom, 'EPP') !== false) $dataType = 'CEPE';
                                elseif(stripos($etablissement->nom, 'CEG') !== false) $dataType = 'BEPC';
                                elseif(stripos($etablissement->nom, 'Lycée') !== false) $dataType = 'BACC';
                            @endphp
                            <div class="col-md-6 col-lg-4 etab-item" data-type="{{ $dataType }}">
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
                            <div class="modal fade" id="etabTypeModal" tabindex="-1" aria-labelledby="etabTypeModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="etabTypeModalLabel">Liste des établissements</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <ul class="list-group" id="etabTypeList"></ul>
                                        </div>
                                    </div>
                                </div>
                            </div>


            <script>
            document.addEventListener('DOMContentLoaded', function() {
                const btns = document.querySelectorAll('.type-btn');
                const items = document.querySelectorAll('.etab-item');
                const etabList = document.getElementById('etablissements-list');
                // Masquer tout au chargement
                etabList.style.display = 'none';
                items.forEach(function(item) { item.style.display = 'none'; });
                btns.forEach(function(btn) {
                    btn.addEventListener('click', function() {
                        const val = btn.getAttribute('data-type');
                        let found = false;
                        items.forEach(function(item) {
                            if (item.getAttribute('data-type') === val) {
                                item.style.display = '';
                                found = true;
                            } else {
                                item.style.display = 'none';
                            }
                        });
                        etabList.style.display = found ? '' : 'none';
                        btns.forEach(b => b.classList.remove('active'));
                        btn.classList.add('active');
                            // Afficher la liste complète dans la modale
                            let etabs = Array.from(items).filter(item => item.getAttribute('data-type') === val);
                            etabTypeList.innerHTML = '';
                            if(etabs.length > 0) {
                                etabs.forEach(function(item) {
                                    let name = item.querySelector('.card-title').textContent;
                                    let lieu = item.querySelector('.card-text').textContent;
                                    let link = item.querySelector('.clickable').getAttribute('onclick');
                                    // Extraire l'URL de l'onclick
                                    let urlMatch = link.match(/window.location='([^']+)'/);
                                    let url = urlMatch ? urlMatch[1] : '#';
                                    let li = document.createElement('li');
                                    li.className = 'list-group-item';
                                    li.innerHTML = `<a href="${url}" class="fw-bold">${name}</a> <span class="text-muted">${lieu}</span>`;
                                    etabTypeList.appendChild(li);
                                });
                            } else {
                                let li = document.createElement('li');
                                li.className = 'list-group-item text-danger';
                                li.textContent = 'Aucun établissement trouvé.';
                                etabTypeList.appendChild(li);
                            }
                            // Afficher la modale (Bootstrap 5)
                            if(window.bootstrap) {
                                let modal = bootstrap.Modal.getOrCreateInstance(etabTypeModal);
                                modal.show();
                            } else {
                                // fallback simple
                                etabTypeModal.style.display = 'block';
                            }
                    });
                });
            });
            </script>
            

            <!-- Recherche Rapide -->
            <div class="card mb-4">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0"><i class="fas fa-search me-2"></i>Recherche Rapide</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('resultats.search') }}" method="GET" class="row g-2 align-items-end">
                        <div class="col-md-5">
                            <input type="text" name="identifiant" class="form-control" placeholder="Nom ou identifiant..." required>
                        </div>
                        <div class="col-md-5">
                            <select name="examen" class="form-select" required>
                                <option value="">Type d'examen</option>
                                @foreach($examens as $examen)
                                    <option value="{{ $examen->id }}">{{ $examen->nom }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-success w-100">
                                <i class="fas fa-search me-2"></i>Recherche Rapide
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Actions -->
            <div class="row g-3">
                <div class="col-md-6">
                    <a href="{{ route('visitor.examens') }}" class="btn btn-info w-100">
                        <i class="fas fa-book me-2"></i>Informations sur les Examens
                    </a>
                </div>
                <div class="col-md-6">
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
