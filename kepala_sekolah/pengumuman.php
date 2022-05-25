<?php
$title = 'Data Pengumuman';
$path = '../';
require '../comp/header.php';

session_start();
include "../koneksi.php";
include "auth_user.php";
?>

<body class="g-sidenav-show bg-gray-100">
  <!-- aside -->
  <?php require '../comp/sidebar.php' ?>
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

                    <h5 class="font-weight-bolder">Data Pengumuman</h5>

                  </div>
                </div>

                <div class="container-fluid py-4">

                  <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#tambahPengumuman">Tambah Pengumuman</button>

                  <div class="row">
                    <div class="table-responsive">
                      <table id="tabel" class="table align-items-center mb-3">
                        <thead>
                          <th>Daftar Pengumuman</th>
                        </thead>
                        <tbody>
                          <?php
                          $no = 1;
                          $i = 0;
                          $querymatakuliah = mysqli_query($konek, "SELECT * FROM pengumuman");
                          $bil =  $querymatakuliah->num_rows;
                          if ($querymatakuliah == false) {
                            die("Terdapat Kesalahan : " . mysqli_error($konek));
                          }
                          ?>
                          <?php while ($pengumuman = mysqli_fetch_array($querymatakuliah)) : ?>
                            <tr>
                              <td>
                                <div class="col-md-12">
                                  <div class="card h-100 p-3">
                                    <div class="overflow-hidden position-relative border-radius-lg bg-cover h-100" style="background-image: linear-gradient(330deg, rgba(225, 225, 225, 0.05) 0%, rgba(225, 225, 225, 0.05) 33.333%,rgba(114, 114, 114, 0.05) 33.333%, rgba(114, 114, 114, 0.05) 66.666%,rgba(52, 52, 52, 0.05) 66.666%, rgba(52, 52, 52, 0.05) 99.999%),linear-gradient(66deg, rgba(181, 181, 181, 0.05) 0%, rgba(181, 181, 181, 0.05) 33.333%,rgba(27, 27, 27, 0.05) 33.333%, rgba(27, 27, 27, 0.05) 66.666%,rgba(251, 251, 251, 0.05) 66.666%, rgba(251, 251, 251, 0.05) 99.999%),linear-gradient(225deg, rgba(98, 98, 98, 0.05) 0%, rgba(98, 98, 98, 0.05) 33.333%,rgba(222, 222, 222, 0.05) 33.333%, rgba(222, 222, 222, 0.05) 66.666%,rgba(228, 228, 228, 0.05) 66.666%, rgba(228, 228, 228, 0.05) 99.999%),linear-gradient(90deg, rgb(28, 20, 63),rgb(40, 160, 253));">
                                      <div class="card-body position-relative z-index-1 d-flex flex-column h-100 p-3">
                                        <a href="" data-bs-toggle="modal" data-bs-target="#detailpengumuman<?= $no ?>">
                                          <h5 class="text-white font-weight-bolder mb-4 pt-2"><?= $pengumuman['judul'] ?></h5>
                                        </a>
                                        <p class="text-white">
                                          <a href="" data-bs-toggle="modal" data-bs-target="#detailpengumuman<?= $no ?>" class="text-success">Baca Isi Pengumuman &nbsp; <i class="fa fa-arrow-right"></i></a>
                                          <br><br>
                                          <a href="unduh_pengumuman.php?file=<?= $pengumuman['lampiran'] ?>" class="text-warning">Unduh Lampiran</a>
                                        </p>
                                        <p class="text-white text-sm font-weight-bold mb-0 icon-move-right mt-auto" href="javascript:;">
                                          <?= formattanggal($pengumuman['tanggal_pembuatan']) ?>
                                        </p>
                                        <div class="row mt-3">
                                          <div class="col-md-6">
                                            <a class="btn-success btn btn-sm text-white" id="<?= $pengumuman['id_pengumuman'] ?>" data-bs-toggle="modal" data-bs-target="#modaledit<?= $no ?>" style="width:100%;">Edit</a>
                                          </div>
                                          <div class="col-md-6">
                                            <a href="delete_pengumuman.php?kode_pengumuman=<?= $pengumuman['id_pengumuman'] ?>" class="btn btn-sm bg-gradient-danger" style="width:100%;">Hapus</a>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </td>
                            </tr>
                            <div class="modal fade" id="modaledit<?= $no ?>" tabindex="-1" role="dialog" aria-labelledby="modaleditLabel<?= $no ?>" aria-hidden="true">
                              <form action="pengumuman_edit.php" name="modal_popup" enctype="multipart/form-data" method="post">
                                <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title">Edit Pengumuman
                                      </h5>
                                      <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <div class="modal-body">

                                      <div class="form-group">
                                        <!-- <label>ID</label> -->

                                        <input name="id" type="hidden" class="form-control" placeholder="Masukan id pengumuman" value="<?= $pengumuman['id_pengumuman'] ?>" />
                                      </div>

                                      <div class="form-group">
                                        <label>Judul</label>

                                        <input name="judul" type="text" class="form-control" placeholder="Masukan judul pengumuman" value="<?= $pengumuman['judul'] ?>" />
                                      </div>

                                      <div class="form-group">
                                        <label>Keterangan</label>
                                        <textarea rows="5" class="form-control" id="deskripsiedit<?= $no ?>" name="keterangan" placeholder="masukan text!"><?= $pengumuman['deskripsi']; ?></textarea>
                                        <script>
                                          CKEDITOR.replace('deskripsiedit<?= $no ?>');
                                        </script>
                                      </div>

                                      <div class="form-group">
                                        <label>Tanggal</label>
                                        <input type="date" name="tanggal" value="<?= $pengumuman['tanggal_pembuatan']; ?>" class="form-control">
                                      </div>

                                      <div class="form-group">
                                        <label>Lampiran</label>
                                        <input name="lampiran" type="file" class="form-control" />
                                      </div>

                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Batal</button>
                                      <button type="submit" class="btn bg-gradient-primary">Ubah</button>
                                    </div>
                                  </div>
                                </div>
                              </form>
                            </div>


                            <div class="modal fade" id="detailpengumuman<?= $no ?>" tabindex="-1" role="dialog" aria-labelledby="detailpengumumanLabel<?= $no ?>" aria-hidden="true">
                              <form action="pengumuman_add.php" name="modal_popup" enctype="multipart/form-data" method="post">
                                <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title">Detail Pengumuman
                                      </h5>
                                      <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <div class="modal-body">
                                      <h5 class="text-dark font-weight-bolder mb-4 pt-2"><?= $pengumuman['judul'] ?></h5>
                                      <p class="text-danger"><?= formattanggal($pengumuman['tanggal_pembuatan']) ?></p>
                                      <?= $pengumuman['deskripsi'] ?>
                                      <br><br>
                                      <a href="unduh_pengumuman.php?file=<?= $pengumuman['lampiran'] ?>" class="btn btn-success">Unduh Lampiran &nbsp;<i class="fa fa-download"></i></a>
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Tutup</button>
                                    </div>
                                  </div>
                                </div>
                              </form>
                            </div>
                          <?php
                            $no++;
                          endwhile; ?>
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
  </main>
  <!-- /main content -->
