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
    $jenis = $_POST['jenis'];
    $seri = $_POST['seri'];
    $harga = $_POST['harga'];
    $durasisewa = $_POST['durasisewa'];
    $deskripsi = $_POST['deskripsi'];
    $gambar = $_FILES['gambar']['name'];

    // Proses upload gambar
    if ($gambar) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($gambar);
        move_uploaded_file($_FILES['gambar']['tmp_name'], $target_file);

        // Query untuk menambahkan kendaraan baru
        $query = "INSERT INTO tbkendaraan (jenis, seri, harga, durasisewa, deskripsi, gambar) VALUES ('$jenis', '$seri', '$harga', '$durasisewa', '$deskripsi', '$gambar')";

        if (mysqli_query($conn, $query)) {
            header("Location: KendaraanAdmin.php"); // Redirect ke halaman daftar kendaraan
            exit();
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        echo "Gambar tidak boleh kosong.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Tambah Kendaraan - Fizh Rental</title>
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
        input[type="number"],
        input[type="file"],
        textarea {
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
            <h1>Tambah Kendaraan</h1>
            <p>Silakan isi form di bawah ini</p>
        </header>
        <div class="container">
            <form method="POST" enctype="multipart/form-data">
                <label for="jenis">Jenis Kendaraan</label>
                <input type="text" id="jenis" name="jenis" required>

                <label for="seri">Seri Kendaraan</label>
                <input type="text" id="seri" name="seri" required>

                <label for="harga">Harga Sewa</label>
                <input type="number" id="harga" name="harga" required>

                <label for="durasisewa">Durasi Sewa (hari)</label>
                <input type="number" id="durasisewa" name="durasisewa" required>

                <label for="deskripsi">Deskripsi</label>
                <textarea id="deskripsi" name="deskripsi" rows="4" required></textarea>

                <label for="gambar">Upload Gambar</label>
                <input type="file" id="gambar" name="gambar" accept="image/*" required>

                <div class="button-container">
                    <button type="submit">Tambah Kendaraan</button>
                    <button type="button" onclick="window.location.href='KendaraanAdmin.php'">Kembali</button>
                </div>
            </form>
        </div>
        <footer>
        <p>&copy; 2024 Fizh Rental. Semua hak dilindungi.</p>
        </footer>
    </body>
</html>