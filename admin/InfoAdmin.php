<?php
session_start();

// Periksa apakah pengguna sudah login dan memiliki role admin
if (!isset($_SESSION['id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../koneksi/login.php");
    exit();
}

// Koneksi ke database
include '../koneksi/koneksi.php'; // Pastikan Anda memiliki file koneksi.php yang berisi koneksi ke database

// Ambil data pengguna dari database
$query = "SELECT * FROM tbpengguna";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Info Admin - Fizh Rental</title>
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
            justify-content: center; 
            align-items: center;
            background-color: #8B0000;
            padding: 10px 20px;
            position: relative;
            z-index: 1000;
        }

        .nav-links {
            display: flex;
            gap: 0; 
            margin: 0;
            list-style: none; 
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

        .add-button {
            background-color: #8B0000; 
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            text-decoration: none; 
            margin-bottom: 20px; 
        }

        .add-button:hover {
            background-color: #A52A2A; 
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            font-size: 1em;
            text-align: left;
            overflow-x: auto; 
        }

        th, td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: center; 
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
        .requirements {
            margin-top: 20px;
            padding: 15px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            width: 100%;
        }

        .requirements h2 {
            margin: 0 0 10px;
            font-size: 1.5em;
            color: #8B0000;
        }

        .requirements p {
            margin: 5px 0;
            font-size: 1em;
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
                display: none; 
                flex-direction: column;
                width: 100%;
                position: absolute;
                top: 60px; 
                left: 0;
                background-color: #8B0000; 
                z-index: 999;
            }

            .nav-links.active {
                display: flex; 
            }

            .hamburger {
                display: flex; 
            }

            table {
                display: block; 
                overflow-x: auto; 
                white-space: nowrap; 
            }

            th, td {
                min-width: 150px; 
            }
        }
    </style>
</head>
<body>
    <header>
        <img src="../img/LogoFizhCarRental.png" alt="Logo">
        <h1>Informasi</h1>
        <p>Kelola Informasi Tertentu Disini</p>
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
        <h2>Daftar Pengguna</h2>
        <a href="tambahpengguna.php" class="add-button">Tambah Pengguna</a> <!-- Tombol Tambah Pengguna -->
        <table>
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Password</th>
                    <th>Role</th>
                    <th>Aksi</th> <!-- Tambahkan kolom untuk aksi -->
                </tr>
            </thead>
            <tbody>
                <?php
                // Tampilkan data pengguna
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['nama']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['password']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['role']) . "</td>";
                        echo "<td>
                                <a href='editpengguna.php?id=" . $row['id'] . "' class='action-button'>Edit</a>
                                <a href='hapuspengguna.php?id=" . $row['id'] . "' class='action-button'>Hapus</a>
                              </td>"; // Tambahkan tombol Edit dan Hapus
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>Tidak ada data pengguna.</td></tr>"; // Sesuaikan colspan
                }
                ?>
            </tbody>
        </table>
        <div class="requirements">
            <h2>Persyaratan Sewa</h2>
            <p>1. Pengguna harus berusia minimal 18 tahun.</p>
            <p>2. Pengguna harus memiliki KTP yang valid.</p>
            <p>3. Pengguna harus memberikan informasi yang akurat saat mendaftar.</p>
            <p>4. Pengguna bertanggung jawab atas kendaraan yang disewa.</p>
            <p>5. Pengguna mengisi bahan bakar mobil itu sendiri.</p>
            <p>6. Pengguna harus menyelesaikan transaksi di kantor pusat.</p>
            <p>7. Pengguna harus datang ke kantor pusat untuk mengambil kendaraan.</p>
            <p>8. Pengguna harus mengembalikan kendaraan dengan kondisi non-cacat.</p>
            <p>9. Pengguna akan dihapus datanya jika sudah menyelesaikan rental sesuai aturan</p>
            <p>10. Pengguna akan dilacak jika tidak mengembalikan kendaraan/tidak melunasinya.</p>
        </div>
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