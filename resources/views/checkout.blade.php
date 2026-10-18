@extends('layouts.app')

@section('content')

<!-- Header Minimalis Khusus Checkout -->
<div class="checkout-header sticky-top">
    <div class="container d-flex justify-content-between align-items-center">
        <!-- Logo Brand -->
        <a href="{{ url('/') }}" class="text-decoration-none d-flex align-items-center gap-2">
            <div class="bg-primary text-white rounded-3 d-flex align-items-center justify-content-center" style="width: 36px; height: 36px;">
                <i class="bi bi-bag-check-fill fs-5"></i>
            </div>
            <span class="fw-bold fs-5 text-dark">ElectroStore</span>
        </a>

        <!-- Tombol Batal Proses -->
        <a href="{{ route('cart.index') }}" class="btn btn-outline-danger btn-sm rounded-pill px-3 py-2 d-flex align-items-center gap-2 font-medium">
            <i class="bi bi-x-circle"></i> Batalkan Proses
        </a>
    </div>
</div>

<div class="container pb-5">
    <!-- Hapus tombol <a href="..."> Kembali ke Keranjang yang lama di sini -->
    
    <form action="{{ route('cart.process') }}" method="POST" id="checkoutForm">
        <!-- Sisa kode form checkout Anda tetap sama -->
<style>
    /* Sembunyikan Navbar utama bawaan layout di halaman checkout saja */
nav.navbar {
    display: none !important;
}

