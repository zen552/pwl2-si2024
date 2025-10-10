@extends('layouts.app')

@section('content')
<h2>Edit Kategori Produk</h2>

<form action="{{ route('categories.update', $category->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="form-group mb-3">
        <label class="font-weight-bold">Nama Kategori</label>
        <input type="text" class="form-control @error('product_category_name') is-invalid @enderror"
            name="product_category_name" value="{{ old('product_category_name', $category->product_category_name) }}" placeholder="Masukkan Nama Kategori">
        @error('product_category_name')
        <div class="alert alert-danger mt-2">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group mb-3">
        <label class="font-weight-bold">Deskripsi</label>
        <textarea class="form-control @error('description') is-invalid @enderror" name="description" rows="5" placeholder="Masukkan Deskripsi">{{ old('description', $category->description) }}</textarea>
        @error('description')
        <div class="alert alert-danger mt-2">{{ $message }}</div>
        @enderror
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
    <a href="{{ route('categories.index') }}" class="btn btn-secondary">Kembali</a>
</form>
@endsection