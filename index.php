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
    case 11:
      $Err = "Username tidak terdaftar";
      break;
  }
}

$title = "Login || SMA";
$path = '';

require 'comp/header.php';
?>

<main class="main-content  mt-0">
  <section>
    <div class="page-header min-vh-75">
      <div class="container">
        <div class="row">
          <div class="col-xl-4 col-lg-5 col-md-6 d-flex flex-column mx-auto">
            <div class="card card-plain mt-7">
              <h5 class="font-weight-bolder text-info ">Portal SMA Katolik Santo Fransiskus Assisi Samarinda </h5>
              <div class="card-header pb-0 text-left bg-transparent">
                <h2 class="font-weight-bolder text-info text-gradient">LOGIN</h2>
                <p class="mb-0">Masukkan username dan password Anda untuk login</p>
              </div>
              <div class="card-body">
                <form action="vl_user.php" method="post" role="form">
                  <label>Username</label>
                  <div class="mb-3">
                    <input type="text" class="form-control" name="Username" placeholder="Username" aria-label="Email" aria-describedby="email-addon" value="<?php if (isset($_COOKIE["user_login"])) {
                                                                                                                                                              echo $_COOKIE["user_login"];
                                                                                                                                                            } ?>">
                  </div>
                  <label>Password</label>
                  <div class="mb-3">
                    <input type="password" class="form-control" name="Password" placeholder="Password" aria-label="Password" aria-describedby="password-addon" value="<?php if (isset($_COOKIE["userpassword"])) {
                                                                                                                                                                        echo $_COOKIE["userpassword"];
                                                                                                                                                                      } ?>">
                  </div>
                  <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="rememberMe" name="remember">
                    <label class="form-check-label" for="rememberMe">Ingat saya</label>
                  </div>
                  <div class="text-center">
                    <button type="submit" class="btn bg-gradient-info w-100 mt-4 mb-0">Masuk</button>
                  </div>
                </form>
              </div>
              <div class="card-footer text-center pt-0 px-lg-2 px-1">
                <p class="mb-4 text-sm mx-auto">
                  <!-- Belum punya akun?
                  <a href="javascript:;" class="text-info text-gradient font-weight-bold">Daftar</a>
                  <br> -->
                  <a href="reset_password.php">Reset password</a>
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