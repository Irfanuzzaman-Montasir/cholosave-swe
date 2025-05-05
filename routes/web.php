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

// Main Pages
Route::get('/', function () {
    if (auth()->check()) {
        return view('welcome', ['user' => auth()->user()]);
    }
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
    Route::post('/profile/update-password', [ProfileController::class, 'updatePassword'])->name('profile.update-password');
    Route::get('/settings', [ProfileController::class, 'settings'])->name('settings');
    
    // Group Routes
    Route::get('/groups/create', [GroupController::class, 'create'])->name('groups.create');
    Route::post('/groups', [GroupController::class, 'store'])->name('groups.store');
    Route::get('/groups/{group}', [GroupController::class, 'show'])->name('groups.show');
    Route::get('/groups/admin/{groupId}', [GroupController::class, 'adminDashboard'])->name('groups.admin.dashboard');
    Route::get('/my-groups', [GroupController::class, 'myGroups'])->name('groups.my');
    Route::get('/join-groups', [GroupController::class, 'joinGroups'])->name('groups.join');
    Route::post('/groups/{groupId}/join', [GroupController::class, 'joinGroup'])->name('groups.join.request');
    
    // Investments Routes
    Route::get('/investments', [InvestmentController::class, 'index'])->name('investments.index');
    Route::get('/investments/create', [InvestmentController::class, 'create'])->name('investments.create');
    Route::post('/investments', [InvestmentController::class, 'store'])->name('investments.store');
    Route::get('/investments/{investment}', [InvestmentController::class, 'show'])->name('investments.show');

    // Group Dashboard Routes
    Route::get('/groups/{groupId}/admin-dashboard', [GroupController::class, 'adminDashboard'])->name('groups.admin_dashboard');
    Route::get('/groups/{groupId}/member/dashboard', [GroupController::class, 'memberDashboard'])->name('groups.member.dashboard');
    Route::get('/groups/{groupId}/enter', [GroupController::class, 'enterGroup'])->name('groups.enter');
});