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
    $mail->Username   = 'emailkamu@gmail.com';   // ganti email SMTP
    $mail->Password   = '';         // ganti password SMTP / APP PASSWORD
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;

    // sender & receiver
    $mail->setFrom('emailkamu@gmail.com', 'nama_apk');
    $mail->addAddress('email_penerima@email.com', 'nama_penerima');

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

