@extends('layouts.app')

@section('title', 'Contact Us - CholoSave')

@section('content')
<div class="contact-container">
    <div class="contact-wrapper">
        <!-- Contact Information Section -->
        <div class="contact-info">
            <h2>Get in Touch</h2>
            <p class="contact-description">
                Have questions or need assistance? We're here to help! Reach out to us through any of the following channels.
            </p>
            
            <div class="info-cards">
                <div class="info-card">
                    <div class="icon-wrapper">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <h3>Our Location</h3>
                    <p>123 Main Street, City, Country</p>
                </div>
                
                <div class="info-card">
                    <div class="icon-wrapper">
                        <i class="fas fa-phone"></i>
                    </div>
                    <h3>Phone Number</h3>
                    <p>+1 234 567 890</p>
                </div>
                
                <div class="info-card">
                    <div class="icon-wrapper">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <h3>Email Address</h3>
                    <p>info@cholosave.com</p>
                </div>
            </div>
        </div>

        <!-- Contact Form Section -->
        <div class="contact-form">
            <h2>Send Us a Message</h2>
            
            @if(session('success'))
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i>
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('contact.submit') }}" class="form">
                @csrf
                
                <div class="form-group">
                    <label for="name">Full Name</label>
                    <div class="input-wrapper">
                        <i class="fas fa-user"></i>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="Enter your full name" required>
                    </div>
                    @error('name')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email">Email Address</label>
                    <div class="input-wrapper">
                        <i class="fas fa-envelope"></i>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="Enter your email address" required>
                    </div>
                    @error('email')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="description">Message</label>
                    <div class="input-wrapper">
                        <i class="fas fa-comment"></i>
                        <textarea id="description" name="description" rows="5" placeholder="Type your message here" required>{{ old('description') }}</textarea>
                    </div>
                    @error('description')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="submit-button">
                    <i class="fas fa-paper-plane"></i>
                    Send Message
                </button>
            </form>
        </div>
    </div>
</div>

<style>
    .contact-container {
        min-height: calc(100vh - 5rem);
        background-color: #f8f9fa;
        padding: 2rem 1rem;
    }

    .contact-wrapper {
        max-width: 1200px;
        margin: 0 auto;
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 2rem;
    }

    .contact-info {
        background: linear-gradient(135deg, #1E40AF 0%, #1E3A8A 100%);
        padding: 2rem;
        border-radius: 1rem;
        color: white;
    }

    .contact-info h2 {
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 1rem;
    }

    .contact-description {
        font-size: 1.1rem;
        opacity: 0.9;
        margin-bottom: 2rem;
    }

    .info-cards {
        display: grid;
        gap: 1.5rem;
    }

    .info-card {
        background: rgba(255, 255, 255, 0.1);
        padding: 1.5rem;
        border-radius: 0.5rem;
        backdrop-filter: blur(10px);
    }

    .info-card h3 {
        font-size: 1.2rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
    }

    .info-card p {
        opacity: 0.9;
    }

    .icon-wrapper {
        width: 40px;
        height: 40px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1rem;
    }

    .icon-wrapper i {
        font-size: 1.2rem;
    }

    .contact-form {
        background: white;
        padding: 2rem;
        border-radius: 1rem;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    }

    .contact-form h2 {
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 1.5rem;
        color: #1E40AF;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-group label {
        display: block;
        font-weight: 500;
        margin-bottom: 0.5rem;
        color: #4B5563;
    }

    .input-wrapper {
        position: relative;
    }

    .input-wrapper i {
        position: absolute;
        left: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: #9CA3AF;
    }

    .input-wrapper input,
    .input-wrapper textarea {
        width: 100%;
        padding: 0.75rem 1rem 0.75rem 2.5rem;
        border: 1px solid #E5E7EB;
        border-radius: 0.5rem;
        font-size: 1rem;
        transition: all 0.3s ease;
    }

    .input-wrapper textarea {
        padding-left: 2.5rem;
        resize: vertical;
    }

    .input-wrapper input:focus,
    .input-wrapper textarea:focus {
        outline: none;
        border-color: #1E40AF;
        box-shadow: 0 0 0 3px rgba(30, 64, 175, 0.1);
    }

    .error-message {
        color: #DC2626;
        font-size: 0.875rem;
        margin-top: 0.25rem;
    }

    .submit-button {
        width: 100%;
        padding: 1rem;
        background: linear-gradient(135deg, #1E40AF 0%, #1E3A8A 100%);
        color: white;
        border: none;
        border-radius: 0.5rem;
        font-weight: 600;
        font-size: 1rem;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
    }

    .submit-button:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    }

    .alert {
        padding: 1rem;
        border-radius: 0.5rem;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .alert-success {
        background-color: #D1FAE5;
        color: #065F46;
        border: 1px solid #6EE7B7;
    }

    @media (max-width: 768px) {
        .contact-wrapper {
            grid-template-columns: 1fr;
        }
    }
</style>
@endsection 