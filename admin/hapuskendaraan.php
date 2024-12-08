<?php
session_start();

// Periksa apakah pengguna sudah login dan memiliki role admin
if (!isset($_SESSION['id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../koneksi/login.php");
    exit();
}

// Koneksi ke database
include '../koneksi/koneksi.php'; // Pastikan Anda memiliki file koneksi.php yang berisi koneksi ke database

// Ambil ID kendaraan dari URL
$id = $_GET['id'];

// Ambil data kendaraan dari database untuk mendapatkan nama gambar
$query = "SELECT gambar FROM tbkendaraan WHERE id = '$id'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);

// Jika data kendaraan tidak ditemukan
if (!$row) {
    echo "Data kendaraan tidak ditemukan.";
    exit();
}

// Hapus data kendaraan dari database
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Hapus gambar dari folder uploads
    $old_image_path = "uploads/" . $row['gambar'];
    if (file_exists($old_image_path)) {
        unlink($old_image_path); // Hapus gambar lama
    }

    // Hapus data kendaraan dari database
    $query = "DELETE FROM tbkendaraan WHERE id = '$id'";
    if (mysqli_query($conn, $query)) {
        header("Location: KendaraanAdmin.php"); // Redirect ke halaman daftar kendaraan
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
    <title>Hapus Kendaraan</title>
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
        <h2>Konfirmasi Hapus Kendaraan</h2>
        <p>Apakah Anda yakin ingin menghapus kendaraan ini?</p>
        <img src="uploads/<?php echo $row['gambar']; ?>" alt="Foto Kendaraan" style="width: 200px; margin-bottom: 15px;">
        <form method="POST">
            <button type="submit">Hapus Kendaraan</button>
            <a href="KendaraanAdmin.php" style="margin-left: 10px; text-decoration: none; color: #8B0000;">Batal</a>
        </form>
    </div>
</body>
</html>