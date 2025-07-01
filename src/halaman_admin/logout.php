<?php
session_start();

// Destroy all session data
session_destroy();

// Redirect to login page
header("Location: ../e-commerce_login/login_admin.php");
exit();
?>