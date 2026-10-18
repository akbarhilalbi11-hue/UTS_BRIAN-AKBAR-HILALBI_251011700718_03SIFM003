<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ElectroStore - Katalog Modern</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Google Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <!-- Custom Modern CSS -->
    <style>
        :root {
            --primary: #4F46E5; /* Indigo Modern */
            --primary-hover: #4338CA;
            --bg-body: #F3F4F6; /* Soft Gray */
            --text-dark: #111827;
            --text-muted: #6B7280;
            --radius-lg: 1.25rem;
            --radius-md: 0.75rem;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-body);
            color: var(--text-dark);
            -webkit-font-smoothing: antialiased;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* Glassmorphism Navbar */
        .navbar-custom {
            background-color: rgba(255, 255, 255, 0.85) !important;
            backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }
        
        .navbar-brand {
            font-weight: 700;
            letter-spacing: -0.5px;
            color: var(--primary) !important;
        }

        /* Modern Card with Soft Shadows & Smooth Hover */
        .card-modern {
            background: #ffffff;
            border: none;
            border-radius: var(--radius-lg);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.03), 0 2px 4px -1px rgba(0, 0, 0, 0.02);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            overflow: hidden;
            height: 100%;
        }

        .card-modern:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        /* Modern Buttons */
        .btn-modern {
            padding: 0.6rem 1.5rem;
            font-weight: 500;
            border-radius: var(--radius-md);
            transition: all 0.3s ease;
        }

        .btn-primary-modern {
            background-color: var(--primary);
            border: none;
            color: white;
        }

        .btn-primary-modern:hover {
            background-color: var(--primary-hover);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 8px 15px rgba(79, 70, 229, 0.3);
        }

        main {
            flex: 1; /* Makes footer stick to bottom */
        }

        footer {
            background-color: #ffffff;
            border-top: 1px solid rgba(0, 0, 0, 0.05);
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-custom sticky-top py-3">
        <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center gap-1 gap-lg-3">
                        <li class="nav-item">
                            <a class="nav-link fw-medium {{ request()->is('/') ? 'active text-primary' : '' }}" href="{{ url('/') }}">
                                <i class="bi bi-house-door-fill me-1 d-none d-lg-inline"></i> Beranda
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fw-medium {{ request()->is('katalog*') ? 'active text-primary' : '' }}" href="{{ route('electronics.index') }}">
                                <i class="bi bi-grid-fill me-1 d-none d-lg-inline"></i> Katalog
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fw-medium {{ request()->is('about') ? 'active text-primary' : '' }}" href="{{ route('about') }}">
                                <i class="bi bi-info-circle-fill me-1 d-none d-lg-inline"></i> Tentang Kami
                            </a>
                        </li>
                        
                        <!-- Pembatas Vertikal (Hanya tampil di layar besar) -->
                        <li class="nav-item d-none d-lg-block">
                            <div class="vr h-100 mx-2 text-muted"></div>
                        </li>

                        <!-- Tombol Keranjang Modern (Diberi margin kanan me-lg-4 agar tidak mepet tepi) -->
                        <li class="nav-item mt-3 mt-lg-0 me-3 me-lg-4">
                            <a href="{{ route('cart.index') }}" class="btn btn-light border position-relative rounded-pill px-4 py-2 d-flex align-items-center gap-2 hover-shadow" style="transition: all 0.3s ease;">
                                <i class="bi bi-cart-fill text-primary fs-5"></i> 
                                <span class="fw-bold text-dark d-lg-none d-xl-inline">Keranjang</span>
                                
                                @if(session('cart') && count(session('cart')) > 0)
                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger border border-2 border-white shadow-sm" style="font-size: 0.75rem; padding: 0.35em 0.65em;">
                                        {{ count(session('cart')) }}
                                    </span>
                                @endif
                            </a>
                        </li>
                    </ul>
            </div>
    </nav>

    <!-- Konten Dinamis -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="py-4 mt-5">
        <div class="container text-center">
            <p class="text-muted mb-0 fw-medium">
                <small>&copy; {{ date('Y') }} ElectroStore - UTS Rekayasa Web.</small>
            </p>
        </div>
    </footer>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>