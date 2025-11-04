<?php
include 'koneksi.php';
session_start();

$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM user WHERE id_user='$id'"));

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $nama = $_POST['nama_lengkap'];
    $role = $_POST['role'];
    $email = $_POST['email'];
    $status = $_POST['status_akun'];

    mysqli_query($conn, "UPDATE user SET 
        username='$username',
        nama_lengkap='$nama',
        role='$role',
        email='$email',
        status_akun='$status'
        WHERE id_user='$id'");

    echo "<script>
        alert('Data pengguna berhasil diperbarui!');
        window.location.href = 'kelola_user.php';
    </script>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Pengguna</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #007bff 0%, #00c6ff 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Poppins', sans-serif;
        }

        .card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 6px 25px rgba(0,0,0,0.1);
            width: 420px;
            padding: 30px;
            background-color: #fff;
            animation: fadeIn 0.5s ease-in-out;
        }

        .card h3 {
            color: #007bff;
            font-weight: 600;
            text-align: center;
            margin-bottom: 8px;
        }

        .card p {
            text-align: center;
            color: #6c757d;
            font-size: 14px;
            margin-bottom: 20px;
        }

        label {
            font-weight: 500;
            color: #333;
            margin-bottom: 5px;
        }

        input, select {
            border-radius: 10px !important;
            font-size: 14px;
            padding: 10px;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
            font-weight: 600;
            padding: 10px;
            border-radius: 10px;
            transition: 0.3s;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .btn-secondary {
            border-radius: 10px;
            font-weight: 500;
        }

        @keyframes fadeIn {
            from {opacity: 0; transform: translateY(-10px);}
            to {opacity: 1; transform: translateY(0);}
        }
    </style>
</head>
<body>
    <div class="card">
        <h3>Edit Data Pengguna</h3>
        <p>Perbarui informasi pengguna di bawah ini</p>

        <form method="POST">
            <div class="mb-3">
                <label>Username</label>
                <input type="text" name="username" value="<?= $data['username']; ?>" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Nama Lengkap</label>
                <input type="text" name="nama_lengkap" value="<?= $data['nama_lengkap']; ?>" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Role</label>
                <select name="role" class="form-select" required>
                    <option value="<?= $data['role']; ?>"><?= ucfirst($data['role']); ?></option>
                    <option value="admin">Admin</option>
                    <option value="dosen">Dosen</option>
                    <option value="mahasiswa">Mahasiswa</option>
                    <option value="kaprodi">Kaprodi</option>
                </select>
            </div>

            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" value="<?= $data['email']; ?>" class="form-control">
            </div>

            <div class="mb-4">
                <label>Status Akun</label>
                <select name="status_akun" class="form-select">
                    <option value="<?= $data['status_akun']; ?>"><?= ucfirst($data['status_akun']); ?></option>
                    <option value="aktif">Aktif</option>
                    <option value="nonaktif">Nonaktif</option>
                </select>
            </div>

            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                <a href="kelola_user.php" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</body>
</html>
