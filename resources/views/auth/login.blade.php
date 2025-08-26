@extends('layouts.app')

@section('title', 'Connexion Admin - Notyka MEN')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6 col-lg-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Accueil</a></li>
                <li class="breadcrumb-item active">Connexion Admin</li>
            </ol>
        </nav>
        
        <div class="card">
            <div class="card-header bg-warning text-dark text-center">
                <h4 class="mb-0"><i class="fas fa-user-shield me-2"></i>Connexion Administrateur</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('login.post') }}">
                    @csrf
                    
                    <div class="mb-3">
                        <label class="form-label">Nom d'utilisateur</label>
                        <input type="text" class="form-control" id="adminUsername" name="username" required 
                               placeholder="Entrez votre nom d'utilisateur">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Mot de passe</label>
                        <input type="password" class="form-control" id="adminPassword" name="password" required 
                               placeholder="Entrez votre mot de passe">
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-warning">
                            <i class="fas fa-sign-in-alt me-2"></i>Se connecter
                        </button>
                    </div>
                </form>
                
                <hr>
                <div class="text-center">
                    <small class="text-muted">
                        <strong>Démonstration:</strong><br>
                        Utilisateur: admin<br>
                        Mot de passe: admin123
                    </small>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
