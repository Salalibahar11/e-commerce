<?php
session_start();
include('../config.php');

// Validasi parameter ID
if (!isset($_GET['product_id']) || empty($_GET['product_id'])) {
    echo "ID tidak ditemukan di URL.";
    exit;
}

$id = intval($_GET['product_id']);
$stmt = $conn->prepare("SELECT * FROM products WHERE product_id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "Produk tidak ditemukan.";
    exit;
}

$product = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($product['name']) ?> - Detail Produk</title>
    <link rel="stylesheet" href="style_detail.css?v=<?= time(); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://code.iconify.design/1/1.0.7/iconify.min.js"></script>
</head>
<body>

<!-- HEADER -->
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
    <div class="search-cart">
        <input type="text" placeholder="Search...">
        <button class="search-button">
            <span class="iconify" data-icon="mdi:search"></span>
        </button>
        <button class="user-button">
            <a href="../e-commerce_login/login_user.php">
                <span class="iconify" data-icon="mdi:user"></span>
            </a>
        </button>
    </div>
    <button class="basket-button">
        <a href="../halaman_utama/keranjang.php">
            <span class="iconify" data-icon="mdi:basket"></span>
        </a>
    </button>
</header>

<!-- KONTEN DETAIL PRODUK -->
<section class="product-detail">
    <div class="detail-container">
        <div class="product-image">
            <img src="../halaman_admin/uploads/<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>" class="detail-image">
        </div>
        <div class="product-info">
            <h2><?= htmlspecialchars($product['name']) ?></h2>
            <p><strong>Kategori:</strong> <?= htmlspecialchars($product['category']) ?></p>
            <p><strong>Deskripsi:</strong> <?= htmlspecialchars($product['description']) ?></p>
            <p class="price">Rp <?= number_format($product['price'], 0, ',', '.') ?></p>
            
             <!-- Display Stock (stok) -->
            <p><strong>Stok:</strong> <?= isset($product['stock']) ? htmlspecialchars($product['stock']) . ' pcs' : 'Tidak tersedia' ?></p>

            <!-- Quantity Selection -->
            <div class="quantity">
                <label for="quantity">Jumlah:</label>
                <input type="number" id="quantity" name="quantity" value="1" min="1">
            </div>

            <!-- Buttons Container with Border -->
                <div class="btn-actions">
                <div class="btn-container">
                    <button id="buy-now-btn" class="btn-detail">Beli Sekarang</button>
                    <a href="#" class="btn-detail">Tambah ke Keranjang</a>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
document.getElementById('buy-now-btn').addEventListener('click', function() {
    // Ambil product_id dari URL halaman saat ini
    const urlParams = new URLSearchParams(window.location.search);
    const productId = urlParams.get('product_id');
    
    // Ambil jumlah yang diinput oleh user
    const quantity = document.getElementById('quantity').value;
    
    // Validasi dasar
    if (quantity < 1) {
        alert('Jumlah minimal adalah 1.');
        return;
    }
    
    // Arahkan ke halaman checkout dengan membawa product_id dan quantity
    window.location.href = `checkout.php?product_id=${productId}&quantity=${quantity}`;
});
</script>

<footer>
    ... (sisa kode Anda) ...
        </div>
    </div>
</section>

<!-- FOOTER -->
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
