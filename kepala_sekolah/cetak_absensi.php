<?php
$title = 'Absensi';
$path = '../';
require 'header.php';

session_start();
include "../koneksi.php";
include "auth_user.php";

$bulan = date("i");
$tahun = date("s");

$format_id = $bulan . $tahun;
?>

<body class="g-sidenav-show bg-gray-100">
  <!-- aside -->
  <?php require '../comp/sidebar.php' ?>
  <!--/ aside -->

  <div class="main-content position-relative bg-gray-100 max-height-vh-100 h-100">

    <?php $title = "Cetak Absensi" ?>
    <!-- navbar -->
    <?php require '../comp/navbar.php' ?>
    <!-- /navbar -->


    <div class="container-fluid py-4">

      <div class="row mt-4">
        <div class="col-lg-12 mb-lg-0 mb-4">
          <div class="card shadow-none">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-lg-6">
                  <div class="d-flex flex-column h-100">

                    <h5 class="font-weight-bolder">Absensi</h5>

                  </div>
                </div>
                <form action="">

                  <div class="container-fluid py-4">
                    <div class="row justify-content-between">

                    </div>

                </form>
                <div class="col-12">
                  <div class="table-responsive">
                    <table class="table align-items-center mb-3">

                      <thead>
                        <tr>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ID Siswa</th>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nama Siswa</th>
                          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Kelas</th>
                          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Pelajaran</th>
                          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tanggal</th>
                          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                        </tr>
                      </thead>
                      <tbody>

                        <?php if ($_POST['tanggal'] !== "") : ?>
                          <?php
                          $querydosen = mysqli_query($konek, "SELECT * from absensi inner join jadwal on absensi.id_pelajaran = jadwal.id_pelajaran inner join pelajaran on absensi.id_pelajaran = pelajaran.id_pelajaran inner join kelas on absensi.id_kelas = kelas.id_kelas where absensi.id_pelajaran = '$_POST[pelajaran]' and absensi.id_kelas='$_POST[kelas]' and absensi.tanggal='$_POST[tanggal]' order by nama_siswa asc");
                          if ($querydosen == false) {
                            die("Terjadi Kesalahan : " . mysqli_error($konek));
                          }
                          while ($absen = mysqli_fetch_array($querydosen)) : ?>


                            <tr>
                              <td class="align-middle text-sm">
                                <span class="text-secondary text-xs font-weight-bolds">
                                  <?= $absen['id_absensi'] ?>
                                </span>
                              </td>
                              <td class="align-middle text-sm">
                                <span class="text-secondary text-xs font-weight-bolds">
                                  <?= $absen['nama_siswa'] ?>
                                </span>
                              </td>
                              <td class="align-middle text-center text-sm">
                                <span class="text-xs font-weight-bold">
                                  <?= $absen['nama_kelas'] ?>
                                </span>
                              </td>
                              <td class="align-middle text-center text-sm">
                                <span class="text-secondary text-xs font-weight-bolds">
                                  <?= $absen['nama_pelajaran'] ?>
                                </span>
                              </td>
                              <td class="align-middle text-center text-sm">
                                <span class="text-secondary text-xs font-weight-bolds">
                                  <?= $absen['tanggal'] ?>
                                </span>
                              </td>
                              <td class="align-middle text-center text-sm">
                                <span class="text-secondary text-xs font-weight-bolds">
                                  <?= $absen['status'] ?>
                                </span>
                              </td>
                            </tr>

                          <?php endwhile; ?>
                        <?php else : ?>

                          <?php
                          $querydosen = mysqli_query($konek, " SELECT *  FROM absensi inner join jadwal on absensi.id_pelajaran = jadwal.id_pelajaran inner join pelajaran on absensi.id_pelajaran = pelajaran.id_pelajaran inner join kelas on absensi.id_kelas = kelas.id_kelas where absensi.id_pelajaran = '$_POST[pelajaran]' and absensi.id_kelas='$_POST[kelas]' order by nama_siswa asc");
                          if ($querydosen == false) {
                            die("Terjadi Kesalahan : " . mysqli_error($konek));
                          }
                          while ($absen = mysqli_fetch_array($querydosen)) :

                          ?>

                            <tr>
                              <td class="align-middle text-sm">
                                <span class="text-secondary text-xs font-weight-bolds">
                                  <?= $absen['id_absensi'] ?>
                                </span>
                              </td>
                              <td class="align-middle text-sm">
                                <span class="text-secondary text-xs font-weight-bolds">
                                  <?= $absen['nama_siswa'] ?>
                                </span>
                              </td>
                              <td class="align-middle text-center text-sm">
                                <span class="text-xs font-weight-bold">
                                  <?= $absen['nama_kelas'] ?>
                                </span>
                              </td>
                              <td class="align-middle text-center text-sm">
                                <span class="text-secondary text-xs font-weight-bolds">
                                  <?= $absen['nama_pelajaran'] ?>
                                </span>
                              </td>
                              <td class="align-middle text-center text-sm">
                                <span class="text-secondary text-xs font-weight-bolds">
                                  <?= $absen['tanggal'] ?>
                                </span>
                              </td>
                              <td class="align-middle text-center text-sm">
                                <span class="text-secondary text-xs font-weight-bolds">
                                  <?= $absen['status'] ?>
                                </span>
                              </td>
                            </tr>
                          <?php endwhile; ?>

                        <?php endif; ?>


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
</body>

