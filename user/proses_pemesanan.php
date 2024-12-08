<?php
session_start();
include '../koneksi/koneksi.php'; // Pastikan Anda memiliki file koneksi.php yang berisi koneksi ke database

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form
    $namalengkap = $_POST['namalengkap'];
    $nik = $_POST['nik'];
    $nokk = $_POST['nokk'];
    $alamat = $_POST['alamat'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $total_pembayaran = $_POST['total_pembayaran'];

    // Simpan data ke dalam tabel tbpemesanan
    $query = "INSERT INTO tbpemesanan (namalengkap, nik, nokk, alamat, jenis_kelamin, total_pembayaran) 
              VALUES ('$namalengkap', '$nik', '$nokk', '$alamat', '$jenis_kelamin', '$total_pembayaran')";

    if (mysqli_query($conn, $query)) {
        // Jika berhasil, set pesan sukses
        $_SESSION['message'] = "Pemesanan berhasil! Terima kasih. Silahkan datang ke kantor pusat kami untuk informasi lebih lanjut. ";
    } else {
        // Jika gagal, set pesan error
        $_SESSION['message'] = "Pemesanan gagal: " . mysqli_error($conn);
    }

    // Redirect kembali ke pemesanan.php
    header("Location: Pemesanan.php");
    exit();
}
?>