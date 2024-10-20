<?php
session_start();

// Cek apakah pengguna sudah login dan memiliki peran administrator
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'administrator') {
    header("Location: login.php");
    exit();
}

// Koneksi ke database
require 'belanja/db.php';

// Proses jika form disubmit untuk menambah user
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_user'])) {
    $username = $_POST['username'];
    $password = $_POST['password']; // Simpan password tanpa hashing seperti yang diminta
    $role = $_POST['role'];

    // Masukkan data user baru ke database
    $query = $pdo->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
    $query->execute([$username, $password, $role]);

    echo "Pengguna baru berhasil ditambahkan!";
}

// Proses hapus user jika parameter `delete_user` ada di URL
if (isset($_GET['delete_user'])) {
    $user_id = $_GET['delete_user'];

    // Hapus user dari database berdasarkan id
    $query = $pdo->prepare("DELETE FROM users WHERE id = ?");
    $query->execute([$user_id]);

    echo "Pengguna berhasil dihapus!";
}

// Ambil semua data pengguna dari database
$query = $pdo->query("SELECT * FROM users");
$users = $query->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Pengguna Baru</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Tambah Pengguna Baru</h2>

        <!-- Form untuk menambahkan user baru -->
        <form method="POST" action="">
            <input type="hidden" name="add_user" value="1">

            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" class="form-control" name="username" required>
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" name="password" required>
            </div>

            <div class="form-group">
                <label for="role">Peran:</label>
                <select class="form-control" name="role">
                    <option value="administrator">Administrator</option>
                    <option value="kepala_gudang">Kepala Gudang</option>
                    <option value="petugas_qc">Petugas QC</option>
                    <option value="admin_gudang">Admin Gudang</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Tambah Pengguna</button>
        </form>

        <h3 class="mt-5">Daftar Pengguna</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Role</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user) { ?>
                <tr>
                    <td><?php echo $user['id']; ?></td>
                    <td><?php echo $user['username']; ?></td>
                    <td><?php echo $user['role']; ?></td>
                    <td>
                        <form method="POST" action="">
                            <input type="text" name="new_password" placeholder="Password Baru">
                            <button type="submit" name="update_password" value="<?php echo $user['id']; ?>" class="btn btn-info btn-sm">Edit Password</button>
                        </form>
                        <a href="add_user.php?delete_user=<?php echo $user['id']; ?>" class="btn btn-danger btn-sm">Hapus</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>

        <a href="index.html" class="btn btn-secondary mt-3">Kembali ke Dashboard</a>
    </div>
</body>
</html>