<!-- Modal -->
<div id="ModalAdd" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Absensi</h4>
      </div>
      <div class="modal-body">
        <form action="absensi_add.php" name="modal_popup" enctype="multipart/form-data" method="post">
          <div class="form-group">
            <label>id absen</label>
            <div class="input-group">
              <div class="input-group-addon">
                1
              </div>
              <input name="id" type="text" class="form-control" value="<?php echo $format_id ?>" readonly />
            </div>
          </div>
          <div class="form-group">
            <label>siswa</label>
            <div class="input-group">
              <div class="input-group-addon">
                2
              </div>
              <input name="siswa" type="text" class="form-control" placeholder="Nama siswa" />
            </div>
          </div>
          <div class="form-group">
            <label>Tanggal</label>
            <div class="input-group date">
              <div class="input-group-addon">
                3
              </div>
              <input name="tanggal" type="date" class="form-control" placeholder="Tanggal Lahir">
            </div>
          </div>
          <div class="form-group">
            <label>Kelas</label>
            <div class="input-group">
              <div class="input-group-addon">
                4
              </div>
              <select name="kelas" class="form-control">
                <option value="">pilih Kelas</option>
                <?php
                $sql = $konek->query("select * from kelas order by id_kelas");
                while ($data = $sql->fetch_assoc()) {
                  echo "<option value='$data[id_kelas]'>$data[nama_kelas]</option>";
                }
                ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label>pelajaran</label>
            <div class="input-group">
              <div class="input-group-addon">
                5
              </div>
              <select name="pelajaran" class="form-control">
                <option value="">pilih pelajaran</option>
                <?php
                $sql = $konek->query("select * from pelajaran order by nama_pelajaran asc");
                while ($data = $sql->fetch_assoc()) {
                  echo "<option value='$data[id_pelajaran]'>$data[nama_pelajaran]</option>";
                }
                ?>
              </select>
            </div>
          </div>

          <div class="form-group">
            <label>status</label>
            <div class="input-group">
              <div class="input-group-addon">
                6
              </div>
              <select name="status" class="form-control">
                <option value="">Pilih status</option>
                <option value="hadir">hadir</option>
                <option value="tidak hadir">tidak hadir</option>
                <option value="izin">izin</option>
              </select>
            </div>
          </div>



          <div class="modal-footer">
            <button class="btn btn-info" type="submit">
              Tambah
            </button>

          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- /Modal -->

<script>
  print();
</script>

<?php require '../comp/footer.php' ?>