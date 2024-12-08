<?php
// PelangganAdmin.php
session_start();

// Periksa apakah pengguna sudah login dan memiliki role admin
if (!isset($_SESSION['id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../koneksi/login.php");
    exit();
}

// Koneksi ke database
include '../koneksi/koneksi.php'; // Pastikan Anda memiliki file koneksi.php yang berisi koneksi ke database

// Ambil data pelanggan dari database
$query = "SELECT * FROM tbpemesanan";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Daftar Pelanggan Admin - Fizh Rental</title>
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
            flex-direction: column;
            align-items: center;
            flex: 1;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            font-size: 1em;
            text-align: left;
            overflow-x: auto; /* Enable horizontal scrolling */
        }

        th, td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: center; /* Center align text */
        }

        th {
            background-color: #8B0000;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ddd;
        }

        .action-button {
            background-color: #8B0000; /* Warna merah gelap */
            color: white;
            padding: 5px 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            text-decoration: none; /* Menghilangkan garis bawah */
        }

        .action-button:hover {
            background-color: #A52A2A; /* Warna saat hover */
        }

        footer {
            background: linear-gradient(to top, #8B0000, #A52A2A);
            color: white;
            text-align: center;
            padding: 10px 0;
            position: relative;
            bottom: 0;
            width: 100%;
            box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.2);
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

            table {
                display: block; /* Buat tabel menjadi block untuk responsif */
                overflow-x: auto; /* Enable horizontal scrolling */
                white-space: nowrap; /* Prevent text wrapping */
            }

            th, td {
                min-width: 150px; /* Set minimum width untuk kolom */
            }
        }
    </style>
</head>
<body>
    <header>
        <img src="../img/LogoFizhCarRental.png" alt="Logo">
        <h1>Data Pelanggan</h1>
        <p>Hapus Data Jika Pelanggan Sudah Menyelesaikan Rental Sesuai Persyaratan yang Ada</p>
    </header>
    <nav>
        <div class="hamburger" onclick="toggleMenu()">
            <div></div>
            <div></div>
            <div></div>
        </div>
        <ul class="nav-links">
            <li><a href="BerandaAdmin.php">Beranda</a></li>
            <li><a href="KendaraanAdmin.php">Kendaraan</a></li>
            <li><a href="PelangganAdmin.php">Pelanggan</a></li>
            <li><a href="InfoAdmin.php">Info</a></li>
            <li><a href="LaporanAdmin.php">Laporan</a></li>
            <li><a href="../koneksi/logout.php">Keluar</a></li>
        </ul>
    </nav>
    <div class="container">
        <h2>Daftar Pelanggan</h2>
        <table>
            <thead>
                <tr>
                    <th>Nama Lengkap</th>
                    <th>NIK</th>
                    <th>No KK</th>
                    <th>Alamat</th>
                    <th>Jenis Kelamin</th>
                    <th>Total Pembayaran</th>
                    <th>Aksi</th> <!-- Tambahkan kolom untuk aksi -->
                </tr>
            </thead>
            <tbody>
                <?php
                // Tampilkan data pelanggan
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row['namalengkap'] . "</td>";
                        echo "<td>" . $row['nik'] . "</td>";
                        echo "<td>" . $row['nokk'] . "</td>";
                        echo "<td>" . $row['alamat'] . "</td>";
                        echo "<td>" . $row['jenis_kelamin'] . "</td>";
                        echo "<td>" . number_format($row['total_pembayaran'], 0, ',', '.') . "</td>";
                        echo "<td>
                                                               <a href='hapuspelanggan.php?id=" . $row['id'] . "' class='action-button'>Hapus</a>
                              </td>"; // Hanya tombol Hapus yang tersisa
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>Tidak ada data pelanggan.</td></tr>"; // Sesuaikan colspan
                }
                ?>
            </tbody>
        </table>
    </div>
    <footer>
        <p>&copy; 2024 Fizh Rental. Semua hak dilindungi.</p>
    </footer>
    <script>
        function toggleMenu() {
            const navLinks = document.querySelector('.nav-links');
            navLinks.classList.toggle('active');
        }
    </script>
</body>
</html>