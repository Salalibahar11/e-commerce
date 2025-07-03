@extends('layouts.admin')

@section('title', 'Tambah Produk - Admin Panel')

@section('content')
<div class="container">
    <h2>Tambah Produk</h2>
    
    @if(session('success'))
        <div class="alert-message success-message">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert-message">
            @foreach($errors->all() as $error)
                {{ $error }}<br>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data" class="form-product">
        @csrf
        <label for="name">Nama Produk *</label>
        <input type="text" name="name" id="name" value="{{ old('name') }}" required>
        
        <label for="description">Deskripsi *</label>
        <textarea name="description" id="description" required>{{ old('description') }}</textarea>
        
        <label for="price">Harga (Rp) *</label>
        <input type="number" name="price" id="price" step="0.01" min="0" value="{{ old('price') }}" required>
        
        <label for="stock">Stok *</label>
        <input type="number" name="stock" id="stock" min="0" value="{{ old('stock') }}" required>
        
        <label for="category">Kategori *</label>
        <input type="text" name="category" id="category" value="{{ old('category') }}" required>
        
        <label for="image">Gambar Produk *</label>
        <input type="file" name="image" id="image" accept="image/*" required>
        <small>Format yang didukung: JPG, JPEG, PNG, GIF. Maksimal 5MB.</small>

        <button type="submit">Tambah Produk</button>
    </form>
</div>
@endsection