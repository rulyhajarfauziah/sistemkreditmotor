<?php 
include 'koneksi.php';
$id = $_GET['id'];
$data = mysqli_query($conn, "SELECT * FROM pengajuan WHERE id=$id");
$row = mysqli_fetch_array($data);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Hasil Keputusan</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light p-5">
    <div class="container bg-white p-4 shadow text-center" style="max-width: 500px;">
        <h2>HASIL KEPUTUSAN KREDIT</h2>
        <hr>
        <p><strong>Nama :</strong> <?php echo $row['nama']; ?></p>
        <h4 class="mt-3">Status : 
            <span class="badge <?php echo $row['hasil_keputusan'] == 'Layak' ? 'bg-success' : 'bg-danger'; ?>">
                <?php echo $row['hasil_keputusan']; ?>
            </span>
        </h4>
        <p class="text-muted">Rule Digunakan : Rule <?php echo $row['id_rule_terpakai']; ?></p>
        <a href="index.php" class="btn btn-link">Kembali</a>
    </div>
</body>
</html>
