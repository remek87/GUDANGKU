<?php
require 'gudang/db.php'; // Koneksi ke database

// Cek apakah form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Ambil izin akses dari checkbox form
    $izin_akses = [
        'akses_barang_yang_sudah_keluar' => isset($_POST['akses_barang_yang_sudah_keluar']),
        'akses_barang_masuk_gudang' => isset($_POST['akses_barang_masuk_gudang']),
        'akses_tambah_barang' => isset($_POST['akses_tambah_barang']),
        'akses_dhasboar_barang_belanja' => isset($_POST['akses_dhasboar_barang_belanja']),
        'akses_qc_lolos' => isset($_POST['akses_qc_lolos']),
        'akses_qc_retur' => isset($_POST['akses_qc_retur']),
        'akses_list_selesai_qc' => isset($_POST['akses_list_selesai_qc']),
        'akses_qc_dashboard' => isset($_POST['akses_qc_dashboard']),
        'akses_reset_delete_stok' => isset($_POST['akses_reset_delete_stok'])
    ];

    // Ubah array izin akses menjadi JSON
    $izin_akses_json = json_encode($izin_akses);

    // Simpan ke database
    $stmt = $pdo->prepare("INSERT INTO users (username, password, izin_akses) VALUES (?, ?, ?)");
    $stmt->execute([$username, $password, $izin_akses_json]);

    echo "Pengguna berhasil ditambahkan.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Tambah Pengguna</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Tambah Pengguna</h2>
    <form method="POST" action="">
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" class="form-control" id="username" name="username" required>
        </div>

        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>

        <h4>Izin Akses:</h4>

        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="akses_barang_yang_sudah_keluar" name="akses_barang_yang_sudah_keluar">
            <label class="form-check-label" for="akses_barang_yang_sudah_keluar">
                Akses Barang Yang Sudah Keluar
            </label>
        </div>

        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="akses_barang_masuk_gudang" name="akses_barang_masuk_gudang">
            <label class="form-check-label" for="akses_barang_masuk_gudang">
                Akses Barang Masuk Gudang
            </label>
        </div>

        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="akses_tambah_barang" name="akses_tambah_barang">
            <label class="form-check-label" for="akses_tambah_barang">
                Akses Tambah Barang
            </label>
        </div>

        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="akses_dhasboar_barang_belanja" name="akses_dhasboar_barang_belanja">
            <label class="form-check-label" for="akses_dhasboar_barang_belanja">
                Akses Dashboard Barang Belanja
            </label>
        </div>

        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="akses_qc_lolos" name="akses_qc_lolos">
            <label class="form-check-label" for="akses_qc_lolos">
                Akses QC Lolos
            </label>
        </div>

        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="akses_qc_retur" name="akses_qc_retur">
            <label class="form-check-label" for="akses_qc_retur">
                Akses QC Retur
            </label>
        </div>

        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="akses_list_selesai_qc" name="akses_list_selesai_qc">
            <label class="form-check-label" for="akses_list_selesai_qc">
                Akses List Selesai QC
            </label>
        </div>

        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="akses_qc_dashboard" name="akses_qc_dashboard">
            <label class="form-check-label" for="akses_qc_dashboard">
                Akses QC Dashboard
            </label>
        </div>

        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="akses_reset_delete_stok" name="akses_reset_delete_stok">
            <label class="form-check-label" for="akses_reset_delete_stok">
                Akses Reset/Delete Stok
            </label>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Tambah Pengguna</button>
    </form>
</div>
</body>
</html>
