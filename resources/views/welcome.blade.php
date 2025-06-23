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
<div class="welcome-guest-container">
    <!-- Carousel Hero Section -->
    <section class="carousel-hero">
        <div class="carousel-particles"></div>
        <div class="carousel-container" id="carouselContainer">
            <!-- Slide 1: Welcome & Overview -->
            <div class="carousel-slide slide-1">
                <div class="slide-content">
                    <div class="slide-text">
                        <h1 class="slide-title">Welcome to CholoSave</h1>
                        <p class="slide-subtitle">Your journey to financial freedom starts here. Transform your relationship with money and build the future you deserve.</p>
                        <ul class="slide-features">
                            <li>🚀 Start your financial journey today</li>
                            <li>💰 Smart savings with AI-driven insights</li>
                            <li>📈 Investment opportunities for everyone</li>
                        </ul>
                        <div class="slide-cta">
                            <a href="{{ route('register') }}" class="btn-primary">Get Started Free</a>
                            <a href="{{ route('login') }}" class="btn-secondary">Sign In</a>
                        </div>
                    </div>
                    <div class="slide-visual">
                        <div class="floating-element element-1">💰 Save Smart</div>
                        <div class="floating-element element-2">📊 Track Progress</div>
                        <div class="floating-element element-3">🎯 Reach Goals</div>
                        <img src="https://images.unsplash.com/photo-1579621970563-ebec7560ff3e?w=500&h=300&fit=crop&crop=center" alt="Financial Success" class="slide-image">
                    </div>
                </div>
            </div>
            <!-- Slide 2: Smart Savings -->
            <div class="carousel-slide slide-2">
                <div class="slide-content">
                    <div class="slide-text">
                        <h1 class="slide-title">Smart Savings</h1>
                        <p class="slide-subtitle">Automate your savings with intelligent algorithms that adapt to your lifestyle and help you save more without thinking about it.</p>
                        <ul class="slide-features">
                            <li>🤖 AI-powered saving recommendations</li>
                            <li>🔄 Automatic round-up savings</li>
                            <li>📅 Goal-based saving plans</li>
                        </ul>
                        <div class="slide-cta">
                            <a href="{{ route('register') }}" class="btn-primary">Start Saving</a>
                            <a href="#learn-more" class="btn-secondary">Learn More</a>
                        </div>
                    </div>
                    <div class="slide-visual">
                        <div class="floating-element element-1">🎯 Goals</div>
                        <div class="floating-element element-2">💡 Smart Tips</div>
                        <div class="floating-element element-3">📈 Growth</div>
                        <img src="https://images.unsplash.com/photo-1554224155-6726b3ff858f?w=500&h=300&fit=crop&crop=center" alt="Smart Savings" class="slide-image">
                    </div>
                </div>
            </div>
            <!-- Slide 3: Investment Tools -->
            <div class="carousel-slide slide-3">
                <div class="slide-content">
                    <div class="slide-text">
                        <h1 class="slide-title">Investment Made Easy</h1>
                        <p class="slide-subtitle">Grow your wealth with beginner-friendly investment tools and expert guidance. Start investing with as little as $1.</p>
                        <ul class="slide-features">
                            <li>📊 Diversified portfolio options</li>
                            <li>🎓 Educational investment resources</li>
                            <li>💹 Real-time market insights</li>
                        </ul>
                        <div class="slide-cta">
                            <a href="{{ route('register') }}" class="btn-primary">Start Investing</a>
                            <a href="#portfolio" class="btn-secondary">View Portfolios</a>
                        </div>
                    </div>
                    <div class="slide-visual">
                        <div class="floating-element element-1">📈 Invest</div>
                        <div class="floating-element element-2">🔍 Research</div>
                        <div class="floating-element element-3">💰 Profit</div>
                        <img src="https://images.unsplash.com/photo-1611974789855-9c2a0a7236a3?w=500&h=300&fit=crop&crop=center" alt="Investment Dashboard" class="slide-image">
                    </div>
                </div>
            </div>
            <!-- Slide 4: Community & Support -->
            <div class="carousel-slide slide-4">
                <div class="slide-content">
                    <div class="slide-text">
                        <h1 class="slide-title">Join Our Community</h1>
                        <p class="slide-subtitle">Connect with like-minded individuals on their financial journey. Share experiences, get support, and celebrate milestones together.</p>
                        <ul class="slide-features">
                            <li>🤝 Supportive community network</li>
                            <li>🎓 Financial education workshops</li>
                            <li>🏆 Achievement celebrations</li>
                        </ul>
                        <div class="slide-cta">
                            <a href="{{ route('register') }}" class="btn-primary">Join Community</a>
                            <a href="#success-stories" class="btn-secondary">Success Stories</a>
                        </div>
                    </div>
                    <div class="slide-visual">
                        <div class="floating-element element-1">🤝 Connect</div>
                        <div class="floating-element element-2">🎯 Achieve</div>
                        <div class="floating-element element-3">🏆 Celebrate</div>
                        <img src="https://images.unsplash.com/photo-1552664730-d307ca884978?w=500&h=300&fit=crop&crop=center" alt="Community Success" class="slide-image">
                    </div>
                </div>
            </div>
        </div>
        <!-- Navigation -->
        <div class="carousel-nav" id="carouselNav">
            <div class="nav-dot active" data-slide="0"></div>
            <div class="nav-dot" data-slide="1"></div>
            <div class="nav-dot" data-slide="2"></div>
            <div class="nav-dot" data-slide="3"></div>
        </div>
        <!-- Arrow Navigation -->
        <div class="carousel-arrow arrow-left" id="prevSlide">‹</div>
        <div class="carousel-arrow arrow-right" id="nextSlide">›</div>
        <!-- Progress Bar -->
        <div class="carousel-progress">
            <div class="progress-fill" id="progressFill"></div>
        </div>
    </section>
    <style>
    /* Carousel CSS from user HTML */
    * { margin: 0; padding: 0; box-sizing: border-box; }
    body { font-family: 'Inter', 'Segoe UI', Arial, sans-serif; background: #ffffff; color: #1e293b; overflow-x: hidden; }
    .carousel-hero { position: relative; height: 100vh; overflow: hidden; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }
    .carousel-container { position: relative; width: 100%; height: 100%; display: flex; transition: transform 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94); }
    .carousel-slide { min-width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; position: relative; padding: 0 2rem; }
    .slide-1 { background: linear-gradient(135deg, rgba(59, 130, 246, 0.95) 0%, rgba(147, 51, 234, 0.95) 100%); }
    .slide-2 { background: linear-gradient(135deg, rgba(16, 185, 129, 0.95) 0%, rgba(34, 197, 94, 0.95) 100%); }
    .slide-3 { background: linear-gradient(135deg, rgba(245, 158, 11, 0.95) 0%, rgba(251, 191, 36, 0.95) 100%); }
    .slide-4 { background: linear-gradient(135deg, rgba(236, 72, 153, 0.95) 0%, rgba(168, 85, 247, 0.95) 100%); }
    .slide-content { max-width: 1200px; width: 100%; display: grid; grid-template-columns: 1fr 1fr; gap: 4rem; align-items: center; opacity: 0; transform: translateY(50px); animation: slideIn 1s ease-out 0.5s forwards; }
    .slide-text { color: white; z-index: 2; }
    .slide-title { font-size: 4rem; font-weight: 800; line-height: 1.1; margin-bottom: 1.5rem; text-shadow: 0 4px 24px rgba(0, 0, 0, 0.2); }
    .slide-subtitle { font-size: 1.3rem; margin-bottom: 2.5rem; opacity: 0.95; line-height: 1.6; }
    .slide-features { list-style: none; margin-bottom: 2rem; }
    .slide-features li { display: flex; align-items: center; margin-bottom: 1rem; font-size: 1.1rem; opacity: 0; animation: fadeInUp 0.6s ease-out forwards; }
    .slide-features li:nth-child(1) { animation-delay: 0.8s; }
    .slide-features li:nth-child(2) { animation-delay: 1s; }
    .slide-features li:nth-child(3) { animation-delay: 1.2s; }
    .slide-features li::before { content: '✓'; background: rgba(255, 255, 255, 0.2); border-radius: 50%; width: 24px; height: 24px; display: flex; align-items: center; justify-content: center; margin-right: 1rem; font-weight: bold; }
    .slide-visual { position: relative; display: flex; align-items: center; justify-content: center; }
    .slide-image { width: 100%; max-width: 400px; height: 300px; object-fit: cover; border-radius: 20px; box-shadow: 0 25px 50px rgba(0, 0, 0, 0.3); transform: scale(0.8); animation: scaleIn 1s ease-out 0.7s forwards; }
    .floating-element { position: absolute; background: rgba(255, 255, 255, 0.1); backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.2); padding: 0.8rem 1.2rem; border-radius: 12px; color: white; font-weight: 600; font-size: 0.9rem; animation: float 4s ease-in-out infinite; z-index: 3; }
    .element-1 { top: 20%; left: 10%; animation-delay: 0s; }
    .element-2 { top: 30%; right: 15%; animation-delay: 1.5s; }
    .element-3 { bottom: 25%; left: 20%; animation-delay: 3s; }
    .carousel-nav { position: absolute; bottom: 30px; left: 50%; transform: translateX(-50%); display: flex; gap: 1rem; z-index: 10; }
    .nav-dot { width: 12px; height: 12px; border-radius: 50%; background: rgba(255, 255, 255, 0.4); cursor: pointer; transition: all 0.3s ease; position: relative; }
    .nav-dot.active { background: white; transform: scale(1.2); }
    .nav-dot::after { content: ''; position: absolute; top: -8px; left: -8px; right: -8px; bottom: -8px; border: 2px solid transparent; border-radius: 50%; transition: border-color 0.3s ease; }
    .nav-dot.active::after { border-color: rgba(255, 255, 255, 0.6); }
    .carousel-arrow { position: absolute; top: 50%; transform: translateY(-50%); background: rgba(255, 255, 255, 0.1); backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.2); width: 50px; height: 50px; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; cursor: pointer; transition: all 0.3s ease; z-index: 10; font-size: 1.2rem; }
    .carousel-arrow:hover { background: rgba(255, 255, 255, 0.2); transform: translateY(-50%) scale(1.1); }
    .arrow-left { left: 30px; }
    .arrow-right { right: 30px; }
    .slide-cta { display: flex; gap: 1.5rem; opacity: 0; animation: fadeInUp 0.8s ease-out 1.4s forwards; }
    .btn-primary, .btn-secondary { padding: 1rem 2rem; border-radius: 50px; font-weight: 600; text-decoration: none; transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275); font-size: 1.1rem; position: relative; overflow: hidden; }
    .btn-primary { background: rgba(255, 255, 255, 0.95); color: #1e293b; box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1); }
    .btn-primary:hover { transform: translateY(-3px) scale(1.05); box-shadow: 0 12px 40px rgba(0, 0, 0, 0.2); }
    .btn-secondary { background: transparent; color: white; border: 2px solid rgba(255, 255, 255, 0.6); }
    .btn-secondary:hover { background: rgba(255, 255, 255, 0.1); border-color: white; transform: translateY(-3px); }
    .carousel-progress { position: absolute; bottom: 0; left: 0; height: 4px; background: rgba(255, 255, 255, 0.3); width: 100%; z-index: 10; }
    .progress-fill { height: 100%; background: white; width: 0%; transition: width 0.1s linear; }
    .carousel-particles { position: absolute; top: 0; left: 0; right: 0; bottom: 0; background-image: radial-gradient(circle at 20% 80%, rgba(255, 255, 255, 0.1) 1px, transparent 1px), radial-gradient(circle at 80% 20%, rgba(255, 255, 255, 0.05) 1px, transparent 1px), radial-gradient(circle at 40% 40%, rgba(255, 255, 255, 0.08) 1px, transparent 1px); background-size: 100px 100px, 150px 150px, 200px 200px; animation: particleFloat 20s infinite linear; z-index: 1; }
    @keyframes slideIn { from { opacity: 0; transform: translateY(50px); } to { opacity: 1; transform: translateY(0); } }
    @keyframes fadeInUp { from { opacity: 0; transform: translateY(30px); } to { opacity: 1; transform: translateY(0); } }
    @keyframes scaleIn { from { transform: scale(0.8); opacity: 0; } to { transform: scale(1); opacity: 1; } }
    @keyframes float { 0%, 100% { transform: translateY(0px) rotate(0deg); } 25% { transform: translateY(-10px) rotate(2deg); } 50% { transform: translateY(-20px) rotate(0deg); } 75% { transform: translateY(-10px) rotate(-2deg); } }
    @keyframes particleFloat { 0% { transform: translateY(0px) rotate(0deg); } 100% { transform: translateY(-20px) rotate(360deg); } }
    @media (max-width: 1024px) { .slide-content { grid-template-columns: 1fr; gap: 3rem; text-align: center; } .slide-title { font-size: 3rem; } }
    @media (max-width: 768px) { .carousel-hero { height: 80vh; } .slide-title { font-size: 2.5rem; } .slide-subtitle { font-size: 1.1rem; } .slide-cta { flex-direction: column; align-items: center; gap: 1rem; } .btn-primary, .btn-secondary { width: 200px; text-align: center; } .carousel-arrow { width: 40px; height: 40px; font-size: 1rem; } .arrow-left { left: 15px; } .arrow-right { right: 15px; } .floating-element { display: none; } }
    @media (max-width: 480px) { .slide-title { font-size: 2rem; } .slide-content { padding: 0 1rem; } }
    </style>
    <script>
        class CarouselManager {
            constructor() {
                this.currentSlide = 0;
                this.totalSlides = 4;
                this.autoPlayInterval = 6000; // 6 seconds
                this.autoPlayTimer = null;
                this.isTransitioning = false;
                this.container = document.getElementById('carouselContainer');
                this.navDots = document.querySelectorAll('.nav-dot');
                this.prevBtn = document.getElementById('prevSlide');
                this.nextBtn = document.getElementById('nextSlide');
                this.progressFill = document.getElementById('progressFill');
                this.init();
            }
            init() {
                this.bindEvents();
                this.startAutoPlay();
                this.updateProgress();
            }
            bindEvents() {
                // Navigation dots
                this.navDots.forEach((dot, index) => {
                    dot.addEventListener('click', () => {
                        if (!this.isTransitioning) {
                            this.goToSlide(index);
                        }
                    });
                });
                // Arrow navigation
                this.prevBtn.addEventListener('click', () => {
                    if (!this.isTransitioning) {
                        this.prevSlide();
                    }
                });
                this.nextBtn.addEventListener('click', () => {
                    if (!this.isTransitioning) {
                        this.nextSlide();
                    }
                });
                // Keyboard navigation
                document.addEventListener('keydown', (e) => {
                    if (e.key === 'ArrowLeft' && !this.isTransitioning) {
                        this.prevSlide();
                    } else if (e.key === 'ArrowRight' && !this.isTransitioning) {
                        this.nextSlide();
                    }
                });
                // Pause autoplay on hover
                this.container.addEventListener('mouseenter', () => {
                    this.stopAutoPlay();
                });
                this.container.addEventListener('mouseleave', () => {
                    this.startAutoPlay();
                });
                // Touch/swipe support
                let startX = 0;
                let endX = 0;
                this.container.addEventListener('touchstart', (e) => {
                    startX = e.touches[0].clientX;
                    this.stopAutoPlay();
                });
                this.container.addEventListener('touchend', (e) => {
                    endX = e.changedTouches[0].clientX;
                    const diff = startX - endX;
                    if (Math.abs(diff) > 50 && !this.isTransitioning) {
                        if (diff > 0) {
                            this.nextSlide();
                        } else {
                            this.prevSlide();
                        }
                    }
                    this.startAutoPlay();
                });
            }
            goToSlide(index) {
                if (index === this.currentSlide) return;
                this.isTransitioning = true;
                this.currentSlide = index;
                // Update container transform
                const translateX = -index * 100;
                this.container.style.transform = `translateX(${translateX}%)`;
                // Update navigation dots
                this.updateNavigation();
                // Reset transition flag after animation
                setTimeout(() => {
                    this.isTransitioning = false;
                }, 800);
                // Restart autoplay
                this.restartAutoPlay();
                this.updateProgress();
            }
            nextSlide() {
                const nextIndex = (this.currentSlide + 1) % this.totalSlides;
                this.goToSlide(nextIndex);
            }
            prevSlide() {
                const prevIndex = (this.currentSlide - 1 + this.totalSlides) % this.totalSlides;
                this.goToSlide(prevIndex);
            }
            updateNavigation() {
                this.navDots.forEach((dot, index) => {
                    dot.classList.toggle('active', index === this.currentSlide);
                });
            }
            startAutoPlay() {
                this.stopAutoPlay();
                this.autoPlayTimer = setInterval(() => {
                    if (!this.isTransitioning) {
                        this.nextSlide();
                    }
                }, this.autoPlayInterval);
            }
            stopAutoPlay() {
                if (this.autoPlayTimer) {
                    clearInterval(this.autoPlayTimer);
                    this.autoPlayTimer = null;
                }
            }
            restartAutoPlay() {
                this.stopAutoPlay();
                this.startAutoPlay();
            }
            updateProgress() {
                let progress = 0;
                const progressInterval = setInterval(() => {
                    progress += (100 / (this.autoPlayInterval / 100));
                    this.progressFill.style.width = `${progress}%`;
                    if (progress >= 100) {
                        clearInterval(progressInterval);
                        this.progressFill.style.width = '0%';
                    }
                }, 100);
            }
        }
        // Initialize carousel when DOM is loaded
        document.addEventListener('DOMContentLoaded', () => {
            new CarouselManager();
            // Add smooth scroll behavior for CTA links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                    }
                });
            });
        });
        // Add entrance animation when page loads
        window.addEventListener('load', () => {
            document.querySelector('.carousel-hero').style.opacity = '1';
        });
    </script>
    <!-- End Carousel Hero Section -->

    <!-- Features Section -->
    <section class="features">
        <div class="section-header">
            <h2>Why Choose CholoSave?</h2>
            <p>Discover the tools that will transform your financial future</p>
        </div>
        <div class="features-grid">
            <div class="feature-card" data-aos="fade-up" data-aos-delay="100">
                <div class="feature-icon-wrapper">
                    <div class="feature-icon">💰</div>
                    <div class="icon-bg"></div>
                </div>
                <h3>Smart Savings</h3>
                <p>Automate your savings and reach your goals faster with AI-powered tailored plans.</p>
                <div class="feature-arrow">→</div>
            </div>
            <div class="feature-card" data-aos="fade-up" data-aos-delay="200">
                <div class="feature-icon-wrapper">
                    <div class="feature-icon">📈</div>
                    <div class="icon-bg"></div>
                </div>
                <h3>Investment Tools</h3>
                <p>Grow your wealth with easy-to-use investment options and expert financial advice.</p>
                <div class="feature-arrow">→</div>
            </div>
            <div class="feature-card" data-aos="fade-up" data-aos-delay="300">
                <div class="feature-icon-wrapper">
                    <div class="feature-icon">🎓</div>
                    <div class="icon-bg"></div>
                </div>
                <h3>Financial Education</h3>
                <p>Access premium resources and tips to make informed financial decisions.</p>
                <div class="feature-arrow">→</div>
            </div>
            <div class="feature-card" data-aos="fade-up" data-aos-delay="400">
                <div class="feature-icon-wrapper">
                    <div class="feature-icon">🤝</div>
                    <div class="icon-bg"></div>
                </div>
                <h3>Community Support</h3>
                <p>Join a supportive community and achieve your financial dreams together.</p>
                <div class="feature-arrow">→</div>
            </div>
        </div>
    </section>

    <!-- How It Works Section -->
    <section class="how-it-works">
        <div class="section-header">
            <h2>How It Works</h2>
            <p>Start your financial journey in three simple steps</p>
        </div>
        <div class="steps-container">
            <div class="step" data-aos="zoom-in" data-aos-delay="100">
                <div class="step-number">01</div>
                <div class="step-content">
                    <div class="step-icon">🚀</div>
                    <h4>Sign Up</h4>
                    <p>Create your free account in seconds with just your email.</p>
                </div>
                <div class="step-connector"></div>
            </div>
            <div class="step" data-aos="zoom-in" data-aos-delay="200">
                <div class="step-number">02</div>
                <div class="step-content">
                    <div class="step-icon">🎯</div>
                    <h4>Set Your Goals</h4>
                    <p>Choose your savings or investment goals with our smart planner.</p>
                </div>
                <div class="step-connector"></div>
            </div>
            <div class="step" data-aos="zoom-in" data-aos-delay="300">
                <div class="step-number">03</div>
                <div class="step-content">
                    <div class="step-icon">📊</div>
                    <h4>Grow Together</h4>
                    <p>Track your progress and celebrate achievements with our community!</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats">
        <div class="stats-container">
            <div class="stat-item" data-aos="fade-up">
                <div class="stat-number" data-count="10000">0</div>
                <div class="stat-label">Happy Users</div>
            </div>
            <div class="stat-item" data-aos="fade-up" data-aos-delay="100">
                <div class="stat-number" data-count="50">0</div>
                <div class="stat-label">Million Saved</div>
            </div>
            <div class="stat-item" data-aos="fade-up" data-aos-delay="200">
                <div class="stat-number" data-count="98">0</div>
                <div class="stat-label">Success Rate</div>
            </div>
            <div class="stat-item" data-aos="fade-up" data-aos-delay="300">
                <div class="stat-number" data-count="24">0</div>
                <div class="stat-label">24/7 Support</div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="testimonials">
        <div class="section-header">
            <h2>What Our Users Say</h2>
            <p>Real stories from real people achieving their financial goals</p>
        </div>
        <div class="testimonials-slider">
            <div class="testimonial-card active" data-aos="fade-left">
                <div class="testimonial-content">
                    <div class="quote-mark">"</div>
                    <p>CholoSave made saving money fun and easy! I reached my first goal in just 3 months and couldn't be happier.</p>
                    <div class="testimonial-author">
                        <div class="author-avatar">A</div>
                        <div class="author-info">
                            <span class="author-name">Ayesha Rahman</span>
                            <span class="author-title">University Student</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="testimonial-card" data-aos="fade-left" data-aos-delay="100">
                <div class="testimonial-content">
                    <div class="quote-mark">"</div>
                    <p>The investment tools are simple to use and the community is incredibly supportive. Best financial decision I've made!</p>
                    <div class="testimonial-author">
                        <div class="author-avatar">R</div>
                        <div class="author-info">
                            <span class="author-name">Rahim Ahmed</span>
                            <span class="author-title">Young Professional</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="testimonial-card" data-aos="fade-left" data-aos-delay="200">
                <div class="testimonial-content">
                    <div class="quote-mark">"</div>
                    <p>I love the educational resources. I finally feel in control of my finances and confident about my future!</p>
                    <div class="testimonial-author">
                        <div class="author-avatar">F</div>
                        <div class="author-info">
                            <span class="author-name">Fatima Khan</span>
                            <span class="author-title">Entrepreneur</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="cta-content">
            <h2>Ready to Start Your Financial Journey?</h2>
            <p>Join thousands of users who are already building their financial future with CholoSave</p>
            <a href="{{ route('register') }}" class="cta-button">
                <span>Start Saving Today</span>
                <div class="button-glow"></div>
            </a>
        </div>
        <div class="cta-bg-animation"></div>
    </section>

    <!-- Footer -->
    <footer class="landing-footer">
        <div class="footer-content">
            <div class="footer-brand">
                <h3>CholoSave</h3>
                <p>Building financial futures, one save at a time.</p>
            </div>
            <div class="footer-links">
                <a href="{{ route('vision') }}">About Us</a>
                <a href="{{ route('contact') }}">Contact</a>
                <a href="#privacy">Privacy Policy</a>
                <a href="#terms">Terms of Service</a>
            </div>
        </div>
        <div class="footer-bottom">
            <span>&copy; {{ date('Y') }} CholoSave. All rights reserved.</span>
        </div>
    </footer>
