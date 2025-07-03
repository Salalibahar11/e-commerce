@extends('layouts.admin')

@section('title', 'Detail Produk')

@section('content')
<div class="container">
    <h2>Detail Produk</h2>

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

    <form action="{{ route('admin.products.update', $product->product_id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <label for="name">Nama Produk</label>
        <input type="text" name="name" id="name" value="{{ $product->name }}" required><br>
        
        <label for="description">Deskripsi</label>
        <textarea name="description" id="description" required>{{ $product->description }}</textarea><br>
        
        <label for="price">Harga</label>
        <input type="number" name="price" step="0.01" value="{{ $product->price }}" required><br>

        <label for="stock">Stok</label>
        <input type="number" name="stock" value="{{ $product->stock }}" required><br>

        <label for="category">Kategori</label>
        <input type="text" name="category" value="{{ $product->category }}" required><br>

        <label for="image">Gambar Produk</label>
        <input type="file" name="image"><br>
        
        @if($product->image)
            <p>Gambar saat ini:</p>
            <img src="{{ asset('uploads/' . $product->image) }}" alt="{{ $product->name }}" width="200">
        @endif

        <div class="button_edit">
            <button type="submit" class="btn btn-primary">Update Produk</button>
        </div>
    </form>

    <!-- Tombol Hapus Produk -->
    <form action="{{ route('admin.products.delete', $product->product_id) }}" method="post" style="margin-top: 20px;">
        @csrf
        @method('DELETE')
        <div class="button_delete">
            <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?');">Hapus Produk</button>
        </div>
    </form>
</div>
@endsection