@extends('layouts.app')

@section('title', 'Welcome to CholoSave')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

            <style>
    /* Hero Section */
    .hero-section {
        position: relative;
        height: 600px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-top: 5rem;
        overflow: hidden;
    }

    .hero-image {
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

    .hero-section:hover .hero-image {
        transform: scale(1);
    }

    .hero-content {
        position: relative;
        z-index: 10;
        text-align: center;
        padding: 0 1rem;
        max-width: 800px;
        margin: 0 auto;
        opacity: 0;
        transform: translateY(20px);
        animation: fadeInUp 1s ease forwards;
    }

    .hero-title {
        font-size: 3.5rem;
        font-weight: 700;
        color: white;
        margin-bottom: 1.5rem;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
    }

    .hero-description {
        font-size: 1.25rem;
        color: #f3f4f6;
        line-height: 1.6;
        margin-bottom: 2rem;
    }

    /* Features Section */
    .features-section {
        padding: 5rem 0;
        background: white;
    }

    .features-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 2rem;
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 1rem;
    }

    .feature-card {
        background: #f8fafc;
        border-radius: 1rem;
        padding: 2rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        opacity: 0;
        transform: translateY(20px);
    }

    .feature-card:nth-child(1) { animation: fadeInUp 1s ease forwards 0.7s; }
    .feature-card:nth-child(2) { animation: fadeInUp 1s ease forwards 0.9s; }
    .feature-card:nth-child(3) { animation: fadeInUp 1s ease forwards 1.1s; }

    .feature-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }

    .feature-icon {
        width: 80px;
        height: 80px;
        border-radius: 1rem;
        margin-bottom: 1.5rem;
        background: linear-gradient(135deg, #1E40AF 0%, #1E3A8A 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 2rem;
    }

    .feature-title {
        font-size: 1.5rem;
        font-weight: 600;
        color: #1E40AF;
        margin-bottom: 1rem;
    }

    .feature-description {
        color: #4B5563;
        line-height: 1.6;
    }

    /* CTA Section */
    .cta-section {
        padding: 5rem 0;
        background: linear-gradient(135deg, #1E40AF 0%, #1E3A8A 100%);
        color: white;
        text-align: center;
    }

    .cta-content {
        max-width: 800px;
        margin: 0 auto;
        padding: 0 1rem;
    }

    .cta-title {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 1.5rem;
    }

    .cta-description {
        font-size: 1.25rem;
        opacity: 0.9;
        margin-bottom: 2rem;
    }

    .cta-button {
        display: inline-block;
        padding: 1rem 2rem;
        background: white;
        color: #1E40AF;
        border-radius: 0.5rem;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .cta-button:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
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
            </style>

<!-- Hero Section -->
<section class="hero-section">
    <img src="/images/hero-bg.jpg" alt="Financial Freedom" class="hero-image">
    <div class="hero-content">
        <h1 class="hero-title">Empowering Your Financial Journey</h1>
        <p class="hero-description">Join CholoSave to transform your savings into opportunities. Together, we build a stronger financial future.</p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('register') }}" class="bg-white text-blue-600 px-8 py-3 rounded-full hover:bg-blue-50 transition">
                Get Started
            </a>
            <a href="{{ route('login') }}" class="bg-blue-600 text-white px-8 py-3 rounded-full hover:bg-blue-700 transition">
                Sign In
            </a>
        </div>
<<<<<<< HEAD
                </div>
</section>

<!-- Features Section -->
<section class="features-section">
    <div class="features-grid">
        <div class="feature-card">
            <div class="feature-icon">
                <i class="fas fa-users"></i>
            </div>
            <h3 class="feature-title">Community Savings</h3>
            <p class="feature-description">Join collaborative saving groups and grow your money together with like-minded individuals in your community.</p>
        </div>
        <div class="feature-card">
            <div class="feature-icon">
                <i class="fas fa-chart-line"></i>
            </div>
            <h3 class="feature-title">Smart Investments</h3>
            <p class="feature-description">Access expert guidance and smart investment tools to maximize your returns while minimizing risks.</p>
        </div>
        <div class="feature-card">
            <div class="feature-icon">
                <i class="fas fa-hand-holding-usd"></i>
                </div>
            <h3 class="feature-title">Financial Education</h3>
            <p class="feature-description">Learn essential financial skills and strategies through our comprehensive educational resources.</p>
        </div>
=======
>>>>>>> master
    </div>
</section>

<<<<<<< HEAD
<!-- CTA Section -->
<section class="cta-section">
    <div class="cta-content">
        <h2 class="cta-title">Ready to Transform Your Financial Future?</h2>
        <p class="cta-description">Join thousands of members who are already on their journey to financial freedom with CholoSave.</p>
        <a href="{{ route('register') }}" class="cta-button">Create Your Account</a>
    </div>
</section>
=======
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
>>>>>>> master
@endsection
