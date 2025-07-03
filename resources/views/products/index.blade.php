@extends('layouts.app')

@section('title', 'Katalog Produk - Dharma Ayu Tani')

@push('styles')
<style>
/* Reset CSS */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body, head {
    font-family: Arial, sans-serif;
    background-color: #f7f7f7;
    line-height: 1.6;
}

header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    height: 80px;
    background-color: #4CAF50;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    padding: 0 20px;
    position: sticky;
    top: 0;
    z-index: 1000;
}

header .logo img {
    height: 60px;
    margin: 15px;
}

.brand-name a {
    font-size: 24px;
    font-weight: bold;
    color: white;
    text-decoration: none;
    letter-spacing: 1px;
    font-family: Arial Black, sans-serif;
    margin-right: auto;
}

nav {
    flex-grow: 1;
    display: flex;
    justify-content: center;
}

nav ul {
    display: flex;
    list-style-type: none;
    font-size: 25px;
    text-align: center;
    margin: 0;
}

nav ul li {
    margin: 0 15px;
}

nav ul li a {
    text-decoration: none;
    color: white;
    font-weight: bold;
}

.search-cart {
    display: flex;
    align-items: center;
    background-color: white;
    padding: 5px 10px;
    border-radius: 20px;
    width: 100%;
    max-width: 400px;
    margin-left: 20px;
    position: relative;
}

.search-cart input {
    width: 100%;
    padding: 10px;
    padding-right: 40px;
    font-size: 16px;
    border-radius: 20px;
    border: 1px solid #ddd;
}

.search-button {
    position: absolute;
    right: 48px;
    top: 28px;
    transform: translateY(-50%);
    border: none;
    background: transparent;
    font-size: 25px;
    color: #000;
    cursor: pointer;
}

.user-button {
    background-color: transparent;
    border: none;
    cursor: pointer;
    font-size: 25px;
}

.basket-button {
    background-color: transparent;
    border: none;
    cursor: pointer;
    font-size: 25px;
    margin: 10px;
}

/* Kategori Produk */
.product-category-inline {
    margin-left: 15px;
}

.product-category-inline .category-dropdown {
    padding: 8px 12px;
    font-size: 14px;
    border-radius: 5px;
    border: 1px solid #ccc;
}

/* Katalog Produk */
.product-catalog {
    padding: 40px;
    text-align: center;
}

.product-catalog h2 {
    font-size: 32px;
    margin-bottom: 20px;
    color: #4CAF50;
}

.product-grid {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 20px;
}

.product-item {
    background-color: white;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    padding: 20px;
    text-align: center;
    width: 250px;
    margin: 10px;
}

.product-item img {
    max-width: 100%;
    height: 200px;
    object-fit: cover;
    border-radius: 10px;
}

.product-item h3 {
    font-size: 20px;
    margin: 15px 0;
    color: #333;
}

.product-item p {
    font-size: 14px;
    color: #555;
}

.product-item .price {
    font-size: 18px;
    font-weight: bold;
    color: #4CAF50;
    margin: 15px 0;
}

.product-item .btn-detail {
    background-color: #4CAF50;
    color: white;
    padding: 10px 20px;
    text-decoration: none;
    border-radius: 5px;
    transition: background-color 0.3s;
}

.product-item .btn-detail:hover {
    background-color: #45a049;
}

footer {
    background-color: #45a049;
    padding: 20px 10px;
    text-align: center;
    margin-top: 50px;
}

footer .footer-content {
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap;
    margin-bottom: 30px;
}

footer .footer-content .footer-left,
footer .footer-content .footer-right {
    width: 45%;
}

footer .footer-left h3,
footer .footer-right h3 {
    font-size: 1.5rem;
    color: white;
    margin-bottom: 10px;
}

footer .footer-left p,
footer .footer-right p {
    font-size: 1rem;
    color: white;
}

footer .footer-right a {
    text-decoration: none;
    color: white;
    font-size: 1rem;
    display: block;
    margin-top: 10px;
}

footer .footer-right a:hover {
    color: #365e39;
}

@media (max-width: 768px) {
    footer .footer-content {
        flex-direction: column;
        align-items: center;
    }

    footer .footer-left, footer .footer-right {
        width: 100%;
        text-align: center;
    }
}
</style>
@endpush

@section('content')
<!-- Header -->
<header>
    <div class="logo">
        <img src="{{ asset('images/LOGO_DHARMA_AYU_TANI.png') }}" alt="Logo Dharma Ayu Tani">
    </div>
    <div class="brand-name">
        <a href="{{ route('home') }}">Dharma Ayu Tani</a>
    </div>
    <nav>
        <ul>
            <li><a href="{{ route('home') }}">Home</a></li>
            <li><a href="{{ route('products.index') }}">Product</a></li>
            <li><a href="#">Contact</a></li>
        </ul>
    </nav>

    <!-- Dropdown Kategori Dinamis -->
    <div class="product-category-inline">
        <form method="GET" action="{{ route('products.index') }}">
            <select name="category" class="category-dropdown" onchange="this.form.submit()">
                <option value="all">Semua Produk</option>
                @foreach($categories as $category)
                    <option value="{{ $category }}" {{ $selectedCategory == $category ? 'selected' : '' }}>
                        {{ ucfirst($category) }}
                    </option>
                @endforeach
            </select>
        </form>
    </div>

    <!-- Search dan User -->
    <div class="search-cart">
        <input type="text" placeholder="Search...">
        <button class="search-button">
            <span class="iconify" data-icon="mdi:search" data-inline="false"></span>
        </button>
        <button class="user-button">
            <a href="{{ route('login') }}">
                <span class="iconify" data-icon="mdi:user" data-inline="false"></span>
            </a>
        </button>
    </div>

    <!-- Keranjang -->
    <button class="basket-button">
        <a href="{{ route('cart.index') }}">
            <span class="iconify" data-icon="mdi:basket" data-inline="false"></span>
        </a>
    </button>
</header>

<!-- Katalog Produk -->
<section class="product-catalog">
    <h2>Katalog Produk</h2>
    <div class="product-grid">
        @forelse($products as $product)
            <div class="product-item {{ $product->category }}">
                <img src="{{ asset('uploads/' . $product->image) }}" alt="{{ $product->name }}">
                <h3>{{ $product->name }}</h3>
                <p>{{ $product->category }}</p>
                <p>{{ Str::limit($product->description, 100) }}</p>
                <p class="stock">Stok: {{ $product->stock }} pcs</p>
                <p class="price">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                <a href="{{ route('products.show', $product->product_id) }}" class="btn-detail">Detail Produk</a>
            </div>
        @empty
            <p>Tidak ada produk yang tersedia untuk kategori ini.</p>
        @endforelse
    </div>
</section>
@endsection