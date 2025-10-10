@extends('layouts.app')
@section('judulHalaman', 'Detail Produk')

@section('content')
<div class="halaman-penuh">
    <div class="header-tambah">
        <div>
            <h1>Detail Produk</h1>
            <p>Informasi lengkap tentang produk yang telah Anda tambahkan.</p>
        </div>
    </div>

    <div class="kartu-form detail-produk">
        <div class="detail-grid">
            {{-- Gambar Produk --}}
            <div class="detail-gambar">
                <img src="{{ asset('storage/image/'.$product->image) }}" alt="Gambar Produk">
            </div>

            {{-- Info Produk --}}
            <div class="detail-info">
                <h2>{{ $product->title }}</h2>

                <div class="info-item">
                    <strong>Kategori:</strong>
                    <span>{{ $product->category->product_category_name ?? '-' }}</span>
                </div>

                <div class="info-item">
                    <strong>Supplier:</strong>
                    <span>{{ $product->supplier->supplier_name ?? '-' }}</span>
                </div>

                <div class="info-item">
                    <strong>Harga:</strong>
                    <span>Rp{{ number_format($product->price, 0, ',', '.') }}</span>
                </div>

                <div class="info-item">
                    <strong>Stok:</strong>
                    <span>{{ $product->stock }}</span>
                </div>

                <div class="info-item">
                    <strong>Deskripsi:</strong>
                    <div class="deskripsi-box">
                        {!! $product->description ?? 'Tidak ada deskripsi.' !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="tombol-aksi">
            <a href="{{ route('products.index') }}" class="tombol tombol--batal">Kembali ke Daftar</a>
        </div>
    </div>
</div>

<style>
.halaman-penuh {
    background-color: #FFF8E7;
    padding: 2.5rem 3rem;
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    align-items: center;
}

.header-tambah {
    text-align: center;
    margin-bottom: 2rem;
}

.header-tambah h1 {
    color: #8B5E3C;
    font-size: 2rem;
    font-weight: 700;
    margin-bottom: 0.3rem;
}

.header-tambah p {
    color: #9B7B5C;
    font-size: 0.95rem;
}

.kartu-form {
    background: #ffffff;
    border-radius: 20px;
    padding: 2rem 2.5rem;
    box-shadow: 0 10px 25px rgba(0,0,0,0.05);
    width: 100%;
    max-width: 950px;
}

.detail-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 2.5rem;
    align-items: center;
}

.detail-gambar img {
    width: 100%;
    max-width: 300px;
    border-radius: 16px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    display: block;
    margin: 0 auto;
}

.detail-info h2 {
    color: #8B5E3C;
    font-size: 1.8rem;
    margin-bottom: 1.2rem;
}

.info-item {
    margin-bottom: 1rem;
}

.info-item strong {
    color: #8B5E3C;
    display: inline-block;
    width: 110px;
}

.info-item span {
    color: #555;
}

.deskripsi-box {
    background: #FFF7E1;
    border-radius: 12px;
    padding: 0.9rem 1rem;
    color: #444;
    line-height: 1.5;
    margin-top: 0.3rem;
    box-shadow: inset 0 0 5px rgba(0,0,0,0.05);
}

.tombol-aksi {
    text-align: right;
    margin-top: 2rem;
    display: flex;
    justify-content: flex-end;
}

.tombol {
    display: inline-block;
    padding: 0.8rem 1.6rem;
    border-radius: 10px;
    font-weight: 600;
    text-decoration: none;
    cursor: pointer;
    transition: 0.2s ease;
}
.tombol--batal {
    background-color: #f2f2f2;
    color: #555;
}
.tombol--batal:hover {
    background-color: #e0e0e0;
}

/* Responsif */
@media (max-width: 900px) {
    .detail-grid {
        grid-template-columns: 1fr;
        text-align: center;
    }

    .detail-info h2 {
        margin-top: 1rem;
    }

    .info-item strong {
        width: auto;
        display: block;
        margin-bottom: 0.2rem;
    }

    .info-item span {
        display: block;
        margin-bottom: 0.6rem;
    }

    .deskripsi-box {
        text-align: left;
    }
}
</style>
@endsection