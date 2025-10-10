@extends('layouts.app')
@section('judulHalaman', 'Detail Kategori Produk')

@section('content')
<div class="halaman-penuh">
    <div class="header-tambah">
        <div>
            <h1>Detail Kategori Produk</h1>
            <p>Informasi lengkap tentang kategori produk ini.</p>
        </div>
    </div>

    <div class="kartu-form detail-produk">
        <div class="detail-info">
            <h2>{{ $category->product_category_name }}</h2>

            <div class="info-item">
                <strong>ID Kategori:</strong>
                <span>{{ $category->id }}</span>
            </div>

            <div class="info-item">
                <strong>Deskripsi:</strong>
                <div class="deskripsi-box">
                    {{ $category->description ?? 'Tidak ada deskripsi.' }}
                </div>
            </div>

            <div class="info-item">
                <strong>Dibuat pada:</strong>
                <span>{{ $category->created_at->format('d M Y') }}</span>
            </div>
        </div>

        <div class="tombol-aksi">
            <a href="{{ route('categories.index') }}" class="tombol tombol--batal">Kembali ke Daftar</a>
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
    max-width: 700px;
}

.detail-info h2 {
    color: #8B5E3C;
    font-size: 1.8rem;
    margin-bottom: 1.5rem;
    text-align: center;
}

.info-item {
    margin-bottom: 1rem;
}
.info-item strong {
    color: #8B5E3C;
    display: inline-block;
    width: 130px;
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
@media (max-width: 700px) {
    .info-item strong {
        display: block;
        width: auto;
        margin-bottom: 0.3rem;
    }
    .info-item span {
        display: block;
    }
}
</style>
@endsection