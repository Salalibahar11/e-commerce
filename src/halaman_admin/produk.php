<?php
    include('../config.php'); // Koneksi database
    // Mengambil data produk
    $query = "SELECT * FROM products";
    $result = $conn->query($query); // Menggunakan query dengan objek
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Produk - Admin Panel</title>
    <link rel="stylesheet" href="styles_admin.css?v=<?= time(); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
            <h2>Daftar Produk</h2>

            <?php
            // Pesan keberhasilan/error
            if (isset($_GET['message'])) {
                echo '<p>' . htmlspecialchars($_GET['message']) . '</p>';
            }
            ?>

            <table>
                <thead>
                    <tr>
                        <th>Nama Produk</th>
                        <th>Deskripsi</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Kategori</th>
                        <th>Gambar</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['name']); ?></td>
                        <td><?php echo htmlspecialchars($row['description']); ?></td>
                        <td><?php echo htmlspecialchars($row['price']); ?></td>
                        <td><?php echo htmlspecialchars($row['stock']); ?></td>
                        <td><?php echo htmlspecialchars($row['category']); ?></td>
                        <td>

                            <!-- Menampilkan gambar jika ada -->
                            <?php if (!empty($row['image'])): ?>
                                <img src="uploads/<?php echo htmlspecialchars($row['image']); ?>" alt="Gambar Produk" width="100">
                            <?php else: ?>
                                <span>Gambar tidak tersedia</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <!-- Tombol untuk mengedit produk -->
                            <a href="produk_detail.php?id=<?php echo $row['product_id']; ?>" class="btn button-info"><i class="fas fa-search"></i></a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>
