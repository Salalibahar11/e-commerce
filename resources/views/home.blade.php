@extends('layouts.app')

@section('title', 'Dharma Ayu Tani - Beranda')

@push('styles')
<style>
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

.welcome {
    background-image: url('{{ asset('images/pertanian.jpg') }}');
    background-size: cover;
    background-position: center;
    padding: 300px 10px;
    text-align: center;
    min-height: 90vh;
    position: relative;
}

.overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.2);
    z-index: 0;
}

.welcome-text {
    max-width: 80%;
    padding: 20px;
    position: relative;
    z-index: 1;
}

.welcome-text h1 {
    color: white;
    font-size: 36px;
    margin-bottom: 10px;
    text-align: left;
}

.welcome-text p {
    color: white;
    text-align: justify;
    font-size: 18px;
    margin-bottom: 10px;
    text-align: left;
    padding-right: 40%;
}

.tentang-kami {
    padding: 50px 30px;
    background-color: #F7F7F7;
    text-align: center;
}

.tentang-kami h2 {
    font-size: 2rem;
    color: #2e4a26;
    margin-bottom: 10px;
}

.tentang-kami h3 {
    font-size: 1.5rem;
    color: #2e4a26;
}

.tentang-kami p {
    margin: 15px;
    font-size: 1.1rem;
    color: #555;
}

.best-products {
    padding: 50px 30px;
    background-color: #F7F7F7;
    text-align: center;
}

.best-products h2 {
    font-size: 2.5rem;
    color: #2e4a26;
    margin-bottom: 30px;
}

.product-container {
    display: flex;
    justify-content: space-around;
    gap: 30px;
}

.product {
    background-color: #f9f9f9;
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 20px;
    width: 300px;
    text-align: center;
    transition: transform 0.3s ease-in-out;
}

.product:hover {
    transform: scale(1.05);
}

.product img {
    width: 100%;
    height: auto;
    border-radius: 8px;
}

.product h3 {
    margin-top: 20px;
    font-size: 1.5rem;
    color: #2e4a26;
}

.product p {
    margin: 10px 0;
    font-size: 1rem;
    color: #555;
}

.product button {
    background-color: #2e4a26;
    color: white;
    border: none;
    padding: 10px 20px;
    cursor: pointer;
    font-size: 1rem;
    border-radius: 5px;
    transition: background-color 0.3s ease;
}

.product button:hover {
    background-color: #365e39;
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
<section class="welcome">
    <div class="overlay"></div>
    <div class="welcome-text">
        <h1>SELAMAT DATANG di DHARMA AYU TANI</h1>
        <p>"Solusi Tepat untuk Kebutuhan Pertanian Anda"</p>
        <p>Kami menyediakan berbagai pupuk organik dan An-organik berkualitas tinggi untuk mendukung produktivitas lahan Anda. Temukan kemudahan berbelanja alat dan bahan pertanian secara online, cepat, aman, dan terpercaya.</p>
    </div>
</section>

<section class="tentang-kami">
    <img src="{{ asset('images/tentangdat.png') }}" alt="Tentang DAT">
    <h2>PT. DHARMA AYU TANI</h2>
    <h3>Perusahaan Agribisnis, Industri Pupuk & Perdagangan Umum</h3>
    <p>PT. Dharma Ayu Tani merupakan sebuah perusahaan terkemuka di Indonesia yang berfokus pada produksi pupuk organik dan an-organik. 
        Sejak didirikan pada tahun 2005, perusahaan kami telah berkomitmen untuk memenuhi kebutuhan pupuk nasional, baik di daerah perkotaan maupun pelosok-pelosok terpencil di Indonesia. 
        Kami berperan penting dalam mendukung kemajuan sektor pertanian di tanah air dengan menyediakan produk-produk berkualitas tinggi yang dapat meningkatkan hasil pertanian serta memperbaiki kualitas tanah.</p>
    <h3>Visi & Misi</h3>
    <p>Visi kami adalah untuk menjadi perusahaan terdepan dalam menyediakan solusi pupuk yang ramah lingkungan dan dapat meningkatkan produktivitas pertanian. 
        Misi kami adalah menciptakan produk pupuk yang tidak hanya efektif dalam meningkatkan hasil pertanian, tetapi juga efisien dalam penggunaan sumber daya.</p>
</section>

<section class="best-products">
    <h2>Rekomendasi Produk</h2>
    <div class="product-container">
        @forelse($featuredProducts as $product)
        <div class="product">
            <img src="{{ asset('uploads/' . $product->image) }}" alt="{{ $product->name }}">
            <h3>{{ $product->name }}</h3>
            <p>{{ Str::limit($product->description, 100) }}</p>
            <a href="{{ route('products.show', $product->product_id) }}">
                <button>Detail Produk</button>
            </a>
        </div>
        @empty
        <div class="product">
            <img src="{{ asset('images/product1.jpg') }}" alt="Product 1">
            <h3>Pupuk Organik</h3>
            <p>Solusi alami untuk meningkatkan kesuburan tanah Anda.</p>
            <button>Detail Produk</button>
        </div>
        <div class="product">
            <img src="{{ asset('images/product2.jpg') }}" alt="Product 2">
            <h3>Mesin Pemupuk</h3>
            <p>Mesin pemupuk berkualitas untuk hasil pertanian yang lebih optimal.</p>
            <button>Detail Produk</button>
        </div>
        <div class="product">
            <img src="{{ asset('images/product3.jpg') }}" alt="Product 3">
            <h3>Alat Penyiram Tanaman</h3>
            <p>Alat penyiram tanaman modern yang memudahkan pekerjaan Anda.</p>
            <button>Detail Produk</button>
        </div>
        @endforelse
    </div>
</section>
@endsection