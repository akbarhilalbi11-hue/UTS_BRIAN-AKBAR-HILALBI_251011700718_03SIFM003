@extends('layouts.app')

@section('content')
<style>
    /* Animasi Mengambang (Floating) untuk Gambar Utama */
    @keyframes float {
        0% { transform: translateY(0px); }
        50% { transform: translateY(-15px); }
        100% { transform: translateY(0px); }
    }
    .img-floating {
        animation: float 4s ease-in-out infinite;
    }

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
    /* Posisi & Warna Masing-masing Kubus */
    .cube-1 { width: 70px; height: 70px; top: 15%; left: 5%; background: linear-gradient(135deg, rgba(79,70,229,0.3) 0%, rgba(139,92,246,0.3) 100%); animation-delay: 0s; }
    .cube-2 { width: 50px; height: 50px; bottom: 20%; left: 45%; background: linear-gradient(135deg, rgba(16,185,129,0.3) 0%, rgba(52,211,153,0.3) 100%); animation-delay: 2s; }
    .cube-3 { width: 90px; height: 90px; top: 25%; right: 8%; background: linear-gradient(135deg, rgba(245,158,11,0.3) 0%, rgba(251,191,36,0.3) 100%); animation-delay: 4s; }
    .cube-4 { width: 40px; height: 40px; bottom: 10%; right: 40%; background: linear-gradient(135deg, rgba(236,72,153,0.3) 0%, rgba(244,114,182,0.3) 100%); animation-delay: 1s; }
    
    /* Efek Gradient Text untuk Judul */
    .text-gradient {
        background: linear-gradient(135deg, var(--primary) 0%, #8b5cf6 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
    
    /* Glassmorphism Profile Badge */
    .badge-glass {
        background: rgba(255, 255, 255, 0.85);
        backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, 0.6);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.08);
        transition: transform 0.3s ease;
    }
    .badge-glass:hover {
        transform: translateY(-5px);
    }
    
    /* Background Pattern Minimalis */
    .hero-section {
        position: relative;
        overflow: hidden;
        padding-top: 5rem;
        padding-bottom: 7rem; /* Diperbesar agar ada ruang untuk lencana di bawah */
    }
    .hero-bg-blob {
        position: absolute;
        width: 600px;
        height: 600px;
        background: radial-gradient(circle, rgba(79,70,229,0.08) 0%, rgba(255,255,255,0) 70%);
        top: -100px;
        right: -100px;
        border-radius: 50%;
        z-index: 0;
    }
</style>

