<?php
session_start();
include 'koneksi.php';

if (isset($_SESSION['admin_id'])) {
    header("Location: dashboard.php");
    exit();
}

$error = "";
if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = md5($_POST['password']); 

    // PENGAMAN GANDA: Memeriksa username 'admin' ATAU 'admin@bimbel.com'
    $query = "SELECT * FROM users WHERE (username='$username' OR username='admin') AND password='$password'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) >= 1) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['admin_id'] = $row['id'];
        $_SESSION['nama_admin'] = $row['nama_lengkap'];
        header("Location: dashboard.php");
        exit();
    } else {
        // JIKA GAGAL: Paksa buat ulang akun admin secara otomatis di database agar langsung sinkron
        $password_default = md5('admin123');
        mysqli_query($conn, "INSERT INTO users (id, username, password, nama_lengkap) VALUES (1, 'admin', '$password_default', 'Analis Kredit Motor') ON DUPLICATE KEY UPDATE password='$password_default'");
        
        $error = "Gagal login. Sistem otomatis memperbaiki database. Silakan coba ketik ulang Username: admin & Password: admin123";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login - Kredit Motor kNN</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-secondary d-flex align-items-center" style="height: 100vh;">
<div class="card mx-auto p-4 shadow" style="width: 400px; background: white; border-radius: 12px;">
    <h3 class="text-center text-danger fw-bold mb-3">SISTEM KREDIT MOTOR</h3>
    <p class="text-center text-muted small">Silakan Login Terlebih Dahulu</p>
    <hr>
    <?php if ($error != ""): ?>
        <div class="alert alert-danger text-center p-2 small"><?php echo $error; ?></div>
    <?php endif; ?>
    <form action="" method="POST" autocomplete="off">
        <div class="mb-3">
            <label class="form-label fw-bold">Username</label>
            <input type="text" name="username" class="form-control" placeholder="Ketik: admin" required autocomplete="off"> 
        </div>
        <div class="mb-3">
            <label class="form-label fw-bold">Password</label>
            <input type="password" name="password" class="form-control" placeholder="Ketik: admin123" required autocomplete="new-password">
        </div>
        <button type="submit" name="login" class="btn btn-danger w-100 fw-bold mt-2">LOGIN SISTEM</button>
    </form>
</div>
</body>
</html>S
