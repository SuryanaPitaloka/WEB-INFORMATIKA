<?php
$koneksi = mysqli_connect("localhost:3307", "root", "", "informatik");
if (!$koneksi) {
    die('Koneksi Gagal' . mysqli_connect_error());
}

function tampildata($query)
{
    global $koneksi;
    $result = mysqli_query($koneksi, $query);

    $rows = [];

    while($row = mysqli_fetch_assoc($result))
    {
        $rows[] = $row;
    }

    return $rows;
}

function tambahdata($data)
{
    global $koneksi;

    $nama = $data["nama"];
    $nim = $data["nim"];
    $jurusan = $data["jurusan"];
    $alamat = $data["alamat"];

    $file = $_FILES['foto']['name'];
    $namafile = date('DMY_Hm') . '_' . $file;
    $tmp = $_FILES['foto']['tmp_name'];
    $folder = 'image/';
    $path = $folder . $namafile;

    if (move_uploaded_file($tmp, $path)) 
    {
        $query = "INSERT INTO mahasiswa VALUES ('', '$namafile', '$nama', '$nim', '$jurusan', '$alamat')";
        mysqli_query($koneksi, $query);

        return mysqli_affected_rows($koneksi) ;
    }
    else 
    {
        return mysqli_affected_rows($koneksi);
    }
}

function hapusdata($id)
{
    global $koneksi;

    $query = "DELETE FROM mahasiswa WHERE id = $id";
    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}

function ubahdata($data, $id)
{
    global $koneksi;

    $nama    = $data["nama"];
    $nim     = $data["nim"];
    $jurusan = $data["jurusan"];
    $alamat  = $data["alamat"];

    $file = $_FILES['foto']['name'];
    $tmp  = $_FILES['foto']['tmp_name'];

    if (!empty($file)) {
        // Jika ada foto baru
        $namafile = date('dmY_His') . '_' . $file;
        $folder   = 'image/';
        $path     = $folder . $namafile;

        if (move_uploaded_file($tmp, $path)) {
            $query = "UPDATE mahasiswa SET 
                        foto = '$namafile',
                        nama = '$nama',
                        nim = '$nim',
                        jurusan = '$jurusan',
                        alamat = '$alamat'
                      WHERE id = $id";
        } else {
            return 0; // gagal upload file
        }
    } else {
        // Tanpa ganti foto
        $query = "UPDATE mahasiswa SET 
                    nama = '$nama',
                    nim = '$nim',
                    jurusan = '$jurusan',
                    alamat = '$alamat'
                  WHERE id = $id";
    }

    mysqli_query($koneksi, $query) or die(mysqli_error($koneksi));
    return mysqli_affected_rows($koneksi);
}

?>