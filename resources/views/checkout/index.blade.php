@extends('layouts.app')

@section('title', 'Checkout - Dharma Ayu Tani')

@push('styles')
<style>
body {
    font-family: 'Poppins', sans-serif;
    margin: 0;
    background-color: #f4f4f4;
    color: #333;
}

header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px 50px;
    background-color: #4CAF50;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.logo img { 
    height: 50px; 
}

.brand-name a {
    text-decoration: none;
    font-size: 1.5em;
    font-weight: 700;
    color: white;
}

nav ul {
    list-style: none;
    margin: 0;
    padding: 0;
    display: flex;
    gap: 20px;
}

nav a {
    text-decoration: none;
    color: white;
    font-weight: 600;
}

.search-cart, .basket-button { 
    display: flex; 
    align-items: center; 
    gap: 10px; 
}

.search-cart input { 
    border: 1px solid #ddd; 
    padding: 8px; 
    border-radius: 5px; 
}

.search-button, .user-button, .basket-button {
    background: none;
    border: none;
    cursor: pointer;
    font-size: 1.5em;
    color: white;
}

.user-button a, .basket-button a { 
    color: inherit; 
}

.checkout-container {
    max-width: 800px;
    margin: 40px auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}

.checkout-container h1 {
    text-align: center;
    color: #2c5e2d;
    margin-bottom: 30px;
}

.checkout-form {
    display: flex;
    flex-direction: column;
    gap: 30px;
}

.form-section {
    border: 1px solid #e0e0e0;
    padding: 20px;
    border-radius: 8px;
}

.form-section h2 {
    margin-top: 0;
    border-bottom: 2px solid #2c5e2d;
    padding-bottom: 10px;
    margin-bottom: 20px;
    color: #333;
}

.order-summary .summary-item {
    display: flex;
    align-items: center;
    gap: 15px;
    margin-bottom: 15px;
}

.summary-image {
    width: 80px;
    height: 80px;
    object-fit: cover;
    border-radius: 5px;
}

.summary-details { 
    flex-grow: 1; 
}

.summary-name { 
    font-weight: 600; 
    margin: 0; 
}

.summary-quantity { 
    color: #666; 
    margin: 5px 0 0; 
}

.summary-price { 
    font-weight: 600; 
    font-size: 1.1em; 
}

.total {
    display: flex;
    justify-content: space-between;
    font-size: 1.2em;
    padding-top: 15px;
    border-top: 1px solid #ddd;
    margin-top: 10px;
}

.form-group {
    margin-bottom: 15px;
}

.form-group label {
    display: block;
    margin-bottom: 5px;
    font-weight: 600;
}

.form-group input,
.form-group textarea {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}

.info-box {
    background-color: #fff3cd;
    border: 1px solid #ffeaa7;
    border-radius: 5px;
    padding: 15px;
    margin-bottom: 20px;
}

.info-box p {
    margin: 0;
    color: #856404;
}

.btn-checkout {
    width: 100%;
    padding: 15px;
    background-color: #28a745;
    color: white;
    border: none;
    border-radius: 5px;
    font-size: 1.2em;
    font-weight: 600;
    cursor: pointer;
    transition: background-color 0.3s;
}

.btn-checkout:hover {
    background-color: #218838;
}

footer {
    background-color: #4CAF50;
    color: white;
    padding: 20px 50px;
    margin-top: 50px;
}

.footer-content { 
    display: flex; 
    justify-content: space-between; 
}

.footer-left, .footer-right { 
    width: 45%; 
}

.footer-right a { 
    color: white; 
    margin-right: 10px; 
    text-decoration: none;
}

.footer-right a:hover {
    text-decoration: underline;
}

@media (max-width: 768px) {
    header {
        padding: 10px 20px;
        flex-wrap: wrap;
    }
    
    .checkout-container {
        margin: 20px;
        padding: 15px;
    }
    
    .footer-content {
        flex-direction: column;
        gap: 20px;
    }
    
    .footer-left, .footer-right {
        width: 100%;
    }
}
</style>
@endpush

@section('content')
<header>
    <div class="logo">
        <img src="{{ asset('images/LOGO_DHARMA_AYU_TANI.png') }}" alt="Logo Dharma Ayu Tani">
    </div>
    <div class="brand-name"><a href="{{ route('home') }}">Dharma Ayu Tani</a></div>
    <nav>
        <ul>
            <li><a href="{{ route('home') }}">Home</a></li>
            <li><a href="{{ route('products.index') }}">Product</a></li>
            <li><a href="#">Contact</a></li>
        </ul>
    </nav>
    <div class="search-cart">
        <input type="text" placeholder="Search...">
        <button class="search-button"><span class="iconify" data-icon="mdi:search"></span></button>
        <button class="user-button"><a href="{{ route('login') }}"><span class="iconify" data-icon="mdi:user"></span></a></button>
    </div>
    <button class="basket-button"><a href="{{ route('cart.index') }}"><span class="iconify" data-icon="mdi:basket"></span></a></button>
</header>

<main class="checkout-container">
    <h1>Checkout</h1>
    
    @if($errors->any())
        <div style="background-color: #f8d7da; color: #721c24; padding: 10px; border-radius: 5px; margin-bottom: 20px;">
            @foreach($errors->all() as $error)
                {{ $error }}<br>
            @endforeach
        </div>
    @endif
    
    <form action="{{ route('checkout.process') }}" method="POST" class="checkout-form">
        @csrf
        <input type="hidden" name="product_id" value="{{ $product->product_id }}">
        <input type="hidden" name="quantity" value="{{ $quantity }}">
        
        <div class="form-section">
            <h2>Ringkasan Pesanan</h2>
            <div class="order-summary">
                <div class="summary-item">
                    <img src="{{ asset('uploads/' . $product->image) }}" alt="{{ $product->name }}" class="summary-image">
                    <div class="summary-details">
                        <p class="summary-name">{{ $product->name }}</p>
                        <p class="summary-quantity">Jumlah: {{ $quantity }}</p>
                    </div>
                    <p class="summary-price">Rp {{ number_format($totalAmount, 0, ',', '.') }}</p>
                </div>
            </div>
            <div class="total">
                <strong>Total Pembayaran:</strong>
                <strong>Rp {{ number_format($totalAmount, 0, ',', '.') }}</strong>
            </div>
        </div>

        <div class="form-section">
            <h2>Informasi Pengiriman</h2>
            <div class="info-box">
                <p>⚠️ <strong>Catatan:</strong> Pesanan akan dikirim ke alamat yang Anda masukkan di bawah ini.</p>
            </div>
            <div class="form-group">
                <label for="customer_name">Nama Penerima</label>
                <input type="text" id="customer_name" name="customer_name" value="{{ old('customer_name') }}" required>
            </div>
            <div class="form-group">
                <label for="customer_address">Alamat Pengiriman</label>
                <textarea id="customer_address" name="customer_address" rows="4" required>{{ old('customer_address') }}</textarea>
            </div>
        </div>
        
        <button type="submit" class="btn-checkout">Konfirmasi dan Bayar</button>
    </form>
</main>
@endsection