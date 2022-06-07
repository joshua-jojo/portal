<?php
$title = 'Jadwal';
$path = '../';
require 'header.php';

session_start();
include "../koneksi.php";
include "auth_user.php";
?>

<body class="g-sidenav-show bg-gray-100">
  <!-- aside -->
  <?php require '../comp/sidebar.php' ?>
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

                    <h5 class="font-weight-bolder">Jadwal Anda</h5>

                  </div>
                </div>
                <div class="container-fluid py-4">
                  <div class="col-12">
                    <div class="table-responsive">
                      <table id="tabel" class="table align-items-center mb-3">

                        <?php require 'test_dt_jadwal.php' ?>

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