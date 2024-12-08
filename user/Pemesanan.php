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
    <title>Pemesanan Kendaraan</title>
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

        form {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
        }

        form input, form select, form textarea {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        form button {
            background-color: #8B0000;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        form button:hover {
            background-color: #A52A2A;
        }

        footer {
            background: linear-gradient(to top, #8B0000, #A52A2A);
            color: white;
            text-align: center;
            padding: 10px 0;
            position: relative;
            bottom: 0;
            width: 100%;
            box-shadow: 0 -2px 10px rgba(0, 0, 0,          0.2);
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
    <h1>Pemesanan Kendaraan</h1>
    <p>Cermati persyaratan wajib sebelum memesan di halaman info</p>
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
    <?php if (isset($_SESSION['message'])): ?>
        <div class="alert">
            <p><?php echo $_SESSION['message']; ?></p>
        </div>
        <?php unset($_SESSION['message']); // Hapus pesan setelah ditampilkan ?>
    <?php endif; ?>

    <form action="proses_pemesanan.php" method="POST">
        <input type="text" name="namalengkap" placeholder="Nama Lengkap" required>
        <input type="text" name="nik" placeholder="NIK" required>
        <input type="text" name="nokk" placeholder="No-KK" required>
        <textarea name="alamat" placeholder="Alamat" required></textarea>
        
        <label for="jenis_kelamin">Jenis Kelamin:</label>
        <select name="jenis_kelamin" id="jenis_kelamin" required>
            <option value="L">Laki-laki</option>
            <option value="P">Perempuan</option>
        </select>

        <label for="kendaraan">Pilih Kendaraan:</label>
        <select name="kendaraan" id="kendaraan" required>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <option value="<?php echo $row['id']; ?>" data-harga="<?php echo $row['harga']; ?>">
                    <?php echo $row['jenis'] . ' - ' . $row['seri']; ?>
                </option>
            <?php endwhile; ?>
        </select>

        <input type="number" name="durasisewa" placeholder="Durasi Sewa (hari)" required>
        <input type="text" name="total_pembayaran" id="total_pembayaran" placeholder="Total Pembayaran" readonly>

        <button type="submit">Pesan Sekarang</button>
    </form>
</div>

<footer>
    <p>&copy; 2024 Fizhh Rental. Semua hak dilindungi.</p>
</footer>

<script>
    function toggleMenu() {
        const navLinks = document.querySelector('.nav-links');
        navLinks.classList.toggle('active');
    }

    const kendaraanSelect = document.getElementById('kendaraan');
    const totalPembayaranInput = document.getElementById('total_pembayaran');
    const durasiSewaInput = document.querySelector('input[name="durasisewa"]');

    function calculateTotal() {
        const selectedOption = kendaraanSelect.options[kendaraanSelect.selectedIndex];
        const harga = selectedOption.getAttribute('data-harga');
        const durasi = durasiSewaInput.value;
        totalPembayaranInput.value = harga * durasi;
    }

    kendaraanSelect.addEventListener('change', calculateTotal);
    durasiSewaInput.addEventListener('input', calculateTotal);
</script>

</body>
</html>