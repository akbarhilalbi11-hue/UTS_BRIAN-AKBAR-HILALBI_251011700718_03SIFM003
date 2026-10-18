@extends('layouts.app')

@section('content')
<div class="container py-5">
    <!-- Tombol Kembali -->
    <div class="mb-4">
        <a href="{{ route('electronics.index') }}" class="text-decoration-none text-muted fw-medium d-inline-flex align-items-center" style="transition: color 0.3s ease;" onmouseover="this.style.color='var(--primary)'" onmouseout="this.style.color='var(--text-muted)'">
            <i class="bi bi-arrow-left me-2"></i> Kembali ke Katalog
        </a>
    </div>

    <!-- Card Detail Produk -->
    <div class="card card-modern overflow-hidden">
        <div class="row g-0">
            <!-- Kolom Kiri: Gambar Produk -->
            <div class="col-md-5 col-lg-6 bg-light d-flex align-items-center justify-content-center p-4 p-md-5">
                <img src="{{ $electronic->image }}" alt="{{ $electronic->name }}" class="img-fluid rounded-4 shadow-sm" style="max-height: 450px; object-fit: contain;">
            </div>
            
            <!-- Kolom Kanan: Detail Informasi -->
            <div class="col-md-7 col-lg-6">
                <div class="card-body p-4 p-lg-5 h-100 d-flex flex-column">
                    <div>
                        <!-- Kategori -->
                        <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill fw-medium mb-4" style="font-size: 0.85rem;">
                            {{ $electronic->category }}
                        </span>
                        
                        <!-- Nama & Brand -->
                        <h2 class="fw-bold mb-2" style="color: var(--text-dark); letter-spacing: -0.5px;">
                            {{ $electronic->name }}
                        </h2>
                        <p class="text-muted fw-medium fs-5 mb-4">{{ $electronic->brand }}</p>
                        
                        <!-- Harga -->
                        <h3 class="fw-bold mb-4" style="color: var(--primary); font-size: 2rem;">
                            Rp {{ number_format($electronic->price, 0, ',', '.') }}
                        </h3>
                        
                        <hr class="my-4" style="border-color: rgba(0,0,0,0.08);">
                        
                        <!-- Spesifikasi -->
                        <h5 class="fw-bold mb-3">Spesifikasi Detail</h5>
                        <p class="text-muted lh-lg mb-4">
                            {{ $electronic->specs }}
                        </p>
                    </div>

                    <!-- Tombol Aksi (Dummy) ditaruh di bawah dengan margin-top auto -->
                    <form action="{{ route('cart.add', $electronic->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary w-100 py-3 rounded-3 fw-bold shadow-sm" style="background: linear-gradient(135deg, var(--primary) 0%, #8b5cf6 100%); border: none;">
                            <i class="bi bi-cart-plus-fill me-2"></i> Tambah ke Keranjang
                        </button>
                    </form>

                    <!-- Notifikasi Sukses -->
                    @if(session('success'))
                        <div class="alert alert-success mt-3 rounded-3 border-0 shadow-sm">
                            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection