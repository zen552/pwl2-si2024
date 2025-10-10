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

    .tabel tr:hover {
        background: #fafafa;
    }

    .tabel .harga {
        font-weight: 600;
        color: var(--warna-utama);
    }

    .tabel .grup-tombol-aksi {
        display: flex;
        gap: 0.5rem;
        flex-wrap: wrap;
    }

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

    .tombol:hover {
        transform: translateY(-2px);
    }

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

    .alert-sukses {
        background-color: #e6f9e6;
        border: 1px solid #b8e6b8;
        color: #2e7d32;
        border-radius: 10px;
        padding: 0.8rem 1.2rem;
        margin-top: 1rem;
    }
</style>

<header class="header" style="display:flex; justify-content:space-between; align-items:center; margin-bottom:1rem; flex-wrap:wrap; gap:1rem;">
    <div>
        <h1 style="font-family:'Poppins',sans-serif; color:var(--warna-utama); font-size:2rem;">Manajemen Transaksi</h1>
        <p>Lihat dan kelola seluruh transaksi yang tercatat.</p>
    </div>
    <a href="{{ route('transaksi.create') }}" class="tombol tombol--utama">+ Buat Transaksi</a>
</header>

<div class="kartu">
    <h2 class="kartu__judul">Daftar Transaksi</h2>
    <table class="tabel">
        <thead>
            <tr>
                <th>No.</th>
                <th>ID Transaksi</th>
                <th>Nama Kasir</th>
                <th>Email Pembeli</th>
                <th>Tanggal Transaksi</th>
                <th>Jumlah Item</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($transaksis as $transaksi)
                <tr>
                    <td>{{ $loop->iteration + $transaksis->firstItem() - 1 }}</td>
                    <td><strong>TRX-{{ $transaksi->id }}</strong></td>
                    <td>{{ $transaksi->nama_kasir }}</td>
                    <td>{{ $transaksi->email_pembeli ?? '-' }}</td>
                    <td>{{ \Carbon\Carbon::parse($transaksi->tanggal_transaksi)->format('d M Y, H:i') }}</td>
                    <td>{{ $transaksi->details->count() }}</td>
                    <td>
                        <div class="grup-tombol-aksi">
                            <a href="{{ route('transaksi.show', $transaksi->id) }}" class="tombol tombol--lihat">Lihat</a>
                            <a href="{{ route('transaksi.edit', $transaksi->id) }}" class="tombol tombol--edit">Edit</a>
                            <form action="{{ route('transaksi.destroy', $transaksi->id) }}" method="POST">
    @csrf
    @method('DELETE')
    <button type="submit" class="tombol tombol--hapus">Hapus</button>
</form>

                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" style="text-align:center; padding:2rem;">Belum ada transaksi tercatat.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div style="margin-top: 1.5rem;">
    {{ $transaksis->links() }}
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
