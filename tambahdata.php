<?php
$koneksi = mysqli_connect("localhost:3307", "root", "", "informatik");
if (!$koneksi) {
    die('Koneksi Gagal' . mysqli_connect_error());
}

if(isset($_POST["submit"]))
{
    // var_dump($_POST);
    $nama = $_POST["nama"];
    $nim = $_POST["nim"];
    $jurusan = $_POST["jurusan"];
    $alamat = $_POST["alamat"];

    $file = $_FILES['foto']['name'];
    $namafile = date('DMY_Hm') . '_' . $file;
    $tmp = $_FILES['foto']['tmp_name'];
    $folder = 'image/';
    $path = $folder . $namafile;

    if(move_uploaded_file($tmp, $path))
    {
        $query = "INSERT INTO mahasiswa VALUES ('', '$namafile', '$nama', '$nim', '$jurusan', '$alamat')";
        mysqli_query($koneksi, $query);

        if(mysqli_affected_rows($koneksi)> 0)
        {
            echo "
            <script>
                alert('Data Berhasil Ditambahkan!');
                document.location.href= 'datamahasiswa.php';
            </script>
            ";
        }
        else
        {
            echo "
            <script>
                alert('Data Gagal Ditambahkan!');
                document.location.href= 'datamahasiswa.php';
            </script>
            ";
        }
    }

}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data</title>
</head>

<body>
    <h1>Tambah Data Mahasiswa</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <label for="nama">Nama</label>
        <input type="text" name="nama" id="nama" />
        <br>
        <label for="nim">NIM</label>
        <input type="text" name="nim" id="nim" />
        <br>
        <label for="jurusan">Jurusan</label>
        <input type="text" name="jurusan" id="jurusan" />
        <br>
        <label for="alamat">Alamat</label>
        <input type="text" name="alamat" id="alamat" />
        <br>
        <label>Upload Foto</label>
        <input type="file" name="foto" />
        <br>
        <button type="submit" name="submit">Tambah</button>
    </form>
</body>

</html>