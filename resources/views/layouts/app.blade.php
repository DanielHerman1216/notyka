<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Notyka - Plateforme Officielle MEN')</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    
    @stack('styles')
</head>
<body>
    <!-- Header officiel du MEN -->
    <div class="ministry-header">
        <div class="container">
            <div class="row align-items-center py-3">
                <div class="col-md-2 text-center">
                    <div class="ministry-logo">
                        <img src="{{ asset('assets/images/logos/SAINA.png') }}" alt="Logo Officiel" class="img-fluid main-logo">
                    </div>
                </div>
                <div class="col-md-8 text-center">
                    <h1 class="ministry-title mb-1">MINISTÈRE DE L'ÉDUCATION NATIONALE</h1>
                    <h2 class="ministry-subtitle mb-0">RÉPUBLIQUE DE MADAGASCAR</h2>
                </div>
                <div class="col-md-2 text-center">
                    <!-- Espace pour logo supplémentaire si nécessaire -->
                </div>
            </div>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-success">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('home') }}">
                <i class="fas fa-graduation-cap me-2"></i>Notyka
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">
                            <i class="fas fa-home me-1"></i>Accueil
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('visitor.index') }}">
                            <i class="fas fa-search me-1"></i>Consulter
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('visitor.examens') }}">
                            <i class="fas fa-book me-1"></i>Examens
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('feedback.create') }}">
                            <i class="fas fa-comments me-1"></i>Feedback
                        </a>
                    </li>
                    @auth
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.dashboard') }}">
                                <i class="fas fa-user-shield me-1"></i>Admin
                            </a>
                        </li>
                        <li class="nav-item">
                            <form method="POST" action="{{ route('logout') }}" class="d-inline">
                                @csrf
                                <button type="submit" class="nav-link btn btn-link">
                                    <i class="fas fa-sign-out-alt me-1"></i>Déconnexion
                                </button>
                            </form>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">
                                <i class="fas fa-sign-in-alt me-1"></i>Connexion
                            </a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- Zone de notifications -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show m-3" role="alert">
            <i class="fas fa-check-circle me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show m-3" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i>
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show m-3" role="alert">
            <i class="fas fa-exclamation-triangle me-2"></i>
            <strong>Erreurs :</strong>
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Contenu principal -->
    <main class="py-4">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-dark text-light py-4 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="d-flex align-items-center mb-3">
                        <img src="{{ asset('assets/images/logos/LOGO.jpg') }}" alt="Logo MEN" class="footer-logo me-3">
                        <div>
                            <h6 class="mb-0">MINISTÈRE DE L'ÉDUCATION NATIONALE</h6>
                            <small class="text-muted">République de Madagascar</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <h6>Notyka © {{ date('Y') }}</h6>
                    <p class="small text-muted mb-0">Plateforme officielle de consultation des résultats d'examens</p>
                    <p class="small text-muted">Tous droits réservés</p>
                </div>
                <div class="col-md-4 text-md-end">
                    <div class="official-footer">
                        <p class="small text-muted mb-1">
                            <i class="fas fa-shield-alt me-1"></i>Site Officiel du MEN
                        </p>
                        <p class="small text-muted mb-1">
                            <i class="fas fa-certificate me-1"></i>Authentifié et Sécurisé
                        </p>
                        <p class="small text-warning mb-0">
                            <i class="fas fa-star me-1"></i>Service Public
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom JS -->
    <script src="{{ asset('js/app.js') }}"></script>
    
    @stack('scripts')
</body>
</html>
