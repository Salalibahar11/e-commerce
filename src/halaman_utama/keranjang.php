<?php
session_start();
include('../config.php');

// Simulasi keranjang
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Menambah produk ke keranjang
if (isset($_POST['add_to_cart'])) {
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];

    // Ambil produk dari database
    $stmt = $conn->prepare("SELECT * FROM products WHERE product_id = ?");
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
        $product['quantity'] = $quantity;
        $_SESSION['cart'][] = $product;
    }
}

// Menghitung total harga
$total_price = 0;
foreach ($_SESSION['cart'] as $item) {
    $total_price += $item['price'] * $item['quantity'];
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja</title>
    <link rel="stylesheet" href="style_keranjang.css">
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
            <li><a href="halaman_utama.php">Home</a></li>
            <li><a href="../katalog_produk/katalog.php">Product</a></li>
            <li><a href="#">Contact</a></li>
        </ul>
    </nav>
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
        <button class="basket-button">
            <span class="iconify" data-icon="mdi:basket" data-inline="false"></span>
        </button>
    </div>
</header>

<!-- Keranjang Belanja -->
<section class="cart">
    <div class="cart-container">
        <h2>Keranjang Belanja</h2>
        
        <!-- Daftar Produk di Keranjang -->
        <div class="cart-items">
            <?php
            foreach ($_SESSION['cart'] as $item) {
                $total_item_price = $item['price'] * $item['quantity'];
                echo "<div class='cart-item'>
                        <img src='img/{$item['name']}.jpg' alt='{$item['name']}' class='cart-item-image'>
                        <div class='cart-item-details'>
                            <h3>{$item['name']}</h3>
                            <p>Ukuran: {$item['size']}</p>
                            <div class='quantity'>
                                <input type='number' value='{$item['quantity']}' min='1'>
                            </div>
                            <p class='item-price'>Rp " . number_format($item['price'], 0, ',', '.') . "</p>
                        </div>
                        <form method='POST'>
                            <input type='hidden' name='remove_id' value='{$item['product_id']}'>
                            <button type='submit' name='remove_from_cart' class='remove-item-button'>
                                <span class='iconify' data-icon='mdi:trash-can' data-inline='false'></span>
                            </button>
                        </form>
                    </div>";
            }
            ?>
        </div>

        <!-- Total dan Checkout -->
        <div class="cart-footer">
            <div class="total">
                <h3>Total: Rp <?= number_format($total_price, 0, ',', '.') ?></h3>
            </div>
            <button class="continue-shopping">Kembali Berbelanja</button>
            <button class="checkout">Selesaikan Pesanan</button>
        </div>
    </div>
</section>

<!-- Footer -->
<footer>
    <div class="footer-content">
        <div class="footer-left">
            <h3>Kontak Kami</h3>
            <p>Alamat: Jl. Pertanian No. 10, Jakarta, Indonesia</p>
            <p>Telepon: +62 21 555 1234</p>
            <p>Email: <a href="mailto:info@bahartriputera.com">info@bahartriputera.com</a></p>
        </div>
        <div class="footer-right">
            <h3>Ikuti Kami</h3>
            <a href="https://www.instagram.com/pt.dharmaayutani" target="_blank">Instagram</a>
            <a href="https://www.facebook.com/bahartriputera" target="_blank">Facebook</a>
            <a href="https://www.twitter.com/bahartriputera" target="_blank">Twitter</a>
        </div>
    </div>
</footer>

</body>
</html>

<?php
// Fungsi untuk menghapus produk dari keranjang
if (isset($_POST['remove_from_cart'])) {
    $remove_id = $_POST['remove_id'];
    foreach ($_SESSION['cart'] as $key => $item) {
        if ($item['product_id'] == $remove_id) {
            unset($_SESSION['cart'][$key]);
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
        }
    }
}
?>
