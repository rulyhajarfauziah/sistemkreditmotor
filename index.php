<!DOCTYPE html>
<html>
<head>
    <title>Sistem Kredit Motor</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light p-5">
    <div class="container bg-white p-4 shadow-sm" style="max-width: 600px;">
        <h3 class="mb-4 text-center">INPUT DATA CALON DEBITUR</h3>
        <form action="proses.php" method="POST">
            <div class="mb-2">
                <label>Nama</label>
                <input type="text" name="nama" class="form-control" required>
            </div>
            <div class="mb-2">
                <label>Penghasilan</label>
                <input type="number" name="penghasilan" class="form-control" required>
            </div>
            <div class="mb-2">
                <label>Jumlah Tanggungan</label>
                <input type="number" name="tanggungan" class="form-control" required>
            </div>
            <div class="mb-2">
                <label>Pekerjaan</label>
                <select name="pekerjaan" class="form-select">
                    <option>Tetap</option>
                    <option>Wiraswasta</option>
                    <option>Honorer</option>
                </select>
            </div>
            <div class="mb-2">
                <label>Kondisi Rumah</label>
                <select name="rumah" class="form-select">
                    <option>Milik Sendiri</option>
                    <option>Kontrak/Sewa</option>
                </select>
            </div>
            <div class="mb-2">
                <label>Kendaraan Lain</label>
                <select name="kendaraan" class="form-select">
                    <option>Tidak Ada</option>
                    <option>Ada</option>
                </select>
            </div>
            <button type="submit" name="proses" class="btn btn-primary w-100 mt-3">PROSES</button>
        </form>
    </div>
</body>
</html>
