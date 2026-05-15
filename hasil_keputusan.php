<?php
session_start();
include 'koneksi.php';

// Cek apakah admin sudah login
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Hasil Keputusan - Kredit Motor</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        .header-table { background-color: blue; color: white; text-align: center; }
        .btn-kembali { background-color: blue; color: white; margin-bottom: 20px; border: none; padding: 5px 15px; }
        .btn-kembali:hover { background-color: darkblue; color: white; }
    </style>
</head>
<body class="bg-light p-4">
    <div class="container bg-white p-4 shadow-sm">
        <h3>Hasil Keputusan Kredit Motor</h3>
        
        <div class="d-flex justify-content-between mb-3">
            <a href="index.php" class="btn btn-kembali">Kembali ke Form</a>
            <a href="data_rules.php" class="btn btn-outline-primary">Lihat Data Rules</a>
        </div>

        <table class="table table-bordered">
            <thead class="header-table">
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Hasil</th>
                    <th>Rule Digunakan</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Query JOIN untuk mengambil data pengajuan dan detail rule-nya
                $query = "SELECT p.*, r.kondisi 
                          FROM pengajuan p 
                          LEFT JOIN rules r ON p.id_rule_terpakai = r.id_rule 
                          ORDER BY p.id DESC";
                $exec = mysqli_query($conn, $query);
                
                $no = 1;
                while($row = mysqli_fetch_assoc($exec)) {
                    echo "<tr>
                            <td class='text-center'>".$no++."</td>
                            <td>".$row['nama']."</td>
                            <td class='text-center'>".$row['hasil_keputusan']."</td>
                            <td>Rule ".$row['id_rule_terpakai'].": ".$row['kondisi']."</td>
                          </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
