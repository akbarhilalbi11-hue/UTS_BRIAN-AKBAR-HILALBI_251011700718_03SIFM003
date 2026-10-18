@extends('layouts.app')

@section('content')
<style>
    /* Custom CSS untuk Tabs Modern */
    .modern-tabs {
        -ms-overflow-style: none; /* Menyembunyikan scrollbar di IE & Edge */
        scrollbar-width: none;    /* Menyembunyikan scrollbar di Firefox */
    }
    .modern-tabs::-webkit-scrollbar {
        display: none;            /* Menyembunyikan scrollbar di Chrome/Safari */
    }
    .modern-tabs .nav-link {
        border-radius: 50rem; /* Bentuk Pill membulat ala iOS */
        color: var(--text-muted);
        font-weight: 500;
        padding: 0.6rem 1.5rem;
        margin-right: 0.5rem;
        margin-bottom: 0.5rem;
        transition: all 0.3s ease;
        cursor: pointer;
        border: 1px solid transparent;
        background-color: transparent;
    }
    .modern-tabs .nav-link:hover {
        background-color: rgba(79, 70, 229, 0.05);
        color: var(--primary);
    }
    .modern-tabs .nav-link.active {
        background-color: var(--primary);
        color: white;
        box-shadow: 0 4px 15px rgba(79, 70, 229, 0.3);
    }
    
    /* Input Pencarian Modern */
    .search-modern {
        border-radius: 50rem;
        padding: 0.6rem 1.5rem;
        border: 1px solid rgba(0,0,0,0.1);
        box-shadow: 0 2px 5px rgba(0,0,0,0.02);
        transition: all 0.3s ease;
    }
    .search-modern:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 0.25rem rgba(79, 70, 229, 0.15);
    }

    /* Animasi Halus Saat Memilih Tab */
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>

<div class="container py-5">
    
    <!-- Bagian Atas: Judul & Bar Pencarian -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end mb-4 gap-3">
        <div>
            <h3 class="fw-bold mb-0">Katalog Produk</h3>
            <p class="text-muted mb-0 mt-1">Temukan perangkat idaman Anda dengan mudah.</p>
        </div>
        
        <!-- Fitur Pencarian Real-time -->
        <div style="min-width: 300px;">
            <div class="position-relative">
                <i class="bi bi-search position-absolute top-50 start-0 translate-middle-y ms-4 text-muted"></i>
                <input type="text" id="searchInput" class="form-control search-modern ps-5" placeholder="Cari nama atau brand...">
            </div>
        </div>
    </div>

    <!-- Fitur Tab Kategori (Otomatis dari Database) -->
    <div class="mb-4 pb-2 border-bottom">
        <ul class="nav nav-pills modern-tabs flex-nowrap overflow-auto pb-2" id="categoryTabs" style="white-space: nowrap;">
            <li class="nav-item">
                <a class="nav-link active" data-filter="all">Semua Produk</a>
            </li>
            @php 
                // Mengambil kategori unik dari database agar tab menjadi dinamis
                $categories = $electronics->pluck('category')->unique(); 
            @endphp
            @foreach($categories as $cat)
            <li class="nav-item">
                <a class="nav-link" data-filter="{{ $cat }}">{{ $cat }}</a>
            </li>
            @endforeach
        </ul>
    </div>

    <!-- Grid Layout Card Produk -->
    <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-4 g-4" id="productGrid">
        @forelse($electronics as $item)
        
        <!-- Wrapper dengan Data Attribute untuk dibaca JavaScript -->
        <div class="col product-wrapper" data-category="{{ $item->category }}" data-name="{{ strtolower($item->name) }}" data-brand="{{ strtolower($item->brand) }}">
            <div class="card card-modern h-100">
                <span class="badge bg-white text-dark position-absolute top-0 start-0 m-3 shadow-sm px-3 py-2 rounded-pill fw-medium" style="font-size: 0.75rem; z-index: 2;">
                    {{ $item->category }}
                </span>
                
                <img src="{{ $item->image }}" class="card-img-top p-3" alt="{{ $item->name }}" style="height: 220px; object-fit: contain;">
                
                <div class="card-body p-4 d-flex flex-column border-top" style="background-color: #fafafa;">
                    <div class="mb-2">
                        <h5 class="card-title fw-bold mb-0 lh-base" style="font-size: 1.1rem; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                            {{ $item->name }}
                        </h5>
                    </div>
                    <p class="text-muted small fw-medium mb-3">{{ $item->brand }}</p>
                    
                    <div class="mt-auto">
                        <h5 class="fw-bold mb-3" style="color: var(--primary);">
                            Rp {{ number_format($item->price, 0, ',', '.') }}
                        </h5>
                        <a href="{{ route('electronics.show', $item->id) }}" class="btn btn-modern btn-primary-modern w-100 text-center text-decoration-none d-block">
                            Lihat Detail
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center py-5 w-100">
            <div class="text-muted">Database produk masih kosong.</div>
        </div>
        @endforelse
    </div>

    <!-- Pesan Muncul Jika Pencarian/Filter Tidak Ketemu -->
    <div id="emptyState" class="text-center py-5 d-none w-100">
        <div class="mb-3">
            <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                <i class="bi bi-search text-primary" style="font-size: 2.5rem;"></i>
            </div>
        </div>
        <h5 class="fw-bold text-dark">Produk Tidak Ditemukan</h5>
        <p class="text-muted">Coba gunakan kata kunci atau pilih tab kategori yang berbeda.</p>
    </div>

</div>

<!-- Script Filter Dinamis tanpa Page Reload -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const tabs = document.querySelectorAll('.modern-tabs .nav-link');
        const products = document.querySelectorAll('.product-wrapper');
        const searchInput = document.getElementById('searchInput');
        const emptyState = document.getElementById('emptyState');

        function filterProducts() {
            // Ambil nilai filter aktif saat ini
            const activeFilter = document.querySelector('.modern-tabs .nav-link.active').getAttribute('data-filter');
            // Ambil teks pencarian
            const searchTerm = searchInput.value.toLowerCase();
            let visibleCount = 0;

            products.forEach(product => {
                const category = product.getAttribute('data-category');
                const name = product.getAttribute('data-name');
                const brand = product.getAttribute('data-brand');
                
                // Cek kecocokan kategori dan kata kunci
                const matchesCategory = (activeFilter === 'all' || category === activeFilter);
                const matchesSearch = name.includes(searchTerm) || brand.includes(searchTerm);

                if (matchesCategory && matchesSearch) {
                    product.style.display = 'block';
                    product.style.animation = 'fadeIn 0.4s ease forwards';
                    visibleCount++;
                } else {
                    product.style.display = 'none';
                    product.style.animation = 'none';
                }
            });

            // Tampilkan state kosong jika tidak ada yang cocok
            if (visibleCount === 0) {
                emptyState.classList.remove('d-none');
            } else {
                emptyState.classList.add('d-none');
            }
        }

        // Event Listener untuk Klik Tab
        tabs.forEach(tab => {
            tab.addEventListener('click', (e) => {
                // Hapus style aktif dari semua tab
                tabs.forEach(t => t.classList.remove('active'));
                // Tambahkan style aktif pada tab yang baru diklik
                e.target.classList.add('active');
                // Panggil fungsi filter
                filterProducts();
            });
        });

        // Event Listener untuk Mengetik di Search Bar
        searchInput.addEventListener('input', filterProducts);
    });
</script>
@endsection