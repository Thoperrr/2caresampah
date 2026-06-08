<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\EdukasiController;
use App\Http\Controllers\PickupController;
use App\Http\Controllers\PointController;
use App\Http\Controllers\BankProfileController;
use App\Http\Controllers\ClientProfileController;
use App\Http\Controllers\ClientDashboardController;
use App\Http\Controllers\BankDashboardController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\PointRedemptionController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ForgotPasswordController;

// Admin Controllers
use App\Http\Controllers\Admin\GamifikasiController;
use App\Http\Controllers\Admin\RewardController;
use App\Http\Controllers\Admin\PointValueController;
use App\Http\Controllers\Admin\EducationMaterialController;
use App\Http\Controllers\Admin\PickupRequestAdminController;
use App\Http\Controllers\Admin\ListBankSampahController;
use App\Http\Controllers\Admin\AdminClientController;
use App\Http\Controllers\Admin\PointRedemptionController as AdminPointRedemptionController;
use App\Http\Controllers\ChallengeController;
use App\Http\Controllers\Admin\PointManagementController;
use App\Http\Controllers\Admin\AdminBankSampahController;
use App\Http\Controllers\PenukaranSampahController;



Route::get('/', function () {
    return view('welcome');
})->name('home');

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);

    Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('forgot-password', [AuthController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('forgot-password', [AuthController::class, 'sendResetLinkEmail'])->name('password.email');

Route::get('/auth/google', [AuthController::class, 'redirectToGoogle'])->name('login.google');
Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback']);

/*
|--------------------------------------------------------------------------
| Forum Routes
|--------------------------------------------------------------------------
*/
Route::get('/forum', [ForumController::class, 'index'])->name('forum.index');
Route::middleware('auth')->group(function () {
    Route::get('/forum/create', [ForumController::class, 'create'])->name('forum.create');
    Route::post('/forum', [ForumController::class, 'store'])->name('forum.store');
    Route::delete('/forum/{forum}', [ForumController::class, 'destroy'])->name('forum.destroy');
    Route::get('/forum/{forum}', [ForumController::class, 'show'])->name('forum.show');
    Route::get('/forum/{forum}/edit', [ForumController::class, 'edit'])->middleware('role:admin')->name('forum.edit');
    Route::put('/forum/{forum}', [ForumController::class, 'update'])->middleware('role:admin')->name('forum.update');
    Route::post('/forum/{forum}/subscribe', [ForumController::class, 'subscribe'])->name('forum.subscribe');
});

/*
|--------------------------------------------------------------------------
| Client Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:client|admin'])->group(function () {
    Route::get('/dashboard', [ClientDashboardController::class, 'index'])->name('client.dashboard');
    Route::get('/gamifikasi', [GamifikasiController::class, 'index'])->name('gamifikasi.index');
    Route::get('/edukasi', [EdukasiController::class, 'index'])->name('edukasi.index');
    Route::get('/challenge', [ChallengeController::class, 'index'])->name('challenge.index');
    Route::get('/penjemputan', function () {
        return view('penjemputan_sampah.index');
    })->name('penjemputan_sampah.index');
    Route::get('points/redemptions', [PointRedemptionController::class, 'index'])->name('points.redemptions.index');
    Route::get('points/redemptions/create', [PointRedemptionController::class, 'create'])->name('points.redemptions.create');
    Route::post('points/redemptions', [PointRedemptionController::class, 'store'])->name('points.redemptions.store');
    Route::delete('points/redemptions/{id}/cancel', [PointRedemptionController::class, 'cancel'])->name('points.redemptions.cancel');

    // Penjemputan Sampah
    Route::get('/penjemputan', [PickupController::class, 'index'])->name('penjemputan.index');
    Route::post('/penjemputan', [PickupController::class, 'store'])->name('penjemputan.store');
    Route::patch('/penjemputan/{id}/status', [PickupController::class, 'updateStatus'])->name('penjemputan.updateStatus');
    Route::get('/exchange', [PenukaranSampahController::class, 'index'])->name('exchange.index');
    Route::post('/exchange', [PenukaranSampahController::class, 'processExchange'])->name('exchange.process');
    Route::get('/gamifikasi', [GamifikasiController::class, 'index'])->name('gamifikasi.index');
    Route::get('/challenge', [ChallengeController::class, 'index'])->name('challenge.index');
});

/*
|--------------------------------------------------------------------------
| Client Profile Routes
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->prefix('client')->name('client.')->group(function () {
    Route::get('profile', [ClientProfileController::class, 'show'])->name('profile.show');
    Route::get('profile/edit', [ClientProfileController::class, 'edit'])->name('profile.edit');
    Route::put('profile', [ClientProfileController::class, 'update'])->name('profile.update');
});

/*
|--------------------------------------------------------------------------
| Bank Sampah Routes
|--------------------------------------------------------------------------
*/
Route::prefix('bank')->middleware(['auth', 'role:bank_sampah'])->group(function () {
    Route::get('/dashboard', [BankDashboardController::class, 'index'])->name('bank.dashboard');
    Route::post('/pickup-requests/schedule', [BankDashboardController::class, 'schedule'])->name('bank.pickup.schedule');
});

// Bank Sampah Routes
Route::prefix('bank')->middleware(['auth', 'role:bank_sampah'])->group(function () {
    Route::get('/dashboard', [BankDashboardController::class, 'index'])->name('bank.dashboard');
    Route::post('/pickup-requests/schedule', [BankDashboardController::class, 'schedule'])->name('bank.pickup.schedule');
    Route::get('/profile', [BankProfileController::class, 'edit'])->name('bank.profile.edit');
    Route::put('/profile', [BankProfileController::class, 'update'])->name('bank.profile.update');
    Route::get('/profile/show', [BankProfileController::class, 'show'])->name('bank.profile.show');
});

/*
|--------------------------------------------------------------------------
| Point Exchange Routes
|--------------------------------------------------------------------------
*/
Route::get('/forum', [ForumController::class, 'index'])->name('forum.index');

Route::middleware('auth')->group(function () {
    Route::get('/forum/create', [ForumController::class, 'create'])->name('forum.create');
    Route::post('/forum', [ForumController::class, 'store'])->name('forum.store');
    Route::delete('/forum/{forum}', [ForumController::class, 'destroy'])->name('forum.destroy');
    Route::get('/forum/{forum}', [ForumController::class, 'show'])->name('forum.show');
    Route::get('/forum/{forum}/edit', [ForumController::class, 'edit'])->middleware('role:admin')->name('forum.edit');
    Route::put('/forum/{forum}', [ForumController::class, 'update'])->middleware('role:admin')->name('forum.update');
    Route::post('/forum/{forum}/subscribe', [ForumController::class, 'subscribe'])->name('forum.subscribe');
});

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::prefix('bank')->middleware(['auth', 'role:bank_sampah'])->group(function () {
    Route::get('/dashboard', [BankDashboardController::class, 'index'])->name('bank.dashboard');
});

Route::prefix('admin')->middleware(['auth', 'role:admin'])->name('admin.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');


    // Point values management
    Route::resource('points/values', PointValueController::class)->parameters([
        'values' => 'waste'
    ])->names([
                'index' => 'points.values',
                'create' => 'points.values.create',
                'store' => 'points.values.store',
                'edit' => 'points.values.edit',
                'update' => 'points.values.update',
                'destroy' => 'points.values.destroy',
            ]);

    // Education Materials Management
    Route::resource('edukasi', EducationMaterialController::class)
        ->parameters(['edukasi' => 'educationMaterial'])
        ->names([
            'index' => 'edukasi.index',
            'create' => 'edukasi.create',
            'store' => 'edukasi.store',
            'edit' => 'edukasi.edit',
            'update' => 'edukasi.update',
            'destroy' => 'edukasi.destroy',
        ])
        ->except(['show']);
    // Route untuk toggle featured
    Route::post('edukasi/{educationMaterial}/toggle-featured', [EducationMaterialController::class, 'toggleFeatured'])
        ->name('edukasi.toggleFeatured');

    // Rewards
    Route::resource('rewards', RewardController::class)->names([
        'index' => 'rewards.index',
        'create' => 'rewards.create',
        'store' => 'rewards.store',
        'edit' => 'rewards.edit',
        'update' => 'rewards.update',
        'destroy' => 'rewards.destroy'
    ]);
    Route::patch('rewards/{reward}/toggle-status', [RewardController::class, 'toggleStatus'])
        ->name('rewards.toggle-status');
    Route::get('leaderboard', [GamifikasiController::class, 'adminLeaderboard'])->name('leaderboard.index');
    Route::post('leaderboard/update/{user}', [GamifikasiController::class, 'updatePoints'])->name('leaderboard.update');

    Route::get('redemptions', [\App\Http\Controllers\Admin\PointRedemptionController::class, 'index'])->name('redemptions.index');
    Route::get('redemptions/{id}/approve', [\App\Http\Controllers\Admin\PointRedemptionController::class, 'approve'])->name('redemptions.approve');
    Route::get('redemptions/{id}/reject', [\App\Http\Controllers\Admin\PointRedemptionController::class, 'reject'])->name('redemptions.reject');

    // Pickup
    Route::patch('/penjemputan/{id}/assign', [PickupController::class, 'assignCollector'])->name('penjemputan.assignCollector');
    Route::get('/penjemputan/status/{status}', [PickupController::class, 'getRequestsByStatus'])->name('penjemputan.getByStatus');

    Route::get('/pickup-requests', [PickupRequestAdminController::class, 'index'])->name('pickup.requests');
    Route::post('/pickup-requests/assign', [PickupRequestAdminController::class, 'assign'])->name('pickup.assign');

    // List Bank
    Route::resource('list-bank', ListBankSampahController::class)->names([
        'index' => 'list-bank.index',
        'create' => 'list-bank.create',
        'store' => 'list-bank.store',
        'show' => 'list-bank.show',
        'edit' => 'list-bank.edit',
        'update' => 'list-bank.update',
        'destroy' => 'list-bank.destroy',
    ]);

    // Clients
    Route::resource('clients', AdminClientController::class)->names([
        'index' => 'clients.index',
        'create' => 'clients.create',
        'store' => 'clients.store',
        'edit' => 'clients.edit',
        'update' => 'clients.update',
        'destroy' => 'clients.destroy',
        'show' => 'clients.show',
    ]);
    Route::post('clients/{client}/activate', [AdminClientController::class, 'activate'])->name('clients.activate');
    Route::post('clients/{client}/deactivate', [AdminClientController::class, 'deactivate'])->name('clients.deactivate');

    // Penukaran Sampah Management (Admin)
    Route::get('penukaran-sampah', [\App\Http\Controllers\Admin\PenukaranSampahAdminController::class, 'index'])->name('penukaran_sampah.index');
});

