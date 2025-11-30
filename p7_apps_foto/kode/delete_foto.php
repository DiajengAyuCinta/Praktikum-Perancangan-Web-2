<?php
include('koneksi.php');
$del = $_GET['del'];

$perintah2 = "SELECT * FROM upload_file_gambar where id_file = '$del'";
$a = mysqli_query($conn, $perintah2);
$b = mysqli_fetch_array($a);

if ($b && file_exists($b['file_path'])) {
    unlink($b['file_path']);
}

$perintah1 = "DELETE FROM upload_file_gambar WHERE id_file = '$del'";
$del2 = mysqli_query($conn, $perintah1);


if ($del2) {
    echo "Gambar berhasil dihapus<br/>
    <a href = 'tampil_foto.php'>Kembali</a>";
}else{
    echo "Gagal menghapus data:" . mysqli_error($conn);
}
?>