<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rental Mobil - Fizh Rental</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column; /* Mengatur arah flex menjadi kolom */
            min-height: 100vh; /* Memastikan body setinggi viewport */
        }
        header {
            background: linear-gradient(to bottom, #8B0000, #B22222); /* Gradasi merah gelap */
            height: auto; /* Mengubah tinggi menjadi otomatis */
            padding: 20px; /* Menambahkan padding */
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: white;
            text-align: center;
        }
        .logo {
            width: 120px; /* Ukuran lebar logo */
            height: 120px; /* Ukuran tinggi logo */
            border-radius: 50%;
            background: url('img/LogoFizhCarRental.png') no-repeat center center/cover;
            margin-bottom: 10px;
            box-shadow: 0 0 15px rgba(255, 255, 255, 0.7); /* Efek cahaya */
        }
        .navbar {
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #7A0000; /* Merah lebih gelap */
            padding: 10px;
            position: relative;
        }
        .navbar a {
            color: white;
            text-decoration: none;
            padding: 14px 20px;
        }
        .navbar .menu {
            display: flex;
            flex-direction: row; /* Menjaga menu dalam satu baris */
        }
        .navbar .hamburger {
            display: none;
            cursor: pointer;
            margin-left: auto; /* Memindahkan hamburger ke kanan */
        }
        @media (max-width: 768px) {
            header {
                padding: 10px; /* Mengurangi padding di header untuk perangkat kecil */
            }
            .navbar .menu {
                display: none;
                flex-direction: column;
                width: 100%;
                position: absolute;
                top: 50px;
                left: 0;
                background-color: #7A0000; /* Merah lebih gelap */
                z-index: 1;
                align-items: center; /* Menyelaraskan item menu ke tengah */
            }
            .navbar .menu.active {
                display: flex;
            }
            .navbar .hamburger {
                display: block;
                font-size: 24px; /* Ukuran ikon hamburger */
                color: white; /* Warna ikon hamburger */
            }
            .navbar a {
                padding: 10px; /* Mengurangi padding di link navbar untuk perangkat kecil */
            }
        }
        .content {
            padding: 20px;
            text-align: center;
            flex: 1; /* Memungkinkan konten untuk mengisi ruang yang tersisa */
        }
        .content > div {
            display: none; /* Sembunyikan semua konten */
        }
        .content > .active {
            display: block; /* Tampilkan konten yang aktif */
        }
        footer {
            background-color: #7A0000; /* Merah lebih gelap */
            color: white;
            text-align: center;
            padding: 10px 0;
            width: 100%;
        }
        /* Efek gulir halus */
        html {
            scroll-behavior: smooth;
        }
    </style>
</head>
<body>

    <header>
        <div class="logo"></div>
        <h1>Selamat Datang di Rental Mobil Fizh Rental!</h1>
        <p>Temukan kendaraan impian Anda di sini!</p>
        <p>Kami menyediakan berbagai pilihan mobil untuk memenuhi kebutuhan Anda.</p>
    </header>

    <div class="navbar">
        <div class="menu" id="menu">
            <a href="#" onclick="showContent('home')">Beranda</a>
            <a href="#" onclick="showContent('about')">Tentang Kami</a>
            <a href="#" onclick="showContent('services')">Layanan</a>
            <a href="#" onclick="showContent('contact')">Kontak</a>
            <a href="#" onclick="showContent('gabung')">Gabung</a>
        </div>
        <div class="hamburger" onclick="toggleMenu()">
            <i class="fas fa-bars"></i>
        </div>
    </div>

    <div class="content">
        <div id="home" class="active">
            <h2>Beranda</h2>
            <p>Selamat datang di platform rental mobil kami. Kami siap membantu Anda menemukan mobil yang tepat.</p>
            <p>Untuk Informasi lebih lanjut silahkan login terlebih dahulu.</p>
        </div>
        <div id="about">
            <h2>Tentang Kami</h2>
            <p>Kami adalah penyedia layanan rental mobil yang berkomitmen untuk memberikan pengalaman terbaik bagi pelanggan.</p>
        </div>
        <div id="services">
            <h2>Layanan</h2>
            <p>Kami menawarkan berbagai jenis mobil untuk disewa, mulai dari mobil keluarga hingga mobil mewah.</p>
            <p>Apakah anda tertarik? Login sekarang juga!</p>
        </div>
        <div id="contact">
        <h2>Hubungi Kami:</h2>
            <p>Telepon      : 0881011274377</p>
            <p>Kantor Pusat : Petambakan, Banjarnegara, Jawa Tengah, Indonesia.</p>
            <p>Instagram    : @haafzh.h</p>
        </div>
        <div id="gabung">
        <h2>Ayo Bergabung Sekarang Juga!!!</h2>

<!-- Tombol Login -->
<a href="koneksi/login.php" class="login-button">Masuk</a>
<a href="koneksi/daftar.php" class="daftar-button">Daftar</a>

<style>
    .login-button {
        display: inline-block;
        margin-top: 20px;
        padding: 10px 15px;
        background-color: #8B0000; /* Warna merah gelap */
        color: white;
        border-radius: 5px;
        text-decoration: none;
        transition: background-color 0.3s;
    }
    .login-button:hover {
        background-color: #B22222; /* Warna merah lebih terang saat hover */
    }
    .daftar-button {
        display: inline-block;
        margin-top: 20px;
        padding: 10px 15px;
        background-color: #8B0000; /* Warna merah gelap */
        color: white;
        border-radius: 5px;
        text-decoration: none;
        transition: background-color 0.3s;
    }
    .daftar-button:hover {
        background-color: #B22222; /* Warna merah lebih terang saat hover */
    }
</style>
        </div>
    </div>

    <footer>
        <p>&copy;2024 Fizhh Rental. Semua hak dilindungi.</p>
    </footer>

    <script>
        function showContent(section) {
            const contents = document.querySelectorAll('.content > div');
            contents.forEach(content => {
                content.classList.remove('active');
            });
            document.getElementById(section).classList.add('active');
        }

        function toggleMenu() {
            const menu = document.getElementById('menu');
            menu.classList.toggle('active');
        }
    </script>
</body>
</html>