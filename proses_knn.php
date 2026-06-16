<?php
session_start();
include 'koneksi.php';
include 'fungsi_knn.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

if (isset($_POST['proses'])) {
    $nama        = mysqli_real_escape_string($conn, $_POST['nama']);
    $penghasilan = intval($_POST['penghasilan']);
    $uang_muka   = intval($_POST['uang_muka']);
    $tenor       = intval($_POST['tenor']);
    $pekerjaan   = intval($_POST['pekerjaan']);
    $rumah       = intval($_POST['rumah']);

    $data_baru = [
        'penghasilan' => $penghasilan,
        'uang_muka'   => $uang_muka,
        'tenor'       => $tenor,
        'pekerjaan'   => $pekerjaan,
        'rumah'       => $rumah
    ];

    $id_admin = $_SESSION['admin_id'];
    $k_value  = 3; // Tetangga terdekat yang digunakan (K=3)

    // Panggil fungsi Algoritma kNN
    $hasil_keputusan = hitung_knn($conn, $data_baru, $k_value);

    $query_simpan = "INSERT INTO pengajuan 
                    (nama, penghasilan, uang_muka, tenor, pekerjaan, rumah, hasil_keputusan, id_admin, k_terpakai) 
                    VALUES 
                    ('$nama', $penghasilan, $uang_muka, $tenor, $pekerjaan, $rumah, '$hasil_keputusan', $id_admin, $k_value)";
    
    if (mysqli_query($conn, $query_simpan)) {
        $id_baru = mysqli_insert_id($conn);
        header("Location: hasil.php?id=" . $id_baru);
        exit();
    } else {
        die("Gagal memproses rekomendasi kredit: " . mysqli_error($conn));
    }
} else {
    header("Location: prediksi.php");
    exit();
}
?>
