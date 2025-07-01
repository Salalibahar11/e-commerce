<?php
include('auth_check.php');
check_admin_auth();
include('../config.php');

$message = '';

// Handle product addition
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_product'])) {
    $name = sanitize_input($_POST['name']);
    $description = sanitize_input($_POST['description']);
    $price = floatval($_POST['price']);
    $stock = intval($_POST['stock']);
    $category = sanitize_input($_POST['category']);

    // Validation
    if (empty($name) || empty($description) || $price <= 0 || $stock < 0 || empty($category)) {
        $message = "Semua field harus diisi dengan benar!";
    } else {
        // Handle image upload
        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            $image = $_FILES['image']['name'];
            $target_dir = __DIR__ . "/uploads/";
            
            // Create uploads directory if it doesn't exist
            if (!file_exists($target_dir)) {
                mkdir($target_dir, 0777, true);
            }
            
            $target_file = $target_dir . basename($image);
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            // Check if file is an image
            $check = getimagesize($_FILES['image']['tmp_name']);
            if ($check === false) {
                $message = "File yang diupload bukan gambar.";
            } elseif (!in_array($imageFileType, ['jpg', 'jpeg', 'png', 'gif'])) {
                $message = "Hanya file JPG, JPEG, PNG & GIF yang diperbolehkan.";
            } elseif ($_FILES['image']['size'] > 5000000) { // 5MB limit
                $message = "Ukuran file terlalu besar. Maksimal 5MB.";
            } else {
                // Generate unique filename to prevent conflicts
                $unique_name = time() . '_' . $image;
                $target_file = $target_dir . $unique_name;
                
                if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
                    // Insert product into database
                    $stmt = $conn->prepare("INSERT INTO products (name, description, price, stock, category, image) VALUES (?, ?, ?, ?, ?, ?)");
                    $stmt->bind_param("ssdiss", $name, $description, $price, $stock, $category, $unique_name);

                    if ($stmt->execute()) {
                        $message = "Produk berhasil ditambahkan!";
                    } else {
                        $message = "Error: " . $stmt->error;
                    }
                    $stmt->close();
                } else {
                    $message = "Terjadi kesalahan saat mengupload file.";
                }
            }
        } else {
            $message = "Gambar produk harus diupload.";
        }
    }
}

$admin_info = get_admin_info();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk - Admin Panel</title>
    <link rel="stylesheet" href="styles_admin.css?v=<?= time(); ?>">
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <h2>Admin Panel</h2>
        <div class="admin-info">
            <p>Welcome, <?= htmlspecialchars($admin_info['username']) ?></p>
        </div>
        <ul>
            <li><a href="tambah_produk.php" class="active">Tambah Produk</a></li>
            <li><a href="data-transaksi.php">Data Transaksi</a></li>
            <li><a href="laporan_penjualan.php">Laporan Penjualan</a></li>
            <li><a href="produk.php">Produk</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="content">
        <div class="container">
            <h2>Tambah Produk</h2>
            
            <?php if (!empty($message)): ?>
                <div class="alert-message <?= strpos($message, 'berhasil') !== false ? 'success-message' : '' ?>">
                    <?= htmlspecialchars($message) ?>
                </div>
            <?php endif; ?>

            <form method="POST" enctype="multipart/form-data" class="form-product">
                <label for="name">Nama Produk *</label>
                <input type="text" name="name" id="name" required>
                
                <label for="description">Deskripsi *</label>
                <textarea name="description" id="description" required></textarea>
                
                <label for="price">Harga (Rp) *</label>
                <input type="number" name="price" id="price" step="0.01" min="0" required>
                
                <label for="stock">Stok *</label>
                <input type="number" name="stock" id="stock" min="0" required>
                
                <label for="category">Kategori *</label>
                <input type="text" name="category" id="category" required>
                
                <label for="image">Gambar Produk *</label>
                <input type="file" name="image" id="image" accept="image/*" required>
                <small>Format yang didukung: JPG, JPEG, PNG, GIF. Maksimal 5MB.</small>

                <button type="submit" name="add_product">Tambah Produk</button>
            </form>
        </div>
    </div>
</body>
</html>