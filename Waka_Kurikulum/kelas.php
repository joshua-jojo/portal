<?php
$title = 'Data Kelas';
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

                    <h5 class="font-weight-bolder">Data Kelas</h5>

                  </div>
                </div>


                <div class="container-fluid py-4">
                  <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#tambahKelas">Tambah Kelas</button>
                </div>
                <div class="table-responsive">
                  <table id="tabel" class="table align-items-center mb-3">

                    <!-- Data Guru -->
                    <thead>
                      <tr>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Kode Ruangan</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Ruangan</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $queryruangan = mysqli_query($konek, "SELECT * FROM kelas");

                      if ($queryruangan == false) {
                        die("Terjadi Kesalahan : " . mysqli_error($konek));
                      }
                      ?>

                      <?php while ($ruangan = mysqli_fetch_array($queryruangan)) : ?>
                        <tr>
                          <td class="align-middle text-sm">
                            <span class="text-secondary text-xs font-weight-bolds">
                              <?= $ruangan['id_kelas'] ?>
                            </span>
                          </td>
                          <td class="align-middle text-sm">
                            <span class="text-secondary text-xs font-weight-bolds">
                              <?= $ruangan['nama_kelas'] ?>
                            </span>
                          </td>

                          <td class="align-middle text-center text-sm">
                            <span class="badge badge-sm bg-gradient-info">
                              <a class="text-white open_modal" id="<?= $ruangan['id_kelas'] ?>" href="#>" data-bs-toggle="modal" data-bs-target="#ModalEditKelas">Edit</a>
                            </span>
                            <span class="badge badge-sm bg-gradient-danger">
                              <a class="text-white" href="#" onclick="confirm_delete(`kelas_delete.php?id_kelas=<?= $ruangan['id_kelas'] ?>`)">Delete</a>
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
    <div class="modal fade" id="tambahKelas" tabindex="-1" role="dialog" aria-labelledby="tambahKelasLabel" aria-hidden="true">
      <form action="kelas_add.php" enctype="multipart/form-data" method="post">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Tambah Kelas</h5>
              <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

              <!-- Form -->
              <div class="form-group">
                <label for="kode" class="form-control-label">Kode Kelas</label>
                <input class="form-control" type="text" name="id_kelas" placeholder="Masukkan Kode Kelas" id="kode" required>
              </div>
              <div class="form-group">
                <label for="nama" class="form-control-label">Nama Kelas</label>
                <input class="form-control" type="text" name="Nama_Kelas" placeholder="Masukkan Nama Kelas" id="nama" required>
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