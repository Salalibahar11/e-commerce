<?php
    include('../config.php'); // Koneksi database

    $id = $_GET['id'];
    
    // Query untuk mengambil data produk berdasarkan id
    $query = mysqli_query($conn, "SELECT * FROM products WHERE product_id='$id'");
    
    // Cek jika query tidak mengembalikan data
    if (mysqli_num_rows($query) == 0) {
        echo "Produk tidak ditemukan.";
        exit();
    }
    
    $data = mysqli_fetch_array($query);

    // Menangani penghapusan produk
    if (isset($_POST['deleteBtn'])) {
        // Query untuk menghapus produk
        $delete_query = "DELETE FROM products WHERE product_id='$id'";
        
        if (mysqli_query($conn, $delete_query)) {
            echo "Produk berhasil dihapus!";
            // Redirect ke halaman produk setelah dihapus
            header("Location: produk.php");
            exit(); // Pastikan proses berhenti setelah redirect
        } else {
            echo "Terjadi kesalahan saat menghapus produk: " . mysqli_error($conn);
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles_admin.css?v=<?= time(); ?>">
    <title>Detail Produk</title>
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
    
    <div class="content">
        <div class="container">
            <h2>Detail Produk</h2>

            <form action="" method="post" enctype="multipart/form-data">
                <label for="name">Nama Produk</label>
                <input type="text" name="name" id="name" value="<?php echo isset($data['name']) ? $data['name'] : ''; ?>" required><br>
                
                <label for="description">Deskripsi</label>
                <textarea name="description" id="description" required><?php echo isset($data['description']) ? $data['description'] : ''; ?></textarea><br>
                
                <label for="price">Harga</label>
                <input type="number" name="price" step="0.01" value="<?php echo isset($data['price']) ? $data['price'] : ''; ?>" required><br>

                <label for="stock">Stok</label>
                <input type="number" name="stock" value="<?php echo isset($data['stock']) ? $data['stock'] : ''; ?>" required><br>

                <label for="category">Kategori</label>
                <input type="text" name="category" value="<?php echo isset($data['category']) ? $data['category'] : ''; ?>" required><br>

                <label for="image">Gambar Produk</label>
                <input type="file" name="image"><br>

                <div class="button_edit">
                    <button type="submit" class="btn btn-primary" name="editBtn">Edit</button>
                </div>
            </form>

            <!-- Tombol Hapus Produk -->
            <form action="" method="post">
                <div class="button_delete">
                    <button type="submit" class="btn btn-danger" name="deleteBtn" onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?');">Hapus Produk</button>
                </div>
            </form>
        </div>
    </div>

    <?php
        if (isset($_POST['editBtn'])) {
            // Ambil data yang di-submit
            $name = htmlspecialchars($_POST['name']);
            $description = htmlspecialchars($_POST['description']);
            $price = htmlspecialchars($_POST['price']);
            $stock = htmlspecialchars($_POST['stock']);
            $category = htmlspecialchars($_POST['category']);

            // Menangani upload gambar jika ada
            if ($_FILES['image']['name'] != '') {
                $image = $_FILES['image']['name'];
                $target_dir = "uploads/"; // Folder tempat menyimpan gambar
                $target_file = $target_dir . basename($image);
                
                // Memindahkan file gambar yang di-upload
                if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
                    // Update data produk dengan gambar baru
                    $image = $target_file;
                } else {
                    echo "Gambar gagal di-upload!";
                    exit();
                }
            } else {
                // Jika tidak ada gambar baru, gunakan gambar lama
                $image = isset($data['image']) ? $data['image'] : ''; 
            }

            // Update data produk di database
            $update_query = "UPDATE products SET name='$name', description='$description', price='$price', stock='$stock', category='$category', image='$image' WHERE product_id='$id'";
            if (mysqli_query($conn, $update_query)) {
                echo "Produk berhasil diperbarui!";
            } else {
                echo "Terjadi kesalahan: " . mysqli_error($conn);
            }
        }
    ?>

</body>
</html>
