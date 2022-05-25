<!-- File ini bikin baru tanpa merubah file yang lama -->
<!-- Semua sintaks di sini dibuat sendiri kak -->

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
    <?php $title = 'Tugas' ?>
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

                    <h5 class="font-weight-bolder">Tugas Anda</h5>
                  </div>
                </div>
                <?php $id  = $_GET['kode_pelajaran'];
                $kelas  = $_GET['kode_kelas']; ?>

                <a href="forum.php?kode_kelas=<?= $kelas ?>&kode_pelajaran=<?= $id ?>"><button class="btn btn-info" type="button"> Forum</button></a>
                <div class="col-12">
                  <div class="table-responsive">
                    <table id="tabel" class="table align-items-center mb-3">

                      <!-- Data Jadwal -->

                      <?php


                      $nis = $_SESSION["Id_User"];
                      $kd_pelajaran = $_GET['kode_pelajaran'];
                      $carikelas = mysqli_query($konek, "select kelas from siswa where nis = $nis");

                      $hasil = mysqli_fetch_array($carikelas);

                      $res = $hasil['kelas'];

                      // $querymatakuliah = mysqli_query ($konek, "select tugas.kode_tugas,kode_kelas,nama_kelas,Nama_guru,nama_pelajaran,tugas,DATE_FORMAT(tanggal, '%d-%m-%Y')as tanggal from tugas inner join kelas on tugas.kode_kelas = kelas.id_kelas inner join guru on tugas.kode_guru = guru.kode_guru inner join pelajaran on tugas.kode_pelajaran = pelajaran.kode_pelajaran where tugas.kode_pelajaran = '$kd_pelajaran' and tugas.kode_kelas = '$res'");
                      // $querymatakuliah = mysqli_query($konek, "select * from tugas inner join kelas on tugas.id_kelas = kelas.id_kelas inner join guru on tugas.id_guru = guru.id_guru inner join pelajaran on tugas.id_pelajaran = pelajaran.id_pelajaran where tugas.id_pelajaran = '$kd_pelajaran' and tugas.id_kelas = '$res'");
                      $querymatakuliah = mysqli_query($konek, "select tugas.id_tugas, tugas.id_kelas, nama_kelas, nama_guru, nama_pelajaran, file_tugas, file_jawaban, DATE_FORMAT(tanggal, '%d-%m-%Y') as tanggal from tugas left join kelas on tugas.id_kelas = kelas.id_kelas left join guru on tugas.id_guru = guru.id_guru left join pelajaran on tugas.id_pelajaran = pelajaran.id_pelajaran left join jawaban_tugas on tugas.id_tugas = jawaban_tugas.id_tugas where tugas.id_pelajaran = '$kd_pelajaran' and tugas.id_kelas = '$res'");


                      ?>



                      <thead>
                        <tr>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No.</th>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Kelas</th>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Guru</th>
                          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Pelajaran</th>
                          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tugas</th>
                          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Batas Akhir</th>
                          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $no = 1;
                        while ($tugas = mysqli_fetch_array($querymatakuliah)) : ?>
                          <tr>
                            <td class="align-middle text-sm">
                              <span class="text-secondary text-xs font-weight-bolds">
                                <?= $no++ ?>
                              </span>
                            </td>
                            <td class="align-middle text-sm">
                              <span class="text-secondary text-xs font-weight-bolds">
                                <?= $tugas['nama_kelas'] ?>
                              </span>
                            </td>
                            <td class="align-middle text-center text-sm">
                              <span class="text-xs font-weight-bold">
                                <?= $tugas['nama_guru'] ?>
                              </span>
                            </td>
                            <td class="align-middle text-center text-sm">
                              <span class="text-secondary text-xs font-weight-bolds">
                                <?= $tugas['nama_pelajaran'] ?>
                              </span>
                            </td>
                            <td class="align-middle text-center text-sm">
                              <span class="text-secondary text-xs font-weight-bolds">
                                <a href="unduh_tugas.php?file=<?= $tugas['file_tugas'] ?>"><?= $tugas['file_tugas'] ?></a>
                              </span>
                            </td>
                            <td class="align-middle text-center text-sm">
                              <span class="text-secondary text-xs font-weight-bolds">
                                <?= $tugas['tanggal'] ?>
                              </span>
                            </td>

                            <!-- <td class="align-middle text-center text-sm">
                              <span class="badge badge-sm bg-gradient-info">
                                <a href='#' class='open_modal' data-bs-toggle="modal" data-bs-target="#exampleModal" id="<?= $tugas['id_tugas'] ?>">Upload</a>
                              </span>
                            </td> -->
                            <td class="align-middle text-center text-sm">

                              <?php if ($tugas['file_jawaban'] != null) { ?>
                                <span class="badge badge-sm bg-gradient-info">
                                  <a href='#' class='open_modal update' data-bs-toggle="modal" data-bs-target="#update" id="<?= $tugas['id_tugas'] ?>">Upload</a>
                                </span>
                                <br>
                                <span class="text-xs font-weight-bold">
                                  <a href="unduh_jawaban.php?file=<?= $tugas['file_jawaban'] ?>" target="_blank">Lihat Jawaban Saya</a>
                                </span>
                              <?php } else { ?>
                                <span class="badge badge-sm bg-gradient-info">
                                  <a href='#' class='open_modal add' data-bs-toggle="modal" data-bs-target="#exampleModal" id="<?= $tugas['id_tugas'] ?>">Upload</a>
                                </span>
                                <br>
                                <span class="text-xs font-weight-bold">
                                  Belum Ada Jawaban
                                </span>
                              <?php    } ?>

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

<!-- Modal add tugas -->
<div class="modal fade" id="update" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">

    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Upload Jawaban Tugas</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      </div>

      <div class="modal-footer">
        <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="submit" class="btn bg-gradient-primary">Upload</button>
      </div>
    </div>

  </div>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">

    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Upload Jawaban Tugas</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      </div>

      <div class="modal-footer">
        <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="submit" class="btn bg-gradient-primary">Upload</button>
      </div>
    </div>

  </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script type="text/javascript">
  $(document).ready(function() {

    $(".update").click(function(e) {
      var m = $(this).attr("id")
      $.ajax({
        url: "tugas_update.php",
        type: "GET",
        data: {
          kode_tugas: m,
        },
        success: function(ajaxData) {
          $("#update").html(ajaxData)
          $("#update").modal('show', {
            backdrop: 'true'
          })
        }
      })

    })
    $(".add").click(function(e) {
      var m = $(this).attr("id")
      $.ajax({
        url: "tugas_uploadd.php",
        type: "GET",
        data: {
          kode_tugas: m,
        },
        success: function(ajaxData) {
          $("#exampleModal").html(ajaxData)
          $("#exampleModal").modal('show', {
            backdrop: 'true'
          })
        }
      })

    })

  })
</script>

<?php require '../comp/footer.php' ?>