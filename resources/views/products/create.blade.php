@extends('layouts.app')
@section('judulHalaman', 'Tambah Produk')

@section('content')
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="alert alert-error">
        {{ session('error') }}
    </div>
@endif

<div class="halaman-penuh">
    <div class="header-tambah">
        <div>
            <h1>Tambah Produk</h1>
            <p>Isi detail produk baru di bawah ini untuk menambahkannya ke daftar produk.</p>
        </div>
    </div>

    <div class="kartu-form">
        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- Gambar Produk --}}
            <div class="grup-formulir">
                <label for="image">Gambar Produk</label>
                <input 
                    type="file" 
                    id="image" 
                    name="image" 
                    class="@error('image') error @enderror" 
                    required>
                @error('image')<div class="pesan-error">{{ $message }}</div>@enderror
            </div>

            {{-- Nama Produk --}}
            <div class="grup-formulir">
                <label for="title">Nama Produk</label>
                <input 
                    type="text" 
                    id="title" 
                    name="title" 
                    value="{{ old('title') }}" 
                    required>
                @error('title')<div class="pesan-error">{{ $message }}</div>@enderror
            </div>

            {{-- Supplier --}}
            <div class="grup-formulir">
                <label for="id_supplier">Supplier</label>
                <select id="id_supplier" name="id_supplier" required>
                    <option value="">-- Pilih Supplier --</option>
                    @foreach($suppliers as $supplier)
                        <option value="{{ $supplier->id }}" {{ old('id_supplier') == $supplier->id ? 'selected' : '' }}>
                            {{ $supplier->supplier_name }}
                        </option>
                    @endforeach
                </select>
                @error('id_supplier')<div class="pesan-error">{{ $message }}</div>@enderror
            </div>

            {{-- Kategori --}}
            <div class="grup-formulir">
                <label for="product_category_id">Kategori</label>
                <select id="product_category_id" name="product_category_id" required>
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($categories as $kategori)
                        <option value="{{ $kategori->id }}" {{ old('product_category_id') == $kategori->id ? 'selected' : '' }}>
                            {{ $kategori->product_category_name }}
                        </option>
                    @endforeach
                </select>
                @error('product_category_id')<div class="pesan-error">{{ $message }}</div>@enderror
            </div>

            {{-- Deskripsi Produk --}}
            <div class="grup-formulir">
                <label for="description">Deskripsi Produk</label>
                <textarea 
                    id="description" 
                    name="description" 
                    rows="4" 
                    required>{{ old('description') }}</textarea>
                @error('description')<div class="pesan-error">{{ $message }}</div>@enderror
            </div>

            {{-- Harga dan Stok --}}
            <div class="formulir-grid">
                <div class="grup-formulir">
                    <label for="price">Harga (Rp)</label>
                    <input 
                        type="number" 
                        id="price" 
                        name="price" 
                        value="{{ old('price', 0) }}" 
                        required>
                    @error('price')<div class="pesan-error">{{ $message }}</div>@enderror
                </div>

                <div class="grup-formulir">
                    <label for="stock">Stok</label>
                    <input 
                        type="number" 
                        id="stock" 
                        name="stock" 
                        value="{{ old('stock', 0) }}" 
                        required>
                    @error('stock')<div class="pesan-error">{{ $message }}</div>@enderror
                </div>
            </div>

            {{-- Tombol --}}
            <div class="tombol-aksi">
                <a href="{{ route('products.index') }}" class="tombol tombol--batal">Batal</a>
                <button type="submit" class="tombol tombol--utama">Simpan Produk</button>
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
    max-width: 900px;
}

.grup-formulir { margin-bottom: 1.3rem; }
label {
    display: block;
    font-weight: 600;
    color: #8B5E3C;
    margin-bottom: 0.4rem;
}
input, select, textarea {
    width: 100%;
    border: 1px solid #ddd;
    border-radius: 10px;
    padding: 0.7rem;
    font-size: 1rem;
}
textarea { resize: none; }

.formulir-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1.2rem;
}

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
