@extends('layouts.app')

@section('content')
<h2>Detail Kategori Produk</h2>

<div class="card">
    <div class="card-body">
        <h5 class="card-title"><strong>ID Kategori:</strong> {{ $category->id }}</h5>
        <p class="card-text"><strong>Nama Kategori:</strong> {{ $category->product_category_name }}</p>
        <p class="card-text"><strong>Deskripsi:</strong> {{ $category->description ?? 'Tidak ada deskripsi' }}</p>
        <p class="card-text"><small class="text-muted">Dibuat pada: {{ $category->created_at->format('d M Y') }}</small></p>
    </div>
</div>

<a href="{{ route('categories.index') }}" class="btn btn-secondary mt-3">Kembali ke Daftar</a>
@endsection