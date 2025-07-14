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

function register($data)
{
    global $koneksi;

    $username = stripslashes(trim($data["username"]));
    $username = mysqli_real_escape_string($koneksi, $username);

    $password1 = trim($data["password1"]);
    $password2 = trim($data["password2"]);

    $queryusername = "SELECT id FROM user WHERE username = '$username'";
    
        $username_check = mysqli_query($koneksi, $queryusername);

        var_dump(mysqli_num_rows($username_check));

    if (mysqli_num_rows($username_check) > 0) {
        return "Username Sudah Terdaftar!";
    }

    if (!preg_match('/^[a-zA-Z0-9._-]+$/', $username)) {
        return "Username Tidak Valid!";
    }

    if ($password1 !== $password2) {
        return "Konfirmasi Password Salah!";
    }

    $hash_password = password_hash($password1, PASSWORD_DEFAULT);

    $query_insert = "INSERT INTO user (username, password) VALUES ('$username', '$hash_password')";

    if (mysqli_query($koneksi, $query_insert)) {
        return "Register Berhasil";
    } else {
        return "Gagal: " . mysqli_error($koneksi);
    }
}


?>