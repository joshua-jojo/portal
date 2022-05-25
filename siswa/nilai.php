<?php
$title = 'Nilai';
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

                    <h5 class="font-weight-bolder">Nilai Anda</h5>

                  </div>
                </div>
                <div class="container-fluid py-4">
                  <a href="cetak_nilai.php" class="btn btn-success">Cetak</a>
                </div>

                <div class="col-12">
                  <div class="table-responsive">
                    <table id="tabel" class="table align-items-center mb-3">

                      <!-- Data Jadwal -->
                      <thead>
                        <tr>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Siswa</th>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nama Pelajaran</th>
                          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Kelas</th>
                          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nilai Tugas Offline</th>
                          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nilai Tugas Online</th>
                          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">UTS</th>
                          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">UAS</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $querynilai = mysqli_query($konek, "SELECT DISTINCT nilai.tugas_siswa,nilai.id_siswa,pelajaran.id_pelajaran,kelas.nama_kelas,pelajaran.nama_pelajaran, siswa.nama_siswa FROM nilai INNER JOIN pelajaran on pelajaran.id_pelajaran = nilai.id_pelajaran INNER JOIN siswa on nilai.id_siswa = siswa.NIS INNER JOIN kelas on kelas.id_kelas = siswa.kelas where nilai.id_siswa = '$_SESSION[Id_User]' ORDER BY pelajaran.nama_pelajaran");
                        // $querynilai = mysqli_query($konek, "select * from users left join jawaban_tugas on users.id_users = jawaban_tugas.id_siswa left join tugas on jawaban_tugas.id_tugas = tugas.id_tugas inner join kelas on tugas.id_kelas = kelas.id_kelas inner join guru on tugas.id_guru = guru.id_guru inner join pelajaran on tugas.id_pelajaran = pelajaran.id_pelajaran left join ujian_murid on users.id_users = ujian_murid.id_murid group by users.id_users");
                        if ($querynilai == false) {
                          die("Terjadi Kesalahan : " . mysqli_error($konek));
                        }
                        ?>
                        <?php while ($nilai = mysqli_fetch_array($querynilai)) : ?>
                          <tr>

                            <td class="align-middle text-sm">
                              <span class="text-secondary text-xs font-weight-bolds">
                                <?= $nilai['nama_siswa'] ?>
                              </span>
                            </td>
                            <td class="align-middle text-sm">
                              <span class="text-secondary text-xs font-weight-bolds">
                                <?= $nilai['nama_pelajaran'] ?>
                              </span>
                            </td>
                            <td class="align-middle text-center text-sm">
                              <span class="text-xs font-weight-bold">
                                <?= $nilai['nama_kelas'] ?>
                              </span>
                            </td>
                            <td class="align-middle text-center text-sm">
                              <span class="text-secondary text-xs font-weight-bolds">
                                <?= $nilai['tugas_siswa'] ?>
                              </span>
                            </td>
                            <?php
                            $querynilaitugas = mysqli_query($konek, "select * from tugas left join jawaban_tugas on tugas.id_tugas = jawaban_tugas.id_tugas where jawaban_tugas.id_siswa = '$nilai[id_siswa]' and tugas.id_pelajaran = '$nilai[id_pelajaran]'");
                            $nilaitugascek = mysqli_num_rows($querynilaitugas);
                            if ($nilaitugascek > 0) {
                              $nilaitugas = 0;
                              $jumlah = 0;
                              while ($datanilai = mysqli_fetch_array($querynilaitugas)) :
                            ?>
                                <?php $nilaitugas += $datanilai['nilai'];
                                $jumlah++; ?>
                              <?php
                              endwhile; ?>
                              <td class="align-middle text-center text-sm">
                                <span class="text-secondary text-xs font-weight-bolds">
                                  <?php
                                  if ($nilaitugas != '0') {
                                    echo round($nilaitugas / $jumlah, 2);
                                  } else {
                                    echo "-";
                                  }
                                  ?>
                                </span>
                              </td>
                            <?php
                            } else { ?>
                              <td class="align-middle text-center text-sm">
                                <span class="text-secondary text-xs font-weight-bolds">
                                  -
                                </span>
                              </td>
                            <?php
                            }
                            ?>

                            <?php
                            $querynilaiuts = mysqli_query($konek, "select * from ujian left join ujian_murid on ujian.id_ujian = ujian_murid.id_ujianjawaban where ujian_murid.id_murid = '$nilai[id_siswa]' and ujian.tipeujian = 'UTS' and ujian.id_pelajaran = '$nilai[id_pelajaran]' limit 1");
                            $nilaiuts = mysqli_fetch_array($querynilaiuts);
                            $nilaiutscek = mysqli_num_rows($querynilaiuts);

                            if ($nilaiutscek > 0) { ?>
                              <td class="align-middle text-center text-sm">
                                <span class="text-secondary text-xs font-weight-bolds">
                                  <?= $nilaiuts['nilai'] ?>
                                </span>
                              </td>
                            <?php
                            } else { ?>
                              <td class="align-middle text-center text-sm">
                                <span class="text-secondary text-xs font-weight-bolds">
                                  -
                                </span>
                              </td>
                            <?php
                            }
                            $querynilaiuas = mysqli_query($konek, "select * from ujian left join ujian_murid on ujian.id_ujian = ujian_murid.id_ujianjawaban where ujian_murid.id_murid = '$nilai[id_siswa]' and ujian.tipeujian = 'UAS' and ujian.id_pelajaran = '$nilai[id_pelajaran]' limit 1");
                            $nilaiuas = mysqli_fetch_array($querynilaiuas);
                            $nilaiuascek = mysqli_num_rows($querynilaiuas);

                            if ($nilaiuascek > 0) { ?>
                              <td class="align-middle text-center text-sm">
                                <span class="text-secondary text-xs font-weight-bolds">
                                  <?= $nilaiuas['nilai'] ?>
                                </span>
                              </td>
                            <?php } else { ?>
                              <td class="align-middle text-center text-sm">
                                <span class="text-secondary text-xs font-weight-bolds">
                                  -
                                </span>
                              </td>
                            <?php
                            } ?>
                          </tr>
                        <?php endwhile; ?>

                      </tbody>
                      <!--/ Data Jadwal -->

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