</div>

<style>
/* Reset and Base Styles */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

.welcome-guest-container {
    font-family: 'Inter', 'Segoe UI', Arial, sans-serif;
    background: #ffffff;
    color: #1e293b;
    overflow-x: hidden;
}

/* Hero Section */
.hero {
    position: relative;
    min-height: 100vh;
    display: flex;
    align-items: center;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    overflow: hidden;
    opacity: 0;
    animation: heroFadeIn 1.2s ease-out 0.2s forwards;
}

@keyframes heroFadeIn {
    from { opacity: 0; transform: translateY(40px); }
    to { opacity: 1; transform: translateY(0); }
}

.hero-bg-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, rgba(59, 130, 246, 0.9) 0%, rgba(139, 92, 246, 0.9) 100%);
    z-index: 1;
}

.hero-particles {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-image: 
        radial-gradient(circle at 20% 80%, rgba(255, 255, 255, 0.1) 1px, transparent 1px),
        radial-gradient(circle at 80% 20%, rgba(255, 255, 255, 0.1) 1px, transparent 1px),
        radial-gradient(circle at 40% 40%, rgba(255, 255, 255, 0.05) 1px, transparent 1px);
    background-size: 100px 100px, 150px 150px, 200px 200px;
    animation: float 20s infinite linear;
    z-index: 1;
}

@keyframes float {
    0% { transform: translateY(0px) rotate(0deg); }
    100% { transform: translateY(-20px) rotate(360deg); }
}

.hero-content {
    position: relative;
    z-index: 2;
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 2rem;
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 4rem;
    align-items: center;
}

.hero-text {
    color: white;
}

.hero-title {
    font-size: 4rem;
    font-weight: 800;
    line-height: 1.1;
    margin-bottom: 2rem;
    text-shadow: 0 4px 24px rgba(30, 41, 59, 0.18), 0 1.5px 0 #fff;
}

.title-line {
    display: block;
    animation: slideInLeft 1s ease-out;
}

.brand-name {
    display: block;
    background: linear-gradient(45deg, #fbbf24, #f59e0b);
    background-clip: text;
    -webkit-background-clip: text;
    color: transparent;
    animation: slideInRight 1s ease-out 0.3s both;
}

.hero-subtitle {
    font-size: 1.3rem;
    margin-bottom: 3rem;
    opacity: 0.95;
    line-height: 1.6;
    animation: fadeInUp 1s ease-out 0.6s both;
}

.cta-buttons {
    display: flex;
    gap: 1.5rem;
    animation: fadeInUp 1s ease-out 0.9s both;
}

.btn-primary, .btn-secondary {
    position: relative;
    padding: 1rem 2rem;
    border-radius: 50px;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275), box-shadow 0.3s;
    font-size: 1.1rem;
    overflow: hidden;
    border: none;
    cursor: pointer;
    box-shadow: 0 2px 16px rgba(251, 191, 36, 0.08);
}

.btn-primary {
    background: linear-gradient(45deg, #fbbf24, #f59e0b);
    color: #1e293b;
}

.btn-primary:hover {
    transform: translateY(-3px) scale(1.07);
    box-shadow: 0 8px 32px 0 rgba(251, 191, 36, 0.25), 0 2px 8px rgba(30, 64, 175, 0.10);
    filter: brightness(1.08);
}

.btn-glow {
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
    transition: left 0.6s;
}

.btn-primary:hover .btn-glow {
    left: 100%;
}

.btn-secondary {
    background: transparent;
    color: white;
    border: 2px solid rgba(255, 255, 255, 0.3);
    backdrop-filter: blur(10px);
}

.btn-secondary:hover {
    background: rgba(255, 255, 255, 0.1);
    border-color: white;
    transform: translateY(-3px);
}

.hero-visual {
    position: relative;
    display: flex;
    justify-content: center;
    align-items: center;
}

.floating-cards {
    position: absolute;
    z-index: 1;
}

.card {
    position: absolute;
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    padding: 1rem 1.5rem;
    border-radius: 15px;
    color: white;
    font-weight: 600;
    font-size: 0.9rem;
    animation: floatCards 6s ease-in-out infinite;
}

.card-1 {
    top: -20px;
    left: -40px;
    animation-delay: 0s;
}

.card-2 {
    top: 50px;
    right: -30px;
    animation-delay: 2s;
}

.card-3 {
    bottom: -10px;
    left: 20px;
    animation-delay: 4s;
}

@keyframes floatCards {
    0%, 100% { transform: translateY(0px) rotate(0deg); }
    50% { transform: translateY(-20px) rotate(5deg); }
}

.hero-image {
    width: 100%;
    max-width: 400px;
    border-radius: 20px;
    box-shadow: 0 25px 50px rgba(0, 0, 0, 0.2);
    animation: heroImageFloat 1.2s ease-out;
    position: relative;
    z-index: 2;
}

.scroll-indicator {
    position: absolute;
    bottom: 30px;
    left: 50%;
    transform: translateX(-50%);
    z-index: 2;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 0.3rem;
}

.scroll-arrow {
    width: 30px;
    height: 30px;
    border: 2px solid white;
    border-top: none;
    border-left: none;
    transform: rotate(45deg);
    animation: bounce 2s infinite;
}

@keyframes bounce {
    0%, 20%, 50%, 80%, 100% { transform: translateY(0) rotate(45deg); }
    40% { transform: translateY(-10px) rotate(45deg); }
    60% { transform: translateY(-5px) rotate(45deg); }
}

.scroll-text {
    color: #fff;
    font-size: 0.95rem;
    opacity: 0.7;
    letter-spacing: 1px;
    margin-top: 0.2rem;
    font-weight: 500;
}

/* Section Headers */
.section-header {
    text-align: center;
    margin-bottom: 4rem;
}

.section-header h2 {
    font-size: 2.5rem;
    font-weight: 700;
    color: #1e293b;
    margin-bottom: 1rem;
}

.section-header p {
    font-size: 1.2rem;
    color: #64748b;
    max-width: 600px;
    margin: 0 auto;
}

/* Features Section */
.features {
    padding: 6rem 2rem;
    background: #f8fafc;
}

.features-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 2.5rem;
    max-width: 1200px;
    margin: 0 auto;
}

.feature-card {
    background: white;
    border-radius: 20px;
    padding: 2.5rem 2rem;
    text-align: center;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    position: relative;
    overflow: hidden;
    border: 1px solid rgba(59, 130, 246, 0.1);
}

.feature-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 25px 50px rgba(59, 130, 246, 0.15);
    border-color: rgba(59, 130, 246, 0.3);
}

.feature-icon-wrapper {
    position: relative;
    display: inline-block;
    margin-bottom: 1.5rem;
}

.feature-icon {
    font-size: 3rem;
    position: relative;
    z-index: 2;
}

.icon-bg {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 80px;
    height: 80px;
    background: linear-gradient(45deg, rgba(59, 130, 246, 0.1), rgba(139, 92, 246, 0.1));
    border-radius: 50%;
    transition: all 0.3s ease;
}

.feature-card:hover .icon-bg {
    transform: translate(-50%, -50%) scale(1.2);
    background: linear-gradient(45deg, rgba(59, 130, 246, 0.2), rgba(139, 92, 246, 0.2));
}

.feature-card h3 {
    font-size: 1.4rem;
    font-weight: 600;
    color: #1e293b;
    margin-bottom: 1rem;
}

.feature-card p {
    color: #64748b;
    line-height: 1.6;
    margin-bottom: 1.5rem;
}

.feature-arrow {
    font-size: 1.5rem;
    color: #3b82f6;
    opacity: 0;
    transform: translateX(-10px);
    transition: all 0.3s ease;
}

.feature-card:hover .feature-arrow {
    opacity: 1;
    transform: translateX(0);
}

/* How It Works Section */
.how-it-works {
    padding: 6rem 2rem;
    background: white;
}

.steps-container {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 2rem;
    max-width: 1000px;
    margin: 0 auto;
    flex-wrap: wrap;
}

.step {
    position: relative;
    text-align: center;
    flex: 1;
    min-width: 250px;
}

.step-number {
    position: absolute;
    top: -10px;
    right: -10px;
    width: 40px;
    height: 40px;
    background: linear-gradient(45deg, #3b82f6, #8b5cf6);
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 1.1rem;
    z-index: 2;
}

.step-content {
    background: white;
    border-radius: 20px;
    padding: 2.5rem 2rem;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
    border: 2px solid #f1f5f9;
    transition: all 0.3s ease;
    position: relative;
}

.step:hover .step-content {
    border-color: #3b82f6;
    transform: translateY(-5px);
}

.step-icon {
    font-size: 2.5rem;
    margin-bottom: 1rem;
}

.step-content h4 {
    font-size: 1.3rem;
    font-weight: 600;
    color: #1e293b;
    margin-bottom: 1rem;
}

.step-content p {
    color: #64748b;
    line-height: 1.6;
}

.step-connector {
    position: absolute;
    top: 50%;
    right: -2rem;
    width: 4rem;
    height: 2px;
    background: linear-gradient(90deg, #3b82f6, #8b5cf6);
    transform: translateY(-50%);
}

.step:last-child .step-connector {
    display: none;
}

/* Stats Section */
.stats {
    padding: 4rem 2rem;
    background: linear-gradient(135deg, #1e293b 60%, #334155 100%, #f8fafc 120%);
    color: white;
    border-radius: 0 0 2rem 2rem;
}

.stats-container {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 3rem;
    max-width: 1000px;
    margin: 0 auto;
    text-align: center;
}

.stat-item {
    padding: 1rem;
}

.stat-number {
    font-size: 3rem;
    font-weight: 800;
    color: #fbbf24;
    display: block;
    margin-bottom: 0.5rem;
}

.stat-label {
    font-size: 1.1rem;
    color: #cbd5e1;
    font-weight: 500;
}

/* Testimonials Section */
.testimonials {
    padding: 6rem 2rem;
    background: #f8fafc;
}

.testimonials-slider {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
    gap: 2rem;
    max-width: 1200px;
    margin: 0 auto;
}

.testimonial-card {
    background: white;
    border-radius: 24px;
    padding: 2.5rem 2rem;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
    transition: all 0.3s ease;
    position: relative;
    border: 1.5px solid #e0e7ef;
}

.testimonial-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 25px 50px rgba(0, 0, 0, 0.1);
}

.quote-mark {
    font-size: 4rem;
    color: #3b82f6;
    line-height: 1;
    margin-bottom: 1rem;
    font-family: serif;
}

.testimonial-content p {
    font-size: 1.1rem;
    line-height: 1.7;
    color: #374151;
    margin-bottom: 2rem;
    font-style: italic;
}

.testimonial-author {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.author-avatar {
    width: 50px;
    height: 50px;
    background: linear-gradient(45deg, #3b82f6, #8b5cf6);
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 1.2rem;
}

.author-name {
    font-weight: 600;
    color: #1e293b;
    display: block;
}

.author-title {
    color: #64748b;
    font-size: 0.9rem;
}

/* CTA Section */
.cta-section {
    position: relative;
    padding: 6rem 2rem;
    background: linear-gradient(135deg, #3b82f6, #8b5cf6);
    color: white;
    text-align: center;
    overflow: hidden;
}

.cta-bg-animation {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: 
        radial-gradient(circle at 20% 80%, rgba(255, 255, 255, 0.1) 0%, transparent 50%),
        radial-gradient(circle at 80% 20%, rgba(255, 255, 255, 0.1) 0%, transparent 50%);
    animation: pulse 4s ease-in-out infinite alternate;
}

@keyframes pulse {
    0% { opacity: 0.5; }
    100% { opacity: 1; }
}

.cta-content {
    position: relative;
    z-index: 2;
    max-width: 600px;
    margin: 0 auto;
}

.cta-content h2 {
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 1.5rem;
}

.cta-content p {
    font-size: 1.2rem;
    margin-bottom: 3rem;
    opacity: 0.9;
}

.cta-button {
    position: relative;
    display: inline-block;
    padding: 1.2rem 3rem;
    background: #fbbf24;
    color: #1e293b;
    text-decoration: none;
    border-radius: 50px;
    font-weight: 700;
    font-size: 1.2rem;
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275), box-shadow 0.3s;
    overflow: hidden;
    box-shadow: 0 15px 35px rgba(251, 191, 36, 0.3);
}

.cta-button:hover {
    transform: translateY(-3px) scale(1.07);
    box-shadow: 0 8px 32px 0 rgba(251, 191, 36, 0.25), 0 2px 8px rgba(30, 64, 175, 0.10);
    filter: brightness(1.08);
}

.button-glow {
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
    transition: left 0.8s;
}

.cta-button:hover .button-glow {
    left: 100%;
}

/* Footer */
.landing-footer {
    background: #1e293b;
    color: white;
    padding: 3rem 2rem 2rem;
}

.footer-content {
    max-width: 1200px;
    margin: 0 auto;
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 3rem;
    align-items: center;
    margin-bottom: 2rem;
}

.footer-brand h3 {
    font-size: 1.8rem;
    font-weight: 700;
    color: #fbbf24;
    margin-bottom: 0.5rem;
}

.footer-brand p {
    color: #cbd5e1;
    line-height: 1.6;
}

.footer-links {
    display: flex;
    gap: 2rem;
    justify-content: flex-end;
    flex-wrap: wrap;
}

.footer-links a {
    color: #cbd5e1;
    text-decoration: none;
    font-weight: 500;
    transition: all 0.3s ease;
    position: relative;
}

.footer-links a:hover {
    color: #fbbf24;
    transform: translateY(-2px);
}

.footer-links a::after {
    content: '';
    position: absolute;
    bottom: -5px;
    left: 0;
    width: 0;
    height: 2px;
    background: #fbbf24;
    transition: width 0.3s ease;
}

.footer-links a:hover::after {
    width: 100%;
}

.footer-bottom {
    text-align: center;
    padding-top: 2rem;
    border-top: 1px solid #374151;
    color: #94a3b8;
}

/* Animation Keyframes */
@keyframes slideInLeft {
    from {
        opacity: 0;
        transform: translateX(-50px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

@keyframes slideInRight {
    from {
        opacity: 0;
        transform: translateX(50px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes heroImageFloat {
    from {
        opacity: 0;
        transform: translateY(30px) scale(0.9);
    }
    to {
        opacity: 1;
        transform: translateY(0) scale(1);
    }
}

/* Scroll Animations */
[data-aos] {
    opacity: 0;
    transition: all 0.8s ease;
}

[data-aos="fade-up"] {
    transform: translateY(30px);
}

[data-aos="fade-left"] {
    transform: translateX(30px);
}

[data-aos="zoom-in"] {
    transform: scale(0.9);
}

[data-aos].aos-animate {
    opacity: 1;
    transform: translateY(0) translateX(0) scale(1);
}

/* Responsive Design */
@media (max-width: 1024px) {
    .hero-content {
        grid-template-columns: 1fr;
        gap: 3rem;
        text-align: center;
    }
    
    .hero-title {
        font-size: 3rem;
    }
    
    .features-grid {
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 2rem;
    }
    
    .steps-container {
        flex-direction: column;
        gap: 1rem;
    }
    
    .step-connector {
        display: none;
    }
}

@media (max-width: 768px) {
    .hero {
        min-height: 70vh;
        padding: 1.5rem 0;
    }
    
    .hero-title {
        font-size: 2.5rem;
    }
    
    .hero-subtitle {
        font-size: 1.1rem;
    }
    
    .cta-buttons {
        flex-direction: column;
        align-items: center;
        gap: 1rem;
    }
    
    .btn-primary, .btn-secondary {
        width: 200px;
        text-align: center;
    }
    
    .section-header h2 {
        font-size: 2rem;
    }
    
    .features, .how-it-works, .testimonials {
        padding: 3rem 0.5rem;
    }
    
    .footer-content {
        grid-template-columns: 1fr;
        text-align: center;
        gap: 2rem;
    }
    
    .footer-links {
        justify-content: center;
    }
    
    .floating-cards {
        display: none;
    }
}

@media (max-width: 480px) {
    .hero-title {
        font-size: 2rem;
    }
    
    .cta-content h2 {
        font-size: 2rem;
    }
    
    .feature-card, .testimonial-card {
        padding: 2rem 1.5rem;
    }
    
    .step-content {
        padding: 2rem 1.5rem;
    }
}

/* JavaScript Animation Trigger Styles */
.animate-counter {
    transition: all 2s ease-out;
}

.reveal {
    opacity: 1 !important;
    transform: translateY(0) !important;
}

/* Additional Interactive Elements */
.hero::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: 
        radial-gradient(ellipse at top, rgba(59, 130, 246, 0.1) 0%, transparent 70%),
        radial-gradient(ellipse at bottom, rgba(139, 92, 246, 0.1) 0%, transparent 70%);
    z-index: 0;
    animation: gradientShift 8s ease-in-out infinite alternate;
}

@keyframes gradientShift {
    0% {
        transform: scale(1) rotate(0deg);
    }
    100% {
        transform: scale(1.1) rotate(5deg);
    }
}

/* Loading Animation for Images */
.hero-image {
    position: relative;
    overflow: hidden;
}

.hero-image::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
    animation: shimmer 2s infinite;
    z-index: 1;
}

@keyframes shimmer {
    0% { left: -100%; }
    100% { left: 100%; }
}

/* Hover Effects for Better Interactivity */
.feature-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(45deg, rgba(59, 130, 246, 0.05), rgba(139, 92, 246, 0.05));
    opacity: 0;
    transition: opacity 0.3s ease;
    border-radius: 20px;
}

.feature-card:hover::before {
    opacity: 1;
}

.testimonial-card::after {
    content: '';
    position: absolute;
    top: -2px;
    left: -2px;
    right: -2px;
    bottom: -2px;
    background: linear-gradient(45deg, #3b82f6, #8b5cf6, #3b82f6);
    border-radius: 22px;
    z-index: -1;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.testimonial-card:hover::after {
    opacity: 1;
}
</style>

<script>
// Smooth scrolling and animations
document.addEventListener('DOMContentLoaded', function() {
    // Counter animation for stats
    const counters = document.querySelectorAll('.stat-number');
    const speed = 200;

    const animateCounters = () => {
        counters.forEach(counter => {
            const target = parseInt(counter.getAttribute('data-count'));
            const count = parseInt(counter.innerText);
            const inc = target / speed;

            if (count < target) {
                counter.innerText = Math.ceil(count + inc);
                setTimeout(animateCounters, 10);
            } else {
                counter.innerText = target;
            }
        });
    };

    // Intersection Observer for scroll animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('aos-animate');
                
                // Trigger counter animation when stats section is visible
                if (entry.target.classList.contains('stats')) {
                    animateCounters();
                }
            }
        });
    }, observerOptions);

    // Observe all elements with data-aos attribute
    document.querySelectorAll('[data-aos]').forEach(el => {
        observer.observe(el);
    });

    // Observe stats section
    const statsSection = document.querySelector('.stats');
    if (statsSection) {
        observer.observe(statsSection);
    }

    // Smooth scroll for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    // Parallax effect for hero section
    let ticking = false;
    
    function updateParallax() {
        const scrolled = window.pageYOffset;
        const parallaxElements = document.querySelectorAll('.hero-particles, .hero-bg-overlay');
        
        parallaxElements.forEach(element => {
            const speed = element.classList.contains('hero-particles') ? 0.5 : 0.3;
            element.style.transform = `translateY(${scrolled * speed}px)`;
        });
        
        ticking = false;
    }

    function requestTick() {
        if (!ticking) {
            requestAnimationFrame(updateParallax);
            ticking = true;
        }
    }

    window.addEventListener('scroll', requestTick);

    // Add loading animation complete class
    window.addEventListener('load', function() {
        document.body.classList.add('loaded');
    });

    // Testimonial slider auto-rotation (optional)
    const testimonialCards = document.querySelectorAll('.testimonial-card');
    let currentTestimonial = 0;

    function rotateTestimonials() {
        testimonialCards.forEach((card, index) => {
            card.classList.remove('active');
            if (index === currentTestimonial) {
                card.classList.add('active');
            }
        });
        
        currentTestimonial = (currentTestimonial + 1) % testimonialCards.length;
    }

    // Auto-rotate testimonials every 5 seconds
    setInterval(rotateTestimonials, 5000);
});
</script>
@endauth
@endsection