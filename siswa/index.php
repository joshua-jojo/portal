<?php
$title = 'Dashboard';
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
                    <!-- <p class="mb-1 pt-2 text-bold">Built by developers</p> -->
                    <h5 class="font-weight-bolder">Selamat Datang, <?php echo $_SESSION['Username'] ?></h5>


                  </div>
                </div>
                <div class="col-lg-5 ms-auto text-center mt-5 mt-lg-0 ">
                  <div class=" border-radius-lg h-100">
                    <img src="../assets/img/shapes/waves-white.svg" class="position-absolute h-100 w-50 top-0 d-lg-block d-none" alt="waves" />
                    <div class="position-relative d-flex align-items-center justify-content-center h-100">
                      <img class="w-100 position-relative z-index-2 pt-4" src="../assets/img/illustrations/sekolah.jpeg" alt="rocket" />
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
      <!-- <div class="row mt-4">
        <div class="col-xl-4 col-sm-4 mb-xl-0 mb-4">
          <a href="jadwal.php">
            <div class="card">
              <div class="card-body p-3">
                <div class="row">
                  <div class="col-8">
                    <div class="numbers">
                      <h5 class="font-weight-bolder mb-0">
                        Jadwal
                      </h5>
                    </div>
                  </div>
                  <div class="col-4 text-end">
                    <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                      <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </a>
        </div>
        <div class="col-xl-4 col-sm-4 mb-xl-0 mb-4">
          <a href="nilai.php">
            <div class="card">
              <div class="card-body p-3">
                <div class="row">
                  <div class="col-8">
                    <div class="numbers">
                      <h5 class="font-weight-bolder mb-0">
                        Nilai
                      </h5>
                    </div>
                  </div>
                  <div class="col-4 text-end">
                    <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                      <i class="ni ni-world text-lg opacity-10" aria-hidden="true"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </a>
        </div>
        <div class="col-xl-4 col-sm-4 mb-xl-0 mb-4">
          <a href="absensi.php">
            <div class="card">
              <div class="card-body p-3">
                <div class="row">
                  <div class="col-8">
                    <div class="numbers">
                      <h5 class="font-weight-bolder mb-0">
                        Absensi
                      </h5>
                    </div>
                  </div>
                  <div class="col-4 text-end">
                    <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                      <i class="ni ni-paper-diploma text-lg opacity-10" aria-hidden="true"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </a>
        </div> -->
      <!-- <div class="col-xl-3 col-sm-6">
          <a href="tagihan.php">
            <div class="card">
              <div class="card-body p-3">
                <div class="row">
                  <div class="col-8">
                    <div class="numbers">
                      <h5 class="font-weight-bolder mb-0">
                        Tagihan
                      </h5>
                    </div>
                  </div>
                  <div class="col-4 text-end">
                    <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                      <i class="ni ni-cart text-lg opacity-10" aria-hidden="true"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </a>
        </div> -->
      <!-- </div> -->
      <div class="row mt-4">
        <?php
        $no = 1;
        $querymatakuliah = mysqli_query($konek, "SELECT * FROM pengumuman order by id_pengumuman desc limit 4");
        if ($querymatakuliah == false) {
          die("Terdapat Kesalahan : " . mysqli_error($konek));
        }
        while ($pengumuman = mysqli_fetch_array($querymatakuliah)) :
        ?>
          <div class="col-md-6">
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
                  <!-- <a href="delete_pengumuman.php?kode_pengumuman=<?= $pengumuman['id_pengumuman'] ?>" class="btn btn-sm bg-gradient-danger mt-3">Hapus</a>
                  <a class="btn-success btn btn-sm text-white open_modal" id="<?= $pengumuman['id_pengumuman'] ?>" data-bs-toggle="modal" data-bs-target="#ModalEditPengumuman">Edit</a> -->
                </div>
              </div>
            </div>
          </div>
          <!-- modaldetail -->
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
        <?php $no++;
        endwhile; ?>
      </div>
    </div>
  </main>
  <!-- /main content -->
</body>

<?php require '../comp/footer.php' ?>