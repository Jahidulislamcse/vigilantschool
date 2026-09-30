<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Admin Sign In - {{ $settings['site_title'] ?? 'Vigilant School' }}</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    
    <!-- Favicon -->
    <link href="{{ asset($settings['site_favicon'] ?? 'kider/img/favicon.ico') }}" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        :root {
            --primary: #FE5D37;
            --primary-dark: #e04824;
            --secondary: #103741;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #103741 0%, #194e5b 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .login-card {
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            width: 100%;
            max-width: 440px;
        }

        .login-header {
            background: #f8fafc;
            padding: 2.2rem 2rem 1.8rem;
            text-align: center;
            border-bottom: 1px solid #edf2f7;
        }

        .login-header .logo-icon {
            width: 60px;
            height: 60px;
            background: rgba(254, 93, 55, 0.1);
            color: var(--primary);
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            margin-bottom: 1rem;
        }

        .login-body {
            padding: 2rem;
        }

        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 0.25rem rgba(254, 93, 55, 0.25);
        }

        .btn-primary {
            background-color: var(--primary);
            border-color: var(--primary);
            padding: 0.75rem;
            font-weight: 600;
        }

        .btn-primary:hover {
            background-color: var(--primary-dark);
            border-color: var(--primary-dark);
        }
    </style>
</head>
<body>

<div class="login-card">
    <div class="login-header">
        <div class="logo-icon">
            <i class="fa fa-graduation-cap"></i>
        </div>
        <h4 class="fw-bold mb-1 text-dark">{{ $settings['site_title'] ?? 'Vigilant School' }}</h4>
        <p class="text-muted small mb-0">Sign in to your administrative control panel</p>
    </div>

    <div class="login-body">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show small" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show small" role="alert">
                <ul class="mb-0 ps-3">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <form action="{{ route('admin.login.submit') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="email" class="form-label fw-semibold small text-secondary">Email Address</label>
                <div class="input-group">
                    <span class="input-group-text bg-light border-end-0 text-muted"><i class="fa fa-envelope"></i></span>
                    <input type="email" class="form-control border-start-0 ps-0" id="email" name="email" value="{{ old('email') }}" placeholder="admin@example.com" required autofocus>
                </div>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label fw-semibold small text-secondary">Password</label>
                <div class="input-group">
                    <span class="input-group-text bg-light border-end-0 text-muted"><i class="fa fa-lock"></i></span>
                    <input type="password" class="form-control border-start-0 ps-0" id="password" name="password" placeholder="••••••••" required>
                </div>
            </div>

            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="remember" name="remember" checked>
                    <label class="form-check-label small text-muted" for="remember">Remember me</label>
                </div>
            </div>

            <button type="submit" class="btn btn-primary w-100 rounded-pill mb-3">
                <i class="fa fa-arrow-right-to-bracket me-2"></i> Sign In
            </button>

            <div class="text-center mt-3">
                <a href="{{ route('home') }}" class="text-decoration-none small text-muted">
                    <i class="fa fa-arrow-left me-1"></i> Back to Website
                </a>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
