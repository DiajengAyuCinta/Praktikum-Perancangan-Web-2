<?php
include "koneksi.php";

require __DIR__ . '/vendor/autoload.php';

use Mpdf\Mpdf;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

    $q = mysqli_query($conn, "
    SELECT username, nama_lengkap, role, email, status_akun FROM user
    $whereSQL
");

    $html = '
    <style>
    body { font-family: Arial; font-size: 10pt; }
    h2 { text-align:center; }
    table { border-collapse: collapse; width:100%; }
    th, td { border: 1px solid #000; padding: 6px; }
    th { background-color: #f2f2f2; }
    </style>

    <h2>LAPORAN DATA PENGGUNA</h2>

    <table>
    <thead>
    <tr>
        <th>No</th>
        <th>Username</th>
        <th>Nama Lengkap</th>
        <th>role</th>
        <th>Email</th>
        <th>Status Akun</th>
    </tr>
    </thead>
    <tbody>
    ';

$no = 1;
while ($r = mysqli_fetch_assoc($q)) {
    $html .= '
    <tr>
        <td>'.$no++.'</td>
        <td>'.$r['username'].'</td>
        <td>'.$r['nama_lengkap'].'</td>
        <td>'.$r['role'].'</td>
        <td>'.$r['email'].'</td>
        <td>'.$r['status_akun'].'</td>
    </tr>
    ';
}

$html .= '</tbody></table>';
if (!is_dir('tmp')) mkdir('tmp');
$path = 'tmp/Laporan_Data_Pengguna.pdf';

$mpdf = new Mpdf([
    'orientation' => 'L',
    'format' => 'A4'
]);

$mpdf->WriteHTML($html);
$mpdf->Output($path, 'F');
$mail = new PHPMailer(true);
try {
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'diajencinta@gmail.com';
    $mail->Password   = 'qbqepxqmbfrjpnot';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;

    $mail->setFrom('diajencinta@gmail.com', 'APK ABSENSI MAHASISWA');
    $mail->addAddress('diajencinta@gmail.com');

    $mail->Subject = 'Laporan Data Pengguna';
    $mail->Body    = 'Terlampir laporan data pengguna dalam format PDF.';
    $mail->addAttachment($path);

    $mail->send();
    $status = 'success';

} catch (Exception $e) {
    $status = 'error';
}

unlink($path);
header("Location: /p10_mpdf/kelola_data_pengguna.php?status=$status");
exit;
