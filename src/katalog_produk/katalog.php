<?php
session_start();
include('../config.php');

// Ambil daftar kategori unik dari database
$categoryQuery = "SELECT DISTINCT category FROM products";
$categoryResult = $conn->query($categoryQuery);

// Ambil kategori yang dipilih dari URL (GET)
$selectedCategory = isset($_GET['category']) ? $_GET['category'] : 'all';

// Ambil produk berdasarkan kategori
if ($selectedCategory != 'all') {
    $stmt = $conn->prepare("SELECT * FROM products WHERE category = ?");
    $stmt->bind_param("s", $selectedCategory);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    $result = $conn->query("SELECT * FROM products");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Produk - Dharma Ayu Tani</title>
    <link rel="stylesheet" href="style_katalog.css?v=<?= time(); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://code.iconify.design/1/1.0.7/iconify.min.js"></script>
</head>
<body>
    <!-- Header -->
    <header>
        <div class="logo">
            <img src="img/LOGO_DHARMA_AYU_TANI.png" alt="Logo Dharma Ayu Tani">
        </div>
        <div class="brand-name">
            <a href="#">Dharma Ayu Tani</a>
        </div>
        <nav>
            <ul>
                <li><a href="../halaman_utama/halaman_utama.php">Home</a></li>
                <li><a href="katalog.php">Product</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        </nav>

        <!-- Dropdown Kategori Dinamis -->
        <div class="product-category-inline">
            <form method="GET" action="">
                <select name="category" class="category-dropdown" onchange="this.form.submit()">
                    <option value="all">Semua Produk</option>
                    <?php while ($cat = $categoryResult->fetch_assoc()) { ?>
                        <option value="<?= $cat['category'] ?>" 
                            <?= ($selectedCategory == $cat['category']) ? 'selected' : '' ?>>
                            <?= ucfirst($cat['category']) ?>
                        </option>
                    <?php } ?>
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
                <a href="../e-commerce_login/login_user.php">
                    <span class="iconify" data-icon="mdi:user" data-inline="false"></span>
                </a>
            </button>
        </div>

        <!-- Keranjang -->
        <button class="basket-button">
            <a href="../halaman_utama/keranjang.php">
                <span class="iconify" data-icon="mdi:basket" data-inline="false"></span>
            </a>
        </button>
    </header>

    <!-- Katalog Produk -->
    <section class="product-catalog">
        <h2>Katalog Produk</h2>
        <div class="product-grid">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    ?>
                    <div class="product-item <?= htmlspecialchars($row['category']) ?>">
                        <img src="../halaman_admin/uploads/<?= htmlspecialchars($row['image']) ?>" alt="<?= htmlspecialchars($row['name']) ?>">
                        <h3><?= htmlspecialchars($row['name']) ?></h3>
                        <p><?= htmlspecialchars($row['category']) ?></p>
                        <p><?= htmlspecialchars($row['description']) ?></p>
                        <p class="stock">Stok: <?= htmlspecialchars($row['stock']) ?> pcs</p>
                        <p class="price">Rp <?= number_format($row['price'], 0, ',', '.') ?></p>
                        <a href="detail_produk.php?product_id=<?= $row['product_id'] ?>" class="btn-detail">Detail Produk</a>
                    </div>
                    <?php
                }
            } else {
                echo "<p>Tidak ada produk yang tersedia untuk kategori ini.</p>";
            }
            ?>
        </div>
    </section>

    <!-- Footer -->
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
