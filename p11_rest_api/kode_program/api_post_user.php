<?php
header("Content-Type: application/json");
include "koneksi.php";

$required = [
    'username','password','nama_lengkap','prodi','role','email','status_akun'
];

foreach ($required as $field) {
    if (!isset($_POST[$field]) || $_POST[$field] === '') {
        echo json_encode([
            "status" => "error",
            "message" => "Field '$field' wajib diisi"
        ]);
        exit;
    }
}

$username     = $_POST['username'];
$password     = $_POST['password'];
$nama_lengkap = $_POST['nama_lengkap'];
$prodi        = $_POST['prodi'];
$role         = $_POST['role'];
$email        = $_POST['email'];
$status_akun  = $_POST['status_akun'];

$query = mysqli_query($conn,
    "INSERT INTO user
     (username,password,nama_lengkap,prodi,role,email,status_akun) VALUES ('$username','$password','$nama_lengkap','$prodi','$role','$email','$status_akun')");

if ($query) {
    echo json_encode([
        "status" => "success",
        "id_user" => mysqli_insert_id($conn), // ⬅️ PENTING
        "message" => "User berhasil disimpan"
    ]);
} else {
    echo json_encode([
        "status" => "error",
        "message" => mysqli_error($conn)
    ]);
}
