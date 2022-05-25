<?php
$title = 'Data Absensi';
$path = '../';
require '../comp/header.php';

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
          <div class="card">
            <div class="card-body p-3">
              <div class="row">

                <div class="container-fluid py-4">

                  <div class="col-12">
                    <div class="table-responsive">
                      <table class="table align-items-center mb-3">


                        <thead>
                          <tr>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Id Absen</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nama Siswa</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nama Kelas</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Pelajaran</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Tanggal</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Status</th>

                          </tr>
                        </thead>
                        <tbody>
                          <?php if ($_POST['tanggal'] !== "") : ?>
                            <?php
                            $querydosen1 = mysqli_query($konek, " select DISTINCT status,id_absensi,nama_siswa,kelas.nama_kelas,pelajaran.nama_pelajaran,tanggal from absensi inner join jadwal on absensi.id_pelajaran = jadwal.id_pelajaran inner join pelajaran on absensi.id_pelajaran = pelajaran.id_pelajaran inner join kelas on absensi.id_kelas = kelas.id_kelas where absensi.id_pelajaran = '$_POST[pelajaran]' and absensi.id_kelas='$_POST[kelas]' and absensi.tanggal='$_POST[tanggal]' order by tanggal desc");
                            if ($querydosen1 == false) {
                              die("Terjadi Kesalahan : " . mysqli_error($konek));
                            } else {
                            ?>

                              <?php while ($absen = mysqli_fetch_array($querydosen1)) : ?>

                                <tr>
                                  <td class="align-middle text-sm">
                                    <span class="text-secondary text-xs font-weight-bolds">
                                      <?= $absen['id_absensi'] ?>
                                    </span>
                                  </td>
                                  <td class="align-middle text-sm">
                                    <span class="text-secondary text-xs font-weight-bolds">
                                      <?= $absen['nama_siswa'] ?>
                                    </span>
                                  </td>
                                  <td class="align-middle text-sm">
                                    <span class="text-secondary text-xs font-weight-bolds">
                                      <?= $absen['nama_kelas'] ?>
                                    </span>
                                  </td>
                                  <td class="align-middle text-sm">
                                    <span class="text-secondary text-xs font-weight-bolds">
                                      <?= $absen['nama_pelajaran'] ?>
                                    </span>
                                  </td>
                                  <td class="align-middle text-sm">
                                    <span class="text-secondary text-xs font-weight-bolds">
                                      <?= $absen['tanggal'] ?>
                                    </span>
                                  </td>
                                  <td class="align-middle text-sm">
                                    <span class="badge badge-sm bg-gradient-warning text-white">
                                      <?= $absen['status'] ?>
                                    </span>
                                  </td>

                                </tr>
                              <?php endwhile; ?>
                            <?php }
                          else : ?>
                            <?php
                            $querydosen2 = mysqli_query($konek, " select DISTINCT status,id_absensi,nama_siswa,kelas.nama_kelas,pelajaran.nama_pelajaran,tanggal from absensi inner join jadwal on absensi.id_pelajaran = jadwal.id_pelajaran inner join pelajaran on absensi.id_pelajaran = pelajaran.id_pelajaran inner join kelas on absensi.id_kelas = kelas.id_kelas where absensi.id_pelajaran = '$_POST[pelajaran]' and kelas.id_kelas='$_POST[kelas]'");
                            if ($querydosen2 == false) {
                              die("Terjadi Kesalahan : " . mysqli_error($konek));
                            } else {
                            ?>

                              <?php while ($absen = mysqli_fetch_array($querydosen2)) : ?>
                                <tr>
                                  <td class="align-middle text-sm">
                                    <span class="text-secondary text-xs font-weight-bolds">
                                      <?= $absen['id_absensi'] ?>
                                    </span>
                                  </td>
                                  <td class="align-middle text-sm">
                                    <span class="text-secondary text-xs font-weight-bolds">
                                      <?= $absen['nama_siswa'] ?>
                                    </span>
                                  </td>
                                  <td class="align-middle text-sm">
                                    <span class="text-secondary text-xs font-weight-bolds">
                                      <?= $absen['nama_kelas'] ?>
                                    </span>
                                  </td>
                                  <td class="align-middle text-sm">
                                    <span class="text-secondary text-xs font-weight-bolds">
                                      <?= $absen['nama_pelajaran'] ?>
                                    </span>
                                  </td>
                                  <td class="align-middle text-sm">
                                    <span class="text-secondary text-xs font-weight-bolds">
                                      <?= $absen['tanggal'] ?>
                                    </span>
                                  </td>
                                  <td class="align-middle text-sm">
                                    <span class="badge badge-sm bg-gradient-warning text-white">
                                      <?= $absen['status'] ?>
                                    </span>
                                  </td>

                                </tr>
                              <?php endwhile; ?>
                          <?php
                            }
                          endif; ?>

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