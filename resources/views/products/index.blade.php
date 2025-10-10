@extends('layouts.app')
@section('judulHalaman', 'Manajemen Produk')

@section('konten')
<header class="header">
    <div>
        <h1>Manajemen Produk</h1>
        <p>Kelola semua produk Anda di sini</p>
    </div>
    <a href="{{ route('products.create') }}" class="tombol tombol--utama">Tambah Produk</a>
</header>

<div class="isi-konten">
    @if (session('sukses'))
        <div class="notifikasi">{{ session('sukses') }}</div>
    @endif

    <div class="kartu">
        <h2 class="kartu__judul">Daftar Produk</h2>

        <table class="tabel">
            <thead>
                <tr>
                    <th>Gambar</th>
                    <th>Nama Produk</th>
                    <th>Deskripsi</th>
                    <th>Kategori</th>
                    <th>Stok</th>
                    <th>Harga</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($products as $produk)
                    <tr>
                        <td style="text-align: center;">
                            {{-- Tampilkan gambar dari folder public/produk --}}
                            @if($produk->gambar)
    @php
        $path = $produk->gambar;
        // cek apakah path-nya URL atau file lokal
        $isLocal = !str_starts_with($path, 'http');
    @endphp

    @if($isLocal)
        <img src="file:///{{ $path }}" 
             alt="{{ $produk->nama_produk }}" 
             width="80" height="80" 
             style="border-radius: 8px; object-fit: cover; border: 1px solid #ddd;">
    @else
        <img src="{{ $path }}" 
             alt="{{ $produk->nama_produk }}" 
             width="80" height="80" 
             style="border-radius: 8px; object-fit: cover; border: 1px solid #ddd;">
    @endif
@else
    <span style="font-size: 0.8em; color: #999;">No Image</span>
@endif

                        {{-- Deskripsi ditampilkan dengan batasan panjang agar tabel tetap rapi --}}
                        <td style="max-width: 200px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                            {{ $produk->deskripsi }}
                        </td>

                        <td>{{ $produk->kategori->product_category_name ?? 'N/A' }}</td>
                        <td>{{ $produk->stok }}</td>
                        <td class="harga">Rp {{ number_format($produk->harga, 0, ',', '.') }}</td>

                        <td>
                            <div class="grup-tombol-aksi" style="display: flex; gap: 6px;">
                                <a href="{{ route('products.edit', $produk->id) }}" class="tombol tombol--edit">Edit</a>
                                <form action="{{ route('products.destroy', $produk->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus produk ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="tombol tombol--hapus">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" style="text-align:center; padding: 2rem;">Belum ada produk.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
