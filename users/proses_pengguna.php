<?php
// berisi dari koneksi dari config
require_once "../koneksi.php";


// isset guna untuk mengirim nilai balik dan bersifat boolean (true or false)
if (isset($_POST['edit_pengguna'])) {

    $id_user = trim(mysqli_real_escape_string($con, $_POST['id_user']));
    $username = trim(mysqli_real_escape_string($con, $_POST['username']));
    $email = trim(mysqli_real_escape_string($con, $_POST['email']));
    $role = trim(mysqli_real_escape_string($con, $_POST['role']));
    $password_input = trim($_POST['password']); // JANGAN langsung di-hash di sini

    // Cek apakah email sudah digunakan oleh user lain
    $sql_cek_pengguna = mysqli_query($con, "SELECT * FROM tb_user WHERE email = '$email' AND id_user != '$id_user'") or die(mysqli_error($con));

    if (mysqli_num_rows($sql_cek_pengguna) > 0) {
        echo "<script>alert('Email telah digunakan! Tolong Diganti!'); window.location='" . base_url('user/pengguna.php') . "';</script>";
    } else {
        if (empty($password_input)) {
            // Jika password tidak diisi → tidak diubah
            mysqli_query($con, "UPDATE tb_user SET username = '$username', email = '$email', role = '$role' WHERE id_user = '$id_user'") or die(mysqli_error($con));
        } else {
            // Jika password diisi → hash dengan SHA1 dulu
            $password = sha1(trim(mysqli_real_escape_string($con, $password_input)));
            mysqli_query($con, "UPDATE tb_user SET username = '$username', password = '$password', email = '$email', role = '$role' WHERE id_user = '$id_user'") or die(mysqli_error($con));
        }
        // PERBARUI SESSION USER
		$_SESSION['user'] = $username;
        echo "<script>alert('Data berhasil di edit!');window.location='" . base_url('users/pengguna.php') . "';</script>";
    }
}


?>