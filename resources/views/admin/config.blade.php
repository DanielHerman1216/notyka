@extends('layouts.app')

@section('title', 'Configuration Système - Notyka MEN')

@section('content')
<div class="page-content active" id="system-config-page">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard Admin</a></li>
                            <li class="breadcrumb-item active">Configuration Système</li>
                        </ol>
                    </nav>
                    <h2><i class="fas fa-cog me-2"></i>Configuration Système</h2>
                </div>
                <!-- Bouton déconnexion supprimé pour éviter la déconnexion sur la page configuration -->
            </div>
            <div class="row g-4">
                <!-- Notification Settings -->
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0"><i class="fas fa-bell me-2"></i>Gestion des Notifications</h5>
                        </div>
                        <div class="card-body">
                            <form>
                                <div class="mb-3">
                                    <label class="form-label">Titre de la notification</label>
                                    <input type="text" class="form-control" placeholder="Entrez le titre...">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Message</label>
                                    <textarea class="form-control" rows="3" placeholder="Entrez le message..."></textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Type</label>
                                    <select class="form-select">
                                        <option value="info">Information</option>
                                        <option value="success">Succès</option>
                                        <option value="warning">Avertissement</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" checked>
                                        <label class="form-check-label">
                                            Notification active
                                        </label>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-plus me-2"></i>Ajouter Notification
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Current Notifications -->
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header bg-info text-white">
                            <h5 class="mb-0"><i class="fas fa-list me-2"></i>Notifications Actuelles</h5>
                        </div>
                        <div class="card-body">
                            <div id="current-notifications">
                                <!-- Liste des notifications dynamiques à intégrer -->
                                <div class="border rounded p-3 mb-3">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div>
                                            <h6>Exemple Notification</h6>
                                            <p class="mb-1 text-muted">Ceci est un exemple de notification.</p>
                                            <small class="text-secondary">26/08/2025</small>
                                        </div>
                                        <div>
                                            <span class="badge bg-info me-2">info</span>
                                            <button class="btn btn-sm btn-outline-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="form-check mt-2">
                                        <input class="form-check-input" type="checkbox" checked>
                                        <label class="form-check-label">Active</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- DREN Management -->
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header bg-success text-white">
                            <h5 class="mb-0"><i class="fas fa-map-marker-alt me-2"></i>Gestion des DREN</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-sm">
                                    <thead>
                                        <tr>
                                            <th>DREN</th>
                                            <th>Statut</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><strong>Exemple DREN</strong></td>
                                            <td>
                                                <span class="badge bg-success">Disponible</span>
                                            </td>
                                            <td>
                                                <button class="btn btn-sm btn-outline-primary">
                                                    <i class="fas fa-toggle-on"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- System Information -->
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header bg-warning text-dark">
                            <h5 class="mb-0"><i class="fas fa-info-circle me-2"></i>Informations Système</h5>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled">
                                <li class="mb-2"><strong>Version:</strong> Notyka v1.0</li>
                                <li class="mb-2"><strong>Dernière mise à jour:</strong> 26/08/2025</li>
                                <li class="mb-2"><strong>Nombre de résultats:</strong> ...</li>
                                <li class="mb-2"><strong>Nombre d'examens:</strong> ...</li>
                                <li class="mb-2"><strong>Feedback reçus:</strong> ...</li>
                                <li class="mb-2"><strong>Notifications actives:</strong> ...</li>
                            </ul>
                            <hr>
                            <div class="d-grid gap-2">
                                <button class="btn btn-outline-primary">
                                    <i class="fas fa-download me-2"></i>Exporter les Données
                                </button>
                                <button class="btn btn-outline-warning">
                                    <i class="fas fa-refresh me-2"></i>Vider le Cache
                                </button>
                                <button class="btn btn-outline-info">
                                    <i class="fas fa-file-alt me-2"></i>Voir les Logs
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
