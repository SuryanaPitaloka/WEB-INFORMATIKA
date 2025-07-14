<?php

session_start();
if (isset($_SESSION["login"])) {
    header("Location: datamahasiswa.php");
    exit;
}
require 'function.php';

$error = false;

if (isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $query = "SELECT * FROM user WHERE username='$username'";

    $result = mysqli_query($koneksi, $query);
    $user = mysqli_fetch_assoc($result);
    if (mysqli_num_rows($result) > 0) {

        if (password_verify($password, $user["password"])) 
        {
            $_SESSION["login"] = $user['id'];

            header("Location: datamahasiswa.php");
            exit;
        }
    }
    $error = true;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN | WEB INFORMATIKA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container mt-5 p-4" style="max-width: 600px; background-color: #ffe6f0;">
        <h1>LOGIN</h1>
        <?php if ($error) : ?>
            <p style="color:red;">Username/Password Salah!</p>
        <?php endif ?>
        <form action="" method="post" enctype="multipart/form-data">
            <label>Username:</label>
            <input type="text" name="username" placeholder="Username">
            <br><br>

            <label for="password">Password:</label>
            <input type="password" name="password" placeholder="Password">
            <br><br>

            <input type="checkbox" id="remember" name="remember" value="yes">
            <label for="remember">Remember me</label>
            <br><br>
            <button type="submit" class="btn btn-primary w-100" name="login">Login</button>

            <p>Belum Punya Akun? <a href="register.php">Daftar</a></p>
        </form>

</body>

</html>