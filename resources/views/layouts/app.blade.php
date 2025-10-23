<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pawfect Manajemen Sistem</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600&family=Nunito+Sans:wght@400;600&display=swap" rel="stylesheet">

    <!-- Bootstrap & Icon -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('storage/image/pawfect-logo.png') }}" type="image/x-icon">
    <style>
        :root {
            --warna-utama: #B57F50;
            --warna-sekunder: #A2B38B;
            --warna-aksen: #D4AF37;
            --warna-latar: #FFF8E7;
            --teks-gelap: #333;
            --teks-terang: #FFF;
            --font-utama: 'Nunito Sans', sans-serif;
            --font-judul: 'Poppins', sans-serif;
            --bayangan: 0 4px 24px rgba(181, 127, 80, 0.08);
            --transisi: all 0.3s ease;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: var(--font-utama);
            background-color: var(--warna-latar);
            color: var(--teks-gelap);
        }

        /* SIDEBAR */
        .sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
            background-color: var(--warna-utama);
            color: var(--teks-terang);
            display: flex;
            flex-direction: column;
            padding: 2rem 0;
            box-shadow: var(--bayangan);
        }
        .logo-img {
            width: 110px;
            height: auto;
            margin-top: 1rem;
            border-radius: 12px; /* bisa diganti 50% kalau mau bulat */
        }

        .sidebar .logo {
            text-align: center;
            margin-bottom: 2.5rem;
        }
        .sidebar .logo h4 {
            font-family: var(--font-judul);
            font-size: 1.7rem;
        }
        .sidebar .logo p {
            font-size: 0.8rem;
            opacity: 0.7;
        }

        .sidebar a {
            color: var(--teks-terang);
            display: block;
            text-decoration: none;
            padding: 1rem 2rem;
            margin: 0.3rem 1rem;
            border-radius: 12px;
            transition: var(--transisi);
        }

        .sidebar a:hover,
        .sidebar a.active {
            background-color: rgba(255, 255, 255, 0.15);
            transform: translateX(5px);
        }

        .sidebar form {
            background-color: rgba(255,0,0, 0.15);
            color: var(--teks-terang);
            display: block;
            text-decoration: none;
            padding: 1rem 2rem;
            margin: 0.3rem 1rem;
            border-radius: 12px;
            transition: var(--transisi);
        }

        .sidebar form:hover,
        .sidebar form.active {
            background-color: rgba(255, 255, 255, 0.15);
            transform: translateX(5px);
        }
        
        /* KONTEN UTAMA */
        .content {
            margin-left: 250px;
            padding: 2rem;
        }

        .page-header {
            background: #fff;
            padding: 2rem;
            border-bottom: 1px solid #eee;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .page-header h1 {
            font-family: var(--font-judul);
            color: var(--warna-utama);
            font-size: 2rem;
            margin-bottom: 0.5rem;
        }

        .btn-primary-custom {
            background: var(--warna-aksen);
            color: white;
            border: none;
            border-radius: 8px;
            padding: 0.6rem 1.2rem;
            font-weight: 600;
            transition: var(--transisi);
        }

        .btn-primary-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(212, 175, 55, 0.3);
        }

        footer {
            text-align: center;
            padding: 2rem;
            color: #aaa;
            font-size: 0.9rem;
        }

        @media (max-width: 768px) {
            .sidebar { display: none; }
            .content { margin-left: 0; }
        }
        .d-flex .pagination {
            margin-left: 12px; 
        }
        .pagination .page-link {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 38px;
            width: 38px;
            border-radius: 8px;
            font-family: 'Poppins', sans-serif;
            font-size: 14px;
            color: #6b4b23;
            line-height: normal;
            padding: 0;
        }

        .pagination .page-item.active .page-link {
            background-color: #d8b04c;
            color: white;
            border-color: #d8b04c;
        }

        .pagination .page-item.disabled .page-link {
            background-color: #f2f2f2;
            color: #c0c0c0;
            border: none;
        }
    </style>
</head>

<body>
    <!-- SIDEBAR -->
    <div class="sidebar">
        <div class="logo">
            <h4>Pawfect</h4>
            <p>Manajemen Sistem</p>
         <img src="{{ asset('storage/image/pawfect-logo.png') }}" alt="Logo Pawfect" class="logo-img">

        </div>

        <a href="{{ url('/products') }}" class="{{ request()->is('products*') ? 'active' : '' }}">
            <i class="bi bi-box"></i> Products
        </a>
        <a href="{{ url('/suppliers') }}" class="{{ request()->is('suppliers*') ? 'active' : '' }}">
            <i class="bi bi-truck"></i> Supplier
        </a>
        <a href="{{ url('/categories') }}" class="{{ request()->is('categories*') ? 'active' : '' }}">
            <i class="bi bi-tags"></i> Kategori Produk
        </a>
        <a href="{{ url('/transaksi') }}" class="{{ request()->is('transaksi*') ? 'active' : '' }}">
            <i class="bi bi-cash-stack"></i> Transaksi
        </a>
        <form action="{{ route('logout') }}" method="POST" >
            @csrf
            <button type="submit" class="dropdown-item text-danger">
                <i class="bi bi-box-arrow-right"></i> Logout
            </button>
        </form>
    </div>

    <!-- KONTEN -->
    <div class="content">
        @yield('content')
        <footer>&copy; 2025 Pawfect Supplies</footer>
    </div>

    <!-- Script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>