/* Header Minimalis Khusus Checkout */
.checkout-header {
    background: #ffffff;
    border-bottom: 1px solid #eaecf0;
    padding: 1rem 0;
    margin-bottom: 2rem;
    box-shadow: 0 1px 3px rgba(0,0,0,0.02);
}
    body { background-color: #f5f5f5; }
    .checkout-card { background: #fff; border-radius: 12px; padding: 20px; margin-bottom: 16px; box-shadow: 0 1px 3px rgba(0,0,0,0.05); }
    .shop-name { font-weight: 600; font-size: 14px; margin-bottom: 12px; display: flex; align-items: center; gap: 8px; }
    .item-checkout img { width: 60px; height: 60px; border-radius: 8px; object-fit: cover; border: 1px solid #eee; }
    .protection-box { border: 1px solid #e0e0e0; border-radius: 8px; padding: 12px; display: flex; align-items: center; justify-content: space-between; margin-top: 16px; }
    .payment-option { border: 1px solid #e0e0e0; border-radius: 8px; padding: 12px; margin-bottom: 8px; cursor: pointer; transition: 0.2s; display: flex; align-items: center; justify-content: space-between; }
    .payment-option:hover, .payment-option.active { border-color: #10b981; background-color: #f0fdf4; }
    
    /* Box QRIS yang akan disembunyikan/ditampilkan */
    .qris-box { display: none; text-align: center; padding: 16px; border: 1px dashed #10b981; border-radius: 8px; background: #fff; margin-top: 10px; margin-bottom: 10px;}
    
    .btn-pay { background-color: #00b14f; border: none; color: white; font-weight: bold; border-radius: 50rem; padding: 14px; transition: 0.2s; }
    .btn-pay:hover { background-color: #009040; }
    /* Efek Garis Tepi Amplop untuk Alamat */
    .address-border { height: 4px; background: repeating-linear-gradient(45deg, #ff6b6b, #ff6b6b 10px, transparent 10px, transparent 20px, #4dabf7 20px, #4dabf7 30px, transparent 30px, transparent 40px); margin-bottom: 16px; border-radius: 4px 4px 0 0; }
</style>



    <form action="{{ route('cart.process') }}" method="POST" id="checkoutForm">
        @csrf
        <div class="row g-4">
            
            <!-- KOLOM KIRI (Informasi Utama) -->
            <div class="col-lg-8">
                
                <!-- KARTU 1: ALAMAT PENGIRIMAN -->
                <div class="checkout-card p-0 overflow-hidden">
                    <div class="address-border"></div>
                    <div class="p-4 pt-2">
                        <h6 class="fw-bold mb-3"><i class="bi bi-geo-alt-fill text-danger me-2"></i> Alamat Pengiriman</h6>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <input type="text" name="name" class="form-control text-sm" required placeholder="Nama Lengkap Penerima">
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="phone" class="form-control text-sm" required placeholder="Nomor Telepon">
                            </div>
                            <div class="col-12">
                                <textarea name="address" class="form-control text-sm" rows="2" required placeholder="Alamat Lengkap (Jalan, RT/RW, Desa, Kecamatan, Kota, Kode Pos)"></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- KARTU 2: RINCIAN PESANAN -->
                <div class="checkout-card">
                    <div class="shop-name">
                        <i class="bi bi-shop text-primary fs-5"></i> ElectroStore Official
                    </div>
                    @foreach($cart as $id => $item)
                    <div class="d-flex gap-3 mb-3 item-checkout pb-3 {{ !$loop->last ? 'border-bottom' : '' }}">
                        <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}">
                        <div class="flex-grow-1">
                            <h6 class="mb-1" style="font-size: 15px;">{{ $item['name'] }}</h6>
                            <p class="text-muted small mb-1">Kategori: {{ $item['category'] }}</p>
                            <p class="fw-bold text-dark mb-0">Rp {{ number_format($item['price'], 0, ',', '.') }}</p>
                        </div>
                        <div class="text-end">
                            <span class="text-muted small">x{{ $item['quantity'] }}</span>
                        </div>
                    </div>
                    @endforeach

                    <!-- Opsi Asuransi Proteksi (Mirip Gambar) -->
                    <div class="protection-box">
                        <div class="d-flex gap-3">
                            <i class="bi bi-shield-plus text-success fs-4"></i>
                            <div>
                                <h6 class="mb-0 fw-bold" style="font-size: 14px;">Proteksi Kerusakan Total</h6>
                                <p class="text-muted mb-0" style="font-size: 12px;">Ganti rugi hingga 90% untuk kerusakan barang.</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-center gap-3">
                            <span class="fw-bold text-dark" style="font-size: 14px;">Rp 15.000</span>
                            <input type="checkbox" name="proteksi" value="1" class="form-check-input mt-0" id="proteksi" onchange="calculateTotal()" style="transform: scale(1.2);">
                        </div>
                    </div>
                </div>

                <!-- KARTU 3: OPSI PENGIRIMAN -->
                <div class="checkout-card">
                    <h6 class="fw-bold mb-3">Opsi Pengiriman</h6>
                    <select name="shipping_method" id="shipping_method" class="form-select" required onchange="calculateTotal()">
                        <option value="" disabled selected>-- Silakan Pilih Pengiriman --</option>
                        <option value="reguler" data-price="25000">Pengiriman Reguler (2-3 Hari) - Rp 25.000</option>
                        <option value="express" data-price="50000">Pengiriman Express Besok Sampai - Rp 50.000</option>
                        <option value="cargo" data-price="100000">Pengiriman Kargo Besar - Rp 100.000</option>
                    </select>
                </div>

                <!-- KARTU 4: METODE PEMBAYARAN -->
                <div class="checkout-card">
                    <h6 class="fw-bold mb-3">Metode Pembayaran</h6>
                    <input type="hidden" name="payment_method" id="payment_method" value="Transfer Bank" required>
                    
                    <div class="payment-option active" onclick="selectPayment(this, 'Transfer Bank')">
                        <div><i class="bi bi-bank me-2 text-primary fs-5"></i> Transfer Bank (Virtual Account)</div>
                        <i class="bi bi-check-circle-fill text-success fs-5 d-none check-icon"></i>
                    </div>
                    
                    <!-- Pilihan QRIS -->
                    <div class="payment-option" onclick="selectPayment(this, 'QRIS')">
                        <div><i class="bi bi-qr-code-scan me-2 text-success fs-5"></i> QRIS (Gopay, OVO, Dana, ShopeePay)</div>
                        <i class="bi bi-check-circle-fill text-success fs-5 d-none check-icon"></i>
                    </div>
                    
                    <!-- Kotak QR Code yang akan muncul saat QRIS dipilih -->
                    <div class="qris-box" id="qris-box">
                        <h6 class="fw-bold text-dark mb-2">Scan QRIS Untuk Membayar</h6>
                        <img src="https://upload.wikimedia.org/wikipedia/commons/d/d0/QR_code_for_mobile_English_Wikipedia.svg" alt="Barcode QRIS" width="180" class="mb-3 shadow-sm rounded-3">
                        <p class="text-muted small mb-0">Buka aplikasi e-wallet Anda, scan kode di atas, dan tagihan akan langsung muncul.</p>
                    </div>
                    
                    <div class="payment-option mt-2" onclick="selectPayment(this, 'COD')">
                        <div><i class="bi bi-cash-coin me-2 text-warning fs-5"></i> Bayar di Tempat (COD)</div>
                        <i class="bi bi-check-circle-fill text-success fs-5 d-none check-icon"></i>
                    </div>
                </div>
            </div>

            <!-- KOLOM KANAN (Ringkasan Tagihan) -->
            <div class="col-lg-4">
                <div class="checkout-card sticky-top" style="top: 20px;">
                    <h5 class="fw-bold mb-3 border-bottom pb-3">Ringkasan Pesanan</h5>
                    
                    <div class="d-flex justify-content-between mb-2 small text-muted">
                        <span>Subtotal produk</span>
                        <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2 small text-muted">
                        <span>Subtotal pengiriman</span>
                        <span id="display-ongkir">Rp 0</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2 small text-muted d-none" id="display-proteksi-row">
                        <span>Proteksi Kerusakan</span>
                        <span>Rp 15.000</span>
                    </div>
                    <div class="d-flex justify-content-between mb-3 small text-muted">
                        <span>Biaya layanan aplikasi</span>
                        <span>Rp 1.000</span>
                    </div>
                    
                    <div class="d-flex justify-content-between mb-4 border-top pt-3">
                        <span class="fw-bold text-dark fs-5">Total</span>
                        <span class="fw-bold text-danger fs-5" id="display-total">Rp {{ number_format($total + 1000, 0, ',', '.') }}</span>
                    </div>
                    
                    <p class="small text-muted mb-4" style="font-size: 11px; line-height: 1.5;">
                        Dengan memesan, Anda menyetujui Ketentuan Penggunaan dan Kebijakan Privasi ElectroStore. Transaksi ini dilakukan dengan aman.
                    </p>
                    
                    <button type="button" class="btn-pay w-100" onclick="submitForm()">
                        Aktifkan untuk Membayar
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- Script Hitung Matematika Murni & Logika QRIS -->
<!-- Script Hitung Matematika Murni & Logika QRIS -->
<script>
    // Memaksa PHP mengirimkan format integer (angka asli) ke JS untuk mencegah String Concatenation
    const baseSubtotal = parseInt('{{ $total }}', 10);
    const serviceFee = 1000;
    const protectionFee = 15000;

    // Tampilkan icon checklist pada metode pembayaran default
    document.querySelector('.payment-option.active .check-icon').classList.remove('d-none');

    function selectPayment(element, method) {
        document.getElementById('payment_method').value = method;
        
        // Hapus seleksi dari kotak lain
        document.querySelectorAll('.payment-option').forEach(el => {
            el.classList.remove('active');
            el.querySelector('.check-icon').classList.add('d-none');
        });
        
        // Tandai kotak yang di-klik
        element.classList.add('active');
        element.querySelector('.check-icon').classList.remove('d-none');
        
        // Logika memunculkan QRIS
        if (method === 'QRIS') {
            document.getElementById('qris-box').style.display = 'block';
        } else {
            document.getElementById('qris-box').style.display = 'none';
        }
    }

    function calculateTotal() {
        // Ambil Data Ongkir
        const shippingSelect = document.getElementById('shipping_method');
        let ongkir = 0;
        if(shippingSelect.value) {
            const selectedOption = shippingSelect.options[shippingSelect.selectedIndex];
            ongkir = parseInt(selectedOption.getAttribute('data-price'), 10);
        }
        
        // Cek status asuransi proteksi
        const isProtected = document.getElementById('proteksi').checked;
        let currentProtection = isProtected ? protectionFee : 0;
        
        // Render Tampilan Ongkir & Proteksi
        document.getElementById('display-ongkir').innerText = 'Rp ' + ongkir.toLocaleString('id-ID');
        if(isProtected) {
            document.getElementById('display-proteksi-row').classList.remove('d-none');
        } else {
            document.getElementById('display-proteksi-row').classList.add('d-none');
        }

        // PENJUMLAHAN MATEMATIKA ASLI (BUKAN STRING)
        const grandTotal = baseSubtotal + ongkir + currentProtection + serviceFee;
        document.getElementById('display-total').innerText = 'Rp ' + grandTotal.toLocaleString('id-ID');
    }

    function submitForm() {
        // 1. Cek apakah metode pengiriman sudah dipilih
        if(!document.getElementById('shipping_method').value) {
            alert('Tunggu dulu! Anda belum memilih metode pengiriman.');
            return;
        }
        
        // 2. Langsung submit form. 
        // Animasi loading QRIS/Transfer Bank sekarang diurus oleh halaman checkout-processing
        document.getElementById('checkoutForm').submit();
    }
</script>
@endsection