<?php
$title = 'Data Pelajaran';
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

                    <h5 class="font-weight-bolder">Data Pelajaran</h5>

                  </div>
                </div>


                <div class="container-fluid py-4">

                  <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#tambahPelajaran">Tambah Pelajaran</button>
                </div>
                <div class="table-responsive">
                  <table id="tabel" class="table align-items-center mb-3">

                    <!-- Data Ruangan -->
                    <thead>
                      <tr>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Kode Pelajaran</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nama Pelajaran</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2"> Pembahasan</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $querypelajaran = mysqli_query($konek, "SELECT * FROM pelajaran");
                      if ($querypelajaran == false) {
                        die("Terdapat Kesalahan : " . mysqli_error($konek));
                      }
                      ?>

                      <?php while ($pelajaran = mysqli_fetch_array($querypelajaran)) : ?>

                        <tr>
                          <td class="align-middle text-sm">
                            <span class="text-secondary text-xs font-weight-bolds">
                              <?= $pelajaran['id_pelajaran'] ?>
                            </span>
                          </td>
                          <td class="align-middle text-sm">
                            <span class="text-secondary text-xs font-weight-bolds">
                              <?= $pelajaran['nama_pelajaran'] ?>
                            </span>
                          </td>

                          <td class="align-middle text-center text-sm">
                            <span class="badge badge-sm bg-gradient-info">
                              <a class="text-white open_modal" id="<?= $pelajaran['id_pelajaran'] ?>" href="unduh_materi.php?file=<?= $pelajaran['materi'] ?>"><?= $pelajaran['materi'] ?></a>
                            </span>

                          </td>
                          <td class="align-middle text-center text-sm">
                            <span class="badge badge-sm bg-gradient-info">
                              <a class="text-white open_modal" onclick="edit(<?= $pelajaran['id_pelajaran'] ?>)" href="#>" data-bs-toggle="modal" data-bs-target="#ModalEditPelajaran">Edit</a>
                            </span>
                            <span class="badge badge-sm bg-gradient-danger">
                              <a class="text-white" href="#" onclick="confirm_delete(`pelajaran_delete.php?id_pelajaran=<?= $pelajaran['id_pelajaran'] ?>`)">Delete</a>
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

    <!-- Modal Tambah Pelajaran -->
    <div class="modal fade" id="tambahPelajaran" tabindex="-1" role="dialog" aria-labelledby="tambahPelajaranLabel" aria-hidden="true">
      <form action="pelajaran_add.php" enctype="multipart/form-data" method="post">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Tambah Pelajaran
              </h5>
              <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

              <!-- Form -->
              <div class="form-group">
                <label for="kode" class="form-control-label">ID Pelajaran</label>
                <input class="form-control" type="text" name="kode_pelajaran" placeholder="Masukkan Kode Pelajaran" id="kode" required>
              </div>
              <div class="form-group">
                <label for="nama" class="form-control-label">Nama Pelajaran</label>
                <input class="form-control" type="text" name="nama_pelajaran" placeholder="Masukkan Nama Pelajaran" id="nama" required>
              </div>
              <div class="form-group">
                <label for="file" class="form-control-label"> Pembahasan</label>
                <input class="form-control" type="file" name="berkas" placeholder="pembahasan" id="file" required>
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
    <!-- /Modal Tambah Pelajaran -->


    <!-- Pop Up Delete -->
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
    <!-- /Pop Up Delete -->

    <!-- Modal Popup Plejaran Edit -->
    <div class="modal fade" id="ModalEditPelajaran" tabindex="-1" role="dialog" aria-labelledby="ModalEditPelajaranLabel" aria-hidden="true">
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
    <!-- /Modal Popup Plejaran Edit -->


  </main>
  <!-- /main content -->
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script type="text/javascript">
function edit(m){
  $.ajax({
        url: "api_edit_pelajaran.php",
        type: "GET",
        data: {
          kode_pelajaran: m,
        },
        success: function(ajaxData) {

          $("#ModalEditPelajaran").html(ajaxData);

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
<?php

// require 'edit_delete_js.php'

?>

<?php require '../comp/footer.php' ?>