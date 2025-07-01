<?php
session_start();
include('../config.php');

// Langkah 1: Pengecekan Wajib Login
// Jika user belum login, alihkan ke halaman login.
if (!isset($_SESSION['user_id'])) {
    // Simpan tujuan halaman agar setelah login bisa kembali ke checkout
    $_SESSION['redirect_url'] = $_SERVER['REQUEST_URI'];
    header('Location: ../e-commerce_login/login_user.php');
    exit;
}

// Validasi parameter produk dari URL
if (!isset($_GET['product_id']) || !isset($_GET['quantity']) || !is_numeric($_GET['product_id']) || !is_numeric($_GET['quantity'])) {
    die("Error: Informasi produk tidak valid.");
}

$product_id = intval($_GET['product_id']);
$quantity = intval($_GET['quantity']);
$user_id = $_SESSION['user_id']; // Ambil user_id dari session

if ($quantity <= 0) {
    die("Error: Jumlah pembelian minimal 1.");
}

// Ambil detail produk dari database
$stmt = $conn->prepare("SELECT name, price, stock, image FROM products WHERE product_id = ?");
$stmt->bind_param("i", $product_id);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows === 0) {
    die("Error: Produk tidak ditemukan.");
}
$product = $result->fetch_assoc();

// Cek ketersediaan stok
if ($product['stock'] < $quantity) {
    die("Maaf, stok produk tidak mencukupi. Stok tersedia: " . $product['stock']);
}

$total_amount = $product['price'] * $quantity;

// Proses form saat disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Status awal diatur ke 'Menunggu Pembayaran' sesuai ENUM di database
    $status = 'Menunggu Pembayaran';

    $conn->begin_transaction();
    try {
        // 1. Simpan ke tabel 'transactions'
        $stmt_trans = $conn->prepare("INSERT INTO transactions (user_id, total_amount, status) VALUES (?, ?, ?)");
        $stmt_trans->bind_param("ids", $user_id, $total_amount, $status);
        $stmt_trans->execute();
        $transaction_id = $conn->insert_id; // Dapatkan ID transaksi baru

        // 2. Kurangi stok produk
        $new_stock = $product['stock'] - $quantity;
        $stmt_stock = $conn->prepare("UPDATE products SET stock = ? WHERE product_id = ?");
        $stmt_stock->bind_param("ii", $new_stock, $product_id);
        $stmt_stock->execute();
        
        // CATATAN PENTING:
        // Di sini seharusnya ada penyimpanan ke tabel detail transaksi.
        // Karena tabelnya tidak ada, kita akan simpan detail produk di session
        // sebagai solusi sementara untuk ditampilkan di halaman sukses.
        $_SESSION['last_order_details'] = [
            'product_name' => $product['name'],
            'product_image' => $product['image'],
            'quantity' => $quantity,
            'total_amount' => $total_amount
        ];

        // Jika semua berhasil, commit
        $conn->commit();

        // Arahkan ke halaman sukses
        header("Location: order_success.php?transaction_id=" . $transaction_id);
        exit();

    } catch (mysqli_sql_exception $exception) {
        $conn->rollback();
        die("Terjadi kesalahan saat memproses pesanan: " . $exception->getMessage());
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - Dharma Ayu Tani</title>
    <link rel="stylesheet" href="style_checkout.css?v=<?= time(); ?>">
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


<main class="checkout-container">
    <h1>Checkout</h1>
    <form action="" method="POST" class="checkout-form">
        <div class="form-section">
            <h2>Ringkasan Pesanan</h2>
            <div class="order-summary">
                <div class="summary-item">
                    <img src="../halaman_admin/uploads/<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>" class="summary-image">
                    <div class="summary-details">
                        <p class="summary-name"><?= htmlspecialchars($product['name']) ?></p>
                        <p class="summary-quantity">Jumlah: <?= htmlspecialchars($quantity) ?></p>
                    </div>
                    <p class="summary-price">Rp <?= number_format($total_amount, 2, ',', '.') ?></p>
                </div>
            </div>
            <div class="total">
                <strong>Total Pembayaran:</strong>
                <strong>Rp <?= number_format($total_amount, 2, ',', '.') ?></strong>
            </div>
        </div>

        <div class="form-section">
            <h2>Informasi Pengiriman</h2>
            <div class="info-box">
                <p>⚠️ <strong>Catatan:</strong> Pesanan akan dikirim ke alamat yang terdaftar pada akun Anda. Pastikan alamat di profil Anda sudah benar.</p>
            </div>
             <div class="form-group">
                <label for="customer_name">Nama Penerima</label>
                <input type="text" id="customer_name" name="customer_name" required>
            </div>
            <div class="form-group">
                <label for="customer_address">Alamat Pengiriman</label>
                <textarea id="customer_address" name="customer_address" rows="4" required></textarea>
            </div>
        </div>
        
        <button type="submit" class="btn-checkout">Konfirmasi dan Bayar</button>
    </form>
</main>

<footer>
    ...
</footer>

</body>
</html>