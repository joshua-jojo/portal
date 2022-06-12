<?php
$title = 'Absensi';
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
                <div class="col-lg-6">
                  <div class="d-flex flex-column h-100">

                    <h5 class="font-weight-bolder">Absensi</h5>

                  </div>
                </div>

                <div class="container-fluid py-4">
                  <!-- cari -->
                  <div class="row justify-content-between">
                    <div class="col-xl-12 col-sm-12">
                      <form action="" method="post">
                        <div class="form-group row">
                          <div class="col-lg-3 col-md-12 col-12 col-xs-12">
                            <select class="form-control mb-1" id="exampleFormControlSelect1" name="pelajaran">
                              <option selected>Pilih Pelajaran</option>
                              <?php
                              $sql = $konek->query("SELECT * from pelajaran");
                              while ($data = $sql->fetch_assoc()) { ?>
                                <option <?php if (!empty($_POST['pelajaran'])) {
                                          if ($_POST['pelajaran'] == $data['id_pelajaran']) echo 'selected';
                                        } ?> <?php if (!empty($_GET['pelajaran'])) {
                                                if ($_GET['pelajaran'] == $data['id_pelajaran']) echo 'selected';
                                              } ?> value="<?= $data['id_pelajaran'] ?>"><?= $data['nama_pelajaran'] ?></option>
                              <?php }
                              ?>
                            </select>
                          </div>
                          <div class="col-lg-3 col-md-12 col-12 col-xs-12">
                            <button type="submit" class="btn btn-sm bg-gradient-success" name="submit" value="cari">Cari</button>
                          </div>

                        </div>
                      </form>
                    </div>
                  </div>
                  <!-- cetak -->
                  <div class="row justify-content-between">
                    <div class="col-xl-12 col-sm-12">
                      <form action="cetak_absensi.php" method="post" target="_blank">
                        <input type="text" name="namaGuru" value="<?= $_SESSION['Id_User'] ?>" hidden>
                        <div class="form-group row">
                          <div class="col-lg-3 col-md-12 col-12 col-xs-12">
                            <select class="form-control mb-1" id="exampleFormControlSelect1" name="pelajaran">
                              <option selected>Pilih Pelajaran</option>
                              <?php
                              $sql = $konek->query("SELECT * from pelajaran");
                              while ($data = $sql->fetch_assoc()) {
                                echo "<option value='$data[id_pelajaran]'>$data[nama_pelajaran]</option>";
                              }
                              ?>
                            </select>
                          </div>
                          <div class="col-lg-3 col-md-12 col-12 col-xs-12">
                            <select class="form-control mb-1" id="exampleFormControlSelect1" name="kelas">
                              <option selected>Pilih kelas</option>
                              <?php
                              $sql = $konek->query("SELECT * FROM kelas");
                              while ($data = $sql->fetch_assoc()) {
                                echo "<option value='$data[id_kelas]'>$data[nama_kelas]</option>";
                              }
                              ?>
                            </select>
                          </div>
                          <div class="col-lg-3 col-md-12 col-12 col-xs-12">
                            <input type="date" class="mb-3 form-control" name='tanggal'>
                          </div>
                          <div class="col-lg-3 col-md-12 col-12 col-xs-12">
                            <button type="submit" class="btn btn-sm bg-gradient-success" name="submit" value="cetak">Cetak</button>
                          </div>

                        </div>
                      </form>
                    </div>
                  </div>
                </div>
                <div class="col-12">

                  <div class="table-responsive">
                    <table id="tabel" class="table align-items-center mb-3">

                      <?php
                      if (!empty($_POST['pelajaran'])) {
                      ?>
                        <thead>
                          <tr>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ID Siswa</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nama Siswa</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Kelas</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Pelajaran</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tanggal</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php

                          // $querydosen = mysqli_query($konek, " select nama_siswa, id_kelas, id_pelajaran, tanggal, status from absensi inner join jadwal on absensi.id_pelajaran = jadwal.id_pelajaran inner join pelajaran on absensi.id_pelajaran = pelajaran.id_pelajaran inner join kelas on absensi.id_kelas = kelas.id_kelas where jadwal.id_guru='$_SESSION[Id_User]' and jadwal.id_pelajaran = '$_POST[pelajaran]'");
                          $querydosen = mysqli_query($konek, " select DISTINCT absensi.id_absensi, absensi.nama_siswa, absensi.id_kelas, jadwal.id_pelajaran, nama_kelas, nama_pelajaran, DATE_FORMAT(tanggal,'%d-%m-%Y') as tanggal, status from absensi inner join jadwal on absensi.id_pelajaran = jadwal.id_pelajaran inner join pelajaran on absensi.id_pelajaran = pelajaran.id_pelajaran inner join kelas on absensi.id_kelas = kelas.id_kelas where jadwal.id_guru='$_SESSION[Id_User]' and jadwal.id_pelajaran = '$_POST[pelajaran]'");
                          if ($querydosen == false) {
                            die("Terjadi Kesalahan : " . mysqli_error($konek));
                          }
                          ?>
                          <?php
                          $no = 1;
                          while ($absen = mysqli_fetch_array($querydosen)) : ?>

                            <tr>
                              <td class="align-middle text-sm">
                                <span class="text-secondary text-xs font-weight-bolds" style="padding-left: 15px;">
                                  <?= $absen['id_absensi'] ?>
                                </span>
                              </td>
                              <td class="align-middle text-sm">
                                <span class="text-secondary text-xs font-weight-bolds">
                                  <?= $absen['nama_siswa'] ?>
                                </span>
                              </td>
                              <td class="align-middle text-center text-sm">
                                <span class="text-xs font-weight-bold">
                                  <?= $absen['nama_kelas'] ?>
                                </span>
                              </td>
                              <td class="align-middle text-center text-sm">
                                <span class="text-secondary text-xs font-weight-bolds">
                                  <?= $absen['nama_pelajaran'] ?>
                                </span>
                              </td>
                              <td class="align-middle text-center text-sm">
                                <span class="text-secondary text-xs font-weight-bolds">
                                  <?= $absen['tanggal'] ?>
                                </span>
                              </td>
                              <td class="align-middle text-center text-sm">
                                <span class="text-secondary text-xs font-weight-bolds">
                                  <?= $absen['status'] ?>
                                </span>
                              </td>
                              <td class="align-middle text-center text-sm">
                                <span class="badge badge-sm bg-gradient-info">
                                  <a class="text-white open_modal" id="<?= $absen['id_absensi'] ?>" href="#" data-bs-toggle="modal" data-bs-target="#ModalEditAbsensi">Edit</a>
                                </span>
                                <span class="badge badge-sm bg-gradient-danger">
                                  <a class="text-white" href="#" onclick="confirm_delete(`absensi_delete.php?id_kelas=<?= $absen['id_absensi'] ?>&pelajaran=<?= $absen['id_pelajaran'] ?>`)">Delete</a>
                                </span>
                              </td>
                            </tr>
                          <?php
                            $no++;
                          endwhile; ?>

                        </tbody>
                        <?php
                        ?>

                        <!-- get -->
                      <?php
                      } elseif (!empty($_GET['pelajaran'])) {
                      ?>
                        <thead>
                          <tr>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ID Siswa</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nama Siswa</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Kelas</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Pelajaran</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tanggal</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php

                          // $querydosen = mysqli_query($konek, " select nama_siswa, id_kelas, id_pelajaran, tanggal, status from absensi inner join jadwal on absensi.id_pelajaran = jadwal.id_pelajaran inner join pelajaran on absensi.id_pelajaran = pelajaran.id_pelajaran inner join kelas on absensi.id_kelas = kelas.id_kelas where jadwal.id_guru='$_SESSION[Id_User]' and jadwal.id_pelajaran = '$_POST[pelajaran]'");
                          $querydosen = mysqli_query($konek, " select DISTINCT absensi.id_absensi, absensi.nama_siswa, absensi.id_kelas, jadwal.id_pelajaran, nama_kelas, nama_pelajaran, DATE_FORMAT(tanggal,'%d-%m-%Y') as tanggal, status from absensi inner join jadwal on absensi.id_pelajaran = jadwal.id_pelajaran inner join pelajaran on absensi.id_pelajaran = pelajaran.id_pelajaran inner join kelas on absensi.id_kelas = kelas.id_kelas where jadwal.id_guru='$_SESSION[Id_User]' and jadwal.id_pelajaran = '$_GET[pelajaran]'");
                          if ($querydosen == false) {
                            die("Terjadi Kesalahan : " . mysqli_error($konek));
                          }
                          ?>
                          <?php
                          $no = 1;
                          while ($absen = mysqli_fetch_array($querydosen)) : ?>

                            <tr>
                              <td class="align-middle text-sm">
                                <span class="text-secondary text-xs font-weight-bolds" style="padding-left: 15px;">
                                  <?= $absen['id_absensi'] ?>
                                </span>
                              </td>
                              <td class="align-middle text-sm">
                                <span class="text-secondary text-xs font-weight-bolds">
                                  <?= $absen['nama_siswa'] ?>
                                </span>
                              </td>
                              <td class="align-middle text-center text-sm">
                                <span class="text-xs font-weight-bold">
                                  <?= $absen['nama_kelas'] ?>
                                </span>
                              </td>
                              <td class="align-middle text-center text-sm">
                                <span class="text-secondary text-xs font-weight-bolds">
                                  <?= $absen['nama_pelajaran'] ?>
                                </span>
                              </td>
                              <td class="align-middle text-center text-sm">
                                <span class="text-secondary text-xs font-weight-bolds">
                                  <?= $absen['tanggal'] ?>
                                </span>
                              </td>
                              <td class="align-middle text-center text-sm">
                                <span class="text-secondary text-xs font-weight-bolds">
                                  <?= $absen['status'] ?>
                                </span>
                              </td>
                              <td class="align-middle text-center text-sm">
                                <span class="badge badge-sm bg-gradient-info">
                                  <a class="text-white open_modal" id="<?= $absen['id_absensi'] ?>" href="#" data-bs-toggle="modal" data-bs-target="#ModalEditAbsensi">Edit</a>
                                </span>
                                <span class="badge badge-sm bg-gradient-danger">
                                  <a class="text-white" href="#" onclick="confirm_delete(`absensi_delete.php?id_kelas=<?= $absen['id_absensi'] ?>&pelajaran=<?= $absen['id_pelajaran'] ?>`)">Delete</a>
                                </span>
                              </td>
                            </tr>
                          <?php
                            $no++;
                          endwhile; ?>

                        </tbody>
                      <?php }
                      ?>
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

