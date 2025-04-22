@extends('layouts.app')

@section('title', 'Register - CholoSave')

@section('content')
<div class="login-container">
    <div class="login-card">
        <div class="login-image">
            <img src="/test_project/assets/images/register.png" alt="Register">
            <h2>Join CholoSave Today!</h2>
            <p>Create your account and start your financial journey</p>
        </div>
        
        <div class="login-form">
            <h1 class="login-title">Register with <span>CholoSave</span></h1>
            
            @if($errors->any())
                <div class="alert alert-error">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}">
                @csrf
                
                <div class="form-group">
                    <label class="form-label" for="name">Full Name</label>
                    <input 
                        type="text" 
                        id="name" 
                        name="name" 
                        class="form-input"
                        placeholder="Enter your full name"
                        value="{{ old('name') }}"
                        required
                    >
                </div>

                <div class="form-group">
                    <label class="form-label" for="email">Email Address</label>
                    <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        class="form-input"
                        placeholder="Enter your email"
                        value="{{ old('email') }}"
                        required
                    >
                </div>

                <div class="form-group">
                    <label class="form-label" for="phone_number">Phone Number</label>
                    <input 
                        type="tel" 
                        id="phone_number" 
                        name="phone_number" 
                        class="form-input"
                        placeholder="Enter your phone number"
                        value="{{ old('phone_number') }}"
                        required
                    >
                </div>
                
                <div class="form-group">
                    <label class="form-label" for="password">Password</label>
                    <input 
                        type="password" 
                        id="password" 
                        name="password" 
                        class="form-input"
                        placeholder="Create your password"
                        required
                    >
                </div>

                <div class="form-group">
                    <label class="form-label" for="password_confirmation">Confirm Password</label>
                    <input 
                        type="password" 
                        id="password_confirmation" 
                        name="password_confirmation" 
                        class="form-input"
                        placeholder="Confirm your password"
                        required
                    >
                </div>
                
                <button type="submit" class="login-button">
                    Create Account
                </button>
            </form>
            
            <div class="register-link">
                Already have an account? 
                <a href="{{ route('login') }}">Login here</a>
            </div>
        </div>
    </div>
</div>

<style>
.login-container {
    font-family: 'Poppins', sans-serif;
    min-height: calc(100vh - 5rem);
    background-color: #f4f7f9;
    padding: 2rem 1rem;
}

.login-card {
    max-width: 1000px;
    margin: 0 auto;
    background: #ffffff;
    border-radius: 1rem;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    overflow: hidden;
    display: flex;
}

.login-image {
    width: 50%;
    background: linear-gradient(135deg, #003366 0%, #004080 100%);
    padding: 2rem;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    color: white;
}

.login-image img {
    max-width: 80%;
    height: auto;
    margin-bottom: 2rem;
}

.login-form {
    width: 50%;
    padding: 3rem 2rem;
}

.login-title {
    font-size: 2rem;
    font-weight: 700;
    text-align: center;
    margin-bottom: 2rem;
}

.login-title span {
    background: linear-gradient(135deg, #22C55E 0%, #16A34A 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

.form-group {
    margin-bottom: 1.5rem;
}

.form-label {
    display: block;
    font-size: 0.875rem;
    font-weight: 500;
    color: #4B5563;
    margin-bottom: 0.5rem;
}

.form-input {
    width: 100%;
    padding: 0.75rem 1rem;
    border: 1px solid #E5E7EB;
    border-radius: 0.5rem;
    font-family: 'Poppins', sans-serif;
    transition: all 0.3s ease;
}

.form-input:focus {
    outline: none;
    border-color: #1E40AF;
    box-shadow: 0 0 0 3px rgba(30, 64, 175, 0.1);
}

.login-button {
    width: 100%;
    padding: 0.875rem;
    background: linear-gradient(135deg, #1E40AF 0%, #1E3A8A 100%);
    color: white;
    border: none;
    border-radius: 0.5rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
}

.login-button:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
}

.register-link {
    text-align: center;
    margin-top: 1.5rem;
    color: #4B5563;
    font-size: 0.875rem;
}

.register-link a {
    color: #1E40AF;
    text-decoration: none;
    font-weight: 500;
}

.register-link a:hover {
    text-decoration: underline;
}

.alert {
    padding: 1rem;
    border-radius: 0.5rem;
    margin-bottom: 1.5rem;
}

.alert-error {
    background-color: #FEE2E2;
    color: #991B1B;
    border: 1px solid #FCA5A5;
}

.alert-success {
    background-color: #D1FAE5;
    color: #065F46;
    border: 1px solid #6EE7B7;
}

@media (max-width: 768px) {
    .login-card {
        flex-direction: column;
    }
    
    .login-image,
    .login-form {
        width: 100%;
    }
    
    .login-image {
        padding: 2rem 1rem;
    }
    
    .login-form {
        padding: 2rem 1.5rem;
    }
}
</style>
@endsection