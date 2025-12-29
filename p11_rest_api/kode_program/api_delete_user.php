<?php
header("Content-Type: application/json");
include "koneksi.php";

parse_str(file_get_contents("php://input"), $_DELETE);

if (!isset($_DELETE['id_user'])) {
    echo json_encode([
        "status" => "error",
        "message" => "id_user wajib diisi"
    ]);
    exit;
}

$id_user = $_DELETE['id_user'];

$query = mysqli_query($conn,
    "DELETE FROM user WHERE id_user = '$id_user'"
);

if ($query) {
    echo json_encode([
        "status" => "success",
        "message" => "Data user berhasil dihapus"
    ]);
} else {
    echo json_encode([
        "status" => "error",
        "message" => mysqli_error($conn)
    ]);
}

