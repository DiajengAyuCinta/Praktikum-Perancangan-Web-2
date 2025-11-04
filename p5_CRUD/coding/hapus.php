<?php
include 'koneksi.php';

if (isset($_GET['hapus'])) {
    $id_user = $_GET['hapus'];

    $cek = mysqli_query($conn, "SELECT * FROM user WHERE id_user='$id_user'");
    if (mysqli_num_rows($cek) > 0) {
        if (mysqli_query($conn, "DELETE FROM user WHERE id_user='$id_user'")) {
            echo "<script>
                alert('Data pengguna berhasil dihapus!');
                window.location.href='kelola_user.php';
            </script>";
        } else {
            echo "<script>
                alert('Gagal menghapus data: " . mysqli_error($conn) . "');
                window.location.href='kelola_user.php';
            </script>";
        }
    } else {
        echo "<script>
            alert('Data tidak ditemukan!');
            window.location.href='kelola_user.php';
        </script>";
    }
    exit;
} else {
    header('Location: kelola_user.php');
    exit;
}
?>