<div class="hero-section">
    <!-- Dekorasi Background & Kubus -->
    <div class="hero-bg-blob"></div>
    <div class="cube cube-1"></div>
    <div class="cube cube-2"></div>
    <div class="cube cube-3"></div>
    <div class="cube cube-4"></div>
    
    <div class="container position-relative mt-2" style="z-index: 1;">
        <div class="row align-items-center g-5">
            
            <!-- Kolom Kiri: Teks & Informasi -->
            <div class="col-lg-6 text-center text-lg-start position-relative" style="z-index: 3;">
                
                <div class="d-inline-flex align-items-center gap-2 px-3 py-2 rounded-pill bg-white shadow-sm border mb-4">
                    <span class="badge bg-primary rounded-pill">Premium</span>
                    <span class="text-muted small fw-medium">Proyek UTS Rekayasa Web 2026</span>
                </div>
                
                <h1 class="display-4 fw-bold mb-4" style="color: var(--text-dark); letter-spacing: -1px; line-height: 1.2;">
                    Masa Depan Teknologi <br class="d-none d-lg-block">
                    <span class="text-gradient">di Tangan Anda.</span>
                </h1>
                
                <p class="lead text-muted mb-5" style="font-size: 1.15rem; max-width: 500px; margin: 0 auto; margin-lg-start: 0;">
                    ElectroStore menghadirkan koleksi perangkat elektronik idaman dengan antarmuka modern yang interaktif dan responsif.
                </p>
                
                <div class="d-flex flex-column flex-sm-row justify-content-center justify-content-lg-start gap-3 mb-5">
                    <a href="{{ route('electronics.index') }}" class="btn btn-modern btn-primary-modern px-4 py-3 fs-6 d-flex justify-content-center align-items-center gap-2 shadow-sm">
                        <i class="bi bi-cart-fill"></i> Mulai Belanja
                    </a>
                    <a href="{{ route('about') }}" class="btn btn-modern px-4 py-3 fs-6 bg-white border text-dark d-flex justify-content-center align-items-center gap-2" style="transition: all 0.3s;" onmouseover="this.classList.add('bg-light')" onmouseout="this.classList.remove('bg-light')">
                        <i class="bi bi-info-circle"></i> Tentang Kami
                    </a>
                </div>
                
                <div class="badge-glass rounded-4 p-4 text-start d-inline-block w-100" style="max-width: 450px;">
                    <h6 class="fw-bold mb-3 text-muted text-uppercase" style="font-size: 0.7rem; letter-spacing: 1px;">Developer Credit:</h6>
                    <div class="d-flex align-items-center gap-3">
                        <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-flex justify-content-center align-items-center flex-shrink-0" style="width: 50px; height: 50px;">
                            <i class="bi bi-person-fill fs-4"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-1" style="color: var(--text-dark);">Brian Akbar Hilalbi</h6>
                            <p class="text-muted small mb-0">NIM: 251011700718 • SI (S-1) • Dosen: Afif Efendi</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Kolom Kanan: Gambar Hero Section & Badge Position -->
            <div class="col-lg-6 d-none d-lg-flex justify-content-center position-relative mt-5 mt-lg-0">
                
                <!-- Pembungkus Gambar agar lencana bisa relatif terhadap gambar -->
                <div class="position-relative img-floating" style="z-index: 2;">
                    
                    <!-- Lingkaran Dekorasi -->
                    <div class="position-absolute top-50 start-50 translate-middle bg-primary bg-opacity-10 rounded-circle" style="width: 420px; height: 420px; z-index: -1;"></div>
                    
                    <!-- Gambar Utama -->
                    <img src="https://images.unsplash.com/photo-1498049794561-7780e7231661?w=800&q=80" alt="ElectroStore Setup" class="img-fluid rounded-4 shadow-lg" style="border: 5px solid white; max-height: 450px; object-fit: cover; position: relative;">
                    
                    <!-- Badge 1: 100% Original (Pindah ke Kiri Bawah Sesuai Permintaan) -->
                    <div class="position-absolute badge-glass p-3 rounded-4 d-flex align-items-center gap-3" style="bottom: 30px; left: -40px; z-index: 3;">
                        <div class="bg-success rounded-circle p-2 text-white d-flex align-items-center justify-content-center">
                            <i class="bi bi-check-lg"></i>
                        </div>
                        <div>
                            <h6 class="mb-0 fw-bold">100% Original</h6>
                            <small class="text-muted">Garansi Resmi</small>
                        </div>
                    </div>

                    <!-- Badge 2: Testimoni Rating (Pindah Ekstra ke Kanan Bawah Bawah) -->
                    <div class="position-absolute badge-glass p-3 rounded-4 shadow" style="bottom: -50px; right: -30px; z-index: 3; max-width: 220px;">
                        <div class="d-flex align-items-center gap-1 mb-2 text-warning">
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <span class="text-dark fw-bold ms-1" style="font-size: 0.85rem;">5.0</span>
                        </div>
                        <p class="small text-muted mb-2 fst-italic" style="line-height: 1.3;">"Pengiriman sangat cepat dan barang yang diterima sangat sesuai !"</p>
                        <div class="d-flex align-items-center gap-2">
                            <div class="bg-primary text-white rounded-circle d-flex justify-content-center align-items-center" style="width: 24px; height: 24px; font-size: 0.6rem; font-weight: bold;">
                                CU
                            </div>
                            <small class="fw-bold text-dark" style="font-size: 0.7rem;">Pembeli Terverifikasi</small>
                        </div>
                    </div>
                    
                </div> <!-- Akhir Pembungkus Gambar -->
            </div>
            
        </div>
    </div>
</div>
@endsection