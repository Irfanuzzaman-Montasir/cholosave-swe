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
                    <img src="{{ asset('images/carousel/savings.jpg') }}" alt="Smart Savings" class="carousel-image">
                </div>
            </div>
            <div class="carousel-slide">
                <div class="slide-content">
                    <h3>Investment Tools</h3>
                    <p>Access powerful tools to grow your wealth</p>
                    <img src="{{ asset('images/carousel/investment.jpg') }}" alt="Investment Tools" class="carousel-image">
                </div>
            </div>
            <div class="carousel-slide">
                <div class="slide-content">
                    <h3>Financial Education</h3>
                    <p>Learn from experts and make informed decisions</p>
                    <img src="{{ asset('images/carousel/education.jpg') }}" alt="Financial Education" class="carousel-image">
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
    width: 100%;
    margin: 0;
    padding: 0;
    min-height: 100vh;
    position: relative;
}

.hero-section {
    text-align: center;
    padding: 4rem 2rem;
    background: linear-gradient(135deg, #1E40AF 0%, #1E3A8A 100%);
    color: white;
}

.hero-section h1 {
    font-size: 3.5rem;
    margin-bottom: 1rem;
}

.hero-section p {
    font-size: 1.5rem;
    margin-bottom: 2rem;
    opacity: 0.9;
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
    background-color: white;
    color: #1E40AF;
}

.btn-secondary {
    background-color: transparent;
    color: white;
    border: 2px solid white;
}

.btn-primary:hover, .btn-secondary:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.carousel-container {
    position: relative;
    width: 100%;
    height: calc(100vh - 300px);
    overflow: hidden;
    background: #f4f7f9;
}

.carousel {
    display: flex;
    height: 100%;
    transition: transform 0.5s ease-in-out;
}

.carousel-slide {
    min-width: 100%;
    height: 100%;
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
}

.slide-content {
    text-align: center;
    max-width: 800px;
    padding: 2rem;
    position: relative;
    z-index: 10;
    opacity: 0;
    transform: translateY(20px);
    animation: fadeInUp 1s ease forwards;
}

.slide-content h3 {
    font-size: 3.5rem;
    font-weight: 700;
    color: white;
    margin-bottom: 1.5rem;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
}

.slide-content p {
    font-size: 1.5rem;
    color: white;
    line-height: 1.6;
    text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);
}

.carousel-image {
    position: absolute;
    inset: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center;
    filter: brightness(0.4);
    transform: scale(1.1);
    transition: transform 0.5s ease;
}

.carousel-slide:hover .carousel-image {
    transform: scale(1);
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
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
    z-index: 3;
}

.carousel-button:hover {
    background: white;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.prev {
    left: 2rem;
}

.next {
    right: 2rem;
}

.carousel-dots {
    position: absolute;
    bottom: 2rem;
    left: 50%;
    transform: translateX(-50%);
    display: flex;
    gap: 0.5rem;
    z-index: 3;
}

.dot {
    width: 12px;
    height: 12px;
    border-radius: 50%;
    background: rgba(30, 64, 175, 0.5);
    cursor: pointer;
    transition: all 0.3s ease;
}

.dot.active {
    background: #1E40AF;
    transform: scale(1.2);
}

@media (max-width: 768px) {
    .hero-section h1 {
        font-size: 2.5rem;
    }
    
    .hero-section p {
        font-size: 1.25rem;
    }
    
    .slide-content h3 {
        font-size: 2rem;
    }
    
    .slide-content p {
        font-size: 1.1rem;
    }
    
    .carousel-button {
        padding: 0.75rem;
        font-size: 1.25rem;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const carousel = document.querySelector('.carousel');
    const slides = document.querySelectorAll('.carousel-slide');
    const dotsContainer = document.querySelector('.carousel-dots');
    let currentSlide = 0;
    let autoSlideInterval;

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
        resetAutoSlide();
    }

    function nextSlide() {
        currentSlide = (currentSlide + 1) % slides.length;
        updateCarousel();
    }

    function prevSlide() {
        currentSlide = (currentSlide - 1 + slides.length) % slides.length;
        updateCarousel();
    }

    function startAutoSlide() {
        autoSlideInterval = setInterval(nextSlide, 5000);
    }

    function resetAutoSlide() {
        clearInterval(autoSlideInterval);
        startAutoSlide();
    }

    // Add event listeners to buttons
    document.querySelector('.next').addEventListener('click', () => {
        nextSlide();
        resetAutoSlide();
    });
    
    document.querySelector('.prev').addEventListener('click', () => {
        prevSlide();
        resetAutoSlide();
    });

    // Start auto-sliding
    startAutoSlide();
});
</script>
@endauth
@endsection