// Admin Point Management Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/points/manage', [App\Http\Controllers\Admin\PointManagementController::class, 'index'])->name('points.manage');
    Route::post('/points/add', [App\Http\Controllers\Admin\PointManagementController::class, 'addPoints'])->name('points.add');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
});

Route::prefix('admin/clients')->name('admin.clients.')->middleware(['auth', 'role:admin'])->group(function () {
    Route::post('bank/{id}/activate', [AdminBankSampahController::class, 'activate'])->name('bank.activate');
    Route::post('bank/{id}/deactivate', [AdminBankSampahController::class, 'deactivate'])->name('bank.deactivate');
    Route::get('bank/{id}/edit', [AdminBankSampahController::class, 'edit'])->name('bank.edit');
    Route::delete('bank/{id}', [AdminBankSampahController::class, 'destroy'])->name('bank.destroy');
    Route::put('bank/{id}', [App\Http\Controllers\Admin\AdminBankSampahController::class, 'update'])->name('admin.clients.bank.update');
});

/*
|--------------------------------------------------------------------------
| Comment Store (Public)
|--------------------------------------------------------------------------
*/
Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/comments/{comment}/edit', [CommentController::class, 'edit'])->name('comments.edit');
    Route::put('/comments/{comment}', [CommentController::class, 'update'])->name('comments.update');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/comments/{comment}/edit', [CommentController::class, 'edit'])->name('comments.edit');
    Route::put('/comments/{comment}', [CommentController::class, 'update'])->name('comments.update');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
});


Route::prefix('admin/bank')->name('admin.bank.')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/bank-sampah', [AdminBankSampahController::class, 'index'])->name('bank-sampah.index');
});