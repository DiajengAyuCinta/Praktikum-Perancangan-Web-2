<?php
include('koneksi.php');

$aran = $_POST['nama'];
$nama = true;

if ($_POST['nama'] == "") {
    echo "Nama masih kosong";
    $nama = false;
}

$cek = ($nama) ? true : false;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Hasil Upload</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #eef3ff;
            padding: 40px;
            text-align: center;
        }

        .container {
            width: 420px;
            margin: auto;
            background: #fff;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.15);
        }

        h2 {
            color: #4a6cf0;
            margin-bottom: 15px;
        }

        .success {
            color: #2e7d32;
            font-weight: bold;
            font-size: 18px;
            margin-bottom: 10px;
        }

        .error {
            color: #d32f2f;
            font-weight: bold;
            font-size: 18px;
            margin-bottom: 10px;
        }

        img {
            border-radius: 10px;
            margin-top: 10px;
            margin-bottom: 15px;
        }

        a {
            display: inline-block;
            margin-top: 15px;
            text-decoration: none;
            padding: 10px 15px;
            background: #4a6cf0;
            color: white;
            border-radius: 8px;
            transition: 0.3s;
        }

        a:hover {
            background: #3b57c0;
        }
    </style>

</head>
<body>

<div class="container">

<?php
if ($cek == true) {

    $file = $_FILES['foto']['name'];
    $tmp_dir = $_FILES['foto']['tmp_name'];
    $file_size = $_FILES['foto']['size'];

    $direktori = 'gambar/';
    $ektensi = strtolower(pathinfo($file, PATHINFO_EXTENSION));

    $valid_ektensi = array('jpeg', 'jpg', 'png', 'gif');
    $gambar = rand(1000, 1000000) . "." . $ektensi;

    if (in_array($ektensi, $valid_ektensi)) {

        if ($file_size < 5000000) {

            move_uploaded_file($tmp_dir, $direktori . $gambar);

            $file_name   = $_POST['nama'];
            $file_path   = $direktori . $gambar;
            $file_type   = $ektensi;
            $file_size   = $_FILES ['foto']['size'];
            $uploaded_at = date("Y-m-d H:i:s");

            $perintah = "INSERT INTO upload_file_gambar (file_name, file_path, file_type, file_size, uploaded_at) VALUES ('$file_name', '$file_path', '$file_type', '$file_size', '$uploaded_at')";
            $query = mysqli_query($conn, $perintah);

            if (!$query) {
                echo "Gagal menyimpan: " . mysqli_error($conn);
            } else {
                echo "Berhasil disimpan<br/>";
                echo "Nama: $aran <br/> <img src='$direktori$gambar' height='200'><br/>";
                echo "Berhasil disimpan<br>";
                echo "<a href='tampil_foto.php'>Lihat Halaman Berikutnya</a>";
            }

        } else {
            echo "Gambar terlalu besar (maksimal 1MB)<br/>";
            echo "<a href='input_foto.php'>Kembali</a>";
        }

    } else {
        echo "Gambar yang kamu upload tidak sesuai ekstensi<br/>";
        echo "<a href='input_foto.php'>Kembali</a>";
    }

}
?>