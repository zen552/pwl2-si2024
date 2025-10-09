@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <div class="">
                    <h3 class="text-center my-4">Transaction Data</h3>
                    <hr>
                </div>
                <div class="card border-0 shadow-5m rounded">
                    <div class="card-body">
                        <a href="{{route('transaksi.create')}}" class="btn btn-md btn-success mb-3">ADD  TRANSACTION</a>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">TGL. TRANSAKSI</th>
                                    <th scope="col">NAMA KASIR</th>
                                    <th scope="col">Total Harga</th>

                                    <th scope="col" style="width:20%">ACTIONS</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($trans as $t)
                                <tr>
                                    <td>{{ $t->transaksi_created}}</td>
                                    <td>{{ $t->nama_kasir }}</td>
                                    <td>{{ "Rp.".number_format($t->total_harga, 2,',','.')}}</td>
                                    <td class="text-center">
                                        <form onsubmit="return confirm('Apakah Anda Yakin?');" action="{{ route('transaksi.destroy', $t->id) }}" method="POST">
                                            <a href="{{ route('transaksi.show', $t->id) }}" class="btn btn-sn btn-dark">SHOW</a>
                                            <a href="{{ route('transaksi.edit', $t->id) }}" class="btn btn-sn btn-primary">EDIT</a>
                                            @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-sm btn-danger btn-delete" data-nama="{{ $product->title }}">
                                            HAPUS
                                        </button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center">
                                        <div class="alert alert-danger">Data Transaksi Belum Tersedia.</div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                            
                        </table>
                        {{$trans->links()}}
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
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
            let namaProduk = this.getAttribute('data-nama');

            Swal.fire({
                title: 'Apakah Anda yakin akan menghapus ' + namaProduk + '?',
                text: "Data produk akan dihapus permanen!",
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