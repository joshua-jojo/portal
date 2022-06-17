<?php
$title = 'Ujian';
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

                    <h5 class="font-weight-bolder">Ujian Anda</h5>

                  </div>
                </div>
                <div class="container-fluid py-4">
                  <div class="col-12">
                    <div class="table-responsive">
                      <table id="tabel" class="table align-items-center mb-3">

                        <!-- Data Jadwal -->
                        <thead>
                          <tr>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Pelajaran</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nama Guru</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Kelas</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tanggal Ujian</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Waktu Mulai</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Waktu Berakhir</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tipe Ujian</th>
                            <!-- <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">UAS</th> -->
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $nis = $_SESSION["Id_User"];
                          $carikelas = mysqli_query($konek, "select kelas from siswa where nis = $nis");

                          $hasil = mysqli_fetch_array($carikelas);

                          $res = $hasil['kelas'];

                          $queryujian = mysqli_query($konek, "select * from ujian inner join kelas on ujian.id_kelas = kelas.id_kelas inner join guru on ujian.id_guru = guru.id_guru inner join pelajaran on ujian.id_pelajaran = pelajaran.id_pelajaran where ujian.id_kelas = '$res'");
                          if ($queryujian == false) {
                            die("Terjadi Kesalahan : " . mysqli_error($konek));
                          }
                          while ($ujian = mysqli_fetch_array($queryujian)) :
                          ?>

                            <tr>
                              <td class="align-middle text-sm">
                                <span class="text-secondary text-xs font-weight-bolds" style="padding-left: 15px;">
                                  <?= $ujian['nama_pelajaran'] ?>
                                </span>
                              </td>
                              <td class="align-middle text-sm">
                                <span class="text-secondary text-xs font-weight-bolds">
                                  <?= $ujian['nama_guru'] ?>
                                </span>
                              </td>
                              <td class="align-middle text-center text-sm">
                                <span class="text-xs font-weight-bold">
                                  <?= $ujian['nama_kelas'] ?>
                                </span>
                              </td>
                              <td class="align-middle text-center text-sm">
                                <span class="text-xs font-weight-bold">
                                  <?= $ujian['tanggalujian'] ?>
                                </span>
                              </td>
                              <td class="align-middle text-center text-sm">
                                <span class="text-xs font-weight-bold">
                                  <?= $ujian['waktumulai'] ?>
                                </span>
                              </td>
                              <td class="align-middle text-center text-sm">
                                <span class="text-xs font-weight-bold">
                                  <?= $ujian['waktuakhir'] ?>
                                </span>
                              </td>
                              <td class="align-middle text-center text-sm">
                                <?php
                                if ($ujian['tipeujian'] != null) { ?>
                                  <span class="text-xs font-weight-bold">
                                    <a href="<?= "../file/" . $ujian['soal'] ?>" target="_blank" download>Soal <?= $ujian['tipeujian'] ?></a>
                                  </span>
                                  <br>

                                  <?php
                                  $data_cek = mysqli_query($konek, "SELECT * FROM `ujian_murid` WHERE id_ujianjawaban = '$ujian[id_ujian]' AND id_murid = '$_SESSION[Id_User]'");
                                  $data = mysqli_num_rows($data_cek);
                                  if ($data != null) {
                                    while ($ujian_data = mysqli_fetch_array($data_cek)) :
                                  ?>
                                      <span class="text-xs font-weight-bold">
                                        <a href="<?= "../ujian_murid/" . $ujian_data['jawaban'] ?>" target="_blank" download>Lihat Jawaban <?= $ujian['tipeujian'] ?> Saya</a>
                                      </span>
                                    <?php
                                    endwhile;
                                  } else { ?>
                                    <span class="badge badge-sm bg-gradient-info">
                                      <a class="text-white open_modal_uts" onclick="edit(<?= $ujian['id_ujian'] ?>)" href="#" data-bs-toggle="modal" data-bs-target="#exampleModal">UPLOAD <?= $ujian['tipeujian'] ?></a>
                                    </span>
                                    <br>
                                    <span class="text-xs font-weight-bold">
                                      Belum Ada Jawaban
                                    </span>
                                  <?php    } ?>
                                <?php } else { ?>
                                  <span class="text-xs font-weight-bold">
                                    Belum Ada Soal
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
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">

    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Upload Ujian</h5>
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
function edit(m){
  $.ajax({
        url: "api_upload_ujian.php",
        type: "GET",
        data: {
          Id_Ujian: m,
        },
        success: function(ajaxData) {
          $("#exampleModal").html(ajaxData)
          $("#exampleModal").modal('show', {
            backdrop: 'true'
          })
        }
      })
}
</script>
<?php require '../comp/footer.php' ?>