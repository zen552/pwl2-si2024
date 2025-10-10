@extends('layouts.app')

@section('title', 'Data Kategori Produk')

@section('content')
    <a href="{{ route('categories.create') }}" class="btn btn-primary mb-3">Tambah Kategori</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Kategori</th>
                <th>Deskripsi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($categories as $category)
            <tr>
                <td>{{ $category->id }}</td>
                <td>{{ $category->product_category_name }}</td>
                <td>{{ $category->description }}</td>
                <td>
                    <a href="{{ route('categories.show', $category->id) }}" class="btn btn-info btn-sm">Lihat</a>
                    <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="text-center">Data Kategori Masih Kosong</td>
            </tr>
            @endforelse
        </tbody>
    </table>
@endsection