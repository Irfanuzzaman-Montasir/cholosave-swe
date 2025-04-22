@extends('layouts.app')

@section('title', 'Welcome to CholoSave')

@section('content')
@auth
<div class="welcome-container">
    <div class="welcome-content">
        <div class="welcome-text">
            <h1>Welcome back, {{ $user->name }}! 👋</h1>
            <p class="subtitle">Your financial journey continues here</p>
        </div>
        <div class="welcome-images">
            <img src="/images/finance-1.jpg" alt="Financial Growth" class="welcome-image">
            <img src="/images/finance-2.jpg" alt="Community" class="welcome-image">
            <img src="/images/finance-3.jpg" alt="Investment" class="welcome-image">
        </div>
    </div>
</div>

<style>
.welcome-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 2rem;
    min-height: calc(100vh - 5rem);
    display: flex;
    align-items: center;
}

.welcome-content {
    width: 100%;
}

.welcome-text {
    text-align: center;
    margin-bottom: 3rem;
}

.welcome-text h1 {
    font-size: 3rem;
    color: #1E40AF;
    margin-bottom: 1rem;
}

.subtitle {
    font-size: 1.5rem;
    color: #6B7280;
}

.welcome-images {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 2rem;
    margin-top: 3rem;
}

.welcome-image {
    width: 100%;
    height: 250px;
    object-fit: cover;
    border-radius: 1rem;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease;
}

.welcome-image:hover {
    transform: translateY(-5px);
}
</style>
@else
<!-- Original welcome content for guests -->
<div class="welcome-container">
    <div class="hero-section">
        <h1>Welcome to CholoSave</h1>
        <p>Your journey to financial freedom starts here</p>
        <div class="cta-buttons">
            <a href="{{ route('register') }}" class="btn-primary">Get Started</a>
            <a href="{{ route('login') }}" class="btn-secondary">Login</a>
        </div>
    </div>
    <!-- Rest of the guest content -->
</div>
@endauth
@endsection
