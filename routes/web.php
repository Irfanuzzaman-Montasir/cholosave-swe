<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ExpertController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\InvestmentController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\AITipsController;

// Main Pages
Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/vision', function () {
    return view('vision');
})->name('vision');

Route::get('/experts', [ExpertController::class, 'index'])->name('experts');

// Contact Routes
Route::get('/contact', [ContactController::class, 'show'])->name('contact');
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');

// Registration Routes
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Login Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Authenticated User Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::get('/settings', [ProfileController::class, 'settings'])->name('settings');
    
    // Groups Routes
    Route::get('/groups', [GroupController::class, 'index'])->name('groups.index');
    Route::get('/groups/create', [GroupController::class, 'create'])->name('groups.create');
    Route::post('/groups', [GroupController::class, 'store'])->name('groups.store');
    Route::get('/groups/{group}', [GroupController::class, 'show'])->name('groups.show');
    
    // Investments Routes
    Route::get('/investments', [InvestmentController::class, 'index'])->name('investments.index');
    Route::get('/investments/create', [InvestmentController::class, 'create'])->name('investments.create');
    Route::post('/investments', [InvestmentController::class, 'store'])->name('investments.store');
    Route::get('/investments/{investment}', [InvestmentController::class, 'show'])->name('investments.show');

    Route::get('/ai-tips', [AITipsController::class, 'index'])->name('ai-tips');
});

// Admin Routes
Route::prefix('admin')->middleware(['auth', \App\Http\Middleware\CheckRole::class.':admin'])->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    
    // Expert Team Routes
    Route::get('/experts', [App\Http\Controllers\Admin\ExpertController::class, 'index'])->name('admin.experts.index');
    Route::get('/experts/create', [App\Http\Controllers\Admin\ExpertController::class, 'create'])->name('admin.experts.create');
    Route::post('/experts', [App\Http\Controllers\Admin\ExpertController::class, 'store'])->name('admin.experts.store');
    Route::get('/experts/{expert}/edit', [App\Http\Controllers\Admin\ExpertController::class, 'edit'])->name('admin.experts.edit');
    Route::put('/experts/{expert}', [App\Http\Controllers\Admin\ExpertController::class, 'update'])->name('admin.experts.update');
    Route::delete('/experts/{expert}', [App\Http\Controllers\Admin\ExpertController::class, 'destroy'])->name('admin.experts.destroy');
    
    // Contact Messages Routes
    Route::get('/contacts', [App\Http\Controllers\Admin\ContactController::class, 'index'])->name('admin.contacts.index');
    Route::delete('/contacts/{contact}', [App\Http\Controllers\Admin\ContactController::class, 'destroy'])->name('admin.contacts.destroy');
});
