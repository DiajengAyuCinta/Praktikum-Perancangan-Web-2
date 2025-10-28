<?php
include'koneksi.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
$id_pengguna = $_POST['id_pengguna'];
$username = $_POST['username'];
$password = $_POST['password'];
$role = $_POST['role'];
$nama = $_POST['nama'];


$query = "INSERT INTO pengguna (id_pengguna, username, password, role, nama) VALUES ('$id_pengguna','$username', '$password', '$role', '$nama')";

if (mysqli_query($conn, $query)) {
    echo "<script>
            alert('Data pengguna berhasil disimpan!');
            window.location.href='form_tambah_pengguna.html';
          </script>";
} else {
    echo "<script>
            alert('Gagal menyimpan data: " . $conn->error . "');
            window.history.back();
          </script>";
}
}
mysqli_close($conn);
?>

