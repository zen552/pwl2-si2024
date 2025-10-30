<!DOCTYPE html> 
<html lang="id"> 
<head> 
    <meta charset="UTF-8"> 
    <title>Detail Transaksi</title> 
    <style> 
    body { 
        font-family: "Segoe UI", Arial, sans-serif; 
        background-color: #f9f6f1; 
        margin: 0; 
        padding: 0; 
        color: #444; 
        } 
    .container { 
        background-color: #ffffff; 
        max-width: 700px; 
        margin: 2rem auto; 
        padding: 2rem; 
        border-radius: 15px; 
        box-shadow: 0 4px 20px rgba(0,0,0,0.05); 
    } 
    h1 { 
        color: #8B5E3C; 
        text-align: center; 
        margin-bottom: 1rem; 
    } 
    .info-transaksi { 
        margin-bottom: 2rem; 
        border-bottom: 1px solid #f0e6d2; 
        padding-bottom: 1rem; 
        } 
    .info-item { 
        margin-bottom: 0.6rem; 
    } 
    .info-item strong { 
        display: inline-block; 
        width: 180px; 
        color: #8B5E3C; 
        } 
    .table-produk { 
        width: 100%; 
        border-collapse: collapse; 
        margin-top: 1rem; 
    } 
    .table-produk th, 
    .table-produk td { 
        border: 1px solid #f0e6d2; 
        padding: 10px; 
        text-align: left; 
    } 
    .table-produk th { 
        background-color: #FFF8E7; 
        color: #8B5E3C; 
    } 
    .total { 
        text-align: right; 
        font-size: 1.1rem; 
        margin-top: 1rem; 
        font-weight: bold; 
        color: #8B5E3C; 
    } 
    .footer { 
        text-align: center; 
        margin-top: 2rem; 
        font-size: 0.9rem; 
        color: #777; 
    } 
    .highlight { 
        color: #D2691E; 
        font-weight: bold; 
    } 
    </style> 
</head> 
<body> 
    <div class="container"> 
        <h1>Detail Transaksi</h1>
        <div class="info-transaksi">
            <div class="info-item"><strong>ID Transaksi:</strong> {{ $transaksi->id }}</div>
            <div class="info-item"><strong>Tanggal Transaksi:</strong> {{ $transaksi->created_at->format('d M Y, H:i') }}</div>
            <div class="info-item"><strong>Email Pembeli:</strong> {{ $transaksi->email_pembeli ?? '-' }}</div>
            <div class="info-item"><strong>Nama Kasir:</strong> {{ $transaksi->nama_kasir ?? '-' }}</div>
        </div>

        <table class="table-produk">
            <thead>
                <tr>
                    <th>Nama Produk</th>
                    <th>Jumlah</th>
                    <th>Harga Satuan</th>
                    <th>Total Harga</th>
                    </tr>
            </thead>
            <tbody>
                @php $grandTotal = 0; @endphp
                @foreach ($transaksi->details as $detail)
                    @php
                        $subtotal = $detail->product->price * $detail->jumlah_pembelian;
                        $grandTotal += $subtotal;
                    @endphp
                    <tr>
                        <td>{{ $detail->product->title }}</td>
                        <td>{{ $detail->jumlah_pembelian }}</td>
                        <td>Rp{{ number_format($detail->product->price, 0, ',', '.') }}</td>
                        <td>Rp{{ number_format($subtotal, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="total">
            Total Harga: <span class="highlight">Rp {{ number_format($total_harga['transaksi'], 0, ',', '.') }}</span>
        </div>

        <div class="footer">
            Terima kasih telah bertransaksi di toko kami!<br>
            Email ini dikirim secara otomatis, mohon tidak membalas langsung.
        </div>
    </div>
</body>
</html>