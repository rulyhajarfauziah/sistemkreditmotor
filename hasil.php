<?php 
session_start();
include 'koneksi.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$data = mysqli_query($conn, "SELECT * FROM pengajuan WHERE id=$id");

if (!$data || mysqli_num_rows($data) == 0) {
    die("<div class='container mt-5 alert alert-danger text-center'>Data tidak ditemukan. <a href='prediksi.php'>Kembali</a></div>");
}

$row = mysqli_fetch_array($data);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Hasil Keputusan - Kredit Motor</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
<div class="container mt-5" style="max-width: 500px;">
    <div class="card p-4 shadow-sm text-center">
        <h3 class="fw-bold text-danger">HASIL EVALUASI KREDIT MOTOR</h3>
        <p class="text-muted small">Rekomendasi Keputusan Berbasis Data kNN (K=3)</p>
        <hr>
        <div class="text-start mb-4 bg-light p-3 rounded">
            <p class="mb-1"><strong>Nama Pemohon:</strong> <?php echo htmlspecialchars($row['nama']); ?></p>
            <p class="mb-1"><strong>Penghasilan:</strong> Rp <?php echo number_format($row['penghasilan'], 0, ',', '.'); ?></p>
            <p class="mb-1"><strong>Uang Muka (DP):</strong> Rp <?php echo number_format($row['uang_muka'], 0, ',', '.'); ?></p>
            <p class="mb-0"><strong>Tenor Cicilan:</strong> <?php echo $row['tenor']; ?> Bulan</p>
        </div>
        
        <h4 class="mb-4">REKOMENDASI SISTEM: <br><br>
            <span class="badge <?php echo $row['hasil_keputusan'] == 'Layak' ? 'bg-success' : 'bg-danger'; ?> px-4 py-2 fs-5">
                <?php echo $row['hasil_keputusan'] == 'Layak' ? 'LAYAK DISETUJUI' : 'TIDAK LAYAK DISETUJUI'; ?>
            </span>
        </h4>
        
        <hr>
        <div class="row g-2">
            <div class="col-6"><a href="prediksi.php" class="btn btn-outline-danger w-100 fw-bold">Uji Data Lagi</a></div>
            <div class="col-6"><a href="dashboard.php" class="btn btn-danger w-100 fw-bold">Ke Dashboard</a></div>
        </div>
    </div>
</div>
</body>
</html>
