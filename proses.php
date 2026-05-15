<?php
include 'koneksi.php';

if (isset($_POST['proses'])) {
    $nama = $_POST['nama'];
    $penghasilan = $_POST['penghasilan'];
    $tanggungan = $_POST['tanggungan'];
    $pekerjaan = $_POST['pekerjaan'];
    $rumah = $_POST['rumah'];
    $kendaraan = $_POST['kendaraan'];

    // DEFAULT DECISION
    $hasil = "Tidak Layak";
    $id_rule = 0;

    // LOGIKA RULE-BASED (Hardcoded Engine berdasarkan tabel rules)
    if ($penghasilan > 5000000 && $rumah == "Milik Sendiri") {
        $hasil = "Layak"; $id_rule = 1;
    } else if ($penghasilan < 2000000 && $tanggungan > 3) {
        $hasil = "Tidak Layak"; $id_rule = 2;
    } else if ($pekerjaan == "Honorer" && $kendaraan == "Ada") {
        $hasil = "Tidak Layak"; $id_rule = 3;
    } else if ($penghasilan >= 3000000 && $rumah == "Milik Sendiri") {
        $hasil = "Layak"; $id_rule = 4;
    }

    // Simpan ke DB
    mysqli_query($conn, "INSERT INTO pengajuan (nama, penghasilan, jumlah_tanggungan, pekerjaan, status_rumah, kendaraan_lain, hasil_keputusan, id_rule_terpakai) 
    VALUES ('$nama', '$penghasilan', '$tanggungan', '$pekerjaan', '$rumah', '$kendaraan', '$hasil', '$id_rule')");

    header("Location: hasil.php?id=" . mysqli_insert_id($conn));
}
?>
