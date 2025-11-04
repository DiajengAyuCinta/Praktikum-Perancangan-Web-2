<?php
error_reporting(0); 
include "koneksi.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_user = $_POST['id_user'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $nama_lengkap = $_POST['nama_lengkap'];
    $role = $_POST['role'];
    $email = $_POST['email'];
    $status_akun = $_POST['status_akun'];

    // Query insert
    $query = "INSERT INTO `user` 
              (id_user, username, password, nama_lengkap, role, email, status_akun)
              VALUES ('$id_user', '$username', '$password', '$nama_lengkap', '$role', '$email', '$status_akun')";

    if (mysqli_query($conn, $query)) {
        echo "<script>
                alert('Data pengguna berhasil disimpan!');
                window.location.href = 'form_tambah_pengguna.html';
              </script>";
    } else {
        echo "<script>
                alert('Gagal menyimpan data: " . mysqli_error($conn) . "');
                window.history.back();
              </script>";
    }
}

mysqli_close($conn);
?>