</body>

<!-- modal detail pengumuman-->


<!-- Modal Tambah Pelajaran -->
<div class="modal fade" id="tambahPengumuman" tabindex="-1" role="dialog" aria-labelledby="tambahPengumumanLabel" aria-hidden="true">
  <form action="pengumuman_add.php" name="modal_popup" enctype="multipart/form-data" method="post">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Tambah Pengumuman
          </h5>
          <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Judul</label>
                <input name="judul" type="text" class="form-control" placeholder="Masukan judul pengumuman" />
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label>Keterangan</label>
                <textarea rows="5" id="deskripsi" class="form-control" name="keterangan" placeholder="Masukkan teks"></textarea>
                <script>
                  CKEDITOR.replace('deskripsi');
                </script>
              </div>
            </div>

            <div class="form-group">
              <label>Lampiran</label>
              <input name="lampiran" type="file" class="form-control" />
            </div>

            <div class="form-group">
              <label>Tanggal</label>
              <input name="tanggal" type="date" class="form-control" value="<?= $tanggal_upload ?>" />
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

<!-- Modal Edit -->
<div class="modal fade" id="ModalEditPengumuman" tabindex="-1" role="dialog" aria-labelledby="ModalEditPengumumanLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalEditPengumumanLabel">Edit Pengumuman</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
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
    $(".open_modal").click(function(e) {
      var m = $(this).attr("id");

      console.log(m);


      $.ajax({
        url: "api_edit_pengumuman.php",
        type: "GET",
        data: {
          id_pengumuman: m,
        },
        success: function(ajaxData) {
          $("#ModalEditPengumuman").html(ajaxData);
          $("#ModalEditPengumuman").modal('show', {
            backdrop: 'true'
          });
        }
      })
    })


  })

  function confirm_delete(delete_url) {
    $("#modal_delete").modal('show', {
      backdrop: 'static'
    });

    document.getElementById('delete_link').setAttribute('href', delete_url);
  }
</script>

<?php require '../comp/footer.php' ?>