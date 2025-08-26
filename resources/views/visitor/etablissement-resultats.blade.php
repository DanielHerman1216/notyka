@extends('layouts.app')
@section('title', 'Résultats - ' . $etablissement->nom)
@section('content')
<div class="container">
    <h2 class="mb-4">Résultats pour {{ $etablissement->nom }}</h2>
    <div class="row">
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0"><i class="fas fa-check-circle me-2"></i>Admis</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        @forelse($admis as $resultat)
                            <li class="list-group-item">
                                {{ $resultat->candidat->nom }} {{ $resultat->candidat->prenoms }}
                                <span class="badge bg-success float-end">Admis</span>
                            </li>
                        @empty
                            <li class="list-group-item text-muted">Aucun admis</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header bg-danger text-white">
                    <h5 class="mb-0"><i class="fas fa-times-circle me-2"></i>Non Admis</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        @forelse($nonAdmis as $resultat)
                            <li class="list-group-item">
                                {{ $resultat->candidat->nom }} {{ $resultat->candidat->prenoms }}
                                <span class="badge bg-danger float-end">Non Admis</span>
                            </li>
                        @empty
                            <li class="list-group-item text-muted">Aucun non admis</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <a href="{{ url()->previous() }}" class="btn btn-secondary mt-4"><i class="fas fa-arrow-left me-2"></i>Retour</a>
</div>
@endsection
