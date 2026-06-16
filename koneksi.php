<?php
// Pastikan nama database-nya adalah kredit_motor_knn
$conn = mysqli_connect("localhost", "root", "", "kredit_motor_knn");

if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}
?>
