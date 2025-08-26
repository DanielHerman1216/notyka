@extends('layouts.app')

@section('title', 'Statistiques - Admin Notyka MEN')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2><i class="fas fa-chart-bar me-2"></i>Statistiques</h2>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-2"></i>Retour au Tableau de Bord
            </a>
        </div>

        <!-- Statistiques générales -->
        <div class="row g-4 mb-4">
            <div class="col-md-3">
                <div class="card bg-primary text-white">
                    <div class="card-body text-center">
                        <i class="fas fa-users fa-2x mb-2"></i>
                        <h3>{{ $stats['total_results'] }}</h3>
                        <p class="mb-0">Total Résultats</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-success text-white">
                    <div class="card-body text-center">
                        <i class="fas fa-check-circle fa-2x mb-2"></i>
                        <h3>{{ $stats['admis_count'] }}</h3>
                        <p class="mb-0">Admis</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-danger text-white">
                    <div class="card-body text-center">
                        <i class="fas fa-times-circle fa-2x mb-2"></i>
                        <h3>{{ $stats['non_admis_count'] }}</h3>
                        <p class="mb-0">Non Admis</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-warning text-dark">
                    <div class="card-body text-center">
                        <i class="fas fa-comments fa-2x mb-2"></i>
                        <h3>{{ $stats['total_feedbacks'] }}</h3>
                        <p class="mb-0">Feedbacks</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Graphiques et détails -->
        <div class="row g-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="fas fa-chart-pie me-2"></i>Répartition des Résultats</h5>
                    </div>
                    <div class="card-body">
                        <canvas id="resultsChart" width="400" height="200"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="fas fa-chart-line me-2"></i>Évolution des Feedbacks</h5>
                    </div>
                    <div class="card-body">
                        <canvas id="feedbacksChart" width="400" height="200"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tableau des statistiques détaillées avancé -->
        <div class="card mt-4 shadow-lg border-0">
            <div class="card-header bg-gradient-primary text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class="fas fa-table me-2"></i>Statistiques Détaillées</h5>
                <div>
                    <input type="text" class="form-control d-inline-block w-auto me-2" placeholder="Recherche..." style="min-width:180px;display:inline-block;">
                    <select class="form-select d-inline-block w-auto me-2" style="min-width:150px;display:inline-block;">
                        <option>Filtrer par Examen</option>
                        <option>BEPC</option>
                        <option>BAC</option>
                        <option>CEPE</option>
                    </select>
                    <button class="btn btn-outline-primary btn-sm"><i class="fas fa-file-export me-1"></i>Exporter</button>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle table-striped table-bordered rounded">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Métrique</th>
                                <th>Valeur</th>
                                <th>Pourcentage</th>
                                <th>Détail</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td><b>Total Résultats</b></td>
                                <td>{{ $stats['total_results'] }}</td>
                                <td><span class="badge bg-primary">100%</span></td>
                                <td><button class="btn btn-outline-info btn-sm"><i class="fas fa-eye"></i></button></td>
                            </tr>
                            <tr class="table-success">
                                <td>2</td>
                                <td><b>Admis</b></td>
                                <td>{{ $stats['admis_count'] }}</td>
                                <td><span class="badge bg-success">{{ $stats['total_results'] > 0 ? round(($stats['admis_count'] / $stats['total_results']) * 100, 1) : 0 }}%</span></td>
                                <td><button class="btn btn-outline-info btn-sm"><i class="fas fa-eye"></i></button></td>
                            </tr>
                            <tr class="table-danger">
                                <td>3</td>
                                <td><b>Non Admis</b></td>
                                <td>{{ $stats['non_admis_count'] }}</td>
                                <td><span class="badge bg-danger">{{ $stats['total_results'] > 0 ? round(($stats['non_admis_count'] / $stats['total_results']) * 100, 1) : 0 }}%</span></td>
                                <td><button class="btn btn-outline-info btn-sm"><i class="fas fa-eye"></i></button></td>
                            </tr>
                            <tr class="table-warning">
                                <td>4</td>
                                <td><b>Feedbacks Nouveaux</b></td>
                                <td>{{ $stats['new_feedbacks'] }}</td>
                                <td><span class="badge bg-warning text-dark">{{ $stats['total_feedbacks'] > 0 ? round(($stats['new_feedbacks'] / $stats['total_feedbacks']) * 100, 1) : 0 }}%</span></td>
                                <td><button class="btn btn-outline-info btn-sm"><i class="fas fa-eye"></i></button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="text-end mt-3">
                    <button class="btn btn-outline-secondary btn-sm"><i class="fas fa-sync-alt me-1"></i>Actualiser</button>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Graphique des résultats
const resultsCtx = document.getElementById('resultsChart').getContext('2d');
new Chart(resultsCtx, {
    type: 'pie',
    data: {
        labels: ['Admis', 'Non Admis'],
        datasets: [{
            data: [{{ $stats['admis_count'] }}, {{ $stats['non_admis_count'] }}],
            backgroundColor: ['#28a745', '#dc3545'],
            borderWidth: 2
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                position: 'bottom'
            }
        }
    }
});

// Graphique des feedbacks (exemple simple)
const feedbacksCtx = document.getElementById('feedbacksChart').getContext('2d');
new Chart(feedbacksCtx, {
    type: 'bar',
    data: {
        labels: ['Total', 'Nouveaux'],
        datasets: [{
            label: 'Feedbacks',
            data: [{{ $stats['total_feedbacks'] }}, {{ $stats['new_feedbacks'] }}],
            backgroundColor: ['#ffc107', '#007bff'],
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
</script>
@endpush
@endsection
