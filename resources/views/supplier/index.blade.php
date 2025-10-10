<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Supplier</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600&family=Nunito+Sans:wght@400;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --warna-utama: #B57F50;
            --warna-sekunder: #A2B38B;
            --warna-aksen: #D4AF37;
            --warna-bahaya: #dc3545;
            --warna-latar: #FFF8E7;
            --teks-terang: #FFF8E7;
            --teks-gelap: #333;
            --font-utama: 'Nunito Sans', sans-serif;
            --font-judul: 'Poppins', sans-serif;
            --bayangan: 0 4px 24px rgba(181, 127, 80, 0.08);
            --transisi: all 0.3s ease;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: var(--font-utama); background: var(--warna-latar); color: var(--teks-gelap); }

        .wadah { display: flex; }
        .bilah-sisi {
            width: 250px; background: var(--warna-utama); color: var(--teks-terang);
            height: 100vh; position: fixed; display: flex; flex-direction: column; padding: 2rem 0;
        }
        .bilah-sisi .logo { text-align: center; margin-bottom: 2.5rem; }
        .bilah-sisi .logo h1 { font-family: var(--font-judul); font-size: 1.7rem; }
        .bilah-sisi .navigasi-link {
            display: block; padding: 1rem 2rem; color: var(--teks-terang);
            text-decoration: none; margin: 0.5rem 1rem; border-radius: 12px; transition: var(--transisi);
        }
        .bilah-sisi .navigasi-link:hover, .bilah-sisi .navigasi-link.aktif {
            background: rgba(255,255,255,0.15); transform: translateX(5px);
        }

        .konten-utama { margin-left: 250px; width: calc(100% - 250px); }
        .header {
            background: #fff; padding: 2rem; border-bottom: 1px solid #eee;
            display: flex; justify-content: space-between; align-items: center;
        }
        .header h1 { font-family: var(--font-judul); color: var(--warna-utama); }
        .isi-konten { padding: 2rem; }

        .kartu { background: #fff; border-radius: 16px; padding: 2rem; box-shadow: var(--bayangan); }
        .tabel { width: 100%; border-collapse: collapse; margin-top: 1rem; }
        .tabel th, .tabel td {
            padding: 1rem; border-bottom: 1px solid #eee; text-align: left; vertical-align: top;
        }

        .tombol {
            padding: 0.6rem 1.2rem; border-radius: 8px; text-decoration: none; border: none;
            font-weight: 600; cursor: pointer; transition: var(--transisi);
        }
        .tombol--utama { background: var(--warna-aksen); color: white; }
        .tombol--edit { background: rgba(212,175,55,0.1); color: var(--warna-aksen); }
        .tombol--hapus { background: rgba(220,53,69,0.1); color: var(--warna-bahaya); }

        footer { text-align: center; padding: 2rem; color: #aaa; font-size: 0.9rem; margin-left: 250px; }

        /* 🔔 Notifikasi */
        #notifikasi {
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            background: var(--warna-aksen);
            color: white;
            padding: 1rem 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            z-index: 2000;
            opacity: 0;
            visibility: hidden;
            transition: all 0.4s ease;
        }

        #notifikasi.tampil {
            opacity: 1;
            visibility: visible;
            animation: hilang 3.5s forwards;
        }

        @keyframes hilang {
            0%, 85% { opacity: 1; visibility: visible; }
            100% { opacity: 0; visibility: hidden; }
        }
    </style>
</head>
<body>
<div class="wadah">
    <aside class="bilah-sisi">
        <div class="logo">
            <h1>Pawfect</h1>
            <p>Manajemen Sistem</p>
        </div>
        <nav>
            <a href="#" class="navigasi-link">Dashboard</a>
            <a href="#" class="navigasi-link">Produk</a>
            <a href="#" class="navigasi-link">Kategori Produk</a>
            <a href="#" class="navigasi-link aktif">Supplier</a>
            <a href="#" class="navigasi-link">Transaksi Penjualan</a>
        </nav>
    </aside>

    <main class="konten-utama">
        <header class="header">
            <h1>Manajemen Supplier</h1>
            <a href="{{ route('suppliers.create') }}" class="tombol tombol--utama">Tambah Supplier</a>
        </header>

        {{-- ✅ Notifikasi sukses --}}
        @if (session('success'))
            <div id="notifikasi" class="tampil">
                {{ session('success') }}
            </div>
        @endif

        <div class="isi-konten">
            <div class="kartu">
                <table class="tabel">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama Supplier</th>
                            <th>PIC Supplier</th>
                            <th>No. Telepon</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($suppliers as $supplier)
                            <tr>
                                <td>{{ $supplier->id }}</td>
                                <td>{{ $supplier->supplier_name }}</td>
                                <td>{{ $supplier->pic_supplier }}</td>
                                <td>{{ $supplier->phone ?? '-' }}</td>
                                <td>
                                    <a href="{{ route('suppliers.edit', $supplier->id) }}" class="tombol tombol--edit">Edit</a>
                                    <form action="{{ route('suppliers.destroy', $supplier->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="tombol tombol--hapus" onclick="return confirm('Yakin ingin menghapus supplier ini?')">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" style="text-align:center;">Belum ada data supplier.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <footer>&copy; 2025 Pawfect Supplies</footer>
    </main>
</div>

<script>
    // 🔔 Auto-hide notifikasi setelah 3 detik
    document.addEventListener('DOMContentLoaded', () => {
        const notif = document.getElementById('notifikasi');
        if (notif) {
            setTimeout(() => {
                notif.style.opacity = '0';
                notif.style.visibility = 'hidden';
            }, 3000);
        }
    });
</script>
</body>
</html>

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Notifikasi SweetAlert dari session
    @if (session('success'))
        Swal.fire({
            icon: "success",
            title: "Berhasil",
            text: "{{ session('success') }}",
            showConfirmButton: false,
            timer: 2000
        });
    @elseif(session('error'))
        Swal.fire({
            icon: "error",
            title: "GAGAL!",
            text: "{{ session('error') }}",
            showConfirmButton: false,
            timer: 2000
        });
    @endif

    // Konfirmasi hapus data
    document.querySelectorAll('.btn-delete').forEach(button => {
        button.addEventListener('click', function (e) {
            e.preventDefault();
            let form = this.closest('form');
            let namaSupplier = this.getAttribute('data-nama');

            Swal.fire({
                title: 'Apakah Anda yakin akan menghapus ' + namaSupplier + '?',
                text: "Data Supplier akan dihapus permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
</script>
@endsection