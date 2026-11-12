<?php require_once "koneksi.php";
if (isset($_SESSION['user'])) {
    // script menampilkan jendela lokasi menuju halaman tujuan
    echo "<script>window.location='" . base_url('auth.php') . "';</script>";
} else { ?>


<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="generator" content="Hugo 0.84.0">
  
  <link rel="icon" type="image/x-icon" href="/ud_hana/logo.png">
  <title>Login - UD HANA</title>
  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  
  <style>
    body {
      background: #f8f9fa;
    }
    .login-container {
      max-width: 400px;
      margin: 5% auto;
      padding: 30px;
      background: white;
      border-radius: 15px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    .logo {
      font-size: 2rem;
      font-weight: bold;
      color: #0d6efd;
    }
  </style>
</head>
<body>


  <div class="login-container">

    <?php
      if (isset($_POST['login'])) {
          // con diambil dari file koneksi, post diambil dari name form
          $username = trim(mysqli_real_escape_string($con, $_POST['username']));
          $pass = sha1(trim(mysqli_real_escape_string($con, $_POST['password'])));
          //query mengambil data dari tb user
          
          $sql_login = mysqli_query($con, "SELECT * FROM tb_user WHERE username = '$username' AND password = '$pass'") or die(mysqli_error($con));
          $r = mysqli_fetch_array($sql_login);
          
          // fungsi isset agar tidak terjadi type of null
          $id_user = isset($r['id_user']) ? $r['id_user'] : '' ;
          $username = isset($r['username']) ? $r['username'] : '' ;
          $password = isset($r['password']) ? $r['password'] : '' ;
          $email = isset($r['email']) ? $r['email'] : '' ;
          $role = isset($r['role']) ? $r['role'] : '' ;

          if($username == $username && $pass == $password){
              // query untuk mencetak session
              $_SESSION['id_user'] = $id_user;
              $_SESSION['user'] = $username;
              $_SESSION['email'] = $email;
              $_SESSION['role'] = $role;
              echo "<script>window.location='" . base_url('auth.php') . "';</script>";
              
          } else { ?>
              <div class="row">
                  <div class="col-lg-12">
                      <div class="alert alert-danger alert-dismissable" role="alert">
                          <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                          <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                          <strong>Login Gagal: Email atau Password salah!</strong>
                      </div>
                  </div>
              </div>
              <?php
            }
          }
      ?>


    <div class="text-center mb-4">
      <div class="logo">UD HANA</div>
      <p class="text-muted">Silakan login untuk melanjutkan</p>
    </div>

    <form class="user" method="post" action="">
      <div class="mb-3">
        <label for="username" class="form-label">Nama Pengguna</label>
        <input type="text" class="form-control" id="username" name="username" required autofocus>
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Kata Sandi</label>
        <input type="password" class="form-control" id="password" name="password" required>
      </div>
      <button type="submit" class="btn btn-primary w-100" name="login">Login</button>
    </form>
  </div>
</body>
</html>
<?php } ?>