@extends('layouts.app')

@section('content')
<style>
    body {
        background-color: #f8f9fa;
    }
    .success-card {
        background: white;
        border-radius: 1.5rem;
        border: none;
        box-shadow: 0 10px 40px rgba(0,0,0,0.05);
        overflow: hidden;
    }
    .success-header {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        padding: 3rem 2rem;
        color: white;
        text-align: center;
    }
    .invoice-details {
        background-color: #f8fafc;
        border-radius: 1rem;
        padding: 1.5rem;
        margin-bottom: 2rem;
    }
    .item-row {
        border-bottom: 1px dashed #e2e8f0;
        padding-bottom: 1rem;
        margin-bottom: 1rem;
    }
    .item-row:last-child {
        border-bottom: none;
        padding-bottom: 0;
        margin-bottom: 0;
    }
</style>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="success-card">
                
                <div class="success-header">
                    <div class="bg-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3 shadow" style="width: 80px; height: 80px;">
                        <i class="bi bi-check-lg text-success" style="font-size: 3rem;"></i>
                    </div>
                    <h2 class="fw-bold mb-1">Pembayaran Berhasil!</h2>
                    <p class="mb-0 opacity-75">Terima kasih telah berbelanja di ElectroStore.</p>
                </div>

                <div class="card-body p-4 p-md-5">
                    
                    <!-- Informasi Invoice -->
                    <div class="invoice-details text-center">
                        <p class="text-muted small text-uppercase mb-1 fw-bold">Nomor Invoice</p>
                        <h4 class="fw-bold text-dark mb-4">{{ $transaction['invoice'] }}</h4>
                        <div class="invoice-details text-center">
                        <p class="text-muted small text-uppercase mb-1 fw-bold">Nomor Invoice</p>
                        <h4 class="fw-bold text-dark mb-2">{{ $transaction['invoice'] }}</h4>
                        
                        <!-- Menambahkan Badge Nomor Resi Otomatis -->
                        <div class="d-inline-block bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill mb-4 border border-primary border-opacity-25">
                            <span class="small fw-bold"><i class="bi bi-truck me-1"></i> No. Resi: {{ $transaction['resi'] }}</span>
                        </div>
                        
                        <div class="row text-start text-muted small g-3">
                        
                        <div class="row text-start text-muted small g-3">
                            <div class="col-sm-6">
                                <p class="mb-1 text-uppercase fw-bold" style="font-size: 0.7rem;">Informasi Pelanggan:</p>
                                <p class="fw-bold text-dark mb-0">{{ $transaction['customer_name'] }}</p>
                                <p class="mb-1">{{ $transaction['address'] }}</p>
                            </div>
                            <div class="col-sm-6 text-sm-end">
                                <p class="mb-1 text-uppercase fw-bold" style="font-size: 0.7rem;">Detail Pembayaran:</p>
                                <p class="fw-bold text-dark mb-0">{{ $transaction['payment_method'] }}</p>
                                <p class="mb-1 text-capitalize">Pengiriman: {{ $transaction['shipping_method'] }}</p>
                                <p class="mb-1">{{ \Carbon\Carbon::parse($transaction['date'])->translatedFormat('d F Y, H:i') }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Rincian Produk -->
                    <h6 class="fw-bold mb-3 text-dark border-bottom pb-2">Rincian Pembelian</h6>
                    <div class="mb-3">
                        @foreach($transaction['items'] as $item)
                            <div class="item-row d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="fw-bold mb-0 text-dark" style="font-size: 0.95rem;">{{ $item['name'] }}</h6>
                                    <small class="text-muted">{{ $item['quantity'] }}x @ Rp {{ number_format($item['price'], 0, ',', '.') }}</small>
                                </div>
                                <div class="fw-bold text-dark">
                                    Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                    
                    <!-- Subtotal & Ongkir -->
                    <div class="d-flex justify-content-between text-muted small mb-2 px-1">
                        <span>Subtotal Produk</span>
                        <span>Rp {{ number_format($transaction['subtotal'], 0, ',', '.') }}</span>
                    </div>
                    <div class="d-flex justify-content-between text-muted small mb-4 px-1">
                        <span>Ongkos Kirim</span>
                        <span>Rp {{ number_format($transaction['ongkir'], 0, ',', '.') }}</span>
                    </div>

                    <!-- Total Keseluruhan -->
                    <div class="d-flex justify-content-between align-items-center bg-light p-3 rounded-3 mb-4 border">
                        <h5 class="fw-bold text-muted mb-0">Total Dibayar</h5>
                        <h4 class="fw-bold text-primary mb-0">Rp {{ number_format($transaction['total'], 0, ',', '.') }}</h4>
                    </div>

                </div>
            </div>
            
            <div class="text-center mt-4 text-muted small">
                &copy; 2026 ElectroStore. Proyek UTS Rekayasa Web.
            </div>
            
        </div>
    </div>
</div>
@endsection