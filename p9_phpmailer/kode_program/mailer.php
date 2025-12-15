<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

// create PHPMailer object
$mail = new PHPMailer(true);

try {
    // SMTP settings
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';        // ganti sesuai SMTP kamu
    $mail->SMTPAuth   = true;
    $mail->Username   = 'diajencinta@gmail.com';   // ganti email SMTP
    $mail->Password   = 'qbqepxqmbfrjpnot';         // ganti password SMTP / APP PASSWORD
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;

    // sender & receiver
    $mail->setFrom('diajencinta@gmail.com', 'APK Absensi Mahasiswa');
    $mail->addAddress('diajencinta@email.com', 'Diajeng Ayu Cinta');

    // OPTIONAL: Jika tidak butuh, hapus agar tidak error
    // $mail->addReplyTo('info@example.com', 'Information');
    // $mail->addCC('cc@example.com');
    // $mail->addBCC('bcc@example.com');

    // email content
    $mail->isHTML(true);
    $mail->Subject = 'Judul Email';
    $mail->Body    = '<b>Ini isi email dalam format HTML.</b>';
    $mail->AltBody = 'Ini versi teks biasa untuk email client yang tidak support HTML.';

    $mail->send();
    echo "Email berhasil dikirim!";
} catch (Exception $e) {
    echo "Email gagal dikirim. Error: {$mail->ErrorInfo}";
}
