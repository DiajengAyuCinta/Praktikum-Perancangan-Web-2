<?php
session_start();
include "koneksi.php";

if (!isset($_GET['token'])) {
    die("Token tidak ditemukan.");
}

$token = $_GET['token'];

// Cari user berdasarkan token
$sql = "SELECT * FROM user WHERE email_token='$token'";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();

    // Hapus token agar tidak bisa digunakan dua kali
    $conn->query("UPDATE user SET email_token=NULL WHERE id_user='{$row['id_user']}'");

    // Set session login
    $_SESSION['id_user'] = $row['id_user'];
    $_SESSION['username'] = $row['username'];
    $_SESSION['nama_lengkap'] = $row['nama_lengkap'];
    $_SESSION['role'] = $row['role'];

    // Arahkan sesuai role
    if ($row['role'] == 'admin') {
        header("Location: dashboard_admin.html");
    } elseif ($row['role'] == 'dosen') {
        header("Location: dashboard_dosen.php");
    } elseif ($row['role'] == 'mahasiswa') {
        header("Location: dashboard_mahasiswa.php");
    } elseif ($row['role'] == 'kaprodi') {
        header("Location: dashboard_kaprodi.php");
    }
    exit;

} else {
    echo "<script>alert('Token tidak valid atau sudah kadaluarsa!'); window.location='1login.html';</script>";
}
?>


