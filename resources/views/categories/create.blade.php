@extends('layouts.app')

@section('content')
    <h1>Tambah Kategori Produk Baru</h1>
    <a href="{{ route('categories.index') }}" class="btn btn-secondary">Kembali</a>
    <hr>

    <form action="{{ route('categories.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Nama Kategori</label>
            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="form-group">
            <label for="description">Deskripsi</label>
            <textarea name="description" id="description" class="form-control">{{ old('description') }}</textarea>
        </div>
        
        <button type="submit" class="btn btn-success mt-3">💾 Simpan Kategori</button>
    </form>
@endsection<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Kategori Baru</title>
    {{-- Kamu bisa menggunakan CSS yang sama dengan halaman index --}}
    <style>
        :root {
            --warna-utama: #B57F50; --warna-sekunder: #A2B38B; --warna-aksen: #D4AF37;
            --warna-bahaya: #dc3545; --warna-latar: #FFF8E7; --teks-terang: #FFF8E7;
            --teks-gelap: #333; --font-utama: 'Nunito Sans', sans-serif; --font-judul: 'Poppins', sans-serif;
            --bayangan: 0 4px 24px rgba(181, 127, 80, 0.08); --transisi: all 0.3s ease;
        }
        body { font-family: var(--font-utama); background: var(--warna-latar); }
        .konten-utama { padding: 2rem; max-width: 800px; margin: auto; }
        .header { padding-bottom: 1rem; border-bottom: 1px solid #eee; display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem; }
        .header h1 { font-family: var(--font-judul); color: var(--warna-utama); }
        .kartu { background: #fff; border-radius: 16px; padding: 2rem; box-shadow: var(--bayangan); }
        .grup-formulir { margin-bottom: 1.5rem; }
        .grup-formulir label { display: block; font-size: 0.9rem; font-weight: 600; color: var(--warna-sekunder); margin-bottom: 0.5rem; }
        .input-teks, .input-area { width: 100%; padding: 0.9rem; border: 1px solid #ddd; border-radius: 8px; font-size: 1rem; }
        .pesan-error { color: var(--warna-bahaya); font-size: 0.8rem; margin-top: 0.25rem; }
        .tombol { display: inline-block; padding: 0.8rem 1.5rem; border-radius: 8px; font-size: 0.9rem; font-weight: 600; text-decoration: none; border: none; }
        .tombol--utama { background: var(--warna-aksen); color: white; }
        .tombol--sekunder { background: #eee; color: var(--teks-gelap); }
    </style>
</head>
<body>
    <main class="konten-utama">
        <header class="header">
            <h1>Tambah Kategori Baru</h1>
            <a href="{{ route('categories.index') }}" class="tombol tombol--sekunder">Kembali</a>
        </header>

        <div class="kartu">
            <form action="{{ route('categories.store') }}" method="POST">
                @csrf
                <div class="grup-formulir">
                    <label for="nama">Nama Kategori</label>
                    <input type="text" id="nama" name="product_category_name" class="input-teks @error('product_category_name') error @enderror" value="{{ old('product_category_name') }}" required>
                    @error('product_category_name')
                        <div class="pesan-error">{{ $message }}</div>
                    @enderror
                </div>
                <div class="grup-formulir">
                    <label for="deskripsi">Deskripsi</label>
                    <textarea id="deskripsi" name="description" class="input-area" rows="4">{{ old('description') }}</textarea>
                </div>
                <button type="submit" class="tombol tombol--utama">Simpan Kategori</button>
            </form>
        </div>
    </main>
</body>
</html>