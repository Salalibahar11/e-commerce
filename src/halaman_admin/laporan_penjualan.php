<?php
include('../config.php'); // Koneksi database

// Mengambil data transaksi dan produk yang terjual
$query = "SELECT t.transaction_id, t.transaction_date, p.name, ti.quantity, ti.price 
          FROM transactions t
          JOIN transaction_items ti ON t.transaction_id = ti.transaction_id
          JOIN products p ON ti.product_id = p.product_id";
$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penjualan</title>
    <link rel="stylesheet" href="styles_admin.css?v=<?= time(); ?>">
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
    
    <div class="container">
        <h2>Laporan Penjualan</h2>
        <table>
            <thead>
                <tr>
                    <th>ID Transaksi</th>
                    <th>Tanggal Transaksi</th>
                    <th>Nama Produk</th>
                    <th>Kuantitas</th>
                    <th>Harga</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?= $row['transaction_id'] ?></td>
                        <td><?= $row['transaction_date'] ?></td>
                        <td><?= $row['name'] ?></td>
                        <td><?= $row['quantity'] ?></td>
                        <td><?= $row['price'] ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>
