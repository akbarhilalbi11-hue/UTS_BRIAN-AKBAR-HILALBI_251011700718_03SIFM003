@extends('layouts.app')

@section('content')
<style>
    body { background-color: #f8f9fa; }
    .processing-container {
        min-height: 70vh;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
    }
    
    /* Animasi Radar / Ripple ala Payment Gateway */
    .radar-spinner {
        position: relative;
        width: 120px;
        height: 120px;
        margin-bottom: 2rem;
    }
    .radar-spinner .circle {
        position: absolute;
        width: 100%;
        height: 100%;
        background-color: rgba(16, 185, 129, 0.2);
        border-radius: 50%;
        animation: ripple 2s infinite ease-in-out;
    }
    .radar-spinner .circle:nth-child(2) { animation-delay: 0.5s; }
    .radar-spinner .circle:nth-child(3) { animation-delay: 1s; }
    .radar-spinner .icon-center {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 60px;
        height: 60px;
        background: #10b981;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.8rem;
        z-index: 10;
        box-shadow: 0 4px 15px rgba(16, 185, 129, 0.4);
    }

    @keyframes ripple {
        0% { transform: scale(0.5); opacity: 1; }
        100% { transform: scale(1.5); opacity: 0; }
    }
</style>

<div class="container">
    <div class="processing-container">
        <div class="radar-spinner">
            <div class="circle"></div>
            <div class="circle"></div>
            <div class="circle"></div>
            <div class="icon-center">
                <i class="bi bi-shield-lock-fill"></i>
            </div>
        </div>
        
        <h3 class="fw-bold text-dark mb-2">Memvalidasi Pembayaran...</h3>
        <p class="text-muted mb-4 max-w-md mx-auto" style="max-width: 400px;">
            Sistem kami sedang memproses dan memverifikasi transaksi Anda secara aman. Mohon jangan menutup atau me-refresh halaman ini.
        </p>
        
        <div class="progress w-100" style="max-width: 300px; height: 6px; border-radius: 50rem;">
            <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" style="width: 100%"></div>
        </div>
    </div>
</div>

<!-- Redirect Otomatis ke Halaman Sukses setelah 3.5 Detik -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        setTimeout(function() {
            window.location.href = "{{ route('cart.success') }}";
        }, 3500);
    });
</script>
@endsection