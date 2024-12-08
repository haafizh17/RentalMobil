<?php
session_start();

// Periksa apakah pengguna sudah login dan memiliki role user
if (!isset($_SESSION['id']) || $_SESSION['role'] !== 'user') {
    header("Location: ../koneksi/login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Info</title>
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
        .contact {
            align-items: center;
            margin-top: 20px;
            padding: 15px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            width: 100%;
        }

        .contact h2 {
            margin: 0 0 10px;
            font-size: 1.5em;
            color: #8B0000;
        }

        .contact p {
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
        <h1>Info</h1>
        <p>Cermati info berikut dari kami</p>
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
    <div class="Contact">
            <h2>Hubungi Kami:</h2>
            <p>Telepon      : 0881011274377</p>
            <p>Kantor Pusat : Petambakan, Banjarnegara, Jawa Tengah, Indonesia.</p>
            <p>Instagram    : @haafzh.h</p>
        </div>
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