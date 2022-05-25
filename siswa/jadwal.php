<?php
$title = 'Jadwal';
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

                    <h5 class="font-weight-bolder">Jadwal Anda</h5>

                  </div>
                </div>
                <div class="container-fluid py-4">
                  <div class="col-12">
                    <div class="table-responsive">
                      <table id="tabel" class="table align-items-center mb-3">
                        <thead>
                          <tr>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Pelajaran</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nama Guru</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Kelas</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Hari</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jam</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Materi</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Link</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $nis = $_SESSION["Id_User"];
                          $carikelas = mysqli_query($konek, "select kelas from siswa where nis = $nis");

                          $hasil = mysqli_fetch_array($carikelas);

                          $res = $hasil['kelas'];

                          $sql = "SELECT * FROM jadwal INNER JOIN pelajaran ON jadwal.id_pelajaran = pelajaran.id_pelajaran INNER JOIN guru ON jadwal.id_guru = guru.id_guru INNER JOIN kelas ON jadwal.id_kelas = kelas.id_kelas INNER JOIN hari ON jadwal.no_hari = hari.id_hari where jadwal.id_kelas = '$res'";
                          $queryjadwal = mysqli_query($konek, $sql);
                          if ($queryjadwal == false) {
                            die("Terjadi Kesalahan : " . mysqli_error($konek));
                          }
                          while ($jadwal = mysqli_fetch_array($queryjadwal)) :
                          ?>

                            <tr>
                              <td class="align-middle text-sm">
                                <span class="badge badge-sm badge-success" style="padding-left: 15px;">
                                  <a href="tugas.php?kode_pelajaran=<?= $jadwal['id_pelajaran'] ?>&kode_kelas=<?= $jadwal['id_kelas'] ?>"><?= $jadwal['nama_pelajaran'] ?></a>
                                </span>
                              </td>
                              <td class="align-middle text-sm">
                                <span class="text-secondary text-xs font-weight-bolds">
                                  <?= $jadwal['nama_guru'] ?>
                                </span>
                              </td>
                              <td class="align-middle text-center text-sm">
                                <span class="text-xs font-weight-bold">
                                  <?= $jadwal['nama_kelas'] ?>
                                </span>
                              </td>
                              <td class="align-middle text-center text-sm">
                                <span class="text-secondary text-xs font-weight-bolds">
                                  <?= $jadwal['nama_hari'] ?>
                                </span>
                              </td>
                              <td class="align-middle text-center text-sm">
                                <span class="text-secondary text-xs font-weight-bolds">
                                  <?= $jadwal['jam'] ?>
                                </span>
                              </td>
                              <td class="align-middle text-center text-sm">
                                <span class="text-secondary text-xs font-weight-bolds">
                                  <a href="unduh_jadwal.php?file=<?= $jadwal['materijadwal'] ?>"><?= $jadwal['materijadwal'] ?></a>
                                </span>
                              </td>
                              <td class="align-middle text-center text-sm">
                                <span class="badge badge-sm bg-gradient-info">
                                  <a class="text-white" href="<?= $jadwal['link_vidcon'] ?>">Gabung</a>
                                </span>
                              </td>
                            </tr>
                          <?php endwhile; ?>

                        </tbody>
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