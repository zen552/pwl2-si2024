@extends('layouts.app')
@section('judulHalaman', 'Tambah Kategori Produk')

@section('content')
<div class="halaman-penuh">
    <div class="header-tambah">
        <div>
            <h1>Tambah Kategori Produk</h1>
            <p>Isi informasi di bawah untuk menambahkan kategori produk baru.</p>
        </div>
    </div>

    <div class="kartu-form">
        <form action="{{ route('categories.store') }}" method="POST">
            @csrf

            {{-- Nama Kategori --}}
            <div class="grup-formulir">
                <label for="product_category_name">Nama Kategori</label>
                <input 
                    type="text" 
                    id="product_category_name" 
                    name="product_category_name" 
                    value="{{ old('product_category_name') }}" 
                    required>
                @error('product_category_name')<div class="pesan-error">{{ $message }}</div>@enderror
            </div>

            {{-- Deskripsi --}}
            <div class="grup-formulir">
                <label for="description">Deskripsi</label>
                <textarea 
                    id="description" 
                    name="description" 
                    rows="4">{{ old('description') }}</textarea>
                @error('description')<div class="pesan-error">{{ $message }}</div>@enderror
            </div>

            {{-- Tombol --}}
            <div class="tombol-aksi">
                <a href="{{ route('categories.index') }}" class="tombol tombol--batal">Batal</a>
                <button type="submit" class="tombol tombol--utama">Simpan Kategori</button>
            </div>
        </form>
    </div>
</div>

<style>
.halaman-penuh {
    background-color: #FFF8E7;
    padding: 3rem 4rem;
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
    font-size: 2.2rem;
    font-weight: 700;
    margin-bottom: 0.3rem;
}
.header-tambah p {
    color: #9B7B5C;
    font-size: 1rem;
}

.kartu-form {
    background: #ffffff;
    border-radius: 20px;
    padding: 2.5rem 3rem;
    box-shadow: 0 10px 25px rgba(0,0,0,0.05);
    width: 90%;
    max-width: 700px;
}

.grup-formulir { margin-bottom: 1.3rem; }
label {
    display: block;
    font-weight: 600;
    color: #8B5E3C;
    margin-bottom: 0.4rem;
}
input, textarea {
    width: 100%;
    border: 1px solid #ddd;
    border-radius: 10px;
    padding: 0.7rem;
    font-size: 1rem;
}
textarea { resize: none; }

.tombol-aksi {
    text-align: right;
    margin-top: 1.8rem;
    display: flex;
    justify-content: flex-end;
    gap: 1rem;
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
.tombol--utama {
    background-color: #D4A017;
    color: white;
}
.tombol--utama:hover { background-color: #c4950f; }
.tombol--batal {
    background-color: #f2f2f2;
    color: #555;
}
.tombol--batal:hover { background-color: #e0e0e0; }

.pesan-error {
    color: #cc0000;
    font-size: 0.85rem;
    margin-top: 0.3rem;
}
</style>
@endsection