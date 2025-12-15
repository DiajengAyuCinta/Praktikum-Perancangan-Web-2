<?php
session_start();
include "koneksi.php";

require 'vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT * FROM user WHERE username='$username'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    if ($password == $row['password']) {

        // Generate token verifikasi unik
        $token = bin2hex(random_bytes(32)); // 64 karakter

        // Simpan token ke tabel user
        $conn->query("UPDATE user SET email_token='$token' WHERE id_user='{$row['id_user']}'");

        // Buat URL verifikasi
        $url = "http://localhost/p9_phpmailer/verifikasi_login.php?token=".$token;

        // Kirim email
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'diajencinta@gmail.com';
            $mail->Password   = 'qbqepxqmbfrjpnot';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;

            $mail->setFrom('diajencinta@gmail.com', 'APK Absensi Mahasiswa');
            $mail->addAddress($row['email'], $row['Diajeng Ayu Cinta']);

            $mail->isHTML(true);
            $mail->Subject = 'Verifikasi Login Anda';
            $mail->Body    = "
                <h3>Verifikasi Login</h3>
                <p>Klik tombol di bawah ini untuk melanjutkan login:</p>
                <p><a href='$url' style='
                    display:inline-block;
                    background:#007bff;
                    color:white;
                    padding:10px 18px;
                    border-radius:8px;
                    text-decoration:none;
                '>VERIFIKASI LOGIN</a></p>
                <br>
                <p>Jika tidak bisa klik tombol, salin link berikut:</p>
                <small>$url</small>
            ";

            $mail->send();

            echo "<script>alert('Silakan cek email Anda untuk verifikasi login.'); window.location='1login.html';</script>";
            exit;

        } catch (Exception $e) {
            echo "Gagal mengirim email: {$mail->ErrorInfo}";
        }

    } else {
        echo "<script>alert('Password salah!'); window.location='1login.html';</script>";
    }

} else {
    echo "<script>alert('Username tidak ditemukan!'); window.location='1login.html';</script>";
}

$conn->close();
?>
