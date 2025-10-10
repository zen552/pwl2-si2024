@extends('layouts.app')
@section('judulHalaman', 'Detail Supplier')

@section('content')
<div class="halaman-penuh">
    <div class="header-tambah">
        <div>
            <h1>Detail Supplier</h1>
            <p>Informasi dasar mengenai supplier yang terdaftar.</p>
        </div>
    </div>

    <div class="kartu-form detail-supplier">
        <div class="detail-info">
            <h2>{{ $supplier->supplier_name }}</h2>

            <div class="info-item">
                <strong>ID Supplier:</strong>
                <span>{{ $supplier->id }}</span>
            </div>

            <div class="info-item">
                <strong>Nama Supplier:</strong>
                <span>{{ $supplier->supplier_name }}</span>
            </div>

            <div class="info-item">
                <strong>Dibuat pada:</strong>
                <span>{{ $supplier->created_at->format('d M Y') }}</span>
            </div>
        </div>

        <div class="tombol-aksi">
            <a href="{{ route('suppliers.index') }}" class="tombol tombol--batal">Kembali ke Daftar</a>
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
    width: 150px;
}
.info-item span {
    color: #555;
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