<!-- Modal -->
<div id="ModalAdd" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Absensi</h4>
      </div>
      <div class="modal-body">
        <form action="absensi_add.php" name="modal_popup" enctype="multipart/form-data" method="post">
          <div class="form-group">
            <label>id absen</label>
            <div class="input-group">
              <div class="input-group-addon">
                1
              </div>
              <input name="id" type="text" class="form-control" value="<?php echo $format_id ?>" readonly />
            </div>
          </div>
          <div class="form-group">
            <label>siswa</label>
            <div class="input-group">
              <div class="input-group-addon">
                2
              </div>
              <input name="siswa" type="text" class="form-control" placeholder="Nama siswa" />
            </div>
          </div>
          <div class="form-group">
            <label>Tanggal</label>
            <div class="input-group date">
              <div class="input-group-addon">
                3
              </div>
              <input name="tanggal" type="date" class="form-control" placeholder="Tanggal Lahir">
            </div>
          </div>
          <div class="form-group">
            <label>Kelas</label>
            <div class="input-group">
              <div class="input-group-addon">
                4
              </div>
              <select name="kelas" class="form-control">
                <option value="">pilih Kelas</option>
                <?php
                $sql = $konek->query("select * from kelas order by id_kelas");
                while ($data = $sql->fetch_assoc()) {
                  echo "<option value='$data[id_kelas]'>$data[nama_kelas]</option>";
                }
                ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label>pelajaran</label>
            <div class="input-group">
              <div class="input-group-addon">
                5
              </div>
              <select name="pelajaran" class="form-control">
                <option value="">pilih pelajaran</option>
                <?php
                $sql = $konek->query("select * from pelajaran order by nama_pelajaran asc");
                while ($data = $sql->fetch_assoc()) {
                  echo "<option value='$data[kode_pelajaran]'>$data[nama_pelajaran]</option>";
                }
                ?>
              </select>
            </div>
          </div>

          <div class="form-group">
            <label>status</label>
            <div class="input-group">
              <div class="input-group-addon">
                6
              </div>
              <select name="status" class="form-control">
                <option value="">Pilih status</option>
                <option value="hadir">hadir</option>
                <option value="tidak hadir">tidak hadir</option>
                <option value="izin">izin</option>
              </select>
            </div>
          </div>



          <div class="modal-footer">
            <button class="btn btn-info" type="submit">
              Tambah
            </button>

          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- /Modal -->
