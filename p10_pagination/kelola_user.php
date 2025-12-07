<?php
include 'koneksi.php';
include 'pagination.php';
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: dashboard.php");
    exit;
}

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kelola Pengguna | Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        body {
            background-color: #f4f6f9;
            font-family: 'Poppins', sans-serif;
        }
        .page-header {
            background-color: #0d6efd;
            color: white;
            border-radius: 12px;
            padding: 20px 30px;
            margin-bottom: 30px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        .table {
            background-color: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
        }
        .table th {
            background-color: #0d6efd;
            color: white;
            text-align: center;
        }
        .table-hover tbody tr:hover {
            background-color: #f1f7ff;
        }
        .btn {
            border-radius: 8px;
        }
        .back-btn {
            text-decoration: none;
            color: white;
            background-color: #6c757d;
            padding: 8px 15px;
            border-radius: 8px;
        }
        .back-btn:hover {
            background-color: #5a6268;
        }
    </style>
</head>
<body>
<div class="container mt-4">
    <div class="page-header d-flex justify-content-between align-items-center">
        <div>
            <h3 class="mb-0"><i data-lucide="users"></i> Kelola Data Pengguna</h3>
            <small>Panel Admin &rsaquo; Manajemen Pengguna</small>
        </div>
        <div>
            <a href="form_tambah_pengguna.html" class="btn btn-light text-primary fw-bold">
                <i data-lucide="user-plus"></i> Tambah Pengguna
            </a>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-hover align-middle text-center">
            <thead>
                <tr>
                    <th>No</th>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Nama Lengkap</th>
                    <th>Role</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                $pagination = paginate($conn, "SELECT * FROM user ORDER BY role ASC", 3);
                $data = $pagination['result'];
                if (mysqli_num_rows($data) > 0) {
                    while ($row = mysqli_fetch_assoc($data)) {
                ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $row['id_user']; ?></td>
                    <td><?= $row['username']; ?></td>
                    <td><?= $row['nama_lengkap']; ?></td>
                    <td><span class="badge bg-primary"><?= ucfirst($row['role']); ?></span></td>
                    <td><?= $row['email']; ?></td>
                    <td>
                        <?php if ($row['status_akun'] == 'aktif'): ?>
                            <span class="badge bg-success">Aktif</span>
                        <?php else: ?>
                            <span class="badge bg-danger">Nonaktif</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <a href="edit.php?id=<?= $row['id_user']; ?>" class="btn btn-warning btn-sm">
                            <i data-lucide="edit-3"></i> Edit
                        </a>
                        <a href="hapus.php?hapus=<?= $row['id_user'];?>" class="btn btn-danger btn-sm"
                           onclick="return confirm('Yakin ingin menghapus pengguna ini?')">
                            <i data-lucide="trash-2"></i> Hapus
                        </a>
                    </td>
                </tr>
                <?php 
                    } 
                } else {
                    echo "<tr><td colspan='8'>Tidak ada data pengguna.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    <?php
    $current = $pagination['page'];
    $total_pages = $pagination['total_pages'];
    echo '<nav><ul class="pagination justify-content-center">';

    if ($current > 1) {
        echo '<li class="page-item"><a class="page-link" href="?page='.($current-1).'">Previous</a></li>';
}

    for ($i = 1; $i <= $total_pages; $i++) {
        $active = ($i == $current) ? 'active' : '';
        echo '<li class="page-item '.$active.'"><a class="page-link" href="?page='.$i.'">'.$i.'</a></li>';
}

    if ($current < $total_pages) {
        echo '<li class="page-item"><a class="page-link" href="?page='.($current+1).'">Next</a></li>';
}
    echo '</ul></nav>';
?>

    <div class="text-end mt-3">
        <a href="dashboard.php" class="back-btn"><i data-lucide="arrow-left"></i> Kembali</a>
    </div>
</div>

<script>
    lucide.createIcons();
</script>
</body>
</html>
