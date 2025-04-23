<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'CholoSave')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        .header {
            background-color: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            border-bottom: 1px solid rgba(255, 255, 255, 0.3);
        }

        .container-custom {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1rem;
            height: 5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo a {
            font-size: 1.8rem;
            font-weight: 700;
            background: linear-gradient(135deg, #22C55E 0%, #16A34A 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            text-decoration: none;
        }

        .nav {
            display: flex;
            gap: 2rem;
            align-items: center;
        }

        .nav-item {
            color: #4B5563;
            text-decoration: none;
            padding: 0.5rem 0.75rem;
            transition: all 0.3s ease;
            position: relative;
        }

        .nav-item:hover {
            color: #1E40AF;
        }

        .btn-login, .btn-register {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            border-radius: 0.375rem;
            font-weight: 600;
            padding: 0.625rem 1.25rem;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .btn-login {
            background-color: #1E40AF;
            color: white;
        }

        .btn-login:hover {
            background-color: #1E3A8A;
        }

        .btn-register {
            background-color: #16A34A;
            color: white;
        }

        .btn-register:hover {
            background-color: #15803D;
        }
    </style>
    @yield('styles')
</head>
<body>
    <!-- Header -->
    <header class="header">
        <div class="container-custom">
            <div class="logo">
                <a href="{{ route('home') }}">CholoSave</a>
            </div>
            <nav class="nav">
                <a href="{{ route('home') }}" class="nav-item">Home</a>
                <a href="{{ route('vision') }}" class="nav-item">Vision</a>
                <a href="{{ route('experts') }}" class="nav-item">Experts</a>
                <a href="{{ route('contact') }}" class="nav-item">Contact</a>
                <a href="{{ route('login') }}" class="btn-login">Login</a>
                <a href="{{ route('register') }}" class="btn-register">Register</a>
            </nav>
        </div>
    </header>

    <main style="margin-top: 5rem;">
        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html> 