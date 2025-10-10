<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('judulHalaman', 'Pawfect - Manajemen')</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600&family=Nunito+Sans:wght@400;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --warna-utama: #B57F50; --warna-sekunder: #A2B38B; --warna-aksen: #D4AF37;
            --warna-bahaya: #dc3545; --warna-latar: #FFF8E7; --teks-terang: #FFF8E7;
            --teks-gelap: #333; --font-utama: 'Nunito Sans', sans-serif; --font-judul: 'Poppins', sans-serif;
            --bayangan: 0 4px 24px rgba(181, 127, 80, 0.08); --transisi: all 0.3s ease;
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
        .konten-utama { margin-left: 250px; width: calc(100% - 250px); }
        .header { background: #fff; padding: 2rem; border-bottom: 1px solid #eee; display: flex; justify-content: space-between; align-items: center; }
        .header h1 { font-family: var(--font-judul); color: var(--warna-utama); font-size: 2rem; }
        .isi-konten { padding: 2rem; }
        .kartu { background: #fff; border-radius: 16px; padding: 2rem; box-shadow: var(--bayangan); }
        .kartu__judul { font-family: var(--font-judul); color: var(--warna-utama); font-size: 1.5rem; margin-bottom: 1.5rem; }
        .tabel { width: 100%; border-collapse: collapse; }
        .tabel th, .tabel td { padding: 1.25rem 1rem; text-align: left; border-bottom: 1px solid #f0f0f0; }
        .tabel th { color: var(--warna-sekunder); font-size: 0.8rem; text-transform: uppercase; }
        .grup-tombol-aksi { display: flex; gap: 0.5rem; }
        .tombol { display: inline-block; padding: 0.6rem 1.2rem; border-radius: 8px; font-size: 0.85rem; font-weight: 600; cursor: pointer; text-decoration: none; border: none; }
        .tombol--utama { background: var(--warna-aksen); color: white; }
        .tombol--sekunder { background: #eee; color: var(--teks-gelap); }
        .tombol--edit { background: rgba(212, 175, 55, 0.1); color: var(--warna-aksen); }
        .tombol--hapus { background: rgba(220, 53, 69, 0.1); color: var(--warna-bahaya); font-family: var(--font-utama); }
        .notifikasi { padding: 1rem; margin-bottom: 1.5rem; border-radius: 8px; color: white; background: #28a745; }
        .formulir-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; }
        .grup-formulir { margin-bottom: 1.5rem; }
        .grup-formulir.lebar-penuh { grid-column: 1 / -1; }
        .grup-formulir label { display: block; font-size: 0.9rem; font-weight: 600; color: var(--warna-sekunder); margin-bottom: 0.5rem; }
        .input-teks, .input-pilihan, .input-angka, .input-area { width: 100%; padding: 0.9rem; border: 1px solid #ddd; border-radius: 8px; font-size: 1rem; }
        .pesan-error { color: var(--warna-bahaya); font-size: 0.8rem; margin-top: 0.25rem; }
        footer { text-align: center; padding: 2rem; color: #aaa; font-size: 0.9rem; margin-left: 250px; }
    </style>
</head>
<body>
    <div class="wadah">
        <aside class="bilah-sisi">
            <div class="logo"><h1>Pawfect</h1><p>Manajemen Sistem</p></div>
            <nav>
                <a href="#" class="navigasi-link {{ Request::is('dashboard*') ? 'aktif' : '' }}">Dashboard</a>
                <a href="{{ route('products.index') }}" class="navigasi-link {{ Request::is('products*') ? 'aktif' : '' }}">Produk</a>
                <a href="#" class="navigasi-link {{ Request::is('categories*') ? 'aktif' : '' }}">Kategori Produk</a>
                <a href="#" class="navigasi-link {{ Request::is('suppliers*') ? 'aktif' : '' }}">Supplier</a>
                <a href="#" class="navigasi-link {{ Request::is('transactions*') ? 'aktif' : '' }}">Transaksi Penjualan</a>
            </nav>
        </aside>
        <main class="konten-utama">
            @yield('konten')
        </main>
    </div>
</body>
</html>