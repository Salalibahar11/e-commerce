<?php
session_start();
include('../config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    $sql = "SELECT * FROM admins WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $admin = $result->fetch_assoc();

        if (password_verify($password, $admin['password'])) {
            header("Location: ../halaman_admin/tambah_produk.php");
            exit();
        } else {
            $_SESSION['error_message'] = "Password salah!";
        }
    } else {
        $_SESSION['error_message'] = "Email tidak terdaftar!";
    }

    $stmt->close();
    $conn->close();

    // redirect untuk menampilkan pesan dan hilang saat refresh
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Login Admin</title>
  <link rel="stylesheet" href="styles_admin.css?v=<?= time(); ?>">
</head>
<body>
  <div class="login-container">
    <h2>Login Admin</h2>

    <?php if (isset($_SESSION['error_message'])): ?>
      <div class="error_message">
        <?= htmlspecialchars($_SESSION['error_message']) ?>
        <?php unset($_SESSION['error_message']); ?>
      </div>
    <?php endif; ?>

    <form action="" method="POST">
      <input type="email" name="email" placeholder="Email" required>
      <input type="password" name="password" placeholder="Password" required>
      <button type="submit">Login</button>
    </form>

    <p>Belum punya akun? <a href="register_admin.html">Daftar</a></p>
  </div>
</body>
</html>
