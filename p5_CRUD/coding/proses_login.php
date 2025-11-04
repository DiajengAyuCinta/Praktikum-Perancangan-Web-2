<?php
session_start();
include "koneksi.php";
$username = $_POST['username'];
$password = $_POST['password'];

$sql ="select * from user where username ='$username'";
$result = $conn->query($sql);

if ($result->num_rows) {
    $row= $result->fetch_assoc();

    if ($password == $row['password']){
    $_SESSION['id_user'] = $row['id_user'];
        $_SESSION['username'] = $row['username'];
        $_SESSION['nama_lengkap'] = $row['nama_lengkap'];
        $_SESSION['role'] = $row['role'];


        if ($row['role'] == 'admin'){
            header("Location: dashboard.php");
        } elseif ($row['role'] == 'mahasiswa') {           
                header("Location: dashboard_mahasiswa.php");
        } else if ($row['role'] == 'dosen') {                
                    header("Location: dashboard_dosen.php");                
        }
        }
        } else {
            echo "<script>alert('Password Salah!'); window.location='1login.html';</script>";
}

$conn->close();
?>


