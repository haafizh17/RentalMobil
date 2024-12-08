<?php
session_start();

// Periksa apakah pengguna sudah login dan memiliki role admin
if (!isset($_SESSION['id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../koneksi/login.php");
    exit();
}

// Koneksi ke database
include '../koneksi/koneksi.php';

// Ambil ID pengguna dari URL
$id = $_GET['id'];

// Ambil data pengguna dari database
$query = "SELECT * FROM tbpengguna WHERE id = '$id'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);

// Jika data pengguna tidak ditemukan
if (!$row) {
    echo "Data pengguna tidak ditemukan.";
    exit();
}

// Proses form jika ada pengiriman data
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    // Enkripsi password dengan MD5
    $hashed_password = md5($password);

    // Update query
    $query = "UPDATE tbpengguna SET nama='$nama', password='$hashed_password', role='$role' WHERE id='$id'";

    if (mysqli_query($conn, $query)) {
        header("Location: InfoAdmin.php"); // Redirect ke halaman InfoAdmin
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2.css">
    <title>Edit Pengguna</title>
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

        .container {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
        }

        h2 {
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
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

        button {
            background-color: #8B0000; /* Warna merah gelap */
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-right: 10px;
        }

        button:hover {
            background-color: #A52A2A; /* Warna saat hover */
        }

        @media (max-width: 600px) {
            .container {
                padding: 15px;
            }

            button {
                width: 100%;
                margin: 5px 0;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Edit Pengguna</h2>
        <form method="POST" action="">
            <div class="form-group">
                <label for="nama">Nama:</label>
                <input type="text" name="nama" id="nama" value="<?php echo htmlspecialchars($row['nama']); ?>" required>
            </div>
            <div class="form-group">
                <label for="password">Password: (wajib diganti jika ingin melakukan perubahan)</label>
                <input type="password" name="password" id="password" required>
            </div>
            <div class="form-group">
                <label for="role">Role:</label>
                <select name="role" id="role" required>
                <option value="admin" <?php echo ($row['role'] == 'admin') ? 'selected' : ''; ?>>Admin</option>
                    <option value="user" <?php echo ($row['role'] == 'user') ? 'selected' : ''; ?>>User </option>
                </select>
            </div>
            <div class="button-container">
                <button type="submit">Simpan</button>
                <a href="InfoAdmin.php" style="text-decoration: none;">
                    <button type="button" style="background-color: #8B0000; color: white;">Kembali</button>
                </a>
            </div>
        </form>
    </div>
</body>
</html>