<div class="modal fade" id="modal_delete" tabindex="-1" role="dialog" aria-labelledby="modal_delete" aria-hidden="true">
  <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title" id="modal-title-notification">Peringatan</h6>
        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="py-3 text-center">
          <i class="ni ni-bell-55 ni-3x"></i>
          <h4 class="text-gradient text-danger mt-4">Apakah Anda Yakin Ingin Menghapus?</h4>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary text-white ml-auto" data-bs-dismiss="modal">Batal</button>
        <a class="btn btn-danger" href="" id="delete_link">Hapus</a>
      </div>
    </div>
  </div>
</div>
</div>
<!-- Delete -->


<!-- Modal Popup Kelas Edit -->
<div class="modal fade" id="ModalEditAbsensi" tabindex="-1" role="dialog" aria-labelledby="ModalEditAbsensiLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn bg-gradient-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script type="text/javascript">
  $(document).ready(function() {

    // Siswa
    $(".open_modal").click(function(e) {
      var m = $(this).attr("id");

      $.ajax({
        url: "api_edit_absensi.php",
        type: "GET",
        data: {
          id_presensi: m,
        },
        success: function(ajaxData) {

          console.log(ajaxData);
          $("#ModalEditAbsensi").html(ajaxData);

        }
      });
    });
  });



  function confirm_delete(delete_url) {
    $("#modal_delete").modal('show', {
      backdrop: 'static'
    });

    document.getElementById('delete_link').setAttribute('href', delete_url);
  }
</script>

<?php require '../comp/footer.php' ?>