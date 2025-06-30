<?php
require 'function.php';

if (isset($_POST["submit"])) {
    if (tambahdata($_POST) > 0) {
        echo "
            <script>
                alert('Data Berhasil Ditambahkan!');
                document.location.href= 'datamahasiswa.php';
            </script>
            ";
    } else {
        echo "
            <script>
                alert('Data Gagal Ditambahkan!');
                document.location.href= 'datamahasiswa.php';
            </script>
            ";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css"
        rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr"
        crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data</title>
</head>

<body>

    <div class="container mt-5 p-4" style="max-width: 600px; background-color: #ffe6f0;">
        <h2 class="mb-4">Tambah Data Mahasiswa</h2>
        <form action="tambahdata.php" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan nama">
            </div>

            <div class="mb-3">
                <label for="nim" class="form-label">NIM</label>
                <input type="text" class="form-control" id="nim" name="nim" placeholder="Masukkan NIM">
            </div>

            <div class="mb-3">
                <label for="jurusan" class="form-label">Jurusan</label>
                <input type="text" class="form-control" id="jurusan" name="jurusan" placeholder="Masukkan jurusan">
            </div>

            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <textarea class="form-control" id="alamat" name="alamat" rows="3" placeholder="Masukkan alamat"></textarea>
            </div>

            <div class="mb-3">
                <label for="foto" class="form-label">Upload Foto</label>
                <input class="form-control" type="file" id="foto" name="foto">
            </div>

            <button type="submit" class="btn btn-primary" name="submit">Tambah</button>
        </form>
    </div>


    <!-- <label for="nama">Nama</label>
        <input type="text" name="nama" id="nama" />
        <br>
        <br>
        <label for="nim">NIM</label>
        <input type="text" name="nim" id="nim" />
        <br>
        <br>
        <label for="jurusan">Jurusan</label>
        <input type="text" name="jurusan" id="jurusan" />
        <br>
        <br>
        <label for="alamat">Alamat</label>
        <input type="text" name="alamat" id="alamat" />
        <br>
        <br>
        <label>Upload Foto</label>
        <input type="file" name="foto" />
        <br>

        <button type="submit" name="submit">Tambah</button> -->
</body>

</html>