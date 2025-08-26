
<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\VisitorController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ResultatController;
use App\Http\Controllers\FeedbackController;

/*
|--------------------------------------------------------------------------
| Web Routes - Notyka MEN
|--------------------------------------------------------------------------
|
| Routes pour la plateforme officielle de consultation des résultats d'examens
| du Ministère de l'Éducation Nationale de Madagascar
|
*/

// Route d'accueil
Route::get('/', [HomeController::class, 'index'])->name('home');

// Routes visiteur
Route::prefix('visitor')->group(function () {
    Route::get('/', [VisitorController::class, 'index'])->name('visitor.index');
    Route::get('/dren/{dren}', [VisitorController::class, 'showDren'])->name('visitor.dren');
    Route::get('/cisco/{cisco}', [VisitorController::class, 'showCisco'])->name('visitor.cisco');
    Route::get('/examens', [VisitorController::class, 'examens'])->name('visitor.examens');
    Route::get('/search', [VisitorController::class, 'search'])->name('visitor.search');
    Route::get('/etablissement/{etablissement}/resultats', [VisitorController::class, 'etablissementResultats'])->name('visitor.etablissement.resultats');
});

// Routes pour les résultats
Route::prefix('resultats')->group(function () {
    Route::get('/search', [ResultatController::class, 'search'])->name('resultats.search');
    Route::get('/{identifiant}', [ResultatController::class, 'show'])->name('resultats.show');
    Route::get('/{identifiant}/pdf', [ResultatController::class, 'pdf'])->name('resultats.pdf');
});

// Routes pour les feedbacks
Route::prefix('feedback')->group(function () {
    Route::get('/', [FeedbackController::class, 'create'])->name('feedback.create');
    Route::post('/', [FeedbackController::class, 'store'])->name('feedback.store');
    Route::get('/success', [FeedbackController::class, 'success'])->name('feedback.success');
});

// Routes administrateur (authentification custom backup)
Route::middleware('admin')->prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/resultats', [AdminController::class, 'resultats'])->name('admin.resultats');
    Route::get('/feedbacks', [AdminController::class, 'feedbacks'])->name('admin.feedbacks');
    Route::get('/statistiques', [AdminController::class, 'statistiques'])->name('admin.statistiques');
    Route::get('/notifications', [AdminController::class, 'notifications'])->name('admin.notifications');
    Route::get('/config', [AdminController::class, 'config'])->name('admin.config');
    // Gestion des feedbacks
    Route::put('/feedbacks/{feedback}/status', [AdminController::class, 'updateFeedbackStatus'])->name('admin.feedbacks.status');
    Route::put('/feedbacks/{feedback}/reponse', [AdminController::class, 'repondreFeedback'])->name('admin.feedbacks.reponse');
    // Gestion des notifications
    Route::post('/notifications', [AdminController::class, 'storeNotification'])->name('admin.notifications.store');
    Route::put('/notifications/{notification}', [AdminController::class, 'updateNotification'])->name('admin.notifications.update');
    Route::delete('/notifications/{notification}', [AdminController::class, 'deleteNotification'])->name('admin.notifications.delete');
});

// Routes d'authentification simples (temporaires)
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', function (Request $request) {
    $username = $request->input('username');
    $password = $request->input('password');
    
    // Authentification simple comme dans le backup
    if ($username === 'admin' && $password === 'admin123') {
        session(['admin_logged_in' => true, 'admin_username' => 'admin']);
        return redirect()->route('admin.dashboard')->with('success', 'Connexion réussie ! Bienvenue dans l\'espace administrateur.');
    } else {
        return back()->with('error', 'Nom d\'utilisateur ou mot de passe incorrect.');
    }
})->name('login.post');

Route::post('/logout', function () {
    session()->forget(['admin_logged_in', 'admin_username']);
    return redirect()->route('home')->with('success', 'Déconnexion réussie !');
})->name('logout');

// Routes Admin (protégées)
Route::middleware('admin')->group(function () {
    Route::get('/admin/dashboard', [App\Http\Controllers\AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/feedbacks', [App\Http\Controllers\AdminController::class, 'feedbacks'])->name('admin.feedbacks');
    Route::get('/admin/statistics', [App\Http\Controllers\AdminController::class, 'statistics'])->name('admin.statistics');
    Route::get('/admin/feedback/{feedback}', [App\Http\Controllers\AdminController::class, 'feedbacks'])->name('admin.feedback.show');
    Route::patch('/admin/feedback/{feedback}/status', [App\Http\Controllers\AdminController::class, 'updateFeedbackStatus'])->name('admin.feedback.update-status');
    Route::patch('/admin/feedback/{feedback}/repondre', [App\Http\Controllers\AdminController::class, 'repondreFeedback'])->name('admin.feedback.repondre');
});
