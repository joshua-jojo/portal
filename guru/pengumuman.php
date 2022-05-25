<?php
$title = 'Pengumuman';
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

                    <h5 class="font-weight-bolder">Pengumuman</h5>

                  </div>
                </div>
                <div class="container-fluid py-4">
                  <div class="col-12">
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
                            $querymatakuliah = mysqli_query($konek, "SELECT * FROM pengumuman order by id_pengumuman");
                            $bil =  $querymatakuliah->num_rows;
                            if ($querymatakuliah == false) {
                              die("Terdapat Kesalahan : " . mysqli_error($konek));
                            }
                            while ($pengumuman = mysqli_fetch_array($querymatakuliah)) : ?>
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
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </td>
                              </tr>
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
          <!-- <div class="col-lg-5">
          <div class="card h-100 p-3">
            <div class="overflow-hidden position-relative border-radius-lg bg-cover h-100" style="background-image: url('../assets/img/ivancik.jpg')">
              <span class="mask bg-gradient-dark"></span>
              <div class="card-body position-relative z-index-1 d-flex flex-column h-100 p-3">
                <h5 class="text-white font-weight-bolder mb-4 pt-2">
                  Work with the rockets
                </h5>
                <p class="text-white">
                  Wealth creation is an evolutionarily recent positive-sum
                  game. It is all about who take the opportunity first.
                </p>
                <a class="text-white text-sm font-weight-bold mb-0 icon-move-right mt-auto" href="javascript:;">
                  Read More
                  <i class="fas fa-arrow-right text-sm ms-1" aria-hidden="true"></i>
                </a>
              </div>
            </div>
          </div>
        </div> -->
        </div>

      </div>
  </main>
  <!-- /main content -->
</body>

<?php require '../comp/footer.php' ?>