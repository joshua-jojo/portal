<?php
$title = 'Data Tagihan';
$path = '../';
require 'comp/header.php';

session_start();
include "../koneksi.php";
include "auth_user.php";

$bulan = date("i");
$tahun = date("s");
$format_id = $bulan . $tahun;
?>

<body class="g-sidenav-show bg-gray-100">
  <!-- aside -->
  <?php require 'comp/sidebar.php' ?>
  <!--/ aside -->

  <div class="main-content position-relative bg-gray-100 max-height-vh-100 h-100">

    <!-- navbar -->
    <?php require '../comp/navbar.php' ?>
    <!-- /navbar -->

    <div class="container-fluid py-4">

      <div class="row mt-4">
        <div class="col-lg-12 mb-lg-0 mb-4">
          <div class="card shadow-none">
            <div class="card-body p-3">
              <div class="row">

                <div class="container-fluid py-4">

                  <div class="col-12">
                    <div class="table-responsive">
                      <table class="table align-items-center mb-3">


                        <thead>
                          <tr>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ID</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nama Siswa</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Kelas</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Tanggal</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Tagihan Bulan</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Total Tagihan</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">No. Rek</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Catatan</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Bukti Pembayaran</th>

                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $querydosen = mysqli_query($konek, "select id_tagihan , no_rekening, bukti_pembayaran,total_tagihan, Nama_siswa, DATE_FORMAT(tanggal, '%d-%m-%Y')as tanggal, nama_kelas,nama_bulan,catatan from tagihan inner join bulan on tagihan.id_bulan  = bulan.id_bulan_spp inner join kelas on tagihan.kode_kelas = kelas.id_kelas inner join siswa on tagihan.id_siswa = siswa.NIS where tagihan.kode_kelas='$_POST[kelas]' and tagihan.id_bulan='$_POST[bulan]'");
                          if ($querydosen == false) {
                            die("Terjadi Kesalahan : " . mysqli_error($konek));
                          }
                          ?>

                          <?php while ($tagihan = mysqli_fetch_array($querydosen)) : ?>

                            <tr>
                              <td class="align-middle text-sm">
                                <span class="text-secondary text-xs font-weight-bolds">
                                  <?= $tagihan['id_tagihan'] ?>
                                </span>
                              </td>
                              <td class="align-middle text-sm">
                                <span class="text-secondary text-xs font-weight-bolds">
                                  <?= $tagihan['Nama_siswa'] ?>
                                </span>
                              </td>
                              <td class="align-middle text-sm">
                                <span class="text-secondary text-xs font-weight-bolds">
                                  <?= $tagihan['nama_kelas'] ?>
                                </span>
                              </td>
                              <td class="align-middle text-sm">
                                <span class="text-secondary text-xs font-weight-bolds">
                                  <?= $tagihan['tanggal'] ?>
                                </span>
                              </td>
                              <td class="align-middle text-sm">
                                <span class="text-secondary text-xs font-weight-bolds">
                                  <?= $tagihan['nama_bulan'] ?>
                                </span>
                              </td>
                              <td class="align-middle text-sm">
                                <span class="badge badge-sm bg-gradient-warning text-white">
                                  <?= $tagihan['total_tagihan'] ?>
                                </span>
                              </td>
                              <td class="align-middle text-sm">
                                <span class="badge badge-sm bg-gradient-warning text-white">
                                  <?= $tagihan['no_rekening'] ?>
                                </span>
                              </td>
                              <td class="align-middle text-sm">
                                <span class="badge badge-sm bg-gradient-warning text-white">
                                  <?= $tagihan['catatan'] ?>
                                </span>
                              </td>

                            </tr>
                          <?php endwhile; ?>


                        </tbody>


                      </table>



                    </div>

                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>

      </div>
    </div>
</body>


</body>

<script type="text/javascript">
  window.print();
</script>

<?php require '../comp/footer.php' ?>