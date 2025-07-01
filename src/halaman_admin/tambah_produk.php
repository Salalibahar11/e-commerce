<?php
include('../config.php'); // Koneksi database
$message = ''; // Variabel untuk menyimpan pesan

// Menambahkan produk ke database
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_product'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $category = $_POST['category'];

    // Mengecek apakah file gambar ada dan valid
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image = $_FILES['image']['name'];
        $target_dir = __DIR__ . "/uploads/"; // Tambahkan slash!
        $target_file = $target_dir . basename($image);
        $target_file = $target_dir . basename($image);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Cek apakah file adalah gambar
        $check = getimagesize($_FILES['image']['tmp_name']);
        if ($check === false) {
            $message = "File yang diupload bukan gambar.";
        } else {
            // Pindahkan file gambar ke folder 'uploads'
            if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
                // Query untuk menambah produk
                $query = "INSERT INTO products (name, description, price, stock, category, image) 
                          VALUES ('$name', '$description', '$price', '$stock', '$category', '$image')";

                if (mysqli_query($conn, $query)) {
                    $message = "Produk berhasil ditambahkan!";
                } else {
                    $message = "Error: " . mysqli_error($conn);
                }
            } else {
                $message = "Sorry, there was an error uploading your file.";
            }
        }
    } else {
        $message = "Tidak ada file gambar yang diunggah atau terjadi kesalahan pada pengunggahan.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Admin - Dashboard</title>
    <link rel="stylesheet" href="styles_admin.css?v=<?= time(); ?>">
    <script type="text/javascript">
        // Menampilkan pesan menggunakan JavaScript
        function showMessage(message) {
            alert(message); // Menggunakan alert untuk menampilkan pesan
        }
    </script>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <h2>Admin Panel</h2>
        <ul>
            <li><a href="tambah_produk.php">Tambah Produk</a></li>
            <li><a href="data-transaksi.php">Data Transaksi</a></li>
            <li><a href="laporan_penjualan.php">Laporan Penjualan</a></li>
            <li><a href="produk.php">Produk</a></li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="content">
        <div class="container">
            <h2>Tambah Produk</h2>
            <form method="POST" enctype="multipart/form-data" class="form-product">
                <label for="name">Nama Produk</label>
                <input type="text" name="name" required><br>
                
                <label for="description">Deskripsi</label>
                <textarea name="description" required></textarea><br>
                
                <label for="price">Harga</label>
                <input type="number" name="price" step="0.01" required><br>
                
                <label for="stock">Stok</label>
                <input type="number" name="stock" required><br>
                
                <label for="category">Kategori</label>
                <input type="text" name="category" required><br>
                
                <label for="image">Gambar Produk</label>
                <input type="file" name="image" required><br>

                <button type="submit" name="add_product">Tambah Produk</button>
            </form>

            <?php
            // Jika ada pesan, tampilkan dengan JavaScript
            if (!empty($message)) {
                echo "<script type='text/javascript'>showMessage('$message');</script>";
            }
            ?>
        </div>
    </div>
    
</body>
</html>
