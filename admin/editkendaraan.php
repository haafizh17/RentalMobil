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

// Ambil data kendaraan dari database
$query = "SELECT * FROM tbkendaraan WHERE id = '$id'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);

// Jika data kendaraan tidak ditemukan
if (!$row) {
    echo "Data kendaraan tidak ditemukan.";
    exit();
}

// Proses form jika ada pengiriman data
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $jenis = $_POST['jenis'];
    $seri = $_POST['seri'];
    $harga = $_POST['harga'];
    $durasisewa = $_POST['durasisewa'];
    $deskripsi = $_POST['deskripsi'];
    $gambar = $_FILES['gambar']['name'];

    // Jika ada gambar baru yang diunggah
    if ($gambar) {
        // Hapus gambar lama dari folder uploads
        $old_image_path = "uploads/" . $row['gambar'];
        if (file_exists($old_image_path)) {
            unlink($old_image_path); // Hapus gambar lama
        }

        // Proses upload gambar baru
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($gambar);
        move_uploaded_file($_FILES['gambar']['tmp_name'], $target_file);

        // Update query dengan gambar baru
        $query = "UPDATE tbkendaraan SET jenis='$jenis', seri='$seri', harga='$harga', durasisewa='$durasisewa', deskripsi='$deskripsi', gambar='$gambar' WHERE id='$id'";
    } else {
        // Jika tidak ada gambar baru, tetap gunakan gambar lama
        $query = "UPDATE tbkendaraan SET jenis='$jenis', seri='$seri', harga='$harga', durasisewa='$durasisewa', deskripsi='$deskripsi' WHERE id='$id'";
    }

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
    <title>Edit Kendaraan</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            background: #f0f0f0;
            color: #333;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
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

        button {
            background-color: #8B0000; /* Warna merah gelap */
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-right: 10px; /* Jarak antara tombol */
        }

        button:hover {
            background-color: #A52A2A; /* Warna saat hover */
        }

        .button-container {
            display: flex;
            justify-content: space-between;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Edit Kendaraan</h1>
        <form method="POST" enctype="multipart/form-data">
            <label for="jenis">Jenis:</label>
            <input type="text" id="jenis" name="jenis" value="<?php echo $row['jenis']; ?>" required>
            <label for="seri">Seri:</label>
            <input type="text" id="seri" name="seri" value="<?php echo $row['seri']; ?>" required>

            <label for="harga">Harga:</label>
            <input type="number" id="harga" name="harga" value="<?php echo $row['harga']; ?>" required>

            <label for="durasisewa">Durasi Sewa (hari):</label>
            <input type="number" id="durasisewa" name="durasisewa" value="<?php echo $row['durasisewa']; ?>" required>

            <label for="deskripsi">Deskripsi:</label>
            <textarea id="deskripsi" name="deskripsi" rows="4" required><?php echo $row['deskripsi']; ?></textarea>

            <label for="gambar">Gambar: (kosongkan jika tidak ingin mengganti)</label>
            <input type="file" id="gambar" name="gambar">

            <div class="button-container">
                <button type="submit">Simpan Perubahan</button>
                <a href="KendaraanAdmin.php" style="text-decoration: none;">
                    <button type="button" style="background-color: #8B0000; color: white;">Kembali</button>
                </a>
            </div>
        </form>
    </div>
</body>
</html>