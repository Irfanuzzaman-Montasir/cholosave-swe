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
use App\Http\Controllers\ForumController;
use App\Http\Controllers\LeaderboardController;

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
    
     // Profile Routes
     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile');
     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
 
     // Community Routes
     Route::get('/community/leaderboard', [LeaderboardController::class, 'index'])->name('leaderboard');
     
     // Forum Routes
     Route::get('/community/forum', [ForumController::class, 'index'])->name('forum.index');
     Route::get('/community/forum/my-questions', [ForumController::class, 'myQuestions'])->name('forum.my-questions');
     Route::get('/community/forum/question/{question}', [ForumController::class, 'show'])->name('forum.question');
     Route::post('/community/forum/question', [ForumController::class, 'store'])->name('forum.store');
     Route::post('/community/forum/reply', [ForumController::class, 'storeReply'])->name('forum.reply.store');
     Route::delete('/community/forum/question/{question}', [ForumController::class, 'destroy'])->name('forum.destroy');
     Route::patch('/community/forum/question/{question}', [ForumController::class, 'update'])->name('forum.update');
});
