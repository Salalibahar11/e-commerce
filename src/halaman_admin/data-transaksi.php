<?php
include('../config.php'); // Koneksi database

// Menghapus transaksi dari database dengan metode POST yang aman
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_transaction'])) {
    $transaction_id = $_POST['transaction_id'];

    // Gunakan prepared statement untuk keamanan
    $stmt_delete_items = $conn->prepare("DELETE FROM transaction_items WHERE transaction_id = ?");
    $stmt_delete_items->bind_param("i", $transaction_id);
    $stmt_delete_items->execute();
    
    $stmt_delete_trans = $conn->prepare("DELETE FROM transactions WHERE transaction_id = ?");
    $stmt_delete_trans->bind_param("i", $transaction_id);

    if ($stmt_delete_trans->execute()) {
        $message = "Transaksi berhasil dihapus!";
    } else {
        $message = "Error: " . $conn->error;
    }
    // Redirect untuk menghindari resubmission form
    header("Location: data-transaksi.php?message=" . urlencode($message));
    exit();
}

// Mengambil data transaksi dari database
$query = "SELECT t.*, u.username FROM transactions t JOIN users u ON t.user_id = u.user_id ORDER BY t.transaction_date DESC";
$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Admin - Transaksi</title>
    <link rel="stylesheet" href="styles_admin.css?v=<?= time(); ?>">
</head>
<body>
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
            <h2>Data Transaksi</h2>
            <?php if(isset($_GET['message'])) { echo "<p>" . htmlspecialchars($_GET['message']) . "</p>"; } ?>
            <table>
                <thead>
                    <tr>
                        <th>ID Transaksi</th>
                        <th>Nama Pengguna</th>
                        <th>Tanggal</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <td><?= $row['transaction_id'] ?></td>
                            <td><?= htmlspecialchars($row['username']) ?></td>
                            <td><?= $row['transaction_date'] ?></td>
                            <td>Rp <?= number_format($row['total_amount'], 2, ',', '.') ?></td>
                            <td><?= htmlspecialchars($row['status']) ?></td>
                            <td>
                                <form action="data-transaksi.php" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus transaksi ini?');">
                                    <input type="hidden" name="transaction_id" value="<?= $row['transaction_id'] ?>">
                                    <button type="submit" name="delete_transaction" class="btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>