@extends('layouts.app')

@section('title', 'Pesanan Berhasil - Dharma Ayu Tani')

@push('styles')
<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
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
}

nav {
    flex-grow: 1;
    display: flex;
    justify-content: center;
}

nav ul {
    display: flex;
    list-style-type: none;
    font-size: 18px;
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
    max-width: 300px;
    margin-left: 20px;
}

.search-cart input {
    width: 100%;
    padding: 8px;
    font-size: 14px;
    border-radius: 20px;
    border: 1px solid #ddd;
}

.search-button, .user-button, .basket-button {
    background-color: transparent;
    border: none;
    cursor: pointer;
    font-size: 20px;
    margin: 0 5px;
}

.user-button a, .basket-button a {
    color: white;
}

.success-container {
    max-width: 800px;
    margin: 40px auto;
    padding: 20px;
    background-color: white;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.success-content {
    text-align: center;
}

.success-icon {
    font-size: 80px;
    color: #28a745;
    margin-bottom: 20px;
}

.success-content h1 {
    color: #28a745;
    font-size: 2.5rem;
    margin-bottom: 10px;
}

.success-message {
    font-size: 1.2rem;
    color: #666;
    margin-bottom: 30px;
}

.order-details {
    background-color: #f8f9fa;
    padding: 20px;
    border-radius: 8px;
    margin: 30px 0;
    text-align: left;
}

.order-details h2 {
    color: #333;
    margin-bottom: 20px;
    text-align: center;
}

.detail-item {
    display: flex;
    justify-content: space-between;
    padding: 10px 0;
    border-bottom: 1px solid #e0e0e0;
}

.detail-item:last-child {
    border-bottom: none;
}

.label {
    font-weight: bold;
    color: #555;
}

.value {
    color: #333;
}

.status-pending {
    color: #ffc107;
    font-weight: bold;
}

.product-summary {
    margin-top: 20px;
    padding-top: 20px;
    border-top: 2px solid #e0e0e0;
}

.product-summary h3 {
    margin-bottom: 15px;
    color: #333;
}

.product-item {
    display: flex;
    align-items: center;
    gap: 15px;
    padding: 10px;
    background-color: white;
    border-radius: 8px;
}

.product-item img {
    width: 80px;
    height: 80px;
    object-fit: cover;
    border-radius: 5px;
}

.product-info {
    flex-grow: 1;
}

.product-name {
    font-weight: bold;
    margin-bottom: 5px;
}

.product-quantity {
    color: #666;
}

.next-steps {
    background-color: #e7f3ff;
    padding: 20px;
    border-radius: 8px;
    margin: 30px 0;
    text-align: left;
}

.next-steps h3 {
    color: #0066cc;
    margin-bottom: 15px;
}

.next-steps ul {
    list-style-type: none;
    padding-left: 0;
}

.next-steps li {
    padding: 5px 0;
    position: relative;
    padding-left: 25px;
}

.next-steps li:before {
    content: "✓";
    position: absolute;
    left: 0;
    color: #28a745;
    font-weight: bold;
}

.action-buttons {
    display: flex;
    gap: 20px;
    justify-content: center;
    margin-top: 30px;
}

.btn {
    padding: 12px 30px;
    border-radius: 5px;
    text-decoration: none;
    font-weight: bold;
    transition: background-color 0.3s;
}

.btn-primary {
    background-color: #4CAF50;
    color: white;
}

.btn-primary:hover {
    background-color: #45a049;
}

.btn-secondary {
    background-color: #6c757d;
    color: white;
}

.btn-secondary:hover {
    background-color: #5a6268;
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

@media (max-width: 768px) {
    .success-container {
        margin: 20px;
        padding: 15px;
    }
    
    .action-buttons {
        flex-direction: column;
        align-items: center;
    }
    
    .btn {
        width: 200px;
        text-align: center;
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

<main class="success-container">
    <div class="success-content">
        <div class="success-icon">
            <i class="fas fa-check-circle"></i>
        </div>
        
        <h1>Pesanan Berhasil!</h1>
        <p class="success-message">Terima kasih atas pesanan Anda. Pesanan Anda sedang diproses.</p>
        
        <div class="order-details">
            <h2>Detail Pesanan</h2>
            <div class="detail-item">
                <span class="label">ID Transaksi:</span>
                <span class="value">#{{ $transaction->transaction_id }}</span>
            </div>
            <div class="detail-item">
                <span class="label">Tanggal Pesanan:</span>
                <span class="value">{{ $transaction->created_at->format('d F Y, H:i') }}</span>
            </div>
            <div class="detail-item">
                <span class="label">Total Pembayaran:</span>
                <span class="value">Rp {{ number_format($transaction->total_amount, 0, ',', '.') }}</span>
            </div>
            <div class="detail-item">
                <span class="label">Status:</span>
                <span class="value status-pending">{{ $transaction->status }}</span>
            </div>
            
            @if($orderDetails)
            <div class="product-summary">
                <h3>Produk yang Dipesan</h3>
                <div class="product-item">
                    <img src="{{ asset('uploads/' . $orderDetails['product_image']) }}" alt="{{ $orderDetails['product_name'] }}">
                    <div class="product-info">
                        <p class="product-name">{{ $orderDetails['product_name'] }}</p>
                        <p class="product-quantity">Jumlah: {{ $orderDetails['quantity'] }}</p>
                    </div>
                </div>
            </div>
            @endif
        </div>
        
        <div class="next-steps">
            <h3>Langkah Selanjutnya</h3>
            <ul>
                <li>Kami akan mengirimkan konfirmasi pesanan ke email Anda</li>
                <li>Tim kami akan memproses pesanan dalam 1-2 hari kerja</li>
                <li>Anda akan menerima informasi pengiriman setelah pesanan diproses</li>
            </ul>
        </div>
        
        <div class="action-buttons">
            <a href="{{ route('products.index') }}" class="btn btn-secondary">Lanjut Belanja</a>
            <a href="{{ route('home') }}" class="btn btn-primary">Kembali ke Beranda</a>
        </div>
    </div>
</main>
@endsection