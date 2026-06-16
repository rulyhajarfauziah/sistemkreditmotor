<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

$query = "SELECT p.*, u.nama_lengkap FROM pengajuan p JOIN users u ON p.id_admin = u.id ORDER BY p.id DESC";
$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Riwayat - Kredit Motor kNN</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
<nav class="navbar navbar-expand-lg navbar-dark bg-danger shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold" href="dashboard.php">📊 KREDIT MOTOR kNN</a>
        <div class="navbar-nav ms-auto">
            <a class="nav-link text-white" href="dashboard.php">Dashboard</a>
            <a class="nav-link text-white" href="prediksi.php">Analisis Kredit</a>
            <a class="nav-link active" href="riwayat.php">Riwayat Uji</a>
            <a class="nav-link text-warning fw-bold" href="logout.php">Logout</a>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <div class="card p-4 shadow-sm">
        <h4 class="fw-bold text-danger mb-4">RIWAYAT PENGUJIAN KELAYAKAN NASABAH</h4>
        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Nama Pemohon</th>
                        <th>Penghasilan</th>
                        <th>DP</th>
                        <th>Tenor</th>
                        <th>Hasil Rekomendasi</th>
                        <th>Analis (Admin)</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; while($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo date('d/m/Y H:i', strtotime($row['tanggal_input'])); ?></td>
                        <td class="fw-bold"><?php echo htmlspecialchars($row['nama']); ?></td>
                        <td>Rp <?php echo number_format($row['penghasilan'], 0, ',', '.'); ?></td>
                        <td>Rp <?php echo number_format($row['uang_muka'], 0, ',', '.'); ?></td>
                        <td><?php echo $row['tenor']; ?> Bln</td>
                        <td>
                            <span class="badge <?php echo $row['hasil_keputusan'] == 'Layak' ? 'bg-success' : 'bg-danger'; ?>">
                                <?php echo $row['hasil_keputusan'] == 'Layak' ? 'Layak' : 'Tidak Layak'; ?>
                            </span>
                        </td>
                        <td class="text-muted"><?php echo $row['nama_lengkap']; ?></td>
                        <td><a href="hasil.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-primary py-0 px-2">Lihat</a></td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>
