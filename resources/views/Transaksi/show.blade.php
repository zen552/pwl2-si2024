@extends('layouts.app')
@section('judulHalaman', 'Detail Transaksi')

@section('content')
<div class="halaman-penuh">
    <div class="header-tambah">
        <div>
            <h1>Detail Transaksi</h1>
            <p>Informasi lengkap tentang transaksi <strong>#TRX-{{ $transaksi->id }}</strong>.</p>
        </div>
    </div>

    <div class="kartu-form detail-transaksi">
        {{-- Informasi Transaksi --}}
        <div class="info-transaksi">
            <h2>Informasi Transaksi</h2>
            <div class="info-item"><strong>ID Transaksi:</strong> <span>TRX-{{ $transaksi->id }}</span></div>
            <div class="info-item"><strong>Nama Kasir:</strong> <span>{{ $transaksi->nama_kasir }}</span></div>
            <div class="info-item"><strong>Email Pembeli:</strong> <span>{{ $transaksi->email_pembeli ?? '-' }}</span></div>
            <div class="info-item"><strong>Tanggal Transaksi:</strong> <span>{{ \Carbon\Carbon::parse($transaksi->tanggal_transaksi)->format('d M Y, H:i:s') }}</span></div>
        </div>

        {{-- Rincian Produk --}}
        <div class="rincian-produk">
            <h2>Rincian Produk</h2>
            <div class="tabel-container">
                <table>
                    <thead>
                        <tr>
                            <th>Produk</th>
                            <th>Jumlah</th>
                            <th>Harga Satuan</th>
                            <th>Subtotal</th>
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
                    <tfoot>
                        <tr>
                            <th colspan="3" class="text-end">Grand Total</th>
                            <th>Rp{{ number_format($grandTotal, 0, ',', '.') }}</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

        {{-- Tombol --}}
        <div class="tombol-aksi">
            <a href="{{ route('transaksi.index') }}" class="tombol tombol--utama">Kembali ke Daftar Transaksi</a>
        </div>
    </div>
</div>

<style>
.halaman-penuh {
    background-color: #FFF8E7;
    padding: 2.5rem 3rem;
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    align-items: center;
}

.header-tambah {
    text-align: center;
    margin-bottom: 2rem;
}
.header-tambah h1 {
    color: #8B5E3C;
    font-size: 2rem;
    font-weight: 700;
    margin-bottom: 0.3rem;
}
.header-tambah p {
    color: #9B7B5C;
    font-size: 0.95rem;
}

.kartu-form {
    background: #ffffff;
    border-radius: 20px;
    padding: 2rem 2.5rem;
    box-shadow: 0 10px 25px rgba(0,0,0,0.05);
    width: 100%;
    max-width: 950px;
}

.info-transaksi, .rincian-produk {
    margin-bottom: 2rem;
}
.info-transaksi h2, .rincian-produk h2 {
    color: #8B5E3C;
    font-size: 1.5rem;
    margin-bottom: 1rem;
}

.info-item {
    margin-bottom: 0.6rem;
}
.info-item strong {
    color: #8B5E3C;
    display: inline-block;
    width: 170px;
}
.info-item span {
    color: #555;
}

/* Tabel */
.tabel-container {
    overflow-x: auto;
}
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 1rem;
}
th, td {
    border: 1px solid #eee;
    padding: 0.8rem;
    text-align: left;
}
th {
    background-color: #FFF3D4;
    color: #8B5E3C;
    font-weight: 600;
}
tfoot th {
    background-color: #FDEDC1;
    text-align: right;
    font-size: 1.05rem;
}
td {
    color: #555;
}
td:nth-child(2),
td:nth-child(3),
td:nth-child(4) {
    text-align: right;
}

/* Tombol */
.tombol-aksi {
    text-align: center;
    margin-top: 2rem;
}
.tombol {
    display: inline-block;
    padding: 0.8rem 1.6rem;
    border-radius: 10px;
    font-weight: 600;
    text-decoration: none;
    cursor: pointer;
    transition: 0.2s ease;
}
.tombol--utama {
    background-color: #D4A017;
    color: white;
}
.tombol--utama:hover {
    background-color: #c4950f;
}

/* Responsif */
@media (max-width: 768px) {
    .info-item strong {
        width: auto;
        display: block;
        margin-bottom: 0.2rem;
    }
    table th, table td {
        font-size: 0.9rem;
    }
}
</style>
@endsection
