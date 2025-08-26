@extends('layouts.app')

@section('title', 'Gestion des Commentaires - Admin Notyka MEN')

@section('content')
<div class="row">
    <div class="col-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Accueil</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard Admin</a></li>
                <li class="breadcrumb-item active">Gestion des Commentaires</li>
            </ol>
        </nav>
        
        <h2 class="mb-4"><i class="fas fa-comments me-2"></i>Gestion des Commentaires</h2>
        
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Liste des Commentaires</h5>
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left me-2"></i>Retour au Dashboard
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Nom</th>
                                <th>Email</th>
                                <th>Sujet</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($feedbacks as $feedback)
                                <tr>
                                    <td>{{ $feedback->date }}</td>
                                    <td><strong>{{ $feedback->nom }}</strong></td>
                                    <td>{{ $feedback->email }}</td>
                                    <td>{{ $feedback->sujet }}</td>
                                    <td>
                                        <a href="{{ route('admin.feedback.show', $feedback) }}" 
                                           class="btn btn-sm btn-outline-info me-1">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <button class="btn btn-sm btn-outline-danger me-1" 
                                                onclick="if(confirm('Êtes-vous sûr de vouloir supprimer ce commentaire ?')) { deleteFeedback({{ $feedback->id }}) }">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted">
                                        <i class="fas fa-inbox fa-2x mb-2"></i>
                                        <p>Aucun commentaire trouvé</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if($feedbacks->hasPages())
                    <div class="d-flex justify-content-center mt-4">
                        {{ $feedbacks->links() }}
                    </div>
                @endif
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
