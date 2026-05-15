<?php
session_start();
include 'koneksi.php';

// Proteksi halaman: Hanya admin yang sudah login yang bisa masuk
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Data Rules - Sistem Kredit Motor</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body { background-color: #f8f9fa; }
        .header-table { background-color: #0000ff; color: white; text-align: center; }
        .btn-custom { background-color: #0000ff; color: white; border: none; }
        .btn-custom:hover { background-color: #0000cc; color: white; }
        .container-box { background-color: white; padding: 30px; border-radius: 10px; margin-top: 50px; }
    </style>
</head>
<body>

<div class="container">
    <div class="container-box shadow-sm">
        <h2 class="mb-4">Data Rules</h2>
        
        <div class="mb-3">
            <a href="hasil_keputusan.php" class="btn btn-custom px-4">Kembali</a>
        </div>

        <table class="table table-bordered table-hover">
            <thead class="header-table">
                <tr>
                    <th width="10%">ID Rule</th>
                    <th width="40%">Kondisi</th>
                    <th width="20%">Keputusan</th>
                    <th width="30%">Alasan</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Ambil data dari tabel rules
                $query = "SELECT * FROM rules ORDER BY id_rule ASC";
                $exec = mysqli_query($conn, $query);

                if (mysqli_num_rows($exec) > 0) {
                    while($row = mysqli_fetch_assoc($exec)) {
                        echo "<tr>
                                <td class='text-center'>".$row['id_rule']."</td>
                                <td>".$row['kondisi']."</td>
                                <td class='text-center'>".$row['keputusan']."</td>
                                <td>".$row['alasan']."</td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='4' class='text-center'>Data rules belum tersedia.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>
