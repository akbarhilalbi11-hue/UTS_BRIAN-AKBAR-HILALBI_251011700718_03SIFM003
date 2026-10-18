@extends('layouts.app')

@section('content')
<style>
    /* Animasi Kubus Berputar & Melayang */
    @keyframes floatCube {
        0% { transform: translateY(0px) rotate(45deg); opacity: 0.4; }
        50% { transform: translateY(-25px) rotate(65deg); opacity: 0.8; }
        100% { transform: translateY(0px) rotate(45deg); opacity: 0.4; }
    }
    .cube {
        position: absolute;
        border-radius: 12px;
        z-index: 0;
        animation: floatCube 6s ease-in-out infinite;
        backdrop-filter: blur(5px);
    }
    
    /* Posisi & Warna Masing-masing Kubus (Tersebar untuk halaman About) */
    .cube-1 { width: 70px; height: 70px; top: 5%; left: 5%; background: linear-gradient(135deg, rgba(79,70,229,0.3) 0%, rgba(139,92,246,0.3) 100%); animation-delay: 0s; }
    .cube-2 { width: 50px; height: 50px; bottom: 15%; left: 8%; background: linear-gradient(135deg, rgba(16,185,129,0.3) 0%, rgba(52,211,153,0.3) 100%); animation-delay: 2s; }
    .cube-3 { width: 90px; height: 90px; top: 35%; right: 5%; background: linear-gradient(135deg, rgba(245,158,11,0.3) 0%, rgba(251,191,36,0.3) 100%); animation-delay: 4s; }
    .cube-4 { width: 40px; height: 40px; bottom: 25%; right: 12%; background: linear-gradient(135deg, rgba(236,72,153,0.3) 0%, rgba(244,114,182,0.3) 100%); animation-delay: 1s; }
    .cube-5 { width: 80px; height: 80px; top: 60%; left: 45%; background: linear-gradient(135deg, rgba(59,130,246,0.3) 0%, rgba(147,197,253,0.3) 100%); animation-delay: 3s; }

    /* Styling Khusus Halaman About */
    .about-hero {
        background: linear-gradient(135deg, rgba(79,70,229,0.05) 0%, rgba(139,92,246,0.05) 100%);
        border-radius: 2rem;
        padding: 4rem 2rem;
        margin-top: 2rem;
        position: relative;
        overflow: hidden;
    }

    .about-hero::before {
        content: '';
        position: absolute;
        top: -50px;
        left: -50px;
        width: 200px;
        height: 200px;
        background: radial-gradient(circle, rgba(79,70,229,0.1) 0%, rgba(255,255,255,0) 70%);
        border-radius: 50%;
    }

    .feature-card {
        background: #ffffff;
        border-radius: 1.5rem;
        padding: 2rem;
        border: 1px solid rgba(0,0,0,0.05);
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.02);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        height: 100%;
        position: relative;
        overflow: hidden;
    }

    .feature-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.05);
        border-color: rgba(79,70,229,0.2);
    }

    .feature-icon-wrapper {
        width: 60px;
        height: 60px;
        border-radius: 1rem;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.8rem;
        margin-bottom: 1.5rem;
        background: linear-gradient(135deg, rgba(79,70,229,0.1) 0%, rgba(139,92,246,0.1) 100%);
        color: var(--primary);
        transition: transform 0.3s ease;
    }

    .feature-card:hover .feature-icon-wrapper {
        transform: scale(1.1) rotate(5deg);
    }

    .team-card {
        background: rgba(255, 255, 255, 0.8);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.9);
        border-radius: 2rem;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.05);
        overflow: hidden;
    }
    
    .team-header-bg {
        background: linear-gradient(135deg, var(--primary) 0%, #8b5cf6 100%);
        height: 120px;
        width: 100%;
    }
    
    .team-avatar {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        border: 4px solid #ffffff;
        background-color: #f3f4f6;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: -50px auto 1rem;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        font-size: 2.5rem;
        color: var(--primary);
    }

    /* Asymmetric Grid Image */
    .image-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        grid-gap: 1rem;
    }
    .img-main {
        grid-column: 1 / 3;
        border-radius: 1.5rem;
        height: 250px;
        object-fit: cover;
        width: 100%;
    }
    .img-sub {
        border-radius: 1.5rem;
        height: 180px;
        object-fit: cover;
        width: 100%;
    }
</style>

<!-- Wrapper dengan position-relative agar kubus tetap berada di dalam halaman ini -->
<div class="position-relative overflow-hidden w-100" style="min-height: 100vh;">
    
    <!-- Kubus Dekorasi Latar Belakang -->
    <div class="cube cube-1"></div>
    <div class="cube cube-2"></div>
    <div class="cube cube-3"></div>
    <div class="cube cube-4"></div>
    <div class="cube cube-5"></div>

    <div class="container pb-5 position-relative" style="z-index: 1;">
        
        <!-- Hero Section About -->
        <div class="about-hero text-center mb-5">
            <h1 class="display-5 fw-bold mb-3" style="color: var(--text-dark); letter-spacing: -1px;">
                Mengenal Lebih Dekat <br/>
                <span class="text-primary">ElectroStore</span>
            </h1>
            <p class="lead text-muted mx-auto mb-0" style="max-width: 600px; font-size: 1.1rem;">
                Mitra teknologi terpercaya Anda. Kami hadir untuk menjembatani inovasi mutakhir langsung ke genggaman Anda.
            </p>
        </div>

        <!-- Visi & Misi Cards -->
        <div class="row g-4 mb-5 pb-4">
            <div class="col-md-6">
                <div class="feature-card">
                    <div class="feature-icon-wrapper">
                        <i class="bi bi-eye"></i>
                    </div>
                    <h3 class="fw-bold mb-3">Visi Kami</h3>
                    <p class="text-muted lh-lg mb-0">
                        Menjadi platform e-commerce elektronik terdepan dan paling dipercaya di Indonesia, dengan komitmen teguh untuk terus memberikan kemudahan akses terhadap teknologi masa depan bagi seluruh lapisan masyarakat.
                    </p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="feature-card">
                    <div class="feature-icon-wrapper">
                        <i class="bi bi-rocket-takeoff"></i>
                    </div>
                    <h3 class="fw-bold mb-3">Misi Kami</h3>
                    <p class="text-muted lh-lg mb-0">
                        Menyediakan kurasi produk elektronik original berkualitas tinggi, menawarkan layanan purna jual yang andal, dan yang terpenting, menyuguhkan pengalaman berbelanja daring dengan antarmuka (UI/UX) yang intuitif, modern, dan menyenangkan.
                    </p>
                </div>
            </div>
        </div>

        <!-- Story & Image Section -->
        <div class="row align-items-center mb-5 pb-5 g-5">
            <div class="col-lg-5 order-2 order-lg-1">
                <h2 class="fw-bold mb-4">Mengapa Memilih Kami?</h2>
                
                <div class="d-flex mb-4">
                    <div class="text-primary me-3 pt-1"><i class="bi bi-check-circle-fill fs-5"></i></div>
                    <div>
                        <h6 class="fw-bold mb-1">Kurasi Ketat</h6>
                        <p class="text-muted small mb-0">Setiap produk di katalog kami melewati proses seleksi ketat untuk memastikan kualitas dan keasliannya.</p>
                    </div>
                </div>
                
                <div class="d-flex mb-4">
                    <div class="text-primary me-3 pt-1"><i class="bi bi-shield-check fs-5"></i></div>
                    <div>
                        <h6 class="fw-bold mb-1">Garansi Terjamin</h6>
                        <p class="text-muted small mb-0">Ketenangan pikiran Anda adalah prioritas. Kami menyediakan garansi resmi untuk seluruh jajaran produk.</p>
                    </div>
                </div>
                
                <div class="d-flex">
                    <div class="text-primary me-3 pt-1"><i class="bi bi-lightning-charge fs-5"></i></div>
                    <div>
                        <h6 class="fw-bold mb-1">Transaksi Cepat</h6>
                        <p class="text-muted small mb-0">Proses pembelian didesain se-efisien mungkin tanpa mengorbankan keamanan data Anda.</p>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-7 order-1 order-lg-2">
            <!-- Grid Gambar Asimetris -->
            <div class="image-grid">
                <img src="{{ asset('images/🦅.jpg') }}" alt="Tech" class="img-sub shadow-sm">
                <img src="{{ asset('images/download (9).jpg') }}" alt="Tech" class="img-sub shadow-sm">
                <img src="{{ asset('images/Canon EOS R6 Mark II Camera Kit _ Powerful Full-Frame Photography Setup.jpg') }}" alt="Tech" class="img-sub shadow-sm">
            </div>
            </div>
        </div>

        <!-- Developer Profile Section -->
        <div class="row justify-content-center mt-4">
            <div class="col-12 text-center mb-5">
                <h6 class="text-uppercase text-muted fw-bold" style="letter-spacing: 2px;">Dirancang & Dikembangkan Oleh</h6>
            </div>
            
            <div class="col-md-6 col-lg-4">
                <div class="team-card text-center pb-4">
                    <div class="team-header-bg"></div>
                    <div class="team-avatar">
                        <i class="bi bi-person-fill"></i>
                    </div>
                    
                    <h4 class="fw-bold mb-1 mt-2">Brian Akbar Hilalbi</h4>
                    <p class="text-primary fw-medium mb-3">Mahasiswa S-1 Sistem Informasi</p>
                    
                    <div class="px-4">
                        <p class="text-muted small mb-4">
                            Proyek pengembangan aplikasi web interaktif ini disusun sebagai pemenuhan tugas Ujian Tengah Semester (UTS) mata kuliah Rekayasa Web, di bawah bimbingan Bapak Afif Efendi.
                        </p>
                        
                        <div class="d-flex justify-content-center flex-wrap gap-2 mb-2">
                            <span class="badge bg-light text-dark border px-3 py-2 rounded-pill"><i class="bi bi-hash"></i> NIM: 251011700718</span>
                            <span class="badge bg-light text-dark border px-3 py-2 rounded-pill"><i class="bi bi-code-slash text-primary"></i> Laravel 13</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection