<?php
header("Content-Type: application/json");
include "koneksi.php";

parse_str(file_get_contents("php://input"), $data);

$required = [
    'id_user',
    'username',
    'password',
    'nama_lengkap',
    'prodi',
    'role',
    'email',
    'status_akun'
];

foreach ($required as $field) {
    if (!isset($data[$field]) || $data[$field] === '') {
        echo json_encode([
            "status" => "error",
            "message" => "Field '$field' wajib diisi"
        ]);
        exit;
    }
}

$id_user      = $data['id_user'];
$username     = $data['username'];
$password     = $data['password'];
$nama_lengkap = $data['nama_lengkap'];
$prodi        = $data['prodi'];
$role         = $data['role'];
$email        = $data['email'];
$status_akun  = $data['status_akun'];

$query = mysqli_query($conn,
    "UPDATE user SET
        username     = '$username',
        password     = '$password',
        nama_lengkap = '$nama_lengkap',
        prodi        = '$prodi',
        role         = '$role',
        email        = '$email',
        status_akun  = '$status_akun'
     WHERE id_user = '$id_user'"
);

if ($query) {
    echo json_encode([
        "status" => "success",
        "message" => "Data user berhasil diupdate"
    ]);
} else {
    echo json_encode([
        "status" => "error",
        "message" => mysqli_error($conn)
    ]);
}

