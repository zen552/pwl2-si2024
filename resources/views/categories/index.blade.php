@extends('layouts.app')
@section('content')

<style>
    :root {
        --warna-utama: #B57F50;
        --warna-sekunder: #A2B38B;
        --warna-aksen: #D4AF37;
        --warna-bahaya: #dc3545;
        --teks-gelap: #333;
        --transisi: all 0.3s ease;
        --bayangan: 0 4px 24px rgba(181, 127, 80, 0.08);
    }
    .kartu {
        background: #fff;
        border-radius: 16px;
        padding: 2rem;
        box-shadow: var(--bayangan);
        margin-top: 1.5rem;
    }
    .kartu__judul {
        font-family: 'Poppins', sans-serif;
        color: var(--warna-utama);
        font-size: 1.5rem;
        margin-bottom: 1.5rem;
    }
    .tabel {
        width: 100%;
        border-collapse: collapse;
    }
    .tabel th, .tabel td {
        padding: 1.25rem 1rem;
        text-align: left;
        border-bottom: 1px solid #f0f0f0;
    }
    .tabel th {
        color: var(--warna-sekunder);
        font-size: 0.8rem;
        text-transform: uppercase;
    }
    .tabel tr:hover { background: #fafafa; }
    .tabel .grup-tombol-aksi { display: flex; gap: 0.5rem; }

    .tombol {
        padding: 0.6rem 1.2rem;
        border: none;
        border-radius: 8px;
        font-size: 0.85rem;
        font-weight: 600;
        cursor: pointer;
        transition: var(--transisi);
        text-decoration: none;
    }
    .tombol:hover { transform: translateY(-2px); }
    .tombol--utama {
        background: var(--warna-aksen);
        color: white;
        box-shadow: 0 4px 12px rgba(212, 175, 55, 0.3);
    }
    .tombol--lihat {
        background: rgba(30, 144, 255, 0.15);
        color: #1e90ff;
    }
    .tombol--lihat:hover {
        background: rgba(30, 144, 255, 0.25);
    }
    .tombol--edit {
        background: rgba(212, 175, 55, 0.1);
        color: var(--warna-aksen);
    }
    .tombol--hapus {
        background: rgba(220, 53, 69, 0.1);
        color: var(--warna-bahaya);
    }
</style>

<header class="header" style="display:flex; justify-content:space-between; align-items:center; margin-bottom:1rem;">
    <div>
        <h1 style="font-family:'Poppins',sans-serif; color:var(--warna-utama); font-size:2rem;">Manajemen Kategori Produk</h1>
        <p>Kelola semua kategori produk Anda di sini</p>
    </div>
    <a href="{{ route('categories.create') }}" class="tombol tombol--utama">+ Tambah Kategori</a>
</header>
<div class="kartu">
    <h2 class="kartu__judul">Daftar Kategori</h2>
    <table class="tabel">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Kategori</th>
                <th>Deskripsi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($categories as $category)
            <tr>
                <td>{{ $category->id }}</td>
                <td>{{ $category->product_category_name }}</td>
                <td>{{ $category->description }}</td>
                <td>
                    <div class="grup-tombol-aksi">
                        <a href="{{ route('categories.show', $category->id) }}" class="tombol tombol--lihat">Lihat</a>
                        <a href="{{ route('categories.edit', $category->id) }}" class="tombol tombol--edit">Edit</a>
                        <form action="{{ route('categories.destroy', $category->id) }}" method="POST">
    @csrf
    @method('DELETE')
    <button type="submit" class="tombol tombol--hapus">Hapus</button>
</form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" style="text-align:center; padding:2rem;">Belum ada kategori. Silakan tambahkan.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Tangkap semua form hapus di halaman ini
    const forms = document.querySelectorAll('form[method="POST"]');

    forms.forEach(form => {
        form.addEventListener('submit', function (e) {
            // Pastikan hanya form hapus yang diubah
            if (form.querySelector('input[name="_method"][value="DELETE"]')) {
                e.preventDefault();
                Swal.fire({
                    title: 'Yakin ingin menghapus data ini?',
                    text: "Data yang dihapus tidak dapat dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#D4A017',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            }
        });
    });
});
</script>

{{-- Notifikasi sukses --}}
@if(session('success'))
<script>
Swal.fire({
    icon: 'success',
    title: 'Berhasil!',
    text: '{{ session('success') }}',
    showConfirmButton: false,
    timer: 2000
});
</script>
@endif
@endsection