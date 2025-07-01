<?php
session_start();
include('../config.php');
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dharma Ayu Tani</title>

  <!-- Font Awesome dan Iconify -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <script src="https://code.iconify.design/1/1.0.7/iconify.min.js"></script>

  <!-- CSS Lokal -->
  <link rel="stylesheet" href="style.css?v=<?= time(); ?>">
</head>
<body>
        <header>
        <!-- Logo -->
        <div class="logo">
            <img src="img/LOGO_DHARMA_AYU_TANI.png" alt="Logo Bahar Tri Putera">
        </div>

        <!-- Nama Brand -->
        <div class="brand-name">
            <a href="#">Dharma Ayu Tani</a>
        </div>

        <!-- Navigasi Menu -->
        <nav>
            <ul>
                <li><a href="halaman_utama.php">Home</a></li>
                <li><a href="../katalog_produk/katalog.php">Product</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        </nav>

        <!-- Search Bar dan Ikon -->
        <div class="search-cart">
            <input type="text" placeholder="Search...">
            <button class="search-button">
                <span class="iconify" data-icon="mdi:search" data-inline="false"></span>
            </button>
            <button class="user-button">
                <a href="../e-commerce_login/login_user.php">
                    <span class="iconify" data-icon="mdi:user" data-inline="false"></span>
                </a>
            </button>
        </div>

        <!-- Keranjang Belanja -->
        <button class="basket-button">
            <a href="keranjang.php">
            <span class="iconify" data-icon="mdi:basket" data-inline="false"></span>
            </a>
        </button>
    </header>

     <!-- Welcome text -->
    <section class="welcome">
        <div class="overlay"></div>
        <div class="welcome-text">
            <h1>SELAMAT DATANG di DHARMA AYU TANI</h1>
            <p>“Solusi Tepat untuk Kebutuhan Pertanian Anda”</p>
            <p>Kami menyediakan berbagai pupuk organik dan An-organik berkualitas tinggi untuk mendukung produktivitas lahan Anda. Temukan kemudahan berbelanja alat dan bahan pertanian secara online, cepat, aman, dan terpercaya.</p>
        </div>
    </section>

     <!-- tentang Dharma Ayu Tani -->
    <section class="tentang-kami">
        <img src="img/tentangdat.png" alt="Tentang DAT">
        <h2>PT. DHARMA AYU TANI</h2>
        <h3>Perusahaan Agribisnis, Industri Pupuk & Perdagangan Umum</h3>
        <p>PT. Dharma Ayu Tani merupakan sebuah perusahaan terkemuka di Indonesia yang berfokus pada produksi pupuk organik dan an-organik. 
            Sejak didirikan pada tahun 2005, perusahaan kami telah berkomitmen untuk memenuhi kebutuhan pupuk nasional, baik di daerah perkotaan maupun pelosok-pelosok terpencil di Indonesia. 
            Kami berperan penting dalam mendukung kemajuan sektor pertanian di tanah air dengan menyediakan produk-produk berkualitas tinggi yang dapat meningkatkan hasil pertanian serta memperbaiki kualitas tanah.
            Sebagai perusahaan yang berlandaskan pada inovasi dan keberlanjutan, PT. Dharma Ayu Tani tidak hanya berfokus pada produksi pupuk semata, tetapi juga berusaha untuk beradaptasi dengan perkembangan teknologi pertanian dan perubahan iklim yang terjadi di Indonesia. Kami selalu berinovasi untuk menghasilkan produk pupuk yang lebih efektif dan efisien, yang dapat disesuaikan dengan berbagai kondisi lahan pertanian di seluruh wilayah Indonesia.</p>
        <h3>Visi & Misi</h3>
        <p>Visi kami adalah untuk menjadi perusahaan terdepan dalam menyediakan solusi pupuk yang ramah lingkungan dan dapat meningkatkan produktivitas pertanian. 
            Kami bertujuan untuk terus berinovasi dan menghasilkan produk pupuk yang mampu mendukung petani Indonesia dalam menciptakan pertanian yang lebih berkelanjutan dan produktif.
            Misi kami adalah menciptakan produk pupuk yang tidak hanya efektif dalam meningkatkan hasil pertanian, tetapi juga efisien dalam penggunaan sumber daya. 
            Kami berkomitmen untuk memastikan bahwa setiap produk yang kami hasilkan berkualitas tinggi dan dapat beradaptasi dengan perubahan iklim yang semakin dinamis di Indonesia. 
            Selain itu, kami berusaha untuk mendukung pemerataan distribusi pupuk ke seluruh penjuru negeri, baik di kota besar maupun di daerah terpencil, agar setiap petani di Indonesia dapat merasakan manfaatnya.
            Kami juga mengutamakan keberlanjutan dalam setiap aspek operasional kami, dari proses produksi yang ramah lingkungan hingga cara kami bekerja dengan para 
            petani untuk membantu mereka meningkatkan kesejahteraan melalui teknologi pertanian yang tepat guna. Dengan visi dan misi ini, PT. Dharma Ayu Tani berharap dapat memberikan kontribusi positif terhadap pembangunan pertanian yang berkelanjutan di Indonesia, serta menciptakan kemajuan yang dapat dirasakan oleh seluruh masyarakat.</p>
    </section>    

     <!-- Produk Paling Laris -->
    <section class="best-products">
        <h2>Rekomendasi Produk</h2>
        <div class="product-container">
            <div class="product">
                <img src="img/product1.jpg" alt="Product 1">
                <h3>Pupuk Organik</h3>
                <p>Solusi alami untuk meningkatkan kesuburan tanah Anda.</p>
                <button>Detail Produk</button>
            </div>

            <div class="product">
                <img src="img/product2.jpg" alt="Product 2">
                <h3>Mesin Pemupuk</h3>
                <p>Mesin pemupuk berkualitas untuk hasil pertanian yang lebih optimal.</p>
                <button>Detail Produk</button>
            </div>

            <div class="product">
                <img src="img/product3.jpg" alt="Product 3">
                <h3>Alat Penyiram Tanaman</h3>
                <p>Alat penyiram tanaman modern yang memudahkan pekerjaan Anda.</p>
                <button>Detail Produk</button>
            </div>
        </div>
    </section>

         <!-- kontak dan lokasi -->
    <footer>
        <footer>
    <div class="footer-content">
        <div class="footer-left">
            <h3>Kontak Kami</h3>
            <p>Untuk informasi lebih lanjut atau pertanyaan, hubungi kami:</p>
            <p>Alamat: Jl. Pertanian No. 10, Jakarta, Indonesia</p>
            <p>Telepon: +62 21 555 1234</p>
            <p>Email: <a href="mailto:info@bahartriputera.com">info@bahartriputera.com</a></p>
        </div>

        <div class="footer-right">
            <h3>Ikuti Kami</h3>
            <p>Terhubung dengan kami di media sosial untuk promo terbaru dan informasi produk:</p>
            <a href="https://www.instagram.com/pt.dharmaayutani" target="_blank">Instagram</a>
            <a href="https://www.facebook.com/bahartriputera" target="_blank">Facebook</a>
            <a href="https://www.twitter.com/bahartriputera" target="_blank">Twitter</a>
        </div>
    </div>
    </footer>
</body>
</html>
