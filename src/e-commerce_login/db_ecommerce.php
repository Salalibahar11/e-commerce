<?php
    $hostname = 'localhost';
    $username = 'root';
    $password = '';
    $dbname   = 'db_ecommerce';

    $conn = mysqli_connect($hostname, $username, $password, $dbname) or die ('Tidak bisa terhubung ke database');
?>