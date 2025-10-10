@extends('layouts.app')
@section('judulHalaman', 'Tambah Produk Baru')
@section('konten')
    {{-- ... (header sama seperti sebelumnya) ... --}}
     <header class="header">
        <div><h1>Tambah Produk Baru</h1><p>Isi detail produk di bawah ini</p></div>
        <a href="{{ route('products.index') }}" class="tombol tombol--sekunder">Kembali</a>
    </header>

    <div class="isi-konten">
        <div class="kartu">
            {{-- PENTING: Tambahkan enctype untuk upload file --}}
            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="grup-formulir">
                    <label for="gambar">Gambar Produk</label>
                    <input type="file" id="gambar" name="gambar" class="input-teks @error('gambar') error @enderror" required>
                    @error('gambar')<div class="pesan-error">{{ $message }}</div>@enderror
                </div>
                <div class="grup-formulir">
                    <label for="nama_produk">Nama Produk</label>
                    <input type="text" id="nama_produk" name="nama_produk" class="input-teks @error('nama_produk') error @enderror" value="{{ old('nama_produk') }}" required>
                    @error('nama_produk')<div class="pesan-error">{{ $message }}</div>@enderror
                </div>
                {{-- ... (sisa form sama seperti sebelumnya) ... --}}
                <div class="formulir-grid">
                    <div class="grup-formulir">
                        <label for="product_category_id">Kategori</label>
                        <select id="product_category_id" name="product_category_id" class="input-pilihan" required>
                            <option value="">-- Pilih Kategori --</option>
                             @foreach($categories as $kategori)
                                <option value="{{ $kategori->id }}" {{ old('product_category_id') == $kategori->id ? 'selected' : '' }}>
                                    {{ $kategori->product_category_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="grup-formulir">
                        <label for="stok">Stok</label>
                        <input type="number" id="stok" name="stok" class="input-angka" value="{{ old('stok', 0) }}" required>
                    </div>
                </div>
                <div class="grup-formulir">
                    <label for="harga">Harga (Rp)</label>
                    <input type="number" id="harga" name="harga" class="input-angka" value="{{ old('harga', 0) }}" required>
                </div>
                <div style="text-align: right; margin-top: 1rem;">
                    <button type="submit" class="tombol tombol--utama">Simpan Produk</button>
                </div>
            </form>
        </div>
    </div>
@endsection