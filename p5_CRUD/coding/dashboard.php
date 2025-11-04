<?php
include 'koneksi.php';
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

$nama_lengkap = $_SESSION['nama_lengkap'];
$role = $_SESSION['role'];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard | Absensi QR</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        body {
            background-color: #f4f6f9;
            font-family: 'Poppins', sans-serif;
            display: flex;
            min-height: 100vh;
        }
        .sidebar {
            width: 250px;
            background-color: #0d6efd;
            color: white;
            display: flex;
            flex-direction: column;
            padding: 20px;
            position: fixed;
            height: 100vh;
        }
        .sidebar h4 {
            margin-bottom: 30px;
            text-align: center;
            font-weight: bold;
        }
        .sidebar a {
            color: white;
            text-decoration: none;
            padding: 10px 15px;
            margin-bottom: 5px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            transition: 0.3s;
        }
        .sidebar a:hover, .sidebar a.active {
            background-color: #084298;
        }
        .sidebar i {
            margin-right: 10px;
        }
        .content {
            flex-grow: 1;
            padding: 40px;
            margin-left: 270px;
        }
        .logout-btn {
            margin-top: auto;
            background-color: #dc3545;
            text-align: center;
            border-radius: 8px;
            padding: 10px;
            color: white;
            text-decoration: none;
        }
        .logout-btn:hover {
            background-color: #bb2d3b;
        }
    </style>
</head>
<body>

<div class="sidebar">
    <h4>Absensi QR</h4>

    <?php if ($role == 'admin'): ?>
        <a href="kelola_user.php"><i data-lucide="users"></i>Kelola Pengguna</a>
        <a href="kelola_jadwal.php"><i data-lucide="calendar"></i>Kelola Jadwal</a>
        <a href="laporan.php"><i data-lucide="file-text"></i>Laporan</a>
        <a href="absensi/lihat_daftar.php"><i data-lucide="list"></i>Lihat Daftar Hadir</a>
        <a href="jurnal/input_jurnal.php"><i data-lucide="book-open"></i>Jurnal Perkuliahan</a>
        <a href="surat_dokter/upload_surat.php"><i data-lucide="file-up"></i>Upload Bukti Surat Dokter</a>

    <?php elseif ($role == 'dosen'): ?>
        <a href="qrcode/generate_qr.php"><i data-lucide="qrcode"></i>Generate QR Code</a>
        <a href="jurnal/input_jurnal.php"><i data-lucide="book-open"></i>Jurnal Perkuliahan</a>
        <a href="absensi/lihat_daftar.php"><i data-lucide="users"></i>Lihat Daftar Hadir</a>

    <?php elseif ($role == 'mahasiswa'): ?>
        <a href="absensi/scan_qr.php"><i data-lucide="scan-line"></i>Scan QR Absensi</a>
        <a href="absensi/riwayat_absensi.php"><i data-lucide="clock"></i>Riwayat Absensi</a>
        <a href="surat_dokter/upload_surat.php"><i data-lucide="file-up"></i>Upload Bukti Surat Dokter</a>

    <?php elseif ($role == 'kaprodi'): ?>
        <a href="jurnal/verifikasi_jurnal.php"><i data-lucide="check-circle"></i>Verifikasi Jurnal</a>
        <a href="laporan.php"><i data-lucide="file-text"></i>Laporan Absensi</a>
    <?php endif; ?>

    <a href="logout.php" class="logout-btn"><i data-lucide="log-out"></i>Logout</a>
</div>

<div class="content">
    <h3 class="fw-bold text-primary mb-3">Selamat Datang, <?= $nama_lengkap; ?>!</h3>
    <p class="text-muted">Anda login sebagai <strong><?= ucfirst($role); ?></strong> di Aplikasi Absensi Mahasiswa Berbasis QR Code.</p>

    <div class="alert alert-info mt-4" role="alert">
        <i data-lucide="info"></i> Silakan pilih menu di sebelah kiri untuk melanjutkan.
    </div>
</div>

<script>
    lucide.createIcons();
</script>
</body>
</html>
