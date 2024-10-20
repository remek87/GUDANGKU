<?php
session_start();

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

// Dapatkan role dari session
$role = $_SESSION['role'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Gudang V1</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            min-height: 100vh;
            background-color: #f8f9fa;
        }
        .sidebar {
            width: 250px;
            background-color: #343a40;
            color: white;
            padding: 15px;
        }
        .sidebar a {
            color: white;
            text-decoration: none;
            display: block;
            padding: 10px 15px;
            border-radius: 5px;
        }
        .sidebar a:hover {
            background-color: #495057;
        }
        .sidebar i {
            margin-right: 10px;
        }
        .content {
            flex-grow: 1;
            padding: 20px;
        }
        .card {
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }
        .dashboard-header {
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h4>Side Panel</h4>

        <!-- Menu berdasarkan role -->
        <?php if ($role == 'administrator' || $role == 'kepala_gudang') { ?>
            <a href="belanja/dhasboar_barang_belanja.php"><i class="fas fa-box"></i>Barang Belanja</a>
            <a href="belanja/tambah_barang.php"><i class="fas fa-plus"></i>Tambah Barang Belanja</a>
        <?php } ?>
        
        <?php if ($role == 'administrator' || $role == 'petugas_qc') { ?>
            <a href="quality_control/qc_lolos.php"><i class="fas fa-check"></i>QC Lolos</a>
            <a href="quality_control/qc_retur.php"><i class="fas fa-times"></i>QC Tidak Lolos</a>
            <a href="quality_control/qc_dashboard.php"><i class="fas fa-tasks"></i>Dashboard QC</a>
        <?php } ?>
        
        <?php if ($role == 'administrator' || $role == 'kepala_gudang' || $role == 'admin_gudang') { ?>
            <a href="quality_control/list_selesai_qc.php"><i class="fas fa-clock"></i>Barang siap pergi ke gudang</a>
            <a href="gudang/index_gudang.html"><i class="fas fa-warehouse"></i>Dashboard Gudang</a>
        <?php } ?>
        
        <a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
    </div>
    
    <div class="content">
        <h2 class="text-center dashboard-header">Selamat Datang di Dashboard Inventory</h2>
        <div class="row">
            <?php if ($role == 'administrator' || $role == 'kepala_gudang') { ?>
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm">
                        <div class="card-body text-center">
                            <i class="fas fa-box fa-2x text-primary mb-3"></i>
                            <h5 class="card-title">Barang Belanja</h5>
                            <p class="card-text">Lihat dan kelola barang belanja.</p>
                            <a href="belanja/dhasboar_barang_belanja.php" class="btn btn-primary">Lihat Barang Belanja</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm">
                        <div class="card-body text-center">
                            <i class="fas fa-plus-circle fa-2x text-success mb-3"></i>
                            <h5 class="card-title">Tambah Barang Belanja</h5>
                            <p class="card-text">Tambahkan Barang Belanja Baru.</p>
                            <a href="belanja/tambah_barang.php" class="btn btn-success">Tambah Barang</a>
                        </div>
                    </div>
                </div>
            <?php } ?>
            
            <?php if ($role == 'administrator' || $role == 'petugas_qc') { ?>
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm">
                        <div class="card-body text-center">
                            <i class="fas fa-check-circle fa-2x text-warning mb-3"></i>
                            <h5 class="card-title">QC Lolos</h5>
                            <p class="card-text">Lihat barang yang lolos QC.</p>
                            <a href="quality_control/qc_lolos.php" class="btn btn-warning">Lihat Barang Lolos QC</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm">
                        <div class="card-body text-center">
                            <i class="fas fa-times-circle fa-2x text-danger mb-3"></i>
                            <h5 class="card-title">QC Tidak Lolos</h5>
                            <p class="card-text">Kelola barang yang tidak lolos QC.</p>
                            <a href="quality_control/qc_retur.php" class="btn btn-danger">Kelola Barang Tidak Lolos QC</a>
                        </div>
                    </div>
                </div>
            <?php } ?>
            
            <?php if ($role == 'administrator' || $role == 'kepala_gudang' || $role == 'admin_gudang') { ?>
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm">
                        <div class="card-body text-center">
                            <i class="fas fa-clock fa-2x text-secondary mb-3"></i>
                            <h5 class="card-title">Barang Siap Pergi ke Gudang</h5>
                            <p class="card-text">Lihat barang yang siap dimasukkan ke gudang.</p>
                            <a href="quality_control/list_selesai_qc.php" class="btn btn-secondary">Lihat Barang Siap ke Gudang</a>
                        </div>
                    </div>
                </div>
            <?php } ?>
            
            <?php if ($role == 'administrator' || $role == 'admin_gudang') { ?>
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm">
                        <div class="card-body text-center">
                            <i class="fas fa-tasks fa-2x text-info mb-3"></i>
                            <h5 class="card-title">Dashboard QC</h5>
                            <p class="card-text">Kelola barang yang menunggu QC.</p>
                            <a href="quality_control/qc_dashboard.php" class="btn btn-info">Kelola Barang QC</a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
