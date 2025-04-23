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
<div class="welcome-container">
    <div class="hero-section">
        <h1>Welcome to CholoSave</h1>
        <p>Your journey to financial freedom starts here</p>
        <div class="cta-buttons">
            <a href="{{ route('register') }}" class="btn-primary">Get Started</a>
            <a href="{{ route('login') }}" class="btn-secondary">Login</a>
        </div>
    </div>

    <div class="carousel-container">
        <div class="carousel">
            <div class="carousel-slide">
                <div class="slide-content">
                    <h3>Smart Savings</h3>
                    <p>Automate your savings and watch your money grow</p>
                    <img src="https://static.vecteezy.com/system/resources/thumbnails/055/229/342/small/saving-coins-in-a-glass-jar-labeled-for-financial-goals-at-home-in-soft-ambient-light-free-photo.jpeg" alt="Smart Savings">
                </div>
            </div>
            <div class="carousel-slide">
                <div class="slide-content">
                    <h3>Investment Tools</h3>
                    <p>Access powerful tools to grow your wealth</p>
                    <img src="/images/investment.jpg" alt="Investment Tools">
                </div>
            </div>
            <div class="carousel-slide">
                <div class="slide-content">
                    <h3>Financial Education</h3>
                    <p>Learn from experts and make informed decisions</p>
                    <img src="/images/education.jpg" alt="Financial Education">
                </div>
            </div>
        </div>
        <button class="carousel-button prev" aria-label="Previous slide">❮</button>
        <button class="carousel-button next" aria-label="Next slide">❯</button>
        <div class="carousel-dots"></div>
    </div>
</div>

<style>
.welcome-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 2rem;
    min-height: calc(100vh - 5rem);
}

.hero-section {
    text-align: center;
    margin-bottom: 3rem;
}

.hero-section h1 {
    font-size: 3rem;
    color: #1E40AF;
    margin-bottom: 1rem;
}

.hero-section p {
    font-size: 1.5rem;
    color: #6B7280;
    margin-bottom: 2rem;
}

.cta-buttons {
    display: flex;
    gap: 1rem;
    justify-content: center;
}

.btn-primary, .btn-secondary {
    padding: 0.75rem 1.5rem;
    border-radius: 0.5rem;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s ease;
}

.btn-primary {
    background-color: #1E40AF;
    color: white;
}

.btn-secondary {
    background-color: #E5E7EB;
    color: #1F2937;
}

.btn-primary:hover, .btn-secondary:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.carousel-container {
    position: relative;
    max-width: 800px;
    margin: 0 auto;
    overflow: hidden;
    border-radius: 1rem;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.carousel {
    display: flex;
    transition: transform 0.5s ease-in-out;
}

.carousel-slide {
    min-width: 100%;
    padding: 2rem;
    background-color: white;
}

.slide-content {
    text-align: center;
}

.slide-content h3 {
    font-size: 1.5rem;
    color: #1E40AF;
    margin-bottom: 1rem;
}

.slide-content p {
    color: #6B7280;
    margin-bottom: 1.5rem;
}

.slide-content img {
    width: 100%;
    max-height: 300px;
    object-fit: cover;
    border-radius: 0.5rem;
}

.carousel-button {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background: rgba(255, 255, 255, 0.8);
    border: none;
    padding: 1rem;
    cursor: pointer;
    border-radius: 50%;
    font-size: 1.5rem;
    color: #1E40AF;
    transition: all 0.3s ease;
}

.carousel-button:hover {
    background: white;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.prev {
    left: 1rem;
}

.next {
    right: 1rem;
}

.carousel-dots {
    position: absolute;
    bottom: 1rem;
    left: 50%;
    transform: translateX(-50%);
    display: flex;
    gap: 0.5rem;
}

.dot {
    width: 10px;
    height: 10px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.5);
    cursor: pointer;
    transition: all 0.3s ease;
}

.dot.active {
    background: white;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const carousel = document.querySelector('.carousel');
    const slides = document.querySelectorAll('.carousel-slide');
    const dotsContainer = document.querySelector('.carousel-dots');
    let currentSlide = 0;

    // Create dots
    slides.forEach((_, index) => {
        const dot = document.createElement('div');
        dot.classList.add('dot');
        if (index === 0) dot.classList.add('active');
        dot.addEventListener('click', () => goToSlide(index));
        dotsContainer.appendChild(dot);
    });

    const dots = document.querySelectorAll('.dot');

    function updateCarousel() {
        carousel.style.transform = `translateX(-${currentSlide * 100}%)`;
        dots.forEach((dot, index) => {
            dot.classList.toggle('active', index === currentSlide);
        });
    }

    function goToSlide(slideIndex) {
        currentSlide = slideIndex;
        updateCarousel();
    }

    function nextSlide() {
        currentSlide = (currentSlide + 1) % slides.length;
        updateCarousel();
    }

    function prevSlide() {
        currentSlide = (currentSlide - 1 + slides.length) % slides.length;
        updateCarousel();
    }

    // Add event listeners to buttons
    document.querySelector('.next').addEventListener('click', nextSlide);
    document.querySelector('.prev').addEventListener('click', prevSlide);

    // Auto-advance slides every 5 seconds
    setInterval(nextSlide, 5000);
});
</script>
@endauth
@endsection
