<?php 
session_start();
include '../koneksi.php';

if (!isset($_SESSION['user']) || ($_SESSION['role'] != 'Admin' && $_SESSION['role'] != 'Kasir')) {
    // Redirect ke login jika belum login atau bukan admin/kasir
    echo "<script>window.location = '" . base_url() . "'; </script>";
    exit;
}

// Proses jika form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = sha1($_POST['password']);  // Gunakan SHA1 untuk password
    $role = $_POST['role'];

    // Validasi input
    if (empty($username) || empty($email) || empty($password) || empty($role)) {
        $error = "Semua field harus diisi!";
    } else {
        // Cek apakah username atau email sudah terdaftar
        $stmt = $con->prepare("SELECT * FROM tb_user WHERE username = ? OR email = ?");
        $stmt->bind_param("ss", $username, $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $error = "Username atau email sudah terdaftar!";
        } else {
            // Insert data user baru ke database
            $stmt = $con->prepare("INSERT INTO tb_user (username, email, password, role) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $username, $email, $password, $role);
            if ($stmt->execute()) {
                $success = "User berhasil ditambahkan!";
            } else {
                $error = "Terjadi kesalahan saat menambahkan user!";
            }
        }
    }
}
?>

<!doctype html>
<html lang="en">

<?php include '../head.php';?>

<body class="hold-transition sidebar-mini layout-fixed">

<div class="wrapper">

  <?php include '../navbar.php';?>
  <?php include '../sidebar.php';?>

<div class="content-wrapper">
  <section class="content">

  <div class="container py-4 px-md-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h2 class="mb-0">Tambah Pengguna</h2>
      <a href="pengguna.php" class="btn btn-secondary btn-sm">← Kembali</a>
    </div>

    <div class="card shadow-sm border-0">
      <div class="card-body">

        <?php if (isset($error)): ?>
          <div class="alert alert-danger"><?= $error; ?></div>
        <?php endif; ?>
        <?php if (isset($success)): ?>
          <div class="alert alert-success"><?= $success; ?></div>
        <?php endif; ?>

        <form method="POST" action="tambah_pengguna.php">
          <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" name="username" required>
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
          </div>
          <div class="mb-3">
            <label for="role" class="form-label">Role</label>
            <select class="form-select" id="role" name="role" required>
              <?php if ($_SESSION['role'] != 'Kasir') { ?>
              <option value="Admin">Admin</option>
              <?php } ?>
              <option value="Kasir">Kasir</option>
            </select>
          </div>
          <button type="submit" class="btn btn-primary">Tambah User</button>
        </form>
      </div>
    </div>
  </div>

  </section>
</div>

<?php include '../footer.php';?>

</div>

<?php include '../javascript.php';?> 

</body>
</html>
