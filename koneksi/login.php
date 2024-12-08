<?php
session_start();
include 'koneksi.php'; // Pastikan Anda memiliki file koneksi ke database

// Periksa apakah pengguna sudah login
if (isset($_SESSION['id'])) {
    // Arahkan ke dashboard sesuai role
    if ($_SESSION['role'] == 'admin') {
        header("Location: ../admin/BerandaAdmin.php");
        exit();
    } else {
        header("Location: ../user/BerandaUser.php");
        exit();
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $password = $_POST['password'];

    // Hash password dengan MD5
    $hashedPassword = md5($password);

    // Query untuk mengambil data admin berdasarkan nama
    $query = "SELECT * FROM tbpengguna WHERE nama = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $nama);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Verifikasi password
        if ($hashedPassword === $row['password']) {
            $_SESSION['id'] = $row['id'];
            $_SESSION['nama'] = $row['nama'];
            $_SESSION['role'] = $row['role'];

            // Arahkan ke dashboard sesuai role
            if ($row['role'] == 'admin') {
                header("Location: ../admin/BerandaAdmin.php");
            } else {
                header("Location: ../user/BerandaUser.php");
            }
            exit(); // Pastikan untuk menghentikan eksekusi setelah pengalihan
        } else {
            $error = "Password salah!";
        }
    } else {
        $error = "Nama tidak ditemukan!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login/Masuk</title>
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
        .login-container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
            width: 90%;
            max-width: 400px;
            text-align: center;
        }
        .login-container h2 {
            margin-bottom: 20px;
            color: #333;
        }
        .login-container input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            transition: border-color 0.3s;
        }
        .login-container input:focus {
            border-color: #8B0000;
            outline: none;
        }
        .login-container button {
            width: 100%;
            padding: 10px;
            background-color: #8B0000;
            border: none;
            color: white;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .login-container button:hover {
            background-color: #B22222;
        }
        .error {
            color: red;
            margin: 10px 0;
        }
        .password-container {
            position: relative;
        }
        .toggle-password {
            position: absolute;
            right: 10px;
            top: 10px;
            cursor: pointer;
            color: #8B0000;
        }
        .back-button {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 15px;
            background-color: #8B0000;
            color: white;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s;
        }
        .back-button:hover {
            background-color: #B22222;
        }
        @media (max-width: 400px) {
            .login-container {
                width: 90%;
            }
        }
    </style>
</head>
<body>

<div class="login-container">
    <h2>Selamat Datang!</h2>
    <?php if (isset($error)): ?>
        <div class="error"><?php echo $error; ?></div>
    <?php endif; ?>
    <form method="POST" action="">
        <input type="text" name="nama" placeholder="Nama Pengguna" required>
        <div class="password-container">
            <input type="password" id="password" name="password" placeholder="Kata Sandi" required>
        </div>
        <button type="submit">Masuk</button>
    </form>
    <a href="../index.php" class="back-button">Kembali ke Halaman Utama</a>
</div>
<script>
    const passwordInput = document.querySelector('#password');
    const togglePassword = document.querySelector('#togglePassword');

    togglePassword.addEventListener('click', function () {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        this.classList.toggle('fa-eye-slash');
    });
</script>

</body>
</html>