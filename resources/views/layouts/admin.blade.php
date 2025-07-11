<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Reset default styling */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Body Styling */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7fc;
            color: #333;
            display: flex;
            height: 100vh;
        }

        /* Sidebar Styling */
        .sidebar {
            width: 250px;
            background-color: #4CAF50;
            color: white;
            padding: 20px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
        }

        .sidebar h2 {
            color: #fff;
            margin-bottom: 30px;
            font-size: 24px;
        }

        .sidebar ul {
            list-style: none;
        }

        .sidebar ul li {
            margin: 15px 0;
        }

        .sidebar ul li a {
            color: #fff;
            text-decoration: none;
            font-size: 18px;
            display: block;
            padding: 10px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .sidebar ul li a:hover {
            background-color: #575757;
        }

        /* Main Content Styling */
        .content {
            margin-left: 260px;
            padding: 20px;
            width: calc(100% - 260px);
            height: 100%;
            overflow-y: auto;
        }

        .container {
            max-width: 900px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        h2 {
            font-size: 26px;
            margin-bottom: 20px;
            color: #333;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        label {
            font-weight: bold;
            font-size: 16px;
            margin-bottom: 5px;
        }

        input[type="text"], input[type="number"], textarea, input[type="file"] {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ddd;
            font-size: 16px;
            color: #333;
        }

        textarea {
            resize: vertical;
            height: 100px;
        }

        button[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 12px;
            font-size: 18px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        /* table produk styling */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th, table td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }

        table th {
            background-color: #f4f7fc;
            font-weight: bold;
        }

        button[type="submit"]:hover {
            background-color: #45a049;
        }

        button[type="submit"]:focus {
            outline: none;
        }

        /* Untuk kolom Action */
        td:last-child {
            text-align: center;
            vertical-align: middle;
        }

        /* Untuk tombol icon search */
        .button-info {
            color: black;
            font-weight: bold;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            text-decoration: none;
            width: 100%;
            height: 100%;
        }

        .button-info i {
            color: black;
            font-weight: bold;
        }

        /* Message Styling */
        .alert-message {
            padding: 10px;
            background-color: #f44336;
            color: white;
            margin: 15px 0;
            border-radius: 5px;
            text-align: center;
        }

        .success-message {
            background-color: #4CAF50;
        }

        .btn-danger {
            background-color: #dc3545;
            color: white;
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .btn-danger:hover {
            background-color: #c82333;
        }

        .btn-primary {
            background-color: #007bff;
            color: white;
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .sidebar {
                width: 200px;
            }

            .content {
                margin-left: 200px;
            }

            .container {
                width: 90%;
            }
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <h2>Admin Panel</h2>
        <ul>
            <li><a href="{{ route('admin.products.create') }}">Tambah Produk</a></li>
            <li><a href="{{ route('admin.products') }}">Produk</a></li>
            <li><a href="{{ route('admin.transactions') }}">Data Transaksi</a></li>
            <li><a href="{{ route('admin.sales-report') }}">Laporan Penjualan</a></li>
            <li><a href="{{ route('admin.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a></li>
        </ul>
        
        <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>

    <!-- Main Content -->
    <div class="content">
        @yield('content')
    </div>
</body>
</html>