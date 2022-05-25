<?php
session_start();
include "koneksi.php";

// Notif Error
$Err = "";
if (isset($_GET["Err"]) && !empty($_GET["Err"])) {
  switch ($_GET["Err"]) {
    case 1:
      $Err = "Username dan Password Kosong";
      break;
    case 2:
      $Err = "Username Kosong";
      break;
    case 3:
      $Err = "Password Kosong";
      break;
    case 4:
      $Err = "Password salah";
      break;
    case 5:
      $Err = "Pastikan username dan password yang anda masukan sudah benar!";
      break;
    case 6:
      $Err = "Maaf, Terjadi Kesalahan";
      break;
    case 7:
      $Err = "id user tidak boleh kosong!";
      break;
    case 8:
      $Err = "username tidak boleh kosong!";
      break;
    case 9:
      $Err = "id user dan username tidak boleh kosong!";
      break;
    case 10:
      $Err = "id user dan username tidak dapat ditemukan!";
      break;
  }
}

$title = "Reset Password || SMA";
$path = '';

require 'comp/header.php';
?>

<main class="main-content  mt-0">
  <section>
    <div class="page-header min-vh-75">
      <div class="container">
        <div class="row">
          <div class="col-xl-4 col-lg-5 col-md-6 d-flex flex-column mx-auto pb-5">
            <div class="card card-plain mt-7 pb-5">
              <div class="card-header pb-0 text-left bg-transparent">
                <h3 class="font-weight-bolder text-info text-gradient">Reset Password</h3>
              </div>
              <div class="card-body">
                <form action="reset.php" method="post">
                  <label>ID User</label>
                  <div class="mb-3">
                    <input type="number" class="form-control" name="Id_User" placeholder="Masukkan NIS atau Kode Guru" require aria-label="Email" aria-describedby="email-addon">
                  </div>
                  <label>Username</label>
                  <div class="mb-3">
                    <input type="text" class="form-control" name="Username" required placeholder="Username" aria-label="Email" aria-describedby="email-addon">
                  </div>
                  <label>Password Baru</label>
                  <div class="mb-3">
                    <input type="password" class="form-control" name="passwordbaru" required placeholder="Password Baru" aria-label="Password" aria-describedby="password-addon">
                  </div>

                  <div class="text-center">
                    <button type="submit" class="btn bg-gradient-info w-100 mt-4 mb-0">Reset</button>
                  </div>
                </form>
              </div>
              <div class="card-footer text-center pt-0 px-lg-2 px-1">
                <p class="mb-4 text-sm mx-auto">
                  <!-- Belum punya akun?
                  <a href="javascript:;" class="text-info text-gradient font-weight-bold">Daftar</a>
                  <br> -->
                  <a href="index.php">Back To Login</a>
                </p>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="oblique position-absolute top-0 h-100 d-md-block d-none me-n8">
              <div class="oblique-image bg-cover position-absolute fixed-top ms-auto h-100 z-index-0 ms-n6" style="background-image:url('assets/img/curved-images/curved6.jpg')"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<?php require 'comp/footer.php'; ?>

<?php

if ($Err) {
  echo "<script>";
  echo "swal('Gagal', '" . $Err . "', 'error');";
  echo "</script>";
}

?>