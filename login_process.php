<?php
session_start();

// Koneksi ke database
require 'belanja/db.php';

// Tangkap input login dari form
$username = trim($_POST['username']);
$password = trim($_POST['password']);

// Cek apakah username dan password valid
$query = $pdo->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
$query->execute([$username, $password]);
$user = $query->fetch();

if ($user) {
    // Jika login berhasil, simpan informasi pengguna ke dalam sesi
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['username'] = $user['username'];
    $_SESSION['role'] = $user['role'];
    
    // Arahkan ke index.html setelah login berhasil
    header("Location: index.php");
    exit(); // Pastikan exit() untuk menghentikan eksekusi
} else {
    // Jika login gagal
    header("Location: login.php?error=InvalidLogin");
    exit();
}
?>
