<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Form Analisis - Kredit Motor kNN</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
<nav class="navbar navbar-expand-lg navbar-dark bg-danger shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold" href="dashboard.php">📊 KREDIT MOTOR kNN</a>
        <div class="navbar-nav ms-auto">
            <a class="nav-link text-white" href="dashboard.php">Dashboard</a>
            <a class="nav-link active" href="prediksi.php">Analisis Kredit</a>
            <a class="nav-link text-white" href="riwayat.php">Riwayat Uji</a>
            <a class="nav-link text-warning fw-bold" href="logout.php">Logout</a>
        </div>
    </div>
</nav>

<div class="container mt-5" style="max-width: 600px;">
    <div class="card p-4 shadow-sm">
        <h4 class="text-center text-danger fw-bold mb-3">FORM PENGAJUAN KREDIT MOTOR</h4>
        <hr>
        <form action="proses_knn.php" method="POST">
            <div class="mb-3">
                <label class="form-label fw-bold">Nama Lengkap Pemohon</label>
                <input type="text" name="nama" class="form-control" placeholder="Contoh: Andi Wijaya" required>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Penghasilan Per Bulan (Rp)</label>
                <input type="number" name="penghasilan" class="form-control" placeholder="Contoh: 4000000" required>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Uang Muka / DP (Rp)</label>
                <input type="number" name="uang_muka" class="form-control" placeholder="Contoh: 2500000" required>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Tenor Cicilan (Bulan)</label>
                <input type="number" name="tenor" class="form-control" placeholder="Contoh: 12, 24, 36" required>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Status Pekerjaan Pemohon</label>
                <select name="pekerjaan" class="form-select" required>
                    <option value="3">Karyawan Tetap / PNS</option>
                    <option value="2">Wiraswasta</option>
                    <option value="1">Honorer / Kerja Lepas</option>
                </select>
            </div>
            <div class="mb-4">
                <label class="form-label fw-bold">Status Kepemilikan Rumah</label>
                <select name="rumah" class="form-select" required>
                    <option value="2">Milik Sendiri</option>
                    <option value="1">Sewa / Kontrak / Kost</option>
                </select>
            </div>
            <button type="submit" name="proses" class="btn btn-danger w-100 fw-bold shadow-sm py-2">PROSES REKOMENDASI KELAYAKAN (kNN)</button>
        </form>
    </div>
</div>
</body>
</html>
