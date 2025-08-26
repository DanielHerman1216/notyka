@extends('layouts.app')

@section('title', 'Envoyer un Feedback - Notyka MEN')

@section('content')
<div class="container">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Accueil</a></li>
            <li class="breadcrumb-item active">Feedback</li>
        </ol>
    </nav>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header bg-warning text-dark">
                    <h4 class="mb-0">
                        <i class="fas fa-comments me-2"></i>Envoyer un Feedback
                    </h4>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-4">
                        Votre avis est important pour nous ! Partagez vos suggestions, signalements de problèmes ou félicitations pour nous aider à améliorer la plateforme Notyka.
                    </p>

                    <form action="{{ route('feedback.store') }}" method="POST" class="needs-validation" novalidate>
                        @csrf
                        
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="nom" class="form-label">
                                    <i class="fas fa-user me-1"></i>Nom complet *
                                </label>
                                <input type="text" class="form-control @error('nom') is-invalid @enderror" 
                                       id="nom" name="nom" value="{{ old('nom') }}" required>
                                @error('nom')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-6">
                                <label for="email" class="form-label">
                                    <i class="fas fa-envelope me-1"></i>Email *
                                </label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                       id="email" name="email" value="{{ old('email') }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-12">
                                <label for="sujet" class="form-label">
                                    <i class="fas fa-tag me-1"></i>Sujet *
                                </label>
                                <input type="text" class="form-control @error('sujet') is-invalid @enderror" 
                                       id="sujet" name="sujet" value="{{ old('sujet') }}" 
                                       placeholder="Ex: Amélioration de l'interface, Problème d'affichage, Félicitations..." required>
                                @error('sujet')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-12">
                                <label for="message" class="form-label">
                                    <i class="fas fa-comment me-1"></i>Message *
                                </label>
                                <textarea class="form-control @error('message') is-invalid @enderror" 
                                          id="message" name="message" rows="6" 
                                          placeholder="Décrivez votre feedback en détail..." required>{{ old('message') }}</textarea>
                                @error('message')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-12">
                                <div class="alert alert-info">
                                    <i class="fas fa-info-circle me-2"></i>
                                    <strong>Note :</strong> Tous les champs marqués d'un * sont obligatoires. 
                                    Nous nous efforçons de répondre à tous les feedbacks dans les plus brefs délais.
                                </div>
                            </div>
                            
                            <div class="col-12 text-center">
                                <button type="submit" class="btn btn-warning btn-lg">
                                    <i class="fas fa-paper-plane me-2"></i>Envoyer le Feedback
                                </button>
                                <a href="{{ route('home') }}" class="btn btn-secondary btn-lg ms-2">
                                    <i class="fas fa-times me-2"></i>Annuler
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
// Validation côté client
(function() {
    'use strict';
    window.addEventListener('load', function() {
        var forms = document.getElementsByClassName('needs-validation');
        var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    }, false);
})();
</script>
@endpush
@endsection
