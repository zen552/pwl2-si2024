<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kategori: {{ $category->product_category_name }}</title>
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
        .tombol { display: inline-block; padding: 0.6rem 1.2rem; border-radius: 8px; font-size: 0.85rem; font-weight: 600; cursor: pointer; text-decoration: none; border: none; }
        .tombol--utama { background: var(--warna-aksen); color: white; }
        .tombol--sekunder { background: #eee; color: var(--teks-gelap); }
        .grup-formulir { margin-bottom: 1.5rem; }
        .grup-formulir label { display: block; font-size: 0.9rem; font-weight: 600; color: var(--warna-sekunder); margin-bottom: 0.5rem; }
        .input-teks, .input-area { width: 100%; padding: 0.9rem; border: 1px solid #ddd; border-radius: 8px; font-size: 1rem; }
        .pesan-error { color: var(--warna-bahaya); font-size: 0.8rem; margin-top: 0.25rem; }
        footer { text-align: center; padding: 2rem; color: #aaa; font-size: 0.9rem; margin-left: 250px; }
        @media (max-width: 768px) { .bilah-sisi { display: none; } .konten-utama, footer { margin-left: 0; width: 100%; } }
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
                <a href="{{ route('categories.index') }}" class="navigasi-link aktif">Kategori Produk</a>
                <a href="#" class="navigasi-link">Supplier</a>
                <a href="#" class="navigasi-link">Transaksi Penjualan</a>
            </nav>
        </aside>

        <main class="konten-utama">
            <header class="header">
                <div>
                    <h1>Edit Kategori</h1>
                    <p>Perbarui detail untuk: {{ $category->product_category_name }}</p>
                </div>
                <a href="{{ route('categories.index') }}" class="tombol tombol--sekunder">Kembali</a>
            </header>

            <div class="isi-konten">
                <div class="kartu">
                    {{-- Form ini akan mengirim data ke method 'update' di Controller --}}
                    <form action="{{ route('categories.update', $category->id) }}" method="POST">
                        @csrf
                        @method('PUT') {{-- Ini wajib untuk proses update di Laravel --}}

                        <div class="grup-formulir">
                            <label for="nama">Nama Kategori</label>
                            {{-- Tampilkan data lama dari database, atau data yang baru diinput jika validasi gagal --}}
                            <input type="text" id="nama" name="product_category_name" class="input-teks @error('product_category_name') error @enderror" value="{{ old('product_category_name', $category->product_category_name) }}" required>
                            @error('product_category_name')
                                <div class="pesan-error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="grup-formulir">
                            <label for="deskripsi">Deskripsi</label>
                            <textarea id="deskripsi" name="description" class="input-area" rows="4">{{ old('description', $category->description) }}</textarea>
                        </div>

                        <div style="text-align: right;">
                            <button type="submit" class="tombol tombol--utama">Perbarui Kategori</button>
                        </div>
                    </form>
                </div>
            </div>
            <footer>&copy; 2025 Pawfect Supplies</footer>
        </main>
    </div>
</body>
</html>