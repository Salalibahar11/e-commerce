<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dharma Ayu Tani')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://code.iconify.design/1/1.0.7/iconify.min.js"></script>
    @stack('styles')
</head>
<body>
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
        </div>
        <button class="basket-button">
            <a href="{{ route('cart.index') }}">
                <span class="iconify" data-icon="mdi:basket" data-inline="false"></span>
            </a>
        </button>
    </header>

    @yield('content')

    <footer>
        <div class="footer-content">
            <div class="footer-left">
                <h3>Kontak Kami</h3>
                <p>Untuk informasi lebih lanjut atau pertanyaan, hubungi kami:</p>
                <p>Alamat: Jl. Pertanian No. 10, Jakarta, Indonesia</p>
                <p>Telepon: +62 21 555 1234</p>
                <p>Email: <a href="mailto:info@dharmaayutani.com">info@dharmaayutani.com</a></p>
            </div>
            <div class="footer-right">
                <h3>Ikuti Kami</h3>
                <p>Terhubung dengan kami di media sosial untuk promo terbaru dan informasi produk:</p>
                <a href="https://www.instagram.com/pt.dharmaayutani" target="_blank">Instagram</a>
                <a href="https://www.facebook.com/dharmaayutani" target="_blank">Facebook</a>
                <a href="https://www.twitter.com/dharmaayutani" target="_blank">Twitter</a>
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>