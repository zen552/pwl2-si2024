@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Daftar Transaksi</h1>
        <a href="{{ route('transaksi.create') }}" class="btn btn-primary">Buat Transaksi Baru</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <table class="table table-bordered table-striped">
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
                            <td>TRX-{{ $transaksi->id }}</td>
                            <td>{{ $transaksi->nama_kasir }}</td>
                            <td>{{ $transaksi->email_pembeli ?? '-' }}</td>
                            <td>{{ \Carbon\Carbon::parse($transaksi->tanggal_transaksi)->format('d M Y, H:i') }}</td>
                            <td>{{ $transaksi->details->count() }}</td>
                            <td>
                                <a href="{{ route('transaksi.show', $transaksi->id) }}" class="btn btn-info btn-sm">Lihat</a>
                                <a href="{{ route('transaksi.edit', $transaksi->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('transaksi.destroy', $transaksi->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus transaksi ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger btn-delete" data-nama="{{ $transaksi->id }}">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">Tidak ada data transaksi.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            {{ $transaksis->links() }}
        </div>
    </div>
@endsection

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
            let namaTransaksi = this.getAttribute('data-nama');

            Swal.fire({
                title: 'Apakah Anda yakin akan menghapus TRX-' + namaTransaksi + '?',
                text: "Data Transaksi akan dihapus permanen!",
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