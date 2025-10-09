@extends('layouts.app')

@section('content')
<h2>Edit Supplier</h2>

<form action="{{ route('suppliers.update', $supplier->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label class="form-label">Nama Supplier</label>
        <input type="text" name="nama_supplier" class="form-control" value="{{ $supplier->nama_supplier }}" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Alamat</label>
        <input type="text" name="alamat" class="form-control" value="{{ $supplier->alamat }}" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Telepon</label>
        <input type="text" name="telepon" class="form-control" value="{{ $supplier->telepon }}" required>
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
    <a href="{{ route('suppliers.index') }}" class="btn btn-secondary">Kembali</a>
</form>
@endsection
