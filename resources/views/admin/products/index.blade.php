@extends('layouts.admin')

@section('title', 'Daftar Produk - Admin Panel')

@section('content')
<div class="container">
    <h2>Daftar Produk</h2>

    @if(session('success'))
        <div class="alert-message success-message">
            {{ session('success') }}
        </div>
    @endif

    <table>
        <thead>
            <tr>
                <th>Nama Produk</th>
                <th>Deskripsi</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Kategori</th>
                <th>Gambar</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($products as $product)
            <tr>
                <td>{{ $product->name }}</td>
                <td>{{ Str::limit($product->description, 50) }}</td>
                <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                <td>{{ $product->stock }}</td>
                <td>{{ $product->category }}</td>
                <td>
                    @if($product->image)
                        <img src="{{ asset('uploads/' . $product->image) }}" alt="{{ $product->name }}" width="100">
                    @else
                        <span>Gambar tidak tersedia</span>
                    @endif
                </td>
                <td>
                    <a href="{{ route('admin.products.show', $product->product_id) }}" class="btn button-info">
                        <i class="fas fa-search"></i>
                    </a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7">Tidak ada produk yang tersedia.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection