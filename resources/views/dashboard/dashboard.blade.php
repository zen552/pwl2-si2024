<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Sistem Manajemen</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600&family=Nunito+Sans:wght@400;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --warna-utama: #B57F50;
            --warna-sekunder: #A2B38B;
            --warna-aksen: #D4AF37;
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

        .bilah-sisi { width: 250px; background: var(--warna-utama); color: var(--teks-terang); height: 100vh; position: fixed; display: flex; flex-direction: column; padding: 2rem 0; }
        .bilah-sisi .logo { text-align: center; padding: 0 1rem; margin-bottom: 2.5rem; }
        .bilah-sisi .logo h1 { font-family: var(--font-judul); font-size: 1.7rem; }
        .bilah-sisi .logo p { font-size: 0.8rem; opacity: 0.7; }
        .bilah-sisi .navigasi-link { display: block; padding: 1rem 2rem; color: var(--teks-terang); text-decoration: none; margin: 0.5rem 1rem; border-radius: 12px; transition: var(--transisi); }
        .bilah-sisi .navigasi-link:hover, .bilah-sisi .navigasi-link.aktif { background: rgba(255, 255, 255, 0.15); transform: translateX(5px); }

        .konten-utama { margin-left: 250px; width: calc(100% - 250px); animation: fadeIn 0.5s ease-out; }
        .header-halaman { background: #fff; padding: 2rem; border-bottom: 1px solid #eee; display: flex; justify-content: space-between; align-items: center; }
        .header-halaman .judul h1 { font-family: var(--font-judul); color: var(--warna-utama); font-size: 1.8rem; margin: 0; }
        .header-halaman .waktu { text-align: right; color: var(--warna-sekunder); }
        .header-halaman .waktu #tanggal-sekarang { font-weight: 600; color: var(--warna-utama); }
        .isi-konten { padding: 2rem; }

        .grid { display: grid; gap: 1.5rem; }
        .grid-kolom-4 { grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); }
        
        .kartu { background: #fff; border-radius: 16px; padding: 2rem; box-shadow: var(--bayangan); margin-bottom: 1.5rem; /* Menambahkan margin bawah */ }
        .kartu__judul { font-family: var(--font-judul); color: var(--warna-utama); font-size: 1.5rem; margin-bottom: 1.5rem; }
        .kartu-ringkasan .judul-info { color: var(--warna-sekunder); font-weight: 600; font-size: 0.9rem; text-transform: uppercase; }
        .kartu-ringkasan .nilai-info { font-family: var(--font-judul); color: var(--warna-utama); font-size: 3rem; margin: 0.5rem 0; }
        .kartu-ringkasan .perubahan-info { font-size: 0.9rem; color: #888; }
        .kartu-ringkasan .perubahan-info.positif { color: #28a745; }

        .tabel { width: 100%; border-collapse: collapse; margin-top: 1rem; }
        .tabel th, .tabel td { padding: 1.25rem 1rem; text-align: left; border-bottom: 1px solid #f0f0f0; }
        .tabel th { color: var(--warna-sekunder); font-size: 0.8rem; text-transform: uppercase; }
        .tabel .harga { font-weight: 600; color: var(--warna-aksen); }

        .tombol-aksi { display: block; width: 100%; padding: 1.5rem; border: none; border-radius: 12px; font-size: 1rem; font-weight: 600; cursor: pointer; transition: var(--transisi); text-align: center; text-decoration: none; background: var(--warna-aksen); color: white; box-shadow: 0 4px 12px rgba(212, 175, 55, 0.3); }
        .tombol-aksi:hover { transform: translateY(-3px); box-shadow: 0 6px 16px rgba(212, 175, 55, 0.4); }

        footer { text-align: center; padding: 2rem; color: #aaa; font-size: 0.9rem; margin-left: 250px; }
        
        @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
        
        @media (max-width: 768px) {
            .bilah-sisi { display: none; }
            .konten-utama, footer { margin-left: 0; width: 100%; }
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
                {{-- Logika untuk link aktif akan ditambahkan di sini --}}
                <a href="{{-- route('dashboard') --}}" class="navigasi-link aktif">Dashboard</a>
                <a href="{{-- route('products.index') --}}" class="navigasi-link">Produk</a>
                <a href="{{-- route('categories.index') --}}" class="navigasi-link">Kategori Produk</a>
                <a href="{{-- route('suppliers.index') --}}" class="navigasi-link">Supplier</a>
                <a href="{{-- route('transaksi.index') --}}" class="navigasi-link">Transaksi Penjualan</a>
            </nav>
        </aside>

        <main class="konten-utama">
            <header class="header-halaman">
                <div class="judul">
                    <h1>Selamat Datang, Admin!</h1>
                    <p>Ringkasan aktivitas bisnis Anda hari ini.</p>
                </div>
                <div class="waktu">
                    <div id="tanggal-sekarang"></div>
                    <div id="jam-sekarang"></div>
                </div>
            </header>

            <div class="isi-konten">
                {{-- Bagian kartu ringkasan --}}
                <div class="grid grid-kolom-4">
                    <div class="kartu kartu-ringkasan">
                        <div class="judul-info">Total Produk</div>
                        <div class="nilai-info">{{ $totalProduk ?? 0 }}</div>
                        <div class="perubahan-info positif">+12 bulan ini</div>
                    </div>
                    <div class="kartu kartu-ringkasan">
                        <div class="judul-info">Total Supplier</div>
                        <div class="nilai-info">{{ $totalSupplier ?? 0 }}</div>
                        <div class="perubahan-info">Supplier aktif</div>
                    </div>
                    <div class="kartu kartu-ringkasan">
                        <div class="judul-info">Total Kategori</div>
                        <div class="nilai-info">{{ $totalKategori ?? 0 }}</div>
                        <div class="perubahan-info">Kategori produk</div>
                    </div>
                    <div class="kartu kartu-ringkasan">
                        <div class="judul-info">Transaksi Hari Ini</div>
                        <div class="nilai-info">{{ $transaksiHariIni ?? 0 }}</div>
                        <div class="perubahan-info positif">+5 dari kemarin</div>
                    </div>
                </div>

                {{-- Bagian tabel dan aksi cepat sekarang berada dalam grid terpisah --}}
                <div class="grid" style="grid-template-columns: 2fr 1fr; align-items: start; margin-top: 1.5rem;">
                    <section class="kartu" style="margin-bottom: 0;">
                        <h2 class="kartu__judul">Transaksi Terbaru</h2>
                        <table class="tabel">
                            <thead>
                                <tr>
                                    <th>ID Transaksi</th>
                                    <th>Tanggal</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($transaksiTerbaru as $trx)
                                <tr>
                                    <td>{{ $trx->id }}</td>
                                    <td>{{ $trx->created_at->format('d M Y H:i') }}</td>
                                    <td class="harga">Rp {{ number_format($trx->total, 0, ',', '.') }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" style="text-align: center; padding: 1rem;">Belum ada transaksi.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </section>

                    <section class="kartu" style="margin-bottom: 0;">
                        <h2 class="kartu__judul">Aksi Cepat</h2>
                        <div class="grid" style="gap: 1rem;">
                            <a href="{{-- route('products.create') --}}" class="tombol-aksi">Tambah Produk</a>
                            <a href="{{-- route('suppliers.create') --}}" class="tombol-aksi">Tambah Supplier</a>
                            <a href="{{-- route('transaksi.create') --}}" class="tombol-aksi">Tambah Transaksi</a>
                            <a href="#" class="tombol-aksi">Lihat Laporan</a>
                        </div>
                    </section>
                </div>
            </div>

            <footer>&copy; 2025 Pawfect Supplies</footer>
        </main>
    </div>

<script>
// Menunggu semua elemen halaman dimuat
document.addEventListener('DOMContentLoaded', () => {
    // Fungsi untuk memperbarui jam dan tanggal
    const perbaruiWaktu = () => {
        const sekarang = new Date();
        const opsiTanggal = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
        document.getElementById('tanggal-sekarang').innerText = sekarang.toLocaleDateString('id-ID', opsiTanggal);
        document.getElementById('jam-sekarang').innerText = sekarang.toLocaleTimeString('id-ID');
    };
    // Panggil fungsi pertama kali
    perbaruiWaktu();
    // Update jam setiap detik
    setInterval(perbaruiWaktu, 1000);
});
</script>
</body>
</html>