<?php
session_start();

// Periksa apakah pengguna sudah login dan memiliki role admin
if (!isset($_SESSION['id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../koneksi/login.php");
    exit();
}

// Koneksi ke database
include '../koneksi/koneksi.php'; // Pastikan Anda memiliki file koneksi.php yang berisi koneksi ke database

// Proses form jika ada pengiriman data
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    // Enkripsi password dengan MD5
    $hashed_password = md5($password);

    // Query untuk menambahkan pengguna baru
    $query = "INSERT INTO tbpengguna (nama, password, role) VALUES ('$nama', '$hashed_password', '$role')";

    if (mysqli_query($conn, $query)) {
        header("Location: InfoAdmin.php"); // Redirect ke halaman daftar pengguna
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Tambah Pengguna - Fizh Rental</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            background: #f0f0f0;
            color: #333;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        header {
            background: linear-gradient(to bottom, #8B0000, #A52A2A);
            color: white;
            text-align: center;
            padding: 20px 0;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        }

        header img {
            max-width: 120px; 
            margin-bottom: 10px;
            border-radius: 50%; 
            border: 3px solid white; 
        }

        header h1 {
            margin: 0;
            font-size: 2.5em;
        }

        header p {
            margin: 10px 0;
            font-size: 1.2em;
        }

        .container {
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            flex: 1;
        }

        form {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
        }

        label {
            margin: 10px 0 5px;
            display: block;
        }

        input[type="text"],
        input[type="password"],
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .button-container {
            display: flex;
            justify-content: space-between;
        }

        button {
            background-color: #8B0000; /* Warna merah gelap */
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            flex: 1;
            margin: 5px; /* Tambahkan margin untuk jarak antar tombol */
        }

        button:hover {
            background-color: #A52A2A; /* Warna saat hover */
        }

        footer {
            background: linear-gradient(to bottom, #8B0000, #A52A2A);
            color: white;
            text-align: center;
            padding: 10px 0;
            position: relative;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>
    <header>
        <img src="../img/LogoFizhCarRental.png" alt="Logo">
        <h1>Tambah Pengguna</h1>
        <p>Silakan isi form di bawah ini</p> </header> <div class="container"> <form method="POST"> <label for="nama">Nama Lengkap</label> <input type="text" id="nama" name="nama" required>
        <label for="password">Password</label>
        <input type="password" id="password" name="password" required>

        <label for="role">Role</label>
        <select id="role" name="role" required>
            <option value="admin">Admin</option>
            <option value="user">User </option>
        </select>

        <div class="button-container">
            <button type="submit">Tambah Pengguna</button>
            <button type="button" onclick="window.location.href='InfoAdmin.php'">Kembali</button>
        </div>
    </form>
</div>
<footer>
    <p>&copy; 2024 Fizh Rental. Semua hak dilindungi.</p>
</footer>