@extends('layouts.app')

@section('content')
<h2>Tambah Kategori Produk Baru</h2>

<form action="{{ route('categories.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="product_category_name" class="form-label">Nama Kategori</label>
        <input type="text" name="product_category_name" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Deskripsi</label>
        <textarea name="description" class="form-control" rows="3"></textarea>
    </div>
    <button type="submit" class="btn btn-success">Simpan</button>
    <a href="{{ route('categories.index') }}" class="btn btn-secondary">Batal</a>
</form>
@endsection