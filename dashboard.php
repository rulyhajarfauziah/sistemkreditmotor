<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

$count_training = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM data_training"));
$count_pengajuan = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM pengajuan"));
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard - Kredit Motor kNN</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
<nav class="navbar navbar-expand-lg navbar-dark bg-danger shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold" href="dashboard.php">📊 KREDIT MOTOR kNN</a>
        <div class="navbar-nav ms-auto">
            <a class="nav-link active" href="dashboard.php">Dashboard</a>
            <a class="nav-link text-white" href="prediksi.php">Analisis Kredit</a>
            <a class="nav-link text-white" href="riwayat.php">Riwayat Uji</a>
            <a class="nav-link text-warning fw-bold" href="logout.php">Logout</a>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <div class="p-4 bg-white shadow-sm rounded mb-4">
        <h4>Selamat Datang, <strong><?php echo $_SESSION['nama_admin']; ?></strong>!</h4>
        <p class="text-muted mb-0">Anda masuk sebagai Analis Kredit. Gunakan menu di atas untuk memproses data baru nasabah menggunakan metode kNN.</p>
    </div>

    <div class="row g-4">
        <div class="col-md-6">
            <div class="card bg-primary text-white p-4 shadow-sm border-0">
                <h5>Total Dataset Training</h5>
                <h2 class="fw-bold"><?php echo $count_training; ?> <span class="fs-5 fw-normal">Data</span></h2>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card bg-success text-white p-4 shadow-sm border-0">
                <h5>Total Pengujian Nasabah</h5>
                <h2 class="fw-bold"><?php echo $count_pengajuan; ?> <span class="fs-5 fw-normal">Histori</span></h2>
            </div>
        </div>
    </div>
</div>
</body>
</html>
