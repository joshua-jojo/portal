<?php
$title = 'Data Guru';
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

                    <h5 class="font-weight-bolder">Data Guru</h5>

                  </div>
                </div>


                <div class="container-fluid py-4">
                  <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#tambahGuru">Tambah Guru</button>
                </div>
                <div class="table-responsive">
                  <table id="tabel" class="table align-items-center mb-3" width="100%">

                    <!-- Data Guru -->
                    <thead>
                      <tr>
                        <th class=" text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Kode Guru</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nama Guru</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tanggal Lahir</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jenis Kelamin</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Telepon</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Alamat</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $querydosen = mysqli_query($konek, "SELECT * FROM guru");
                      if ($querydosen == false) {
                        die("Terjadi Kesalahan : " . mysqli_error($konek));
                      }
                      ?>
                      <?php while ($dosen = mysqli_fetch_array($querydosen)) : ?>
                        <tr>
                          <td class="align-middle text-sm">
                            <span class="text-secondary text-xs font-weight-bolds">
                              <?= $dosen['id_guru'] ?>
                            </span>
                          </td>
                          <td class="align-middle text-sm">
                            <span class="text-secondary text-xs font-weight-bolds">
                              <?= $dosen['nama_guru'] ?>
                            </span>
                          </td>
                          <td class="align-middle text-center text-sm">
                            <span class="text-xs font-weight-bold">
                              <?= $dosen['tanggal_lahir'] ?>
                            </span>
                          </td>
                          <td class="align-middle text-center text-sm">
                            <span class="text-secondary text-xs font-weight-bolds">
                              <?php
                              if ($dosen["gender"] == "L") {
                                echo "Laki - laki";
                              } else {
                                echo "Perempuan";
                              }
                              ?>
                            </span>
                          </td>
                          <td class="align-middle text-center text-sm">
                            <span class="text-secondary text-xs font-weight-bolds">
                              <?= $dosen['no_hp'] ?>
                            </span>
                          </td>
                          <td class="align-middle text-center text-sm">
                            <span class="text-secondary text-xs font-weight-bolds">
                              <?= $dosen['alamat'] ?>
                            </span>
                          </td>
                          <td class="align-middle text-center text-sm">
                            <span class="badge badge-sm bg-gradient-info">
                              <a class="text-white open_modal" id="<?= $dosen['id_guru'] ?>" onclick="edit(<?= $dosen['id_guru'] ?>)" href="#>" data-bs-toggle="modal" data-bs-target="#ModalEditDosen">Edit</a>
                            </span>
                            <span class="badge badge-sm bg-gradient-danger">
                              <a class="text-white" href="#" onclick="confirm_delete(`dosen_delete.php?kode_guru=<?= $dosen['id_guru'] ?>`)">Delete</a>
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

    <!-- Modal Tambah Guru -->
    <div class="modal fade" id="tambahGuru" tabindex="-1" role="dialog" aria-labelledby="tambahGuruLabel" aria-hidden="true">

      <form action="dosen_add.php" enctype="multipart/form-data" method="post">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="tambahGuruLabel">Tambah Data Guru</h5>
              <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

              <!-- Form -->
              <div class="form-group">
                <label for="kode" class="form-control-label">Kode Guru</label>
                <input class="form-control" type="text" name="NIP" placeholder="Masukkan Kode Guru" id="kode" required>
              </div>

              <div class="form-group">
                <label for="nama" class="form-control-label">Nama</label>
                <input class="form-control" type="text" name="Nama_guru" placeholder="Masukkan Nama Guru" id="nama" required>
              </div>

              <div class="form-group">
                <label for="tanggal" class="form-control-label">Tanggal Lahir</label>
                <input class="form-control" type="date" name="Tanggal_Lahir" id="tanggal">
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
    <div class="modal fade" id="ModalEditDosen" tabindex="-1" role="dialog" aria-labelledby="ModalEditDosenLabel" aria-hidden="true">
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
  // $(document).ready(function() {

  //   // Guru
  //   $(".open_modal").click(function(e) {
  //     var m = $(this).attr("id");

  //     $.ajax({
  //       url: "api_edit_guru.php",
  //       type: "GET",
  //       data: {
  //         kode_guru: m,
  //       },
  //       success: function(ajaxData) {

  //         $("#ModalEditDosen").html(ajaxData);

  //       }
  //     });
  //   });

  // });

  function edit(m) {


    $.ajax({
      url: "api_edit_guru.php",
      type: "GET",
      data: {
        kode_guru: m,
      },
      success: function(ajaxData) {

        $("#ModalEditDosen").html(ajaxData);

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