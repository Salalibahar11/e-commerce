<?php
session_start();
include('../config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = sanitize_input($_POST['username']);
    $email = sanitize_input($_POST['email']);
    $password = $_POST['password'];

    // Validation
    if (empty($username) || empty($email) || empty($password)) {
        $_SESSION['error'] = "Semua field harus diisi!";
    } elseif (!validate_email($email)) {
        $_SESSION['error'] = "Format email tidak valid!";
    } elseif (strlen($password) < 6) {
        $_SESSION['error'] = "Password minimal 6 karakter!";
    } else {
        // Check if email already exists
        $check = $conn->prepare("SELECT * FROM admins WHERE email = ?");
        $check->bind_param("s", $email);
        $check->execute();
        $result = $check->get_result();

        if ($result->num_rows > 0) {
            $_SESSION['error'] = "Email sudah terdaftar!";
        } else {
            // Insert new admin
            $hashedPassword = hash_password($password);
            $stmt = $conn->prepare("INSERT INTO admins (username, email, password) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $username, $email, $hashedPassword);

            if ($stmt->execute()) {
                $_SESSION['success'] = "Registrasi berhasil! Silakan login.";
                header("Location: login_admin.php");
                exit();
            } else {
                $_SESSION['error'] = "Terjadi kesalahan saat menyimpan data.";
            }
            $stmt->close();
        }
        $check->close();
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Admin</title>
    <link rel="stylesheet" href="styles_admin.css?v=<?= time(); ?>">
</head>
<body>
    <div class="login-container">
        <h2>Register Admin</h2>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="error_message"><?= htmlspecialchars($_SESSION['error']) ?></div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>

        <?php if (isset($_SESSION['success'])): ?>
            <div class="error_message" style="color: green; background-color: #e6ffe6;">
                <?= htmlspecialchars($_SESSION['success']) ?>
            </div>
            <?php unset($_SESSION['success']); ?>
        <?php endif; ?>

        <form method="POST" action="">
            <input type="text" name="username" placeholder="Username" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Register</button>
        </form>

        <p>Sudah punya akun? <a href="login_admin.php">Login</a></p>
    </div>
</body>
</html>