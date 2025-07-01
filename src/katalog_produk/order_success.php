<?php
session_start();
include('../config.php');

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: ../e-commerce_login/login_user.php');
    exit;
}

// Validate transaction ID
if (!isset($_GET['transaction_id']) || !is_numeric($_GET['transaction_id'])) {
    die("Error: ID transaksi tidak valid.");
}

$transaction_id = intval($_GET['transaction_id']);
$user_id = $_SESSION['user_id'];

// Get transaction details
$stmt = $conn->prepare("SELECT * FROM transactions WHERE transaction_id = ? AND user_id = ?");
$stmt->bind_param("ii", $transaction_id, $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Error: Transaksi tidak ditemukan.");
}

$transaction = $result->fetch_assoc();
$order_details = isset($_SESSION['last_order_details']) ? $_SESSION['last_order_details'] : null;
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan Berhasil - Dharma Ayu Tani</title>
    <link rel="stylesheet" href="style_success.css?v=<?= time(); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://code.iconify.design/1/1.0.7/iconify.min.js"></script>
</head>
<body>

<header>
    <div class="logo">
        <img src="img/LOGO_DHARMA_AYU_TANI.png" alt="Logo Dharma Ayu Tani">
    </div>
    <div class="brand-name"><a href="#">Dharma Ayu Tani</a></div>
    <nav>
        <ul>
            <li><a href="../halaman_utama/halaman_utama.php">Home</a></li>
            <li><a href="katalog.php">Product</a></li>
            <li><a href="#">Contact</a></li>
        </ul>
    </nav>
    <div class="search-cart">
        <input type="text" placeholder="Search...">
        <button class="search-button"><span class="iconify" data-icon="mdi:search"></span></button>
        <button class="user-button"><a href="../e-commerce_login/login_user.php"><span class="iconify" data-icon="mdi:user"></span></a></button>
    </div>
    <button class="basket-button"><a href="../halaman_utama/keranjang.php"><span class="iconify" data-icon="mdi:basket"></span></a></button>
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
                <span class="value">#<?= htmlspecialchars($transaction['transaction_id']) ?></span>
            </div>
            <div class="detail-item">
                <span class="label">Tanggal Pesanan:</span>
                <span class="value"><?= date('d F Y, H:i', strtotime($transaction['transaction_date'])) ?></span>
            </div>
            <div class="detail-item">
                <span class="label">Total Pembayaran:</span>
                <span class="value">Rp <?= number_format($transaction['total_amount'], 2, ',', '.') ?></span>
            </div>
            <div class="detail-item">
                <span class="label">Status:</span>
                <span class="value status-pending"><?= htmlspecialchars($transaction['status']) ?></span>
            </div>
            
            <?php if ($order_details): ?>
            <div class="product-summary">
                <h3>Produk yang Dipesan</h3>
                <div class="product-item">
                    <img src="../halaman_admin/uploads/<?= htmlspecialchars($order_details['product_image']) ?>" alt="<?= htmlspecialchars($order_details['product_name']) ?>">
                    <div class="product-info">
                        <p class="product-name"><?= htmlspecialchars($order_details['product_name']) ?></p>
                        <p class="product-quantity">Jumlah: <?= htmlspecialchars($order_details['quantity']) ?></p>
                    </div>
                </div>
            </div>
            <?php endif; ?>
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
            <a href="katalog.php" class="btn btn-secondary">Lanjut Belanja</a>
            <a href="../halaman_utama/halaman_utama.php" class="btn btn-primary">Kembali ke Beranda</a>
        </div>
    </div>
</main>

<footer>
    <div class="footer-content">
        <div class="footer-left">
            <h3>Kontak Kami</h3>
            <p>Alamat: Jl. Pertanian No. 10, Jakarta, Indonesia</p>
            <p>Telepon: +62 21 555 1234</p>
            <p>Email: <a href="mailto:info@dharmaayutani.com">info@dharmaayutani.com</a></p>
        </div>
        <div class="footer-right">
            <h3>Ikuti Kami</h3>
            <a href="https://www.instagram.com/pt.dharmaayutani" target="_blank">Instagram</a>
            <a href="https://www.facebook.com/dharmaayutani" target="_blank">Facebook</a>
            <a href="https://www.twitter.com/dharmaayutani" target="_blank">Twitter</a>
        </div>
    </div>
</footer>

</body>
</html>

<?php
// Clear the order details from session after displaying
if (isset($_SESSION['last_order_details'])) {
    unset($_SESSION['last_order_details']);
}
?>