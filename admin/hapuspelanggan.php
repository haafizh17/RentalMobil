<?php
session_start();

// Periksa apakah pengguna sudah login dan memiliki role admin
if (!isset($_SESSION['id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../koneksi/login.php");
    exit();
}

// Koneksi ke database
include '../koneksi/koneksi.php'; // Pastikan Anda memiliki file koneksi.php yang berisi koneksi ke database

// Ambil ID pelanggan dari URL
$id = $_GET['id'];

// Ambil data pelanggan dari database
$query = "SELECT namalengkap FROM tbpemesanan WHERE id = '$id'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);

// Jika data pelanggan tidak ditemukan
if (!$row) {
    echo "Data pelanggan tidak ditemukan.";
    exit();
}

// Hapus data pelanggan dari database
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Hapus data pelanggan dari database
    $query = "DELETE FROM tbpemesanan WHERE id = '$id'";
    if (mysqli_query($conn, $query)) {
        header("Location: PelangganAdmin.php"); // Redirect ke halaman daftar pelanggan
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
    <title>Hapus Pelanggan</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            background: #f0f0f0;
            color: #333;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            align-items: center;
            justify-content: center;
        }

        .container {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        button {
            background-color: #8B0000; /* Warna merah gelap */
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #A52A2A; /* Warna saat hover */
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Konfirmasi Hapus Pelanggan</h2>
        <p>Apakah Anda yakin ingin menghapus pelanggan <strong><?php echo $row['namalengkap']; ?></strong>?</p>
        <form method="POST">
            <button type="submit">Hapus Pelanggan</button>
            <a href="PelangganAdmin.php" style="margin-left: 10px; text-decoration: none; color: #8B0000;">Batal</a>
        </form>
    </div>
</body>
</html>