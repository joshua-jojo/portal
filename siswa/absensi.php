<?php
$title = 'Absensi';
$path = '../';
require '../comp/header.php';

session_start();
include "../koneksi.php";
include "auth_user.php";
?>

<body class="g-sidenav-show bg-gray-100">
  <!-- aside -->
  <?php require 'comp/sidebar.php' ?>
  <!--/ aside -->

  <!-- main content -->
  <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg">

    <!-- navbar -->
    <?php require '../comp/navbar.php' ?>
    <!-- /navbar -->

    <div class="container-fluid py-4">

      <div class="row mt-4">
        <div class="col-lg-12 mb-lg-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-lg-6">
                  <div class="d-flex flex-column h-100">

                    <h5 class="font-weight-bolder">Absensi Anda</h5>

                  </div>
                </div>
                <div class="container-fluid py-4">
                  <form action="" method="post">
                    <div class="form-group row">
                      <div class="col-lg-3 col-md-12 col-12 col-xs-12">
                        <select class="form-control" id="exampleFormControlSelect1" name="pelajaran">
                          <option selected>Pilih Pelajaran</option>
                          <?php
                          $data_kelas = $konek->query("select kelas from siswa where NIS = '$_SESSION[Id_User]'");
                          $kelas;
                          while ($data = $data_kelas->fetch_assoc()) {
                            $kelas = $data['kelas'];
                          }
                          $sql = $konek->query("SELECT pelajaran.nama_pelajaran, pelajaran.id_pelajaran FROM `jadwal` INNER JOIN pelajaran on jadwal.id_pelajaran = pelajaran.id_pelajaran inner JOIN kelas on jadwal.id_kelas = kelas.id_kelas WHERE jadwal.id_kelas = '$kelas'");
                          while ($data = $sql->fetch_assoc()) { ?>
                            <option <?php if (!empty($_POST['pelajaran'])) {
                                      if ($_POST['pelajaran'] == $data['id_pelajaran']) echo 'selected';
                                    } ?> value="<?= $data['id_pelajaran'] ?>"><?= $data['nama_pelajaran'] ?></option>
                          <?php }
                          ?>
                        </select>
                      </div>
                      <div class="col-lg-3 col-md-12 col-12 col-xs-12">
                        <input type="submit" class="btn btn-sm btn-info" name="submit" value="cari">
                      </div>
                    </div>
                  </form>
                </div>
                <div class="col-12">
                  <div class="table-responsive">
                    <table id="tabel" class="table align-items-center mb-3">

                      <!-- Data Jadwal -->
                      <?php
                      if (empty($_POST['pelajaran'])) {
                        echo "<div class='text-danger border border-danger p-1 rounded fw-light'>Masukan pelajaran yang ingin dicari!</div>";
                      } else {
                        include "dt_absensi.php";
                      }
                      ?>
                      <!-- /Data Jadwal -->

                    </table>
                  </div>

                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>
  </main>
  <!-- /main content -->
</body>

<?php require '../comp/footer.php' ?>