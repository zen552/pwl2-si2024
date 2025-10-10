{{-- Halaman ini menggabungkan tampilan, tambah, edit, dan hapus dalam satu file menggunakan modal --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Kategori</title>
    {{-- Mengambil CSRF token untuk keamanan AJAX Laravel --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
        .tombol { padding: 0.6rem 1.2rem; border: none; border-radius: 8px; font-size: 0.85rem; font-weight: 600; cursor: pointer; transition: var(--transisi); text-decoration: none; }
        .tombol--utama { background: var(--warna-aksen); color: white; box-shadow: 0 4px 12px rgba(212, 175, 55, 0.3); }
        .tombol--sekunder { background: #f0f0f0; color: #555; }
        .tombol--edit { background: rgba(212, 175, 55, 0.1); color: var(--warna-aksen); }
        .tombol--hapus { background: rgba(220, 53, 69, 0.1); color: var(--warna-bahaya); }
        
        /* --- Style untuk Modal dan Form di dalamnya --- */
        .lapisan-modal { position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); display: flex; align-items: center; justify-content: center; z-index: 1000; opacity: 0; visibility: hidden; transition: var(--transisi); }
        .lapisan-modal.aktif { opacity: 1; visibility: visible; }
        .modal { background: #fff; border-radius: 24px; padding: 2rem; width: 90%; max-width: 500px; transform: scale(0.95); transition: var(--transisi); box-shadow: 0 10px 30px rgba(0,0,0,0.1); }
        .lapisan-modal.aktif .modal { transform: scale(1); }
        .modal__header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; padding: 0 0.5rem; }
        .modal__judul { font-family: var(--font-judul); color: var(--warna-utama); font-size: 1.7rem; }
        .modal__tombol-tutup { background: #f0f0f0; border-radius: 50%; width: 32px; height: 32px; border: none; cursor: pointer; }
        .formulir-modal { background: #fff; padding: 0.5rem; border-radius: 12px; }
        .grup-formulir { margin-bottom: 1.5rem; }
        .grup-formulir label { display: block; font-size: 0.8rem; font-weight: 600; color: var(--warna-sekunder); margin-bottom: 0.5rem; text-transform: uppercase; }
        .input-teks, .input-area { width: 100%; padding: 1rem; border: 1px solid #ddd; background: #fafafa; border-radius: 12px; font-size: 1rem; transition: var(--transisi); }
        .input-teks:focus, .input-area:focus { outline: none; border-color: var(--warna-utama); box-shadow: 0 0 0 3px rgba(181, 127, 80, 0.1); background: #fff; }
        .formulir-aksi { display: flex; justify-content: flex-end; gap: 0.75rem; margin-top: 2rem; }
        
        #notifikasi { position: fixed; top: 20px; left: 50%; transform: translateX(-50%); background: var(--warna-aksen); color: white; padding: 1rem 2rem; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); z-index: 2000; opacity: 0; visibility: hidden; transition: all 0.4s ease; }
        #notifikasi.tampil { opacity: 1; visibility: visible; top: 30px; }
    </style>
</head>
<body>
    <div id="notifikasi"></div>

    <div class="wadah">
        <aside class="bilah-sisi">
            <div class="logo"><h1>Pawfect</h1><p>Manajemen Sistem</p></div>
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
                <div><h1>Manajemen Kategori</h1><p>Kelola semua kategori produk</p></div>
                <button class="tombol tombol--utama" id="tombolTambah">Tambah Kategori</button>
            </header>

            <div class="isi-konten">
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
                        <tbody id="isiTabel">
                            @forelse ($categories as $kategori)
                                <tr id="baris-kategori-{{ $kategori->id }}">
                                    <td>{{ $kategori->id }}</td>
                                    <td>{{ $kategori->product_category_name }}</td>
                                    <td>{{ $kategori->description }}</td>
                                    <td>
                                        <div class="grup-tombol-aksi">
                                            <button class="tombol tombol--edit" data-aksi="edit" data-kategori="{{ json_encode($kategori) }}">Edit</button>
                                            <button class="tombol tombol--hapus" data-aksi="hapus" data-id="{{ $kategori->id }}">Hapus</button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="4" style="text-align:center; padding: 2rem;">Data masih kosong.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <footer>&copy; 2025 Pawfect Supplies</footer>
        </main>
    </div>

    {{-- Modal untuk form Tambah dan Edit --}}
    <div class="lapisan-modal" id="modalKategori">
        <div class="modal">
            <div class="modal__header">
                <h3 class="modal__judul" id="judulModal"></h3>
                <button class="modal__tombol-tutup" id="tombolTutupModal">&times;</button>
            </div>
            <div id="kontenModal">
                {{-- Form akan dibuat oleh JavaScript di sini --}}
            </div>
        </div>
    </div>
@endsection

<script>
document.addEventListener('DOMContentLoaded', () => {
    // Variabel global untuk menyimpan ID kategori yang sedang diedit
    let idKategoriSaatIni = null;
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    // Mengambil elemen-elemen penting dari HTML
    const ambilElemen = (id) => document.getElementById(id);
    const modal = ambilElemen('modalKategori');
    const isiTabel = ambilElemen('isiTabel');
    const kontenModal = ambilElemen('kontenModal');
    const judulModal = ambilElemen('judulModal');
    const notifikasi = ambilElemen('notifikasi');

    // Fungsi untuk menampilkan notifikasi
    const tampilkanNotifikasi = (pesan, sukses = true) => {
        notifikasi.textContent = pesan;
        notifikasi.style.background = sukses ? 'var(--warna-aksen)' : 'var(--warna-bahaya)';
        notifikasi.classList.add('tampil');
        setTimeout(() => { notifikasi.classList.remove('tampil'); }, 3000);
    };
    
    // Fungsi untuk membuka modal (baik untuk Tambah maupun Edit)
    const bukaModal = (mode, dataKategori = null) => {
        idKategoriSaatIni = dataKategori ? dataKategori.id : null;
        judulModal.innerText = mode === 'edit' ? 'Edit Kategori' : 'Tambah Kategori';
        
        // Membuat HTML untuk form di dalam modal
        const kontenHTML = `
            <form id="formulirKategori" class="formulir-modal">
                <div class="grup-formulir">
                    <label for="nama">Nama Kategori</label>
                    <input type="text" id="nama" class="input-teks" value="${dataKategori ? dataKategori.product_category_name : ''}" required>
                </div>
                <div class="grup-formulir">
                    <label for="deskripsi">Deskripsi</label>
                    <textarea id="deskripsi" class="input-area" rows="3" required>${dataKategori ? dataKategori.description : ''}</textarea>
                </div>
                <div class="formulir-aksi">
                    <button type="button" class="tombol tombol--sekunder" id="tombolBatal">Batal</button>
                    <button type="submit" class="tombol tombol--utama">Simpan</button>
                </div>
            </form>`;
        
        kontenModal.innerHTML = kontenHTML;
        modal.classList.add('aktif');
    };
    const tutupModal = () => modal.classList.remove('aktif');

    // Fungsi untuk mengirim data (Simpan atau Update) ke Controller
    async function simpanData(event) {
        event.preventDefault();
        
        const nama = ambilElemen('nama').value.trim();
        const deskripsi = ambilElemen('deskripsi').value.trim();
        const url = idKategoriSaatIni 
            ? `{{ url('categories') }}/${idKategoriSaatIni}` 
            : `{{ route('categories.store') }}`;

        const formData = new FormData();
        formData.append('product_category_name', nama);
        formData.append('description', deskripsi);
        if (idKategoriSaatIni) {
            formData.append('_method', 'PUT'); // Wajib untuk update
        }

        try {
            const response = await fetch(url, { 
                method: 'POST', 
                headers: { 'X-CSRF-TOKEN': csrfToken },
                body: formData 
            });
            const result = await response.json();

            if (!response.ok) {
                const errors = Object.values(result.errors).map(e => e[0]).join('\n');
                throw new Error(errors);
            }
            
            tampilkanNotifikasi(result.success);
            tutupModal();
            setTimeout(() => window.location.reload(), 1500); // Reload halaman agar data terbaru muncul

        } catch (error) {
            tampilkanNotifikasi('Error: ' + error.message, false);
        }
    }

    // Fungsi untuk menghapus data
    async function hapusData(id) {
        if (!confirm(`Yakin ingin menghapus kategori dengan ID ${id}?`)) return;

        const url = `{{ url('categories') }}/${id}`;
        try {
            const response = await fetch(url, {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': csrfToken, 'Content-Type': 'application/json' },
                body: JSON.stringify({ _method: 'DELETE' })
            });

            const result = await response.json();
            if (!response.ok) throw new Error(result.error || 'Gagal menghapus data.');
            
            tampilkanNotifikasi(result.success);
            ambilElemen(`baris-kategori-${id}`).remove(); // Hapus baris dari tabel

        } catch (error) {
            tampilkanNotifikasi('Error: ' + error.message, false);
        }
    }
    
    // --- Event Listener (Menangani semua klik dan submit) ---
    ambilElemen('tombolTambah').addEventListener('click', () => bukaModal('tambah'));
    ambilElemen('tombolTutupModal').addEventListener('click', tutupModal);
    modal.addEventListener('click', (e) => { if (e.target.classList.contains('lapisan-modal')) tutupModal(); });

    // Event listener untuk tombol di dalam tabel (Edit dan Hapus)
    isiTabel.addEventListener('click', (e) => {
        const target = e.target.closest('button');
        if (!target) return;
        
        const aksi = target.dataset.aksi;
        if (aksi === 'edit') {
            const data = JSON.parse(target.dataset.kategori);
            bukaModal('edit', data);
        }
        if (aksi === 'hapus') {
            hapusData(target.dataset.id);
        }
    });
    
    // Event listener untuk tombol di dalam modal (Batal dan Simpan)
    kontenModal.addEventListener('click', (e) => { if (e.target.id === 'tombolBatal') tutupModal(); });
    kontenModal.addEventListener('submit', (e) => { if (e.target.id === 'formulirKategori') simpanData(e); });
});
</script>
</body>
</html>