<?php
$title = 'Data Absensi';
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
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-lg-6">
                  <div class="d-flex flex-column h-100">

                    <h5 class="font-weight-bolder">Absensi</h5>

                  </div>
                </div>

                <div class="container-fluid py-4">
                  <div class="row justify-content-between">

                    <!-- Cetak -->
                    <div class="col-xl-12 col-sm-12">
                      <form action="cetak_absensi.php" method="post" target="_blank">
                        <input type="text" name="namaGuru" value="<?= $_SESSION['Id_User'] ?>" hidden>
                        <div class="form-group row">
                          <div class="col-lg-3 col-md-12 col-12 col-xs-12">
                            <select class="form-control mb-1" id="exampleFormControlSelect1" name="pelajaran">
                              <option selected>Pilih Pelajaran</option>
                              <?php

                              $sql = $konek->query("select * from pelajaran");
                              while ($data = $sql->fetch_assoc()) {
                                echo "<option value='$data[id_pelajaran]'>$data[nama_pelajaran]</option>";
                              }
                              ?>
                            </select>
                          </div>
                          <div class="col-lg-3 col-md-12 col-12 col-xs-12">
                            <select class="form-control mb-1" id="exampleFormControlSelect1" name="kelas">
                              <option selected>Pilih Kelas</option>
                              <?php

                              $sql = $konek->query("select * from kelas");
                              while ($data = $sql->fetch_assoc()) {
                                echo "<option value='$data[id_kelas]'>$data[nama_kelas]</option>";
                              }
                              ?>
                            </select>
                          </div>
                          <div class="col-lg-3 col-md-12 col-12 col-xs-12">
                            <input type="date" class="mb-3 form-control" name="tanggal">
                          </div>
                          <div class="col-lg-3 col-md-12 col-12 col-xs-12">
                            <input type="submit" name="submit" value="Cetak Absen" class="btn btn-sm btn-success">
                          </div>

                        </div>
                      </form>
                    </div>
                    <!-- /Cetak -->


                  </div>
                  <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#tambahAbsensi">Tambah Absensi</button>
                </div>



                <div class="table-responsive">
                  <table id="tabel" class="table align-items-center mb-3">


                    <thead>
                      <tr>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Id Absen</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nama Siswa</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Kode Kelas</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Pelajaran</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Tanggal</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Status</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $querydosen = mysqli_query($konek, "SELECT * FROM absensi inner join kelas on absensi.id_kelas = kelas.id_kelas inner join pelajaran on absensi.id_pelajaran = pelajaran.id_pelajaran ORDER BY nama_siswa");
                      if ($querydosen == false) {
                        die("Terjadi Kesalahan : " . mysqli_error($konek));
                      }
                      ?>

                      <?php while ($absen = mysqli_fetch_array($querydosen)) : ?>
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

                          <td class="align-middle text-center text-sm">
                            <span class="badge badge-sm bg-gradient-info">
                              <a class="text-white open_modal" onclick="edit(<?= $absen['id_absensi'] ?>)" href="#" data-bs-toggle="modal" data-bs-target="#ModalEditAbsensi">Edit</a>
                            </span>
                            <span class="badge badge-sm bg-gradient-danger">
                              <a class="text-white" href="#" onclick="confirm_delete(`absensi_delete.php?id_kelas=<?= $absen['id_absensi'] ?>`)">Delete</a>
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

<!-- Modal Tambah Siswa -->
<div class="modal fade" id="tambahAbsensi" tabindex="-1" role="dialog" aria-labelledby="tambahAbsensiLabel" aria-hidden="true">
  <form action="absensi_add.php" enctype="multipart/form-data" method="post">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Tambah Absensi</h5>
          <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

          <!-- Form -->
          <div class="form-group">
            <label for="kode" class="form-control-label">ID Absensi</label>
            <input class="form-control" type="text" name="id" placeholder="Masukkan ID Absensi" id="kode" readonly value="<?= $format_id ?>">
          </div>

          <div class="form-group">
            <label for="nama" class="form-control-label">Siswa</label>
            <select name="siswa" id="" class="form-control">
              <option selected>Pilih Siswa</option>
              <?php
              $sql = $konek->query("select * from siswa order by nama_siswa");
              while ($data = $sql->fetch_assoc()) {
                echo "<option value='$data[nama_siswa]'>$data[nama_siswa]</option>";
              }
              ?>
            </select>
          </div>

          <div class="form-group">
            <label>Tanggal</label>

            <input name="tanggal" type="date" class="form-control" placeholder="Tanggal Lahir" required>
          </div>

          <div class="form-group">
            <label>Kelas</label>

            <select name="kelas" class="form-control" required>
              <option value="">Pilih Kelas</option>
              <?php
              $sql = $konek->query("select * from kelas order by id_kelas");
              while ($data = $sql->fetch_assoc()) {
                echo "<option value='$data[id_kelas]'>$data[nama_kelas]</option>";
              }
              ?>
            </select>
          </div>

          <div class="form-group">
            <label>Pelajaran</label>

            <select name="pelajaran" class="form-control" required>
              <option value="">pilih pelajaran</option>
              <?php
              $sql = $konek->query("select * from pelajaran order by nama_pelajaran asc");
              while ($data = $sql->fetch_assoc()) {
                echo "<option value='$data[id_pelajaran]'>$data[nama_pelajaran]</option>";
              }
              ?>
            </select>
          </div>

          <div class="form-group">
            <label>Status</label>

            <select name="status" class="form-control" required>
              <option value="">Pilih status</option>
              <option value="hadir">Hadir</option>
              <option value="tidak hadir">Tidak Hadir</option>
              <option value="izin">Izin</option>
            </select>
          </div>


        </div>
        <div class="modal-footer">
          <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn bg-gradient-primary" type="submit">Tambah</button>
        </div>
      </div>
    </div>
  </form>
</div>
<!-- /Modal Tambah Guru -->



<div class="col-md-4">
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
<!-- /Modal Popup Kelas Edit -->

</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script type="text/javascript">
  function edit(m) {
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
  }



  function confirm_delete(delete_url) {
    $("#modal_delete").modal('show', {
      backdrop: 'static'
    });

    document.getElementById('delete_link').setAttribute('href', delete_url);
  }
</script>

<?php require '../comp/footer.php' ?>