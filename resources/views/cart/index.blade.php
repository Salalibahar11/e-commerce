@extends('layouts.app')

@section('title', 'Keranjang Belanja')

@push('styles')
<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
}

header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    height: 80px;
    background-color: #4CAF50;
    padding: 0 20px;
}

header .logo img {
    height: 50px;
}

header .brand-name a {
    font-size: 24px;
    font-weight: bold;
    color: white;
    text-decoration: none;
}

nav ul {
    display: flex;
    list-style: none;
}

nav ul li {
    margin: 0 15px;
}

nav ul li a {
    color: white;
    text-decoration: none;
    font-weight: bold;
}

.search-cart {
    display: flex;
    align-items: center;
}

.search-cart input {
    padding: 5px;
    border-radius: 20px;
    border: none;
    margin-right: 10px;
}

.cart {
    padding: 50px 20px;
    background-color: #fff;
}

.cart-container {
    max-width: 1200px;
    margin: 0 auto;
}

.cart-items {
    display: flex;
    flex-direction: column;
}

.cart-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color: #f9f9f9;
    margin: 15px 0;
    padding: 15px;
    border-radius: 10px;
}

.cart-item img {
    width: 100px;
    height: 100px;
    object-fit: cover;
    border-radius: 8px;
}

.cart-item-details {
    flex-grow: 1;
    padding-left: 20px;
}

.cart-item-details h3 {
    margin-bottom: 10px;
}

.quantity input {
    width: 50px;
    padding: 5px;
    margin: 0 10px;
    text-align: center;
}

.remove-item-button {
    background-color: transparent;
    border: none;
    cursor: pointer;
    font-size: 20px;
    color: red;
}

.cart-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-top: 20px;
    border-top: 2px solid #ddd;
    margin-top: 20px;
}

.cart-footer .total {
    font-size: 1.5rem;
    font-weight: bold;
}

button {
    padding: 12px 30px;
    background-color: #4CAF50;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    margin-left: 10px;
}

button:hover {
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
        <button class="basket-button">
            <span class="iconify" data-icon="mdi:basket" data-inline="false"></span>
        </button>
    </div>
</header>

<!-- Keranjang Belanja -->
<section class="cart">
    <div class="cart-container">
        <h2>Keranjang Belanja</h2>
        
        @if(session('success'))
            <div style="background-color: #d4edda; color: #155724; padding: 10px; border-radius: 5px; margin-bottom: 20px;">
                {{ session('success') }}
            </div>
        @endif
        
        <!-- Daftar Produk di Keranjang -->
        <div class="cart-items">
            @forelse($cart as $index => $item)
                <div class='cart-item'>
                    <img src="{{ asset('uploads/' . $item['image']) }}" alt="{{ $item['name'] }}" class='cart-item-image'>
                    <div class='cart-item-details'>
                        <h3>{{ $item['name'] }}</h3>
                        <div class='quantity'>
                            <span>Jumlah: {{ $item['quantity'] }}</span>
                        </div>
                        <p class='item-price'>Rp {{ number_format($item['price'], 0, ',', '.') }}</p>
                        <p class='item-total'>Total: Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</p>
                    </div>
                    <form method='POST' action="{{ route('cart.remove', $index) }}">
                        @csrf
                        @method('DELETE')
                        <button type='submit' class='remove-item-button' onclick="return confirm('Hapus item ini dari keranjang?')">
                            <span class='iconify' data-icon='mdi:trash-can' data-inline='false'></span>
                        </button>
                    </form>
                </div>
            @empty
                <div style="text-align: center; padding: 50px;">
                    <p>Keranjang belanja Anda kosong.</p>
                    <a href="{{ route('products.index') }}" style="color: #4CAF50; text-decoration: none;">Mulai Berbelanja</a>
                </div>
            @endforelse
        </div>

        @if(count($cart) > 0)
        <!-- Total dan Checkout -->
        <div class="cart-footer">
            <div class="total">
                <h3>Total: Rp {{ number_format($totalPrice, 0, ',', '.') }}</h3>
            </div>
            <div>
                <a href="{{ route('products.index') }}">
                    <button class="continue-shopping">Kembali Berbelanja</button>
                </a>
                <button class="checkout">Selesaikan Pesanan</button>
            </div>
        </div>
        @endif
    </div>
</section>
@endsection