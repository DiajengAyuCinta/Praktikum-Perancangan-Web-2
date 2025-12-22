<?php
include "koneksi.php";

$query = mysqli_query($conn, "SELECT * FROM user");
?>

<?php
if (isset($_GET['status'])) {
    if ($_GET['status'] === 'success') {
        echo "<script>alert('Laporan berhasil dikirim ke email!');</script>";
    } elseif ($_GET['status'] === 'error') {
        echo "<script>alert('Gagal mengirim laporan ke email!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kelola Data Pengguna - Sistem Absensi QR</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap">
  <style>
    :root {
      --primary: #4361ee;
      --primary-light: #4895ef;
      --secondary: #3f37c9;
      --success: #2ecc71;
      --warning: #ff9e00;
      --danger: #f72585;
      --info: #4cc9f0;
      --light: #f8f9fa;
      --dark: #212529;
      --gray: #6c757d;
      --light-gray: #e9ecef;
      --sidebar-width: 260px;
      --card-radius: 12px;
      --transition: all 0.3s ease;
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Poppins', sans-serif;
    }

    body {
      background-color: #f5f7fb;
      color: var(--dark);
      overflow-x: hidden;
      min-height: 100vh;
      display: flex;
    }

    /* Sidebar Styling */
    .sidebar {
      width: var(--sidebar-width);
      background: linear-gradient(180deg, var(--primary), var(--secondary));
      color: white;
      padding: 25px 0;
      height: 100vh;
      position: sticky;
      top: 0;
      box-shadow: 5px 0 15px rgba(0, 0, 0, 0.1);
      display: flex;
      flex-direction: column;
      z-index: 100;
    }

    .sidebar-header {
      display: flex;
      align-items: center;
      padding: 0 25px;
      margin-bottom: 40px;
    }

    .logo {
      display: flex;
      align-items: center;
      gap: 12px;
    }

    .logo-icon {
      font-size: 28px;
      background: rgba(255, 255, 255, 0.2);
      width: 45px;
      height: 45px;
      border-radius: 10px;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .logo-text h3 {
      font-size: 20px;
      font-weight: 700;
    }

    .logo-text p {
      font-size: 12px;
      opacity: 0.8;
    }

    .profile {
      display: flex;
      align-items: center;
      gap: 15px;
      padding: 0 25px;
      margin-bottom: 40px;
    }

    .profile-img {
      width: 50px;
      height: 50px;
      border-radius: 50%;
      background: linear-gradient(45deg, #4cc9f0, #4361ee);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 22px;
      font-weight: 600;
      box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
    }

    .profile-info h4 {
      font-size: 16px;
      font-weight: 600;
      margin-bottom: 3px;
    }

    .profile-info p {
      font-size: 12px;
      opacity: 0.8;
      background: rgba(255, 255, 255, 0.15);
      padding: 2px 8px;
      border-radius: 20px;
      display: inline-block;
    }

    .sidebar-menu {
      flex-grow: 1;
      padding: 0 15px;
    }

    .sidebar-menu a {
      display: flex;
      align-items: center;
      padding: 15px 20px;
      color: rgba(255, 255, 255, 0.8);
      text-decoration: none;
      white-space: nowrap;
      border-radius: 10px;
      margin-bottom: 10px;
      gap: 6px;
      transition: var(--transition);
    }

    .sidebar-menu a:hover {
      background: rgba(255, 255, 255, 0.15);
      color: white;
    }

    .sidebar-menu a.active {
      background: rgba(255, 255, 255, 0.2);
      color: white;
      box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
    }

    .sidebar-menu a i {
      font-size: 20px;
      width: 30px;
    }

    .sidebar-footer {
      padding: 25px;
      border-top: 1px solid rgba(255, 255, 255, 0.1);
    }

    .logout-btn {
      display: flex;
      align-items: center;
      gap: 15px;
      color: white;
      background: rgba(255, 255, 255, 0.1);
      border: none;
      padding: 15px 20px;
      border-radius: 10px;
      width: 100%;
      cursor: pointer;
      transition: var(--transition);
      font-size: 16px;
    }

    .logout-btn:hover {
      background: rgba(255, 255, 255, 0.2);
      transform: translateY(-2px);
    }

    /* Main Content */
    .main {
      flex-grow: 1;
      padding: 30px;
      display: flex;
      flex-direction: column;
      min-height: 100vh;
    }

    .content-wrapper {
      flex-grow: 1;
    }

    .header {
      margin-bottom: 30px;
      padding-bottom: 20px;
      border-bottom: 1px solid var(--light-gray);
    }

    .header h2 {
      font-size: 28px;
      font-weight: 700;
      color: var(--dark);
      margin-bottom: 5px;
    }

    .header p {
      color: var(--gray);
      font-size: 15px;
    }

    /* Summary Cards */
    .summary {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
      gap: 20px;
      margin-bottom: 30px;
    }

    .summary-card {
      background: white;
      border-radius: var(--card-radius);
      padding: 25px;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
      transition: var(--transition);
      position: relative;
      overflow: hidden;
      border-left: 5px solid var(--primary);
    }

    .summary-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
    }

    .summary-card:nth-child(1) { border-left-color: #4361ee; }
    .summary-card:nth-child(2) { border-left-color: #4cc9f0; }
    .summary-card:nth-child(3) { border-left-color: #f72585; }
    .summary-card:nth-child(4) { border-left-color: #7209b7; }

    .summary-card-icon {
      position: absolute;
      top: 25px;
      right: 25px;
      font-size: 40px;
      opacity: 0.2;
      color: inherit;
    }

    .summary-card p {
      color: var(--gray);
      font-size: 14px;
      margin-bottom: 10px;
      font-weight: 500;
    }

    .summary-card h3 {
      font-size: 32px;
      font-weight: 700;
      color: var(--dark);
      margin-bottom: 5px;
    }

    .summary-card .trend {
      font-size: 13px;
      display: flex;
      align-items: center;
      gap: 5px;
    }

    .summary-card .trend.up {
      color: #2ecc71;
    }

    /* Action Bar */
    .action-bar {
      background: white;
      border-radius: var(--card-radius);
      padding: 25px;
      margin-bottom: 30px;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
      display: flex;
      justify-content: space-between;
      align-items: center;
      flex-wrap: wrap;
      gap: 15px;
    }

    .action-left, .action-right {
      display: flex;
      align-items: center;
      gap: 15px;
      flex-wrap: wrap;
    }

    .btn-primary {
      background: linear-gradient(to right, var(--primary), var(--secondary));
      color: white;
      border: none;
      padding: 12px 24px;
      border-radius: 8px;
      font-weight: 500;
      cursor: pointer;
      display: flex;
      align-items: center;
      gap: 8px;
      transition: var(--transition);
    }

    .btn-primary:hover {
      transform: translateY(-2px);
      box-shadow: 0 5px 15px rgba(67, 97, 238, 0.3);
    }

    .search-input {
      position: relative;
    }

    .search-input i {
      position: absolute;
      left: 15px;
      top: 50%;
      transform: translateY(-50%);
      color: var(--gray);
    }

    .search-input input {
      padding: 12px 15px 12px 45px;
      border: 2px solid var(--light-gray);
      border-radius: 8px;
      font-size: 15px;
      width: 350px;
      transition: var(--transition);
    }

    .search-input input:focus {
      border-color: var(--primary);
      outline: none;
      box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.1);
    }

    .action-right select {
      padding: 12px 15px;
      border: 2px solid var(--light-gray);
      border-radius: 8px;
      font-size: 15px;
      background: white;
      min-width: 150px;
      transition: var(--transition);
    }

    .action-right select:focus {
      border-color: var(--primary);
      outline: none;
      box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.1);
    }

    /* Table Container */
    .table-container {
      background: white;
      border-radius: var(--card-radius);
      overflow: hidden;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
      margin-bottom: 30px;
    }

    .table-header {
      padding: 20px 25px;
      border-bottom: 1px solid var(--light-gray);
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .table-header h3 {
      font-size: 18px;
      color: var(--dark);
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .table-header h3 i {
      color: var(--primary);
    }

    .total-entries {
      font-size: 14px;
      color: var(--gray);
    }

    table {
      width: 100%;
      border-collapse: collapse;
    }

    thead {
      background-color: #f8f9fa;
    }

    th {
      padding: 18px 15px;
      text-align: left;
      font-weight: 600;
      color: var(--dark);
      border-bottom: 2px solid var(--light-gray);
      font-size: 14px;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }

    th i {
      margin-left: 5px;
      color: var(--gray);
      cursor: pointer;
    }

    tbody tr {
      border-bottom: 1px solid var(--light-gray);
      transition: var(--transition);
    }

    tbody tr:hover {
      background-color: #f8f9fa;
    }

    td {
      padding: 18px 15px;
      color: var(--dark);
      font-size: 14px;
    }

    .role {
      display: inline-block;
      padding: 6px 12px;
      border-radius: 20px;
      font-size: 12px;
      font-weight: 600;
      text-align: center;
      min-width: 90px;
    }

    .role.mahasiswa {
      background-color: rgba(67, 97, 238, 0.15);
      color: #4361ee;
    }

    .role.dosen {
      background-color: rgba(76, 201, 240, 0.15);
      color: #4cc9f0;
    }

    .role.admin {
      background-color: rgba(247, 37, 133, 0.15);
      color: #f72585;
    }

    .role.kaprodi {
      background-color: rgba(114, 9, 183, 0.15);
      color: #7209b7;
    }

    .status {
      display: inline-block;
      padding: 6px 12px;
      border-radius: 20px;
      font-size: 12px;
      font-weight: 600;
      text-align: center;
      min-width: 90px;
    }

    .status.active {
      background-color: rgba(46, 204, 113, 0.15);
      color: #2ecc71;
    }

    .status.inactive {
      background-color: rgba(108, 117, 125, 0.15);
      color: #6c757d;
    }

    .status.pending {
      background-color: rgba(255, 158, 0, 0.15);
      color: #ff9e00;
    }

    .actions {
      display: flex;
      gap: 8px;
    }

    .action-btn {
      width: 36px;
      height: 36px;
      border-radius: 8px;
      border: none;
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      transition: var(--transition);
      background: var(--light-gray);
      color: var(--gray);
    }

    .action-btn:hover {
      transform: translateY(-2px);
    }

    .action-btn.edit:hover {
      background: var(--primary);
      color: white;
    }

    .action-btn.delete:hover {
      background: var(--danger);
      color: white;
    }

    .action-btn.reset:hover {
      background: var(--warning);
      color: white;
    }

    .action-btn.view:hover {
      background: var(--info);
      color: white;
    }

    /* Pagination */
    .table-footer {
      padding: 20px 25px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      border-top: 1px solid var(--light-gray);
      background: #f8f9fa;
    }

    .pagination-info {
      font-size: 14px;
      color: var(--gray);
    }

    .pagination {
      display: flex;
      gap: 8px;
    }

    .pagination-btn {
      padding: 8px 15px;
      border: 1px solid var(--light-gray);
      background: white;
      border-radius: 6px;
      cursor: pointer;
      transition: var(--transition);
      font-weight: 500;
      color: var(--dark);
    }

    .pagination-btn:hover:not(.disabled) {
      background: var(--primary);
      color: white;
      border-color: var(--primary);
    }

    .pagination-btn.active {
      background: var(--primary);
      color: white;
      border-color: var(--primary);
    }

    .pagination-btn.disabled {
      opacity: 0.5;
      cursor: not-allowed;
    }

    /* Footer */
    .main-footer {
      margin-top: auto;
      padding-top: 30px;
      border-top: 1px solid var(--light-gray);
      color: var(--gray);
      font-size: 14px;
    }

    .footer-content {
      display: flex;
      justify-content: space-between;
      align-items: center;
      flex-wrap: wrap;
      gap: 20px;
    }

    .footer-links {
      display: flex;
      gap: 20px;
    }

    .footer-links a {
      color: var(--gray);
      text-decoration: none;
      transition: var(--transition);
    }

    .footer-links a:hover {
      color: var(--primary);
    }

    .footer-copyright {
      text-align: center;
      padding-top: 15px;
      border-top: 1px solid var(--light-gray);
      margin-top: 20px;
      font-size: 13px;
    }

    /* Modal */
    .modal {
      display: none;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0, 0, 0, 0.5);
      z-index: 1000;
      justify-content: center;
      align-items: center;
      padding: 20px;
    }

    .modal-content {
      background: white;
      border-radius: var(--card-radius);
      width: 100%;
      max-width: 600px;
      max-height: 90vh;
      overflow-y: auto;
      box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
    }

    .modal-header {
      padding: 25px 30px;
      border-bottom: 1px solid var(--light-gray);
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .modal-header h3 {
      font-size: 20px;
      color: var(--dark);
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .close-modal {
      background: none;
      border: none;
      font-size: 24px;
      color: var(--gray);
      cursor: pointer;
      transition: var(--transition);
    }

    .close-modal:hover {
      color: var(--danger);
    }

    .modal-body {
      padding: 30px;
    }

    .form-group {
      margin-bottom: 20px;
    }

    .form-group label {
      display: block;
      margin-bottom: 8px;
      font-weight: 500;
      color: var(--dark);
    }

    .form-group input,
    .form-group select {
      width: 100%;
      padding: 12px 15px;
      border: 2px solid var(--light-gray);
      border-radius: 8px;
      font-size: 15px;
      transition: var(--transition);
    }

    .form-group input:focus,
    .form-group select:focus {
      border-color: var(--primary);
      outline: none;
      box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.1);
    }

    .form-row {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 20px;
    }

    .modal-footer {
      padding: 20px 30px;
      border-top: 1px solid var(--light-gray);
      display: flex;
      justify-content: flex-end;
      gap: 15px;
    }

    .btn-secondary {
      background: var(--light-gray);
      color: var(--dark);
      border: none;
      padding: 12px 24px;
      border-radius: 8px;
      font-weight: 500;
      cursor: pointer;
      transition: var(--transition);
    }

    .btn-secondary:hover {
      background: #dee2e6;
    }

    /* Empty State */
    .empty-state {
      text-align: center;
      padding: 60px 20px;
    }

    .empty-icon {
      font-size: 60px;
      color: var(--light-gray);
      margin-bottom: 20px;
    }

    .empty-state h4 {
      font-size: 18px;
      color: var(--gray);
      margin-bottom: 10px;
    }

    .empty-state p {
      color: var(--gray);
      margin-bottom: 20px;
    }

    /* Responsive */
    @media (max-width: 1200px) {
      .sidebar {
        width: 80px;
        padding: 20px 0;
      }
      
      .logo-text, .profile-info, .sidebar-menu span {
        display: none;
      }
      
      .logo, .profile {
        justify-content: center;
      }
      
      .sidebar-menu a {
        justify-content: center;
        padding: 15px;
      }
      
      .sidebar-footer {
        padding: 15px;
      }
      
      .logout-btn span {
        display: none;
      }
      
      .main {
        margin-left: 0;
      }
    }

    @media (max-width: 992px) {
      .action-bar {
        flex-direction: column;
        align-items: stretch;
      }
      
      .action-left, .action-right {
        justify-content: center;
      }
      
      .search-input input {
        width: 100%;
      }
      
      .form-row {
        grid-template-columns: 1fr;
      }
    }

    @media (max-width: 768px) {
      body {
        flex-direction: column;
      }
      
      .sidebar {
        width: 100%;
        height: auto;
        position: relative;
        padding: 15px 0;
      }
      
      .sidebar-header, .profile {
        display: none;
      }
      
      .sidebar-menu {
        display: flex;
        overflow-x: auto;
        padding: 0 15px;
      }
      
      .sidebar-menu a {
        flex-shrink: 0;
        margin-bottom: 0;
        margin-right: 10px;
      }
      
      .sidebar-footer {
        display: none;
      }
      
      .main {
        padding: 20px;
      }
      
      .summary {
        grid-template-columns: repeat(2, 1fr);
      }
      
      .table-footer {
        flex-direction: column;
        gap: 15px;
      }
      
      .footer-content {
        flex-direction: column;
        text-align: center;
      }
      
      table {
        display: block;
        overflow-x: auto;
      }
    }

    @media (max-width: 576px) {
      .header h2 {
        font-size: 24px;
      }
      
      .summary {
        grid-template-columns: 1fr;
      }
      
      .action-left, .action-right {
        flex-direction: column;
        width: 100%;
      }
      
      .search-input input, .action-right select {
        width: 100%;
      }
    }
  </style>
</head>
<body>
  <!-- Sidebar -->
  <div class="sidebar">
    <div class="sidebar-header">
      <div class="logo">
        <div class="logo-icon">
          <i class="fas fa-qrcode"></i>
        </div>
        <div class="logo-text">
          <h3>AbsensiQR</h3>
          <p>Admin Panel</p>
        </div>
      </div>
    </div>

    <div class="profile">
      <div class="profile-img">A</div>
      <div class="profile-info">
        <h4>Admin</h4>
        <p>Administrator</p>
      </div>
    </div>

    <div class="sidebar-menu">
      <a href="dashboard_admin.php">
        <i class="fas fa-tachometer-alt"></i>
        Dashboard
      </a>
      <a href="daftar_hadir.php">
        <i class="fas fa-list-check"></i>
        Daftar Hadir
      </a>
      <a href="#" class="active">
        <i class="fas fa-users"></i>
        Kelola Data Pengguna
      </a>
      <a href="#">
        <i class="fas fa-calendar-alt"></i>
        Kelola Jadwal
      </a>
      <a href="#">
        <i class="fas fa-chart-bar"></i>
        Laporan
      </a>
    </div>

    <div class="sidebar-footer">
      <button class="logout-btn" id="logoutBtn">
        <i class="fas fa-sign-out-alt"></i>
        <span>Logout</span>
      </button>
    </div>
  </div>

  <!-- Main Content -->
  <div class="main">
    <div class="content-wrapper">
      <div class="header">
        <h2>Kelola Data Pengguna</h2>
        <p>Manajemen pengguna sistem absensi QR</p>
      </div>

      <!-- Summary Cards -->
      <div class="summary">
        <div class="summary-card">
          <div class="summary-card-icon">
            <i class="fas fa-user-graduate"></i>
          </div>
          <p>Total Mahasiswa</p>
          <h3 id="totalMahasiswa">0</h3>
        </div>
        
        <div class="summary-card">
          <div class="summary-card-icon">
            <i class="fas fa-chalkboard-teacher"></i>
          </div>
          <p>Total Dosen</p>
          <h3 id="totalDosen">0</h3>
        </div>
        
        <div class="summary-card">
          <div class="summary-card-icon">
            <i class="fas fa-user-shield"></i>
          </div>
          <p>Total Admin</p>
          <h3 id="totalAdmin">0</h3>
        </div>
        
        <div class="summary-card">
          <div class="summary-card-icon">
            <i class="fas fa-user-tie"></i>
          </div>
          <p>Total Kaprodi</p>
          <h3 id="totalKaprodi">0</h3>
        </div>
      </div>

      <!-- Action Bar -->
      <div class="action-bar">
        <div class="action-left">
          <button class="btn-primary" id="addUserBtn">
            <a href="tambah_data.php" class="active">
        <i class="fas fa-users"></i> Tambah Pengguna
      </a>
          </button>          
          <form action="download_laporan.php" method="post" target="_blank">
          <button type="submit" class="btn-primary">
            <i class="fas fa-file-pdf"></i> Export & Kirim Email
          </button>
        </form>

          <div class="search-input">
            <i class="fas fa-search"></i>
            <input type="text" id="searchInput" placeholder="Cari nama, username, atau email...">
          </div>
        </div>
        
        <div class="action-right">
          <select id="roleFilter">
            <option value="">Semua Role</option>
            <option value="mahasiswa">Mahasiswa</option>
            <option value="dosen">Dosen</option>
            <option value="admin">Admin</option>
            <option value="kaprodi">Kaprodi</option>
          </select>
          
          <select id="statusFilter">
            <option value="">Semua Status</option>
            <option value="active">Aktif</option>
            <option value="inactive">Nonaktif</option>
          </select>
        </div>
      </div>

      <!-- Table Container -->
      <div class="table-container">
        <div class="table-header">
          <h3><i class="fas fa-users-cog"></i> Daftar Pengguna Sistem</h3>
        </div>

        <table id="usersTable">
          <thead>
            <tr>
              <th>No <i class="fas fa-sort"></i></th>
              <th>ID</th>
              <th>Username <i class="fas fa-sort"></i></th>
              <th>Nama Lengkap <i class="fas fa-sort"></i></th>
              <th>Role</th>
              <th>Prodi</th>
              <th>Email</th>
              <th>Status</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $no = 1;
            while ($row = mysqli_fetch_assoc($query)) {
            ?>
              <tr>
                <td><?= $no++; ?></td>
                <td><?= $row['id_user']; ?></td>
                <td><?= $row['username']; ?></td>
                <td><?= $row['nama_lengkap']; ?></td>
                <td>
                  <span class="role <?= $row['role']; ?>">
                    <?= ucfirst($row['role']); ?>
                  </span>
                </td>
                <td></td>
                <td><?= $row['email']; ?></td>
                <td>
                  <span class="status <?= $row['status_akun'] == 'active' ? 'active' : 'inactive'; ?>">
                    <?= $row['status_akun'] == 'active' ? 'Aktif' : 'Nonaktif'; ?>
                  </span>
                </td>
                <td class="actions">
                  <button class="action-btn edit"><i class="fas fa-edit"></i></button>
                  <button class="action-btn delete"><i class="fas fa-trash"></i></button>
                </td>
              </tr>
            <?php } ?>
          </tbody>

        </table>

        <div class="table-footer">
          <div class="pagination-info">
            Menampilkan <span id="startIndex">0</span> - <span id="endIndex">0</span> dari <span id="totalData">0</span> data
          </div>
          <div class="pagination">
            <button class="pagination-btn disabled" id="prevBtn">
              <i class="fas fa-chevron-left"></i> Prev
            </button>
            <button class="pagination-btn active">1</button>
            <button class="pagination-btn">2</button>
            <button class="pagination-btn">3</button>
            <span>...</span>
            <button class="pagination-btn">42</button>
            <button class="pagination-btn" id="nextBtn">
              Next <i class="fas fa-chevron-right"></i>
            </button>
          </div>
        </div>
      </div>
    </div>

    <!-- Footer -->
    <footer class="main-footer">
      <div class="footer-copyright">
        <p>© Sistem Absensi QR <span id="currentYear">2025</span></p>
      </div>
    </footer>
  </div>

  <!-- Modal Tambah/Edit Pengguna -->
  <div class="modal" id="userModal">
    <div class="modal-content">
      <div class="modal-header">
        <h3><i class="fas fa-user-plus"></i> <span id="modalTitle">Tambah Pengguna Baru</span></h3>
        <button class="close-modal" id="closeModal">&times;</button>
      </div>
      
      <div class="modal-body">
        <form id="userForm">
          <div class="form-row">
            <div class="form-group">
              <label for="inputNama">Nama Lengkap *</label>
              <input type="text" id="inputNama" placeholder="Masukkan nama lengkap" required>
            </div>
            
            <div class="form-group">
              <label for="inputUsername">Username *</label>
              <input type="text" id="inputUsername" placeholder="Masukkan username" required>
            </div>
          </div>
          
          <div class="form-row">
            <div class="form-group">
              <label for="inputEmail">Email *</label>
              <input type="email" id="inputEmail" placeholder="email@contoh.com" required>
            </div>
            
            <div class="form-group">
              <label for="inputPhone">No. Telepon</label>
              <input type="text" id="inputPhone" placeholder="0812-3456-7890">
            </div>
          </div>
          
          <div class="form-row">
            <div class="form-group">
              <label for="inputRole">Role *</label>
              <select id="inputRole" required>
                <option value="">Pilih Role</option>
                <option value="mahasiswa">Mahasiswa</option>
                <option value="dosen">Dosen</option>
                <option value="admin">Admin</option>
                <option value="kaprodi">Kaprodi</option>
              </select>
            </div>
            
            <div class="form-group">
              <label for="inputProdi">Program Studi</label>
              <select id="inputProdi">
                <option value="">Pilih Prodi</option>
                <option value="ti">Teknik Informatika</option>
                <option value="si">Teknik Mesin</option>
              </select>
            </div>
          </div>
          
          <div class="form-row">
            <div class="form-group">
              <label for="inputPassword">Password *</label>
              <input type="password" id="inputPassword" placeholder="Minimal 8 karakter" required>
            </div>
            
            <div class="form-group">
              <label for="inputConfirmPassword">Konfirmasi Password *</label>
              <input type="password" id="inputConfirmPassword" placeholder="Ulangi password" required>
            </div>
          </div>
          
          <div class="form-group">
            <label for="inputStatus">Status Akun</label>
            <select id="inputStatus">
              <option value="active">Aktif</option>
              <option value="inactive">Nonaktif</option>
            </select>
          </div>
        </form>
      </div>
      
      <div class="modal-footer">
        <button class="btn-secondary" id="cancelBtn">Batal</button>
        <button class="btn-primary" id="saveUserBtn">Simpan Pengguna</button>
      </div>
    </div>
  </div>

  <script>
    // Sample data
    const tableBody = document.getElementById('tableBody');
    const paginationEl = document.querySelector('.pagination');
    const startIndexEl = document.getElementById('startIndex');
    const endIndexEl = document.getElementById('endIndex');
    const totalDataEl = document.getElementById('totalData');

  function renderTable() {
    tableBody.innerHTML = '';

    const totalEntries = usersData.length;

    // UPDATE INFO TEXT
    totalDataEl.textContent = totalEntries;

    if (totalEntries === 0) {
      tableBody.innerHTML = `
        <tr>
          <td colspan="9" style="text-align:center">
            Belum ada data pengguna
          </td>
        </tr>
      `;

      startIndexEl.textContent = 0;
      endIndexEl.textContent = 0;

      // 👉 INI BAGIAN PENTING
      paginationEl.style.display = 'none';
      return;
    }

    // kalau ada data
    paginationEl.style.display = 'flex';

    startIndexEl.textContent = 1;
    endIndexEl.textContent = totalEntries;

    // (nanti di sini lanjut render data dari database)
  }

</script>