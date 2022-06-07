<?php
$title = 'Tagihan';
$path = '../';
require 'comp/header.php';

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

                    <h5 class="font-weight-bolder">Tagihan Anda</h5>

                  </div>
                </div>
                <div class="col-12">
                  <div class="table-responsive">
                    <table class="table align-items-center mb-3">

                      <!-- Data Tagihan -->
                      <thead>
                        <tr>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Kelas</th>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nama Siswa</th>
                          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tanggal Jatuh Tempo</th>
                          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No. Rek</th>
                          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Pembayaran Bulan</th>
                          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Catatan</th>
                          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
                        </tr>
                      </thead>
                      <?php
                      include "dt_tagihan.php";
                      ?>
                      <!-- /Data Tagihan -->

                    </table>
                    <nav aria-label="Page navigation example">
                      <ul class="pagination justify-content-end">
                        <li class="page-item disabled">
                          <a class="page-link" href="javascript:;" tabindex="-1">
                            <i class="fa fa-angle-left"></i>
                            <span class="sr-only">Previous</span>
                          </a>
                        </li>
                        <li class="page-item active"><a class="page-link" href="javascript:;">1</a></li>
                        <li class="page-item">
                          <a class="page-link" href="javascript:;">
                            <i class="fa fa-angle-right"></i>
                            <span class="sr-only">Next</span>
                          </a>
                        </li>
                      </ul>
                    </nav>


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