<?php
$title = 'Data Tagihan';
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

                    <h5 class="font-weight-bolder">Data Tagihan</h5>

                  </div>
                </div>


                <div class="container-fluid py-4">
                  <div class="row">
                    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                      <form action="cetak_tagihan.php" method="post">


                        <div class=" form-group col-md-5">
                          <div class="form-group">

                            <label>Cetak Tagihan</label>
                            <select name="bulan" class="form-control mb-1">
                              <option value="">Pilih Bulan</option>
                              <?php

                              $sql = $konek->query("select * from bulan;");
                              while ($data = $sql->fetch_assoc()) {
                                echo "<option value='$data[id_bulan_spp]'>$data[nama_bulan]</option>";
                              }
                              ?>

                            </select>
                            <select name="kelas" class="form-control">
                              <option value="">pilih kelas</option>
                              <?php

                              $sql = $konek->query("select * from kelas");
                              while ($data = $sql->fetch_assoc()) {
                                echo "<option value='$data[id_kelas]'>$data[nama_kelas]</option>";
                              }
                              ?>
                            </select>
                          </div>

                          <input type="submit" class="btn btn-success" name="submit" value="cetak">
                        </div>
                      </form>

                    </div>
                    <div class="col-xl-12 col-sm-12 mb-xl-0 mb-4">
                      <form action="tagihan_add_modal.php" id="cari_kelas">
                        <div class="form-group col-md-5">
                          <label>kelas</label>
                          <select name="kelas" id="cari_kelass" class="form-control" required>
                            <option value="">pilih kelas</option>
                            <?php
                            $sql = $konek->query("select * from kelas order by id_kelas");
                            while ($data = $sql->fetch_assoc()) {
                              echo "<option value='$data[id_kelas]'>$data[nama_kelas]</option>";
                            }
                            ?>
                          </select>
                          <br>
                          <input type="submit" class="btn btn-success" name="submit" value="tambah data tagihan">
                        </div>


                      </form>
                    </div>


                  </div>

                  <div class="col-12">

                    <div class="table-responsive">
                      <table class="table align-items-center mb-3">

                        <!-- Data Guru -->
                        <thead>
                          <tr>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ID</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nama Siswa</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Kelas </th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Tanggal </th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Tagihan Bulan </th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Total Tagihan</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">No. Rek</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Catatan</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Bukti Pembayaran</th>
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



                        </tbody>
                        <!-- /Data Guru -->

                      </table>
                      <nav aria-label="Page navigation example">
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
                      </nav>


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