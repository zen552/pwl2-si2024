@extends('layouts.app')
@section('judulHalaman', 'Edit Produk')
@section('konten')
    {{-- ... (header sama seperti sebelumnya) ... --}}
    <header class="header">
        <div><h1>Edit Produk</h1><p>Perbarui detail untuk: {{ $product->nama_produk }}</p></div>
        <a href="{{ route('products.index') }}" class="tombol tombol--sekunder">Kembali</a>
    </header>

    <div class="isi-konten">
        <div class="kartu">
            {{-- PENTING: Tambahkan enctype untuk upload file --}}
            <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="grup-formulir">
                    <label for="gambar">Gambar Produk (Kosongkan jika tidak ingin diubah)</label>
                    <input type="file" id="gambar" name="gambar" class="input-teks @error('gambar') error @enderror">
                    @error('gambar')<div class="pesan-error">{{ $message }}</div>@enderror
                    {{-- Preview gambar yang ada --}}
                    @if($product->gambar)
                        <div style="margin-top: 10px;">
                            <img src="{{ asset('storage/produk/' . $product->gambar) }}" alt="Gambar saat ini" width="100" style="border-radius: 8px;">
                        </div>
                    @endif
                </div>
                <div class="grup-formulir">
                    <label for="nama_produk">Nama Produk</label>
                    <input type="text" id="nama_produk" name="nama_produk" class="input-teks @error('nama_produk') error @enderror" value="{{ old('nama_produk', $product->nama_produk) }}" required>
                    @error('nama_produk')<div class="pesan-error">{{ $message }}</div>@enderror
                </div>
                {{-- ... (sisa form sama seperti sebelumnya) ... --}}
                <div class="formulir-grid">
                    <div class="grup-formulir">
                        <label for="product_category_id">Kategori</label>
                        <select id="product_category_id" name="product_category_id" class="input-pilihan" required>
                             @foreach($categories as $kategori)
                                <option value="{{ $kategori->id }}" {{ old('product_category_id', $product->product_category_id) == $kategori->id ? 'selected' : '' }}>
                                    {{ $kategori->product_category_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="grup-formulir">
                        <label for="stok">Stok</label>
                        <input type="number" id="stok" name="stok" class="input-angka" value="{{ old('stok', $product->stok) }}" required>
                    </div>
                </div>
                <div class="grup-formulir">
                    <label for="harga">Harga (Rp)</label>
                    <input type="number" id="harga" name="harga" class="input-angka" value="{{ old('harga', $product->harga) }}" required>
                </div>
                <div style="text-align: right; margin-top: 1rem;">
                    <button type="submit" class="tombol tombol--utama">Perbarui Produk</button>
                </div>
            </form>
        </div>
    </div>
@endsection