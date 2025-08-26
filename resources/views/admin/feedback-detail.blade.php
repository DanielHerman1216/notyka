@extends('layouts.app')

@section('title', 'Détails du Commentaire - Admin Notyka MEN')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard Admin</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.feedbacks') }}">Gestion des Commentaires</a></li>
                <li class="breadcrumb-item active">Détails du Commentaire</li>
            </ol>
        </nav>
        
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2><i class="fas fa-eye me-2"></i>Détails du Commentaire</h2>
            <div>
                <a href="{{ route('admin.feedbacks') }}" class="btn btn-outline-secondary me-2">
                    <i class="fas fa-arrow-left me-2"></i>Retour
                </a>
                <button class="btn btn-outline-danger" onclick="if(confirm('Êtes-vous sûr de vouloir supprimer ce commentaire ?')) { deleteFeedback({{ $feedback->id }}) }">
                    <i class="fas fa-trash me-2"></i>Supprimer
                </button>
            </div>
        </div>
        
        <div class="card">
            <div class="card-header bg-primary text-white">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0"><i class="fas fa-comment me-2"></i>{{ $feedback->sujet }}</h5>
                    <span class="badge bg-light text-dark">{{ $feedback->date }}</span>
                </div>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <h6><i class="fas fa-user me-2"></i>Informations de Contact</h6>
                        <table class="table table-borderless table-sm">
                            <tr>
                                <td><strong>Nom :</strong></td>
                                <td>{{ $feedback->nom }}</td>
                            </tr>
                            <tr>
                                <td><strong>Email :</strong></td>
                                <td>{{ $feedback->email }}</td>
                            </tr>
                            <tr>
                                <td><strong>Date :</strong></td>
                                <td>{{ $feedback->date }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <h6><i class="fas fa-info-circle me-2"></i>Détails du Message</h6>
                        <table class="table table-borderless table-sm">
                            <tr>
                                <td><strong>Sujet :</strong></td>
                                <td>{{ $feedback->sujet }}</td>
                            </tr>
                            <tr>
                                <td><strong>Statut :</strong></td>
                                <td>
                                    @if($feedback->statut == 'nouveau')
                                        <span class="badge bg-primary">{{ $feedback->statut }}</span>
                                    @elseif($feedback->statut == 'en_cours')
                                        <span class="badge bg-warning">{{ $feedback->statut }}</span>
                                    @else
                                        <span class="badge bg-success">{{ $feedback->statut }}</span>
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                
                <div class="mb-4">
                    <h6><i class="fas fa-envelope me-2"></i>Message</h6>
                    <div class="alert alert-light">
                        {{ $feedback->message }}
                    </div>
                </div>

                @if($feedback->reponse)
                    <div class="mb-4">
                        <h6><i class="fas fa-reply me-2"></i>Réponse</h6>
                        <div class="alert alert-success">
                            {{ $feedback->reponse }}
                        </div>
                    </div>
                @endif

                <!-- Actions -->
                <div class="card">
                    <div class="card-header">
                        <h6 class="mb-0"><i class="fas fa-cogs me-2"></i>Actions</h6>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <form method="POST" action="{{ route('admin.feedback.update-status', $feedback) }}">
                                    @csrf
                                    @method('PATCH')
                                    <label for="statut" class="form-label">Changer le statut</label>
                                    <select name="statut" id="statut" class="form-select mb-2">
                                        <option value="nouveau" {{ $feedback->statut == 'nouveau' ? 'selected' : '' }}>Nouveau</option>
                                        <option value="en_cours" {{ $feedback->statut == 'en_cours' ? 'selected' : '' }}>En cours</option>
                                        <option value="traite" {{ $feedback->statut == 'traite' ? 'selected' : '' }}>Traité</option>
                                    </select>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save me-2"></i>Mettre à jour
                                    </button>
                                </form>
                            </div>
                            
                            @if(!$feedback->reponse)
                                <div class="col-md-8">
                                    <form method="POST" action="{{ route('admin.feedback.repondre', $feedback) }}">
                                        @csrf
                                        @method('PATCH')
                                        <label for="reponse" class="form-label">Répondre au commentaire</label>
                                        <textarea name="reponse" id="reponse" class="form-control mb-2" rows="4" 
                                                  placeholder="Tapez votre réponse ici..."></textarea>
                                        <button type="submit" class="btn btn-success">
                                            <i class="fas fa-paper-plane me-2"></i>Envoyer la réponse
                                        </button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function deleteFeedback(id) {
    if (confirm('Êtes-vous sûr de vouloir supprimer ce commentaire ?')) {
        // Ici vous pouvez ajouter une requête AJAX pour supprimer le feedback
        alert('Fonctionnalité de suppression en cours de développement');
    }
}
</script>
@endsection
