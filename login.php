<?php
session_start();
include 'koneksi.php';

if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = md5($_POST['password']); // Gunakan MD5 untuk kesederhanaan localhost

    $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $exec = mysqli_query($conn, $query);
    $data = mysqli_fetch_assoc($exec);

    if ($data) {
        $_SESSION['admin_id'] = $data['id'];
        header("Location: hasil_keputusan.php"); // Redirect ke dashboard hasil
        exit();
    } else {
        $error = "Username atau Password salah!";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login - Sistem Kredit Motor</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body { background-color: #f4f7f6; }
        .login-card { max-width: 400px; margin: 10% auto; padding: 30px; border-radius: 10px; }
        .login-title { font-size: 24px; font-weight: bold; margin-bottom: 20px; }
        .btn-login { background-color: blue; color: white; width: 100%; border: none; font-size: 16px; padding: 10px; }
        .btn-login:hover { background-color: darkblue; color: white;}
    </style>
</head>
<body>
<div class="container">
    <div class="card login-card shadow-sm bg-white">
        <h2 class="login-title text-center text-primary">LOGIN SISTEM KREDIT</h2>
        <?php if(isset($error)) { echo "<div class='alert alert-danger'>$error</div>"; } ?>
        <form method="POST">
            <div class="mb-3">
                <label>Username</label>
                <input type="text" name="username" class="form-control" required>
            </div>
            <div class="mb-4">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" name="login" class="btn btn-login shadow">LOGIN</button>
        </form>
    </div>
</div>
</body>
</html>
