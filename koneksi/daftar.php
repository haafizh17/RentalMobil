<?php
session_start();
include 'koneksi.php'; // Pastikan Anda memiliki file koneksi ke database

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $password = $_POST['password'];
    $hashedPassword = md5($password);
    $role = 'user'; // Role default

    // Query untuk menyimpan data pengguna baru
    $query = "INSERT INTO tbpengguna (nama, password, role) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sss", $nama, $hashedPassword, $role);

    if ($stmt->execute()) {
        $success = "Pendaftaran berhasil! Silakan login.";
    } else {
        $error = "Terjadi kesalahan saat mendaftar. Silakan coba lagi.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(to right, #8B0000, #B22222);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .register-container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
            width: 90%;
            max-width: 400px;
            text-align: center;
        }
        .register-container h2 {
            margin-bottom: 20px;
            color: #333;
        }
        .register-container input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            transition: border-color 0.3s;
        }
        .register-container input:focus {
            border-color: #8B0000;
            outline: none;
        }
        .register-container button {
            width: 100%;
            padding: 10px;
            background-color: #8B0000;
            border: none;
            color: white;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .register-container button:hover {
            background-color: #B22222;
        }
        .error, .success {
            margin: 10px 0;
        }
        .error {
            color: red;
        }
        .success {
            color: green;
        }
        @media (max-width: 400px) {
            .register-container {
                width: 90%;
            }
        }
    </style>
</head>
<body>

<div class="register-container">
    <h2>Daftar Pengguna Baru</h2>
    <?php if (isset($error)): ?>
        <div class="error"><?php echo $error; ?></div>
    <?php endif; ?>
    <?php if (isset($success)): ?>
        <div class="success"><?php echo $success; ?></div>
    <?php endif; ?>
    <form method="POST" action="">
        <input type="text" name="nama" placeholder="Nama Pengguna" required>
        <input type="password" name="password" placeholder="Kata Sandi" required>
        <button type="submit">Daftar</button>
    </form>
    <a href="../index.php" class="back-button">Kembali</a>
</div>

</body>
</html>