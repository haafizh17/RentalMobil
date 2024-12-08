<?php
session_start();

// Periksa apakah pengguna sudah login dan memiliki role user
if (!isset($_SESSION['id']) || $_SESSION['role'] !== 'user') {
    header("Location: ../koneksi/login.php");
    exit();
}

// Koneksi ke database
include '../koneksi/koneksi.php'; // Pastikan Anda memiliki file koneksi.php yang berisi koneksi ke database

// Ambil data kendaraan dari database
$query = "SELECT * FROM tbkendaraan";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Daftar Kendaraan</title>
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

        nav {
            display: flex;
            justify-content: center; /* Center the navbar items */
            align-items: center;
            background-color: #8B0000;
            padding: 10px 20px;
            position: relative;
            z-index: 1000;
        }

        .nav-links {
            display: flex;
            gap: 0; /* Remove gap between nav items */
            margin: 0;
            list-style: none; /* Remove bullet points */
        }

        .nav-links a {
            color: white;
            text-decoration: none;
            padding: 10px 15px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .nav-links a:hover {
            background-color: #A52A2A;
        }

        .hamburger {
            display: none;
            flex-direction: column;
            cursor: pointer;
        }

        .hamburger div {
            width: 25px;
            height: 3px;
            background-color: white;
            margin: 4px 0;
            transition: 0.4s;
        }

        .container {
            padding: 20px;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            flex: 1;
        }

        .card {
            background: linear-gradient(to bottom, #8B0000, #A52A2A);
            color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 200px;
            max-width: 100%;
            transition: transform 0.3s, box-shadow 0.3s;
            cursor: pointer;
        }

        .card:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
        }

        .card img {
            width: 100%;
            border-radius: 10px;
            margin-bottom: 10px;
        }

        .card h3 {
            margin: 10px 0;
        }

        footer {
            background: linear-gradient(to top, #8B0000, #A52A2A);
            color: white;
            text-align: center;
            padding: 10px 0;
            position: relative;
            bottom:  0;
            width: 100%;
            box-shadow: 0 - 2px 10px rgba(0, 0, 0, 0.2);
        }

        @media (max-width: 768px) {
            .nav-links {
                display: none; /* Sembunyikan menu navigasi pada layar kecil */
                flex-direction: column;
                width: 100%;
                position: absolute;
                top: 60px; /* Sesuaikan dengan tinggi header */
                left: 0;
                background-color: #8B0000; /* Warna latar belakang menu */
                z-index: 999;
            }

            .nav-links.active {
                display: flex; /* Tampilkan menu navigasi saat hamburger diklik */
            }

            .hamburger {
                display: flex; /* Tampilkan hamburger pada layar kecil */
            }
        }
    </style>
</head>
<body>
    <header>
        <img src="../img/LogoFizhCarRental.png" alt="Logo">
        <h1>Daftar Kendaraan</h1>
        <p>Temukan kendaraan yang Anda inginkan</p>
    </header>
    <nav>
        <div class="hamburger" onclick="toggleMenu()">
            <div></div>
            <div></div>
            <div></div>
        </div>
        <ul class="nav-links">
        <li><a href="BerandaUser.php">Beranda</a></li>
            <li><a href="DaftarKendaraan.php">Kendaraan</a></li>
            <li><a href="Pemesanan.php">Pemesanan</a></li>
            <li><a href="Info.php">Info</a></li>
            <li><a href="../koneksi/logout.php">Keluar</a></li>
        </ul>
    </nav>
    <div class="container">
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
        <div class="card">
            <img src="../admin/uploads/<?php echo $row['gambar']; ?>" alt="<?php echo $row['jenis']; ?>">
            <h3><?php echo $row['jenis']; ?> - <?php echo $row['seri']; ?></h3>
            <p>Harga: Rp <?php echo number_format($row['harga'], 0, ',', '.'); ?></p>
            <p>Durasi Sewa: <?php echo $row['durasisewa']; ?> hari</p>
            <p><?php echo $row['deskripsi']; ?></p>
        </div>
        <?php endwhile; ?>
    </div>
    <footer>
        <p>&copy; 2024 Fizhh Rental. Semua hak dilindungi.</p>
    </footer>
    <script>
        function toggleMenu() {
            const navLinks = document.querySelector('.nav-links');
            navLinks.classList.toggle('active');
        }
    </script>
</body>
</html>