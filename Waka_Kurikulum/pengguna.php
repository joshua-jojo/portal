<?php
$title = 'Data User';
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

                    <h5 class="font-weight-bolder">Data User</h5>

                  </div>
                </div>


                <div class="container-fluid py-4">

                  <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#tambahUserGuru">Tambah User Guru</button>
                  <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#tambahUserSiswa">Tambah User Siswa</button>
                </div>
                <div class="table-responsive">
                  <table id="tabel" class="table align-items-center mb-3">

                    <!-- Data Guru -->
                    <thead>
                      <tr>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Username</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Kelompok Pengguna</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $queryuser = mysqli_query($konek, "SELECT *, users.id_users as iduserku FROM users INNER JOIN kelompok_pengguna ON no_role_users = kelompok_pengguna.id_users");
                      if ($queryuser == false) {
                        die("Terjadi Kesalahan : " . mysqli_error($konek));
                      }
                      ?>

                      <?php while ($user = mysqli_fetch_array($queryuser)) : ?>
                        <tr>
                          <td class="align-middle text-sm">
                            <span class="text-secondary text-xs font-weight-bolds">
                              <?= $user['username'] ?>
                            </span>
                          </td>
                          <td class="align-middle text-sm">
                            <span class="text-secondary text-xs font-weight-bolds">
                              <?= $user['nama_status'] ?>
                            </span>
                          </td>

                          <td class="align-middle text-center text-sm">
                            <span class="badge badge-sm bg-gradient-danger">
                              <a class="text-white" href="#" onclick="confirm_delete(`user_delete.php?Id_User=<?= $user['iduserku'] ?>`)">Delete</a>
                            </span>
                          </td>
                        </tr>
                      <?php endwhile; ?>

                    </tbody>
                    <!-- /Data Guru -->

                  </table>

                </div>

              </div>
            </div>
          </div>
        </div>
      </div>

    </div>

    </div>

    <!-- Modal Tambah Siswa -->
    <div class="modal fade" id="tambahUserGuru" tabindex="-1" role="dialog" aria-labelledby="tambahUserGuruLabel" aria-hidden="true">
      <form action="user_add_guru.php" enctype="multipart/form-data" method="post">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Tambah User Guru</h5>
              <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

              <!-- Form -->
              <div class="form-group">
                <label for="kode" class="form-control-label">Kelompok Pengguna</label>
                <select name="id_users" class="form-control" required>

                  <?php

                  $querypengguna = mysqli_query($konek, "SELECT * FROM users where no_role_users = 4");

                  if (mysqli_num_rows($querypengguna) === 1) {
                    echo "<option value='2'>Guru</option>";
                  }

                  else if (mysqli_num_rows($querypengguna) < 1) {

                    echo "<option value='2'>Guru</option>";
                    echo "<option value='4'>Kepala sekolah</option>";
                  }


                  ?>
                </select>
              </div>
              <div class="form-group">
                <label for="nama" class="form-control-label">Guru</label>
                <select name="User_Dosen" class="form-control">
                  <option value="">Pilih Guru</option>
                  <?php

                  $querydosen = mysqli_query($konek, "SELECT * FROM guru");

                  if ($querydosen == false) {
                    die("Terdapat Kesalahan : " . mysqli_error($konek));
                  }
                  while ($dosen = mysqli_fetch_array($querydosen)) {

                    echo "<option value='$dosen[id_guru].$dosen[nama_guru]'>$dosen[nama_guru]</option>";
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

    <div class="modal fade" id="tambahUserSiswa" tabindex="-1" role="dialog" aria-labelledby="tambahUserSiswaLabel" aria-hidden="true">
      <form action="user_add_siswa.php" enctype="multipart/form-data" method="post">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Tambah User Siswa</h5>
              <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

              <!-- Form -->
              <div class="form-group">
                <label for="kode" class="form-control-label">Kelompok Pengguna</label>
                <select name="id_users" class="form-control">
                  <option value="3" selected>Siswa</option>
                </select>
              </div>
              <div class="form-group">
                <label for="nama" class="form-control-label">Siswa</label>
                <select name="User_siswa" class="form-control">
                <option value="">Pilih Siswa</option>
                  <?php

                  $querysiswa = mysqli_query($konek, "SELECT * FROM siswa");

                  if ($querysiswa == false) {
                    die("Terdapat Kesalahan : " . mysqli_error($konek));
                  }
                  while ($dosen = mysqli_fetch_array($querysiswa)) {

                    echo "<option value='$dosen[NIS].$dosen[nama_siswa]'>$dosen[nama_siswa]</option>";
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


    <!-- Modal Popup Kelas Edit -->
    <div class="modal fade" id="ModalEditKelas" tabindex="-1" role="dialog" aria-labelledby="ModalEditKelasLabel" aria-hidden="true">
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


  </main>
  <!-- /main content -->
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script type="text/javascript">
  $(document).ready(function() {

    // Siswa
    $(".open_modal").click(function(e) {
      var m = $(this).attr("id");

      console.log(m);




      $.ajax({
        url: "api_edit_kelas.php",
        type: "GET",
        data: {
          id_kelas: m,
        },
        success: function(ajaxData) {

          console.log(ajaxData);
          $("#ModalEditKelas").html(ajaxData);

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