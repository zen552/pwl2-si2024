<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Supplier</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600&family=Nunito+Sans:wght@400;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --warna-utama: #B57F50;
            --warna-sekunder: #A2B38B;
            --warna-aksen: #D4AF37;
            --warna-latar: #FFF8E7;
            --teks-gelap: #333;
            --font-utama: 'Nunito Sans', sans-serif;
            --font-judul: 'Poppins', sans-serif;
            --bayangan: 0 4px 24px rgba(181, 127, 80, 0.08);
            --transisi: all 0.3s ease;
        }

        body {
            font-family: var(--font-utama);
            background: var(--warna-latar);
            color: var(--teks-gelap);
            display: flex;
            justify-content: center;
            align-items: flex-start;
            min-height: 100vh;
            padding-top: 3rem;
        }

        .kartu {
            background: #fff;
            padding: 2rem 3rem;
            border-radius: 16px;
            box-shadow: var(--bayangan);
            width: 480px;
        }

        h2 {
            font-family: var(--font-judul);
            color: var(--warna-utama);
            text-align: center;
            margin-bottom: 2rem;
        }

        label {
            font-weight: 600;
        }

        input {
            width: 100%;
            padding: 0.6rem 1rem;
            border: 1px solid #ccc;
            border-radius: 8px;
            margin-top: 0.3rem;
            margin-bottom: 1.2rem;
            transition: var(--transisi);
        }

        input:focus {
            border-color: var(--warna-aksen);
            outline: none;
            box-shadow: 0 0 5px rgba(212,175,55,0.3);
        }

        .tombol {
            display: inline-block;
            padding: 0.7rem 1.4rem;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            border: none;
            cursor: pointer;
            transition: var(--transisi);
        }

        .tombol--utama {
            background: var(--warna-aksen);
            color: white;
            margin-right: 0.5rem;
        }

        .tombol--utama:hover {
            background: #c9a63b;
        }

        .tombol--sekunder {
            background: #f3f3f3;
            color: var(--teks-gelap);
        }

        .tombol--sekunder:hover {
            background: #e2e2e2;
        }
    </style>
</head>
<body>
    <div class="kartu">
        <h2>Tambah Supplier</h2>
        <form action="{{ route('suppliers.store') }}" method="POST">
            @csrf
            <label>Nama Supplier:</label><br>
            <input type="text" name="supplier_name" required><br>

            <label>PIC Supplier:</label><br>
            <input type="text" name="pic_supplier" required><br>

            <label>No. Telepon:</label><br>
            <input type="text" name="phone" required><br>
            <button type="submit" class="tombol tombol--utama">Simpan</button>
            <a href="{{ route('suppliers.index') }}" class="tombol tombol--sekunder">Kembali</a>
        </form>
    </div>
</body>
</html>
