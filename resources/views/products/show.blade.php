@extends('layouts.app')

@section('title', $product->name . ' - Detail Produk')

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

/* Layout adjustments */
.product-detail {
    display: flex;
    justify-content: center;
    padding: 20px;
}

.detail-container {
    display: flex;
    justify-content: space-between;
    width: 80%;
    border: 2px solid #ddd;
    padding: 20px;
    background-color: #fff;
    border-radius: 10px;
}

.product-image img {
    width: 100%;
    max-width: 300px;
    border-radius: 10px;
}

.product-info {
    flex: 1;
    margin-left: 20px;
}

.product-info h2 {
    font-size: 24px;
    margin-bottom: 10px;
}

.product-info p {
    font-size: 16px;
    color: #333;
}

.product-info .price {
    font-size: 22px;
    color: #4CAF50;
    font-weight: bold;
    margin-top: 10px;
}

/* Quantity input field */
.quantity {
    margin-top: 15px;
    margin-bottom: 20px;
}

.quantity input {
    padding: 8px;
    border-radius: 5px;
    border: 1px solid #ddd;
    width: 50px;
    text-align: center;
}

/* Button container */
.btn-container {
    display: flex;
    gap: 15px;
    margin-top: 20px;
}

.btn-detail {
    background-color: #4CAF50;
    color: white;
    padding: 12px 30px;
    border-radius: 5px;
    font-size: 16px;
    text-decoration: none;
    text-align: center;
    display: inline-block;
    transition: background-color 0.3s ease;
    border: none;
    cursor: pointer;
}

.btn-detail:hover {
    background-color: #45a049;
}

.btn-actions {
    border-top: 2px solid #ddd;
    padding-top: 15px;
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
<!-- HEADER -->
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
            <span class="iconify" data-icon="mdi:search"></span>
        </button>
        <button class="user-button">
            <a href="{{ route('login') }}">
                <span class="iconify" data-icon="mdi:user"></span>
            </a>
        </button>
    </div>
    <button class="basket-button">
        <a href="{{ route('cart.index') }}">
            <span class="iconify" data-icon="mdi:basket"></span>
        </a>
    </button>
</header>

<!-- KONTEN DETAIL PRODUK -->
<section class="product-detail">
    <div class="detail-container">
        <div class="product-image">
            <img src="{{ asset('uploads/' . $product->image) }}" alt="{{ $product->name }}" class="detail-image">
        </div>
        <div class="product-info">
            <h2>{{ $product->name }}</h2>
            <p><strong>Kategori:</strong> {{ $product->category }}</p>
            <p><strong>Deskripsi:</strong> {{ $product->description }}</p>
            <p class="price">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
            
            <!-- Display Stock (stok) -->
            <p><strong>Stok:</strong> {{ $product->stock }} pcs</p>

            <!-- Quantity Selection -->
            <form action="{{ route('checkout') }}" method="GET" id="checkout-form">
                <input type="hidden" name="product_id" value="{{ $product->product_id }}">
                <div class="quantity">
                    <label for="quantity">Jumlah:</label>
                    <input type="number" id="quantity" name="quantity" value="1" min="1" max="{{ $product->stock }}">
                </div>

                <!-- Buttons Container with Border -->
                <div class="btn-actions">
                    <div class="btn-container">
                        <button type="submit" class="btn-detail">Beli Sekarang</button>
                        <button type="button" class="btn-detail" onclick="addToCart()">Tambah ke Keranjang</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

<script>
function addToCart() {
    const quantity = document.getElementById('quantity').value;
    const productId = {{ $product->product_id }};
    
    // Create form for adding to cart
    const form = document.createElement('form');
    form.method = 'POST';
    form.action = '{{ route("cart.add") }}';
    
    // Add CSRF token
    const csrfToken = document.createElement('input');
    csrfToken.type = 'hidden';
    csrfToken.name = '_token';
    csrfToken.value = '{{ csrf_token() }}';
    form.appendChild(csrfToken);
    
    // Add product ID
    const productIdInput = document.createElement('input');
    productIdInput.type = 'hidden';
    productIdInput.name = 'product_id';
    productIdInput.value = productId;
    form.appendChild(productIdInput);
    
    // Add quantity
    const quantityInput = document.createElement('input');
    quantityInput.type = 'hidden';
    quantityInput.name = 'quantity';
    quantityInput.value = quantity;
    form.appendChild(quantityInput);
    
    document.body.appendChild(form);
    form.submit();
}
</script>
@endsection