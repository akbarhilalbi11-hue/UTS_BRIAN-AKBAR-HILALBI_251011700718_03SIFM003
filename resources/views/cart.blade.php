@extends('layouts.app')

@section('content')
<div class="container py-5" style="min-height: 75vh;">
    <h3 class="fw-bold mb-4">Keranjang Belanja</h3>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-4 border-0 shadow-sm" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show rounded-4 border-0 shadow-sm" role="alert">
        <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
    @endif

    @if(count($cart) > 0)
        <div class="row g-4">
            <!-- List Produk di Keranjang -->
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-body p-4">
                        @foreach($cart as $id => $details)
                            <div class="row align-items-center mb-4 {{ !$loop->last ? 'border-bottom pb-4' : '' }}">
                                <div class="col-3 col-md-2">
                                    <img src="{{ $details['image'] }}" alt="{{ $details['name'] }}" class="img-fluid rounded-3" style="object-fit: contain;">
                                </div>
                                <div class="col-7 col-md-7">
                                    <span class="badge bg-light text-dark mb-1">{{ $details['category'] ?? 'Produk' }}</span>
                                    <h5 class="fw-bold mb-1">{{ $details['name'] }}</h5>
                                    <p class="text-primary fw-bold mb-0">Rp {{ number_format($details['price'], 0, ',', '.') }}</p>
                                </div>
                                <div class="col-2 col-md-3 text-end d-flex flex-column align-items-end justify-content-between">
                                    <span class="badge bg-primary rounded-pill px-3 py-2 mb-2">Qty: {{ $details['quantity'] }}</span>
                                    
                                    <form action="{{ route('cart.remove', $id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-outline-danger rounded-circle" title="Hapus">
                                            <i class="bi bi-trash-fill"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Ringkasan Pesanan -->
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm rounded-4 sticky-top" style="top: 100px;">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-4">Ringkasan Belanja</h5>
                        
                        <div class="d-flex justify-content-between mb-3 text-muted">
                            <span>Total Item</span>
                            <span>{{ count($cart) }} Barang</span>
                        </div>
                        <div class="d-flex justify-content-between mb-4 text-muted">
                            <span>Pajak (0%)</span>
                            <span>Rp 0</span>
                        </div>
                        
                        <hr class="border-secondary opacity-25">
                        
                        <div class="d-flex justify-content-between mb-4">
                            <span class="fw-bold fs-5">Total Harga</span>
                            <span class="fw-bold fs-5 text-primary">Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                        
                        <a href="{{ route('cart.checkout') }}" class="btn btn-primary w-100 py-3 rounded-pill fw-bold" style="background: linear-gradient(135deg, var(--primary) 0%, #8b5cf6 100%); border: none;">
                            Lanjut ke Pengiriman <i class="bi bi-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @else
        <!-- Tampilan Jika Keranjang Kosong -->
        <div class="text-center py-5">
            <div class="mb-4">
                <i class="bi bi-cart-x text-muted" style="font-size: 5rem; opacity: 0.3;"></i>
            </div>
            <h4 class="fw-bold text-dark">Keranjang masih kosong</h4>
            <p class="text-muted mb-4">Yuk, temukan perangkat elektronik idamanmu sekarang!</p>
            <a href="{{ route('electronics.index') }}" class="btn btn-primary rounded-pill px-4 py-2">
                Belanja Sekarang
            </a>
        </div>
    @endif
</div>
@endsection