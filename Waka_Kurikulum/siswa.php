<?php
$title = 'Data Siswa';
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

                    <h5 class="font-weight-bolder">Data Siswa</h5>

                  </div>
                </div>


                <div class="container-fluid py-4">
                  <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#tambahSiswa">Tambah Siswa</button>
                </div>
                <div class="table-responsive">
                  <table id="tabel" class="table align-items-center mb-3">

                    <!-- Data Guru -->
                    <thead>
                      <tr>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">NIS</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Siswa</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tanggal Lahir</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jenis Kelamin</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Telepon</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Alamat</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Agama</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Kelas</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $querymhs = mysqli_query($konek, "SELECT * from siswa inner join kelas on siswa.kelas = kelas.id_kelas");
                      if ($querymhs == false) {
                        die("Terjadi Kesalahan : " . mysqli_error($konek));
                      }
                      ?>
                      <?php while ($siswa = mysqli_fetch_array($querymhs)) : ?>
                        <tr>
                          <td class="align-middle text-sm">
                            <span class="text-secondary text-xs font-weight-bolds">
                              <?= $siswa['NIS'] ?>
                            </span>
                          </td>
                          <td class="align-middle text-sm">
                            <span class="text-secondary text-xs font-weight-bolds">
                              <?= $siswa['nama_siswa'] ?>
                            </span>
                          </td>
                          <td class="align-middle text-center text-sm">
                            <span class="text-xs font-weight-bold">
                              <?= $siswa['tanggal_lahir'] ?>
                            </span>
                          </td>
                          <td class="align-middle text-center text-sm">
                            <span class="text-secondary text-xs font-weight-bolds">
                              <?php
                              if ($siswa["gender"] == "L") {
                                echo "Laki - laki";
                              } else {
                                echo "Perempuan";
                              }
                              ?>
                            </span>
                          </td>
                          <td class="align-middle text-center text-sm">
                            <span class="text-secondary text-xs font-weight-bolds">
                              <?= $siswa['no_hp'] ?>
                            </span>
                          </td>
                          <td class="align-middle text-center text-sm">
                            <span class="text-secondary text-xs font-weight-bolds">
                              <?= $siswa['alamat'] ?>
                            </span>
                          </td>
                          <td class="align-middle text-center text-sm">
                            <span class="text-secondary text-xs font-weight-bolds">
                              <?= $siswa['agama'] ?>
                            </span>
                          </td>
                          <td class="align-middle text-center text-sm">
                            <span class="text-secondary text-xs font-weight-bolds">
                              <?= $siswa['nama_kelas'] ?>
                            </span>
                          </td>
                          <td class="align-middle text-center text-sm">
                            <span class="badge badge-sm bg-gradient-info">
                              <a class="text-white open_modal" id="<?= $siswa['NIS'] ?>" href="#>" data-bs-toggle="modal" data-bs-target="#ModalEditSiswa">Edit</a>
                            </span>
                            <span class="badge badge-sm bg-gradient-danger">
                              <a class="text-white" href="#" onclick="confirm_delete(`siswa_delete.php?NIS=<?= $siswa['NIS'] ?>`)">Delete</a>
                            </span>
                          </td>
                        </tr>
                      <?php endwhile; ?>

                    </tbody>
                    <!-- /Data Guru -->

                  </table>
                  <!-- <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-end">
                      <li class="page-item disabled">
                        <a class="page-link" href="javascript:;" tabindex="-1">
                          <i class="fa fa-angle-left"></i>
                          <span class="sr-only">Previous</span>
                        </a>
                      </li>
                      <li class="page-item">
                        <a class="page-link" href="javascript:;">
                          <i class="fa fa-angle-right"></i>
                          <span class="sr-only">Next</span>
                        </a>
                      </li>
                    </ul>
                  </nav> -->


                </div>

              </div>
            </div>
          </div>
        </div>
      </div>

    </div>

    </div>

    <!-- Modal Tambah Siswa -->
    <div class="modal fade" id="tambahSiswa" tabindex="-1" role="dialog" aria-labelledby="tambahSiswaLabel" aria-hidden="true">
      <form action="siswa_add.php" enctype="multipart/form-data" method="post">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Tambah Data Siswa</h5>
              <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

              <!-- Form -->
              <div class="form-group">
                <label for="kode" class="form-control-label">NIS</label>
                <input class="form-control" type="text" name="NIS" placeholder="Masukkan NIS" id="kode" maxlength="10" minlength="4" required>
              </div>
              <div class="form-group">
                <label for="nama" class="form-control-label">Nama</label>
                <input class="form-control" type="text" name="Nama_siswa" placeholder="Masukkan Nama Siswa" id="nama" required>
              </div>
              <div class="form-group">
                <label for="tanggal" class="form-control-label">Tanggal Lahir</label>
                <input class="form-control" type="date" name="tanggal_lahir" id="tanggal">
              </div>
              <div class="form-group">
                <label for="kelamin">Jenis Kelamin</label>
                <select class="form-control" id="kelamin" name="JK">
                  <option>Pilih Jenis Kelamin</option>
                  <option value="L">Laki - Laki</option>
                  <option value="P">Perempuan</option>
                </select>
              </div>
              <div class="form-group">
                <label for="no_telp" class="no_telp">No. Telp</label>
                <input class="form-control" type="number" name="No_Telp" placeholder="Masukkan No. Telp" id="no_telp" required>
              </div>
              <div class="form-group">
                <label for="alamat" class="form-control-label">Alamat</label>
                <input class="form-control" type="text" placeholder="Alamat" id="alamat" name="Alamat" required>
              </div>
              <div class="form-group">
                <label class="form-control-label">Agama</label>
                <select name="agama" class="form-control" required>
                  <option value="">Pilih Agama</option>
                  <option value="buddha">buddha</option>
                  <option value="hindu">hindu</option>
                  <option value="islam">islam</option>
                  <option value="kristen">kristen</option>
                  <option value="katolik">katolik</option>
                  <option value="kong hu cu">kong hu cu</option>
                </select>
              </div>
              <div class="form-group">
                <label class="form-control-label">Kelas</label>
                <select name="kelas" class="form-control" required>
                  <option value="">Pilih Kelas</option>
                  <?php
                  $sql = $konek->query("select * from kelas order by id_kelas");
                  while ($data = $sql->fetch_assoc()) {
                    echo "<option value='$data[id_kelas].$data[nama_kelas]'>$data[nama_kelas]</option>";
                  }
                  ?>
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


    <!-- Modal Popup Dosen Edit -->
    <div class="modal fade" id="ModalEditSiswa" tabindex="-1" role="dialog" aria-labelledby="ModalEditSiswaLabel" aria-hidden="true">
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
    <!-- /Modal Popup Dosen Edit -->


  </main>
  <!-- /main content -->
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script type="text/javascript">
  $(document).ready(function() {

    // Siswa
    $(".open_modal").click(function(e) {
      var m = $(this).attr("id");

      $.ajax({
        url: "api_edit_siswa.php",
        type: "GET",
        data: {
          NIS: m,
        },
        success: function(ajaxData) {

          console.log(ajaxData);
          $("#ModalEditSiswa").html(ajaxData);

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
<?php

// require 'edit_delete_js.php'

?>

<?php require '../comp/footer.php' ?>