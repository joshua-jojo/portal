<?php
$title = 'Nilai Siswa';
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
          <div class="card shadow-none">
            <div class="card-body p-3">
              <div class="row">

                <div class="col-12">
                  <div class="table-responsive">

                    <table id="data" class="table align-items-center mb-3">
                      <thead>
                        <tr>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Siswa</th>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Pelajaran</th>
                          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tugas Offline</th>
                          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tugas Online</th>
                          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">UTS</th>
                          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">UAS</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $sql = "SELECT * from nilai inner join siswa on nilai.id_siswa = siswa.nis inner join pelajaran on nilai.id_pelajaran = pelajaran.id_pelajaran where siswa.nama_kelas = '$_POST[kelas]' order by nama_siswa asc";

                        if ($_POST['kelas'] == '') {
                          $sql = "SELECT * from nilai inner join siswa on nilai.id_siswa = siswa.nis inner join pelajaran on nilai.id_pelajaran = pelajaran.id_pelajaran order by nama_siswa asc";
                        }

                        $querynilai = mysqli_query($konek, $sql);
                        if ($querynilai == false) {
                          die("Terjadi Kesalahan : " . mysqli_error($konek));
                        }
                        while ($nilai = mysqli_fetch_array($querynilai)) :
                        ?>
                          <tr>
                            <td class="align-middle text-sm">
                              <span class="text-secondary text-xs font-weight-bolds">
                                <?= $nilai['nama_siswa'] ?>
                              </span>
                            </td>
                            <td class="align-middle text-center text-sm">
                              <span class="text-xs font-weight-bold">
                                <?= $nilai['nama_pelajaran'] ?>
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
                                <?php $nilaitugas += $datanilai['nilai'] ?>
                              <?php $jumlah++;
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
<script>
  window.print()
</script>

<?php require '../comp/footer.php' ?>