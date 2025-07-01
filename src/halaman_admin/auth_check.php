<?php
// Authentication check for admin pages
session_start();

function check_admin_auth() {
    if (!isset($_SESSION['admin_id'])) {
        header("Location: ../e-commerce_login/login_admin.php");
        exit();
    }
}

function get_admin_info() {
    return [
        'id' => $_SESSION['admin_id'] ?? null,
        'username' => $_SESSION['admin_username'] ?? null,
        'email' => $_SESSION['admin_email'] ?? null
    ];
}
?>