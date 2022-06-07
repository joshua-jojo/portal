<?php
$title = 'Jadwal';
$path = '../';
require 'header.php';

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

                    <h5 class="font-weight-bolder">Jadwal Anda</h5>

                  </div>
                </div>
                <div class="container-fluid py-4">
                  <div class="col-12">
                    <div class="table-responsive">
                      <table id="tabel" class="table align-items-center mb-3">
                        <thead>
                          <tr>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Pelajaran</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Kelas</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Guru</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jam</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Materi</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Edit Materi</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Hari</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Edit Link Vidcon</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Vidcon</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $queryjadwal = mysqli_query($konek, "select * from jadwal inner join pelajaran on jadwal.id_pelajaran = pelajaran.id_pelajaran inner join kelas on jadwal.id_kelas = kelas.id_kelas inner join guru on jadwal.id_guru = guru.id_guru inner join hari on jadwal.no_hari = hari.id_hari  WHERE jadwal.id_guru='$_SESSION[Id_User]'");
                          if ($queryjadwal == false) {
                            die("Terjadi Kesalahan : " . mysqli_error($konek));
                          }
                          ?>
                          <?php
                          $no = 1;
                          while ($jadwal = mysqli_fetch_array($queryjadwal)) : ?>
                            <tr>
                              <td class="align-middle text-sm">
                                <span class="badge badge-sm badge-success" style="padding-left: 15px;">
                                  <a href="tugas.php?kode_pelajaran=<?= $jadwal['id_pelajaran'] ?>&kode_kelas=<?= $jadwal['id_kelas'] ?>"><?= $jadwal['nama_pelajaran'] ?></a>
                                </span>
                              </td>
                              <td class="align-middle text-sm">
                                <span class="text-secondary text-xs font-weight-bolds">
                                  <?= $jadwal['nama_kelas'] ?>
                                </span>
                              </td>
                              <td class="align-middle text-center text-sm">
                                <span class="text-xs font-weight-bold">
                                  <?= $jadwal['nama_guru'] ?>
                                </span>
                              </td>
                              <td class="align-middle text-center text-sm">
                                <span class="text-secondary text-xs font-weight-bolds">
                                  <?= $jadwal['jam'] ?>
                                </span>
                              </td>
                              <td class="align-middle text-center text-sm">
                                <span class="text-secondary text-xs font-weight-bolds">
                                  <a href="unduh_jadwal.php?file=<?= $jadwal['materijadwal'] ?>"><?= $jadwal['materijadwal'] ?></a>
                                </span>
                              </td>
                              <td class="align-middle text-center text-sm">
                                <span class="badge badge-sm bg-gradient-info">
                                  <a class="text-white open_modal" id="<?= $jadwal['id_jadwal'] ?>" href="#" data-bs-toggle="modal" data-bs-target="#ModalEditJadwal<?= $no ?>">Edit</a>
                                </span>
                              </td>
                              <div class="modal fade" id="ModalEditJadwal<?= $no ?>" tabindex="-1" role="dialog" aria-labelledby="ModalEditJadwalLabel<?= $no ?>" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="ModalEditJadwalLabel<?= $no ?>">Edit Materi</h5>
                                      <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <form action="jadwal_edit.php" enctype="multipart/form-data" method="post">
                                      <div class="modal-body">
                                        <input class="form-control" type="hidden" name="id" id="kode" required value="<?= $jadwal['id_jadwal'] ?>" readonly>

                                        <div class="form-group">
                                          <label for="pembahasan" class="form-control-label">Materi</label>
                                          <input class="form-control" required type="file" name="berkas" id="pembahasan">
                                        </div>

                                        <!-- /Form -->

                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn bg-gradient-primary">Simpan</button>
                                      </div>
                                    </form>
                                  </div>
                                </div>
                              </div>
                              <td class="align-middle text-center text-sm">
                                <span class="text-secondary text-xs font-weight-bolds">
                                  <?= $jadwal['nama_hari'] ?>
                                </span>
                              </td>
                              <td class="align-middle text-center text-sm">
                                <span class="badge badge-sm bg-gradient-info">
                                  <a class="text-white" href="#" data-bs-toggle="modal" data-bs-target="#modaleditvidcon<?= $no ?>" id="<?= $tugas['id_tugas'] ?>">Edit</a>
                                </span>
                              </td>
                              <td class="align-middle text-center text-sm">
                                <span class="badge badge-sm bg-gradient-success">
                                  <a target="_blank" class="text-white" href="<?= $jadwal['link_vidcon'] ?>">Gabung</a>
                                </span>
                              </td>
                            </tr>
                            <div class="modal fade" id="modaleditvidcon<?= $no ?>" tabindex="-1" role="dialog" aria-labelledby="ModalEdit" aria-hidden="true">
                              <form name="modal_popup" enctype="multipart/form-data" method="post">
                                <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h6 class="modal-title" id="modal-title-default">Edit Link Vidcon</h6>
                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                      </button>
                                    </div>
                                    <form action="" method="post">
                                      <div class="modal-body">
                                        <div class="form-group">
                                          <label>Link Vidcon</label>
                                          <input type="hidden" name="idjadwal" value="<?= $jadwal['id_jadwal'] ?>">
                                          <input class="form-control" type="text" name="link_vidcon" value="https://" required>
                                          <span class="text-danger" style="font-size:12px">Mohon tetap sisipkan https:// sebelum link website</span>
                                        </div>
                                      </div>
                                      <div class="modal-footer">
                                        <button type="submit" name="save" class="btn bg-gradient-primary">Simpan</button>
                                        <button type="button" class="btn btn-link  ml-auto" data-bs-dismiss="modal">Tutup</button>
                                      </div>
                                    </form>
                                  </div>
                                </div>
                              </form>
                            </div>
                          <?php
                            $no++;
                          endwhile; ?>
                        </tbody>
                        <?php
                        if (isset($_POST['save'])) {
                          $konek->query("UPDATE jadwal SET link_vidcon='$_POST[link_vidcon]' WHERE id_jadwal='$_POST[idjadwal]'");
                          echo "<script>alert('Link Vidcon berhasil di simpan');</script>";
                          echo "<script>location='jadwal.php';</script>";
                        }
                        ?>
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

    <div class="container-fluid py-4">

      <div class="row mt-4">
        <div class="col-lg-12 mb-lg-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-lg-6">
                  <div class="d-flex flex-column h-100">

                    <h5 class="font-weight-bolder">Jadwal Semua Kelas</h5>

                  </div>
                </div>
                <div class="container-fluid py-4">
                  <div class="col-12">
                    <div class="table-responsive">
                      <table id="tabel2" class="table align-items-center mb-3">
                        <thead>
                          <tr>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Pelajaran</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Kelas</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Guru</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jam</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Materi</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Hari</th>
                            <!-- <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Edit Link Vidcon</th> -->
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Vidcon</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $queryjadwal = mysqli_query($konek, "select * from jadwal inner join pelajaran on jadwal.id_pelajaran = pelajaran.id_pelajaran inner join kelas on jadwal.id_kelas = kelas.id_kelas inner join guru on jadwal.id_guru = guru.id_guru inner join hari on jadwal.no_hari = hari.id_hari");
                          if ($queryjadwal == false) {
                            die("Terjadi Kesalahan : " . mysqli_error($konek));
                          }
                          ?>
                          <?php
                          $no = 1;
                          while ($jadwal = mysqli_fetch_array($queryjadwal)) : ?>
                            <tr>
                              <td class="align-middle text-sm">
                                <span class="text-secondary text-xs font-weight-bolds" style="padding-left: 15px;">
                                  <?= $jadwal['nama_pelajaran'] ?>
                                </span>
                              </td>
                              <td class="align-middle text-sm">
                                <span class="text-secondary text-xs font-weight-bolds">
                                  <?= $jadwal['nama_kelas'] ?>
                                </span>
                              </td>
                              <td class="align-middle text-center text-sm">
                                <span class="text-xs font-weight-bold">
                                  <?= $jadwal['nama_guru'] ?>
                                </span>
                              </td>
                              <td class="align-middle text-center text-sm">
                                <span class="text-secondary text-xs font-weight-bolds">
                                  <?= $jadwal['jam'] ?>
                                </span>
                              </td>
                              <td class="align-middle text-center text-sm">
                                <span class="text-secondary text-xs font-weight-bolds">
                                  <a href="unduh_jadwal.php?file=<?= $jadwal['materijadwal'] ?>"><?= $jadwal['materijadwal'] ?></a>
                                </span>
                              </td>
                              <td class="align-middle text-center text-sm">
                                <span class="text-secondary text-xs font-weight-bolds">
                                  <?= $jadwal['nama_hari'] ?>
                                </span>
                              </td>
                              <!-- <td class="align-middle text-center text-sm">
                                <span class="badge badge-sm bg-gradient-info">
                                  <a class="text-white" href="#" data-bs-toggle="modal" data-bs-target="#modaleditvidcon<?= $no ?>" id="<?= $tugas['id_tugas'] ?>">Edit</a>
                                </span>
                              </td> -->
                              <td class="align-middle text-center text-sm">
                                <span class="badge badge-sm bg-gradient-success">
                                  <a target="_blank" class="text-white" href="<?= $jadwal['link_vidcon'] ?>">Gabung</a>
                                </span>
                              </td>
                            </tr>
                            <div class="modal fade" id="modaleditvidcon<?= $no ?>" tabindex="-1" role="dialog" aria-labelledby="ModalEdit" aria-hidden="true">
                              <form name="modal_popup" enctype="multipart/form-data" method="post">
                                <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h6 class="modal-title" id="modal-title-default">Edit Link Vidcon</h6>
                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                      </button>
                                    </div>
                                    <form action="" method="post">
                                      <div class="modal-body">
                                        <div class="form-group">
                                          <label>Link Vidcon</label>
                                          <input type="hidden" name="idjadwal" value="<?= $jadwal['id_jadwal'] ?>">
                                          <input class="form-control" type="text" name="link_vidcon" value="https://" required>
                                          <span class="text-danger" style="font-size:12px">Mohon tetap sisipkan https:// sebelum link website</span>
                                        </div>
                                      </div>
                                      <div class="modal-footer">
                                        <button type="submit" name="save" class="btn bg-gradient-primary">Simpan</button>
                                        <button type="button" class="btn btn-link  ml-auto" data-bs-dismiss="modal">Tutup</button>
                                      </div>
                                    </form>
                                  </div>
                                </div>
                              </form>
                            </div>
                          <?php
                            $no++;
                          endwhile; ?>
                        </tbody>
                        <?php
                        if (isset($_POST['save'])) {
                          $konek->query("UPDATE jadwal SET link_vidcon='$_POST[link_vidcon]' WHERE id_jadwal='$_POST[idjadwal]'");
                          echo "<script>alert('Link Vidcon berhasil di simpan');</script>";
                          echo "<script>location='jadwal.php';</script>";
                        }
                        ?>
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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  <script>
    $(document).ready(function() {
      $(".edit_materi").click(function(e) {
        var m = $(this).attr("id")
        $.ajax({
          url: "jadwal_modal_edit.php",
          type: "GET",
          data: {
            kode_tugas: m,
          },
          success: function(ajaxData) {
            $("#exampleModal").html(ajaxData)
            $("#exampleModal").modal('show', {
              backdrop: 'true'
            })
          }
        })

      })
    })
  </script>
</body>

<?php require '../comp/footer.php' ?>