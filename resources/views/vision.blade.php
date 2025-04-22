@extends('layouts.app')

@section('title', 'Our Vision - CholoSave')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<style>
    body {
        font-family: 'Poppins', sans-serif;
        background-color: #f4f7f9;
    }

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

    /* Impact Section */
    .impact-section {
        padding: 5rem 0;
        background: white;
        position: relative;
    }

    .section-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 1rem;
    }

    .section-title {
        font-size: 2.5rem;
        font-weight: 700;
        text-align: center;
        margin-bottom: 3rem;
        background: linear-gradient(135deg, #1E40AF 0%, #1E3A8A 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        opacity: 0;
        transform: translateY(20px);
        animation: fadeInUp 1s ease forwards 0.5s;
    }

    .impact-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 2rem;
    }

    .impact-card {
        background: #f8fafc;
        border-radius: 1rem;
        padding: 2rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        opacity: 0;
        transform: translateY(20px);
    }

    .impact-card:nth-child(1) { animation: fadeInUp 1s ease forwards 0.7s; }
    .impact-card:nth-child(2) { animation: fadeInUp 1s ease forwards 0.9s; }
    .impact-card:nth-child(3) { animation: fadeInUp 1s ease forwards 1.1s; }

    .impact-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }

    .impact-icon {
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

    .impact-title {
        font-size: 1.5rem;
        font-weight: 600;
        color: #1E40AF;
        margin-bottom: 1rem;
    }

    .impact-description {
        color: #4B5563;
        line-height: 1.6;
    }

    /* Goals Section */
    .goals-section {
        padding: 5rem 0;
        background: #f4f7f9;
        position: relative;
    }

    .goals-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
    }

    .goal-item {
        display: flex;
        align-items: center;
        gap: 1.5rem;
        background: white;
        padding: 1.5rem;
        border-radius: 1rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
        opacity: 0;
        transform: translateY(20px);
    }

    .goal-item:nth-child(1) { animation: fadeInUp 1s ease forwards 0.7s; }
    .goal-item:nth-child(2) { animation: fadeInUp 1s ease forwards 0.9s; }
    .goal-item:nth-child(3) { animation: fadeInUp 1s ease forwards 1.1s; }
    .goal-item:nth-child(4) { animation: fadeInUp 1s ease forwards 1.3s; }

    .goal-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }

    .goal-icon {
        width: 60px;
        height: 60px;
        border-radius: 0.75rem;
        background: linear-gradient(135deg, #1E40AF 0%, #1E3A8A 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.5rem;
    }

    .goal-text {
        font-size: 1.125rem;
        color: #4B5563;
        font-weight: 500;
    }

    /* Stats Section */
    .stats-section {
        padding: 5rem 0;
        background: linear-gradient(135deg, #1E40AF 0%, #1E3A8A 100%);
        color: white;
        position: relative;
        overflow: hidden;
    }

    .stats-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.1'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        opacity: 0.1;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 2rem;
        max-width: 800px;
        margin: 0 auto;
        position: relative;
        z-index: 1;
    }

    .stat-card {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border-radius: 1rem;
        padding: 2rem;
        text-align: center;
        transition: all 0.3s ease;
        opacity: 0;
        transform: translateY(20px);
    }

    .stat-card:nth-child(1) { animation: fadeInUp 1s ease forwards 0.7s; }
    .stat-card:nth-child(2) { animation: fadeInUp 1s ease forwards 0.9s; }

    .stat-card:hover {
        transform: scale(1.05);
        background: rgba(255, 255, 255, 0.15);
    }

    .stat-icon {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 80px;
        height: 80px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 50%;
        margin-bottom: 1rem;
        font-size: 2rem;
    }

    .stat-title {
        font-size: 1.25rem;
        font-weight: 500;
        margin-bottom: 0.5rem;
    }

    .stat-number {
        font-size: 3rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
        background: linear-gradient(135deg, #ffffff 0%, #f3f4f6 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .stat-description {
        color: rgba(255, 255, 255, 0.9);
    }

    .cta-button {
        display: inline-block;
        background: white;
        color: #1E40AF;
        padding: 1rem 2rem;
        border-radius: 0.5rem;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
        margin-top: 3rem;
        position: relative;
        overflow: hidden;
        z-index: 1;
    }

    .cta-button::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, #1E40AF 0%, #1E3A8A 100%);
        opacity: 0;
        z-index: -1;
        transition: opacity 0.3s ease;
    }

    .cta-button:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        color: white;
    }

    .cta-button:hover::before {
        opacity: 1;
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

    @media (max-width: 768px) {
        .hero-title {
            font-size: 2.5rem;
        }

        .hero-description {
            font-size: 1rem;
        }

        .impact-grid {
            grid-template-columns: 1fr;
        }

        .stats-grid {
            grid-template-columns: 1fr;
        }

        .goals-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<main>
    <!-- Hero Section -->
    <section class="hero-section">
    <img src="/images/vision/hero.jpg" alt="Financial Vision" class="hero-image"/>
        <div class="hero-content">
            <h1 class="hero-title">Our Vision</h1>
            <p class="hero-description">
                At CholoSave, our vision is to empower people to achieve financial independence through collaboration and smart investments. We believe in creating a platform that supports financial growth for everyone, regardless of background or financial knowledge.
            </p>
        </div>
    </section>

    <!-- Impact Section -->
    <section class="impact-section">
        <div class="section-container">
            <h2 class="section-title">How We Make an Impact</h2>
            <div class="impact-grid">
                <div class="impact-card">
                    <div class="impact-icon">
                        <i class="fas fa-handshake"></i>
                    </div>
                    <h3 class="impact-title">Collaboration</h3>
                    <p class="impact-description">
                        By pooling resources and working together, we unlock greater investment opportunities and savings potential for everyone involved.
                    </p>
                </div>
                <div class="impact-card">
                    <div class="impact-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <h3 class="impact-title">Smart Investment</h3>
                    <p class="impact-description">
                        We provide intelligent tools and guidance to ensure that your investments grow steadily, maximizing returns with minimal risk.
                    </p>
                </div>
                <div class="impact-card">
                    <div class="impact-icon">
                        <i class="fas fa-unlock-alt"></i>
                    </div>
                    <h3 class="impact-title">Financial Freedom</h3>
                    <p class="impact-description">
                        Our goal is to help you gain financial freedom through consistent savings, smart investments, and the support of like-minded individuals.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Goals Section -->
    <section class="goals-section">
        <div class="section-container">
            <h2 class="section-title">Our Goals</h2>
            <div class="goals-grid">
                <div class="goal-item">
                    <div class="goal-icon">
                        <i class="fas fa-tools"></i>
                    </div>
                    <p class="goal-text">Provide accessible financial tools for everyone.</p>
                </div>
                <div class="goal-item">
                    <div class="goal-icon">
                        <i class="fas fa-piggy-bank"></i>
                    </div>
                    <p class="goal-text">Encourage a culture of saving and smart investing.</p>
                </div>
                <div class="goal-item">
                    <div class="goal-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <p class="goal-text">Foster a community of financial empowerment and collaboration.</p>
                </div>
                <div class="goal-item">
                    <div class="goal-icon">
                        <i class="fas fa-rocket"></i>
                    </div>
                    <p class="goal-text">Help members achieve long-term financial independence.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats-section">
        <div class="section-container">
            <h2 class="section-title" style="color: white; background: none; -webkit-text-fill-color: white;">Our Growing Community</h2>
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <h3 class="stat-title">Total Users</h3>
                    <div class="stat-number" id="userCount" data-target="{{ $userCount ?? 0 }}">0</div>
                    <p class="stat-description">Active members in our community</p>
                </div>
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <h3 class="stat-title">Active Groups</h3>
                    <div class="stat-number" id="groupCount" data-target="{{ $groupCount ?? 0 }}">0</div>
                    <p class="stat-description">Collaborative saving groups</p>
                </div>
            </div>
            <div style="text-align: center;">
                <a href="{{ route('register') }}" class="cta-button">Join Our Community</a>
            </div>
        </div>
    </section>
</main>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const countElements = document.querySelectorAll('#userCount, #groupCount');
        
        const animateValue = (element, start, end, duration) => {
            let startTimestamp = null;
            const step = (timestamp) => {
                if (!startTimestamp) startTimestamp = timestamp;
                const progress = Math.min((timestamp - startTimestamp) / duration, 1);
                const current = Math.floor(progress * (end - start) + start);
                element.textContent = new Intl.NumberFormat().format(current);
                if (progress < 1) {
                    window.requestAnimationFrame(step);
                }
            };
            window.requestAnimationFrame(step);
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const target = parseInt(entry.target.getAttribute('data-target'));
                    animateValue(entry.target, 0, target, 2000);
                    observer.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.5
        });

        countElements.forEach(counter => {
            observer.observe(counter);
        });
    });
</script>
@endsection