<?php
$title = 'Data Ujian';
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

                    <h5 class="font-weight-bolder">Data Ujian</h5>

                  </div>
                </div>

                <div class="container-fluid py-4">
                  <div class="row">
                    <div class="col-2">
                      <button type="button" class="btn bg-gradient-success" data-bs-toggle="modal" data-bs-target="#ModalUjian">
                        Tambah Ujian
                      </button>
                    </div>
                    <div class="col-12">

                      <div class="table-responsive">
                        <table id="tabel" class="table align-items-center mb-3">

                          <!-- Data Jadwal -->
                          <thead>
                            <tr>
                              <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Kelas</th>
                              <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Guru</th>
                              <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Pelajaran</th>
                              <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tipe Ujian</th>
                              <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Ujian</th>
                              <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tanggal Ujian</th>
                              <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Waktu Mulai</th>
                              <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Waktu AKhir</th>
                              <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jawaban Siswa</th>
                              <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            $queryujian = mysqli_query($konek, "select * from ujian inner join kelas on ujian.id_kelas = kelas.id_kelas inner join guru on ujian.id_guru = guru.id_guru inner join pelajaran on ujian.id_pelajaran = pelajaran.id_pelajaran");
                            $no = 1;
                            while ($ujian = mysqli_fetch_array($queryujian)) : ?>
                              <tr>
                                <td class="align-middle text-sm">
                                  <span class="text-secondary text-xs font-weight-bolds">
                                    <?= $ujian['nama_kelas'] ?>
                                  </span>
                                </td>
                                <td class="align-middle text-center text-sm">
                                  <span class="text-xs font-weight-bold">
                                    <?= $ujian['nama_guru'] ?>
                                  </span>
                                </td>
                                <td class="align-middle text-center text-sm">
                                  <span class="text-secondary text-xs font-weight-bolds">
                                    <?= $ujian['nama_pelajaran'] ?>
                                  </span>
                                </td>
                                <td class="align-middle text-center text-sm">
                                  <span class="text-secondary text-xs font-weight-bolds">
                                    <b><?= $ujian['tipeujian'] ?></b>
                                  </span>
                                </td>
                                <td class="align-middle text-center text-sm">
                                  <span class="text-secondary text-xs font-weight-bolds">
                                    <a href="unduh_ujian.php?file=<?= $ujian['soal'] ?>"> <?= $ujian['soal'] ?></a>
                                  </span>
                                </td>
                                <td class="align-middle text-center text-sm">
                                  <span class="text-secondary text-xs font-weight-bolds">
                                    <?= $ujian['tanggalujian'] ?>
                                  </span>
                                </td>
                                <td class="align-middle text-center text-sm">
                                  <span class="text-secondary text-xs font-weight-bolds">
                                    <?= $ujian['waktumulai'] ?>
                                  </span>
                                </td>
                                <td class="align-middle text-center text-sm">
                                  <span class="text-secondary text-xs font-weight-bolds">
                                    <?= $ujian['waktuakhir'] ?>
                                  </span>
                                </td>

                                <td class="align-middle text-center text-sm">

                                  <span class="badge badge-sm bg-gradient-danger text-white" style="color:white">
                                    <a href="ujianjawaban.php?id_ujian=<?= $ujian['id_ujian'] ?>" style="color:white">Lihat Jawaban Ujian Siswa</a>
                                  </span>
                                </td>
                                <td class="align-middle text-center text-sm">
                                  <span class="badge badge-sm bg-gradient-info">
                                    <a class="text-white open_modal_edit" href="#" data-bs-toggle="modal" data-bs-target="#ModalEdit<?= $no ?>" id="<?= $ujian['id_ujian'] ?>">Edit</a>
                                  </span>
                                  <span class="badge badge-sm bg-gradient-danger">
                                    <a class="text-white" href="#" data-bs-toggle="modal" data-bs-target="#modalhapus<?= $no ?>">Delete</a>
                                  </span>
                                </td>
                              </tr>
                              <div class="modal fade" id="ModalEdit<?= $no ?>" tabindex="-1" role="dialog" aria-labelledby="ModalUjianLabel" aria-hidden="true">
                                <form name="modal_popup" enctype="multipart/form-data" method="post">

                                  <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="ModalUjianLabel">Edit Ujian</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                      </div>
                                      <div class="modal-body">
                                        <div class="form-group">
                                          <label>Tipe Ujian</label>
                                          <select name="tipeujian" class="form-control" required>
                                            <option selected value="<?= $ujian['tipeujian'] ?>">Pilihan Sebelumnya : <?= $ujian['tipeujian'] ?></option>
                                            <option value="UTS">UTS</option>
                                            <option value="UAS">UAS</option>
                                          </select>
                                        </div>

                                        <div class="form-group">
                                          <label>Kelas</label>
                                          <select name="kelas" class="form-control">
                                            <?php
                                            $kelas = $_GET['kode_kelas'];
                                            $sql = $konek->query("SELECT * from kelas");
                                            while ($data = $sql->fetch_assoc()) {
                                              if ($ujian['nama_kelas'] == $data['nama_kelas']) {
                                                echo "<option selected value='$data[id_kelas]'>$data[nama_kelas]</option>";
                                              } else {
                                                echo "<option value='$data[id_kelas]'>$data[nama_kelas]</option>";
                                              }
                                            }
                                            ?>
                                          </select>
                                        </div>

                                        <div class="form-group">
                                          <label>Guru</label>

                                          <select name="guru" class="form-control" required>

                                            <?php
                                            $guru = $_SESSION['Id_User'];
                                            $sql = $konek->query("select * from guru");
                                            while ($data = $sql->fetch_assoc()) {
                                              if ($ujian['nama_guru'] == $data['nama_guru']) {
                                                echo "<option selected value='$data[id_guru]'>$data[nama_guru]</option>";
                                              } else {
                                                echo "<option value='$data[id_guru]'>$data[nama_guru]</option>";
                                              }
                                            }
                                            ?>
                                          </select>
                                        </div>

                                        <div class="form-group">
                                          <label>Pelajaran</label>

                                          <select name="pelajaran" class="form-control" required>
                                            <?php
                                            $pelajaran = $_GET['kode_pelajaran'];

                                            $sql = $konek->query("select * from pelajaran");
                                            while ($data = $sql->fetch_assoc()) {
                                              if ($ujian['nama_pelajaran'] == $data['nama_pelajaran']) {
                                                echo "<option selected value='$data[id_pelajaran]'>$data[nama_pelajaran]</option>";
                                              } else {
                                                echo "<option value='$data[id_pelajaran]'>$data[nama_pelajaran]</option>";
                                              }
                                            }
                                            ?>
                                          </select>
                                        </div>

                                        <div class="form-group">
                                          <label>Soal Ujian</label>

                                          <input name="ujian" type="file" class="form-control" placeholder="pembahasan" required>
                                        </div>



                                        <div class="form-group">
                                          <label>Tanggal Ujian</label>
                                          <input name="tanggalujian" type="date" class="form-control" value="<?= $ujian['tanggalujian'] ?>" required>
                                        </div>

                                        <div class="form-group">
                                          <label>Waktu Mulai</label>
                                          <input name="waktumulai" type="time" class="form-control" value="<?= $ujian['waktumulai'] ?>" required>
                                        </div>

                                        <div class="form-group">
                                          <label>Waktu Akhir</label>
                                          <input name="waktuakhir" type="time" class="form-control" value="<?= $ujian['waktuakhir'] ?>" required>
                                        </div>


                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Batal</button>
                                        <button class="btn bg-gradient-primary" name="ujiansimpan" type="submit">Simpan</button>
                                      </div>
                                    </div>
                                  </div>
                                </form>

                              </div>
                              <div class="modal fade" id="modalhapus<?= $no ?>" tabindex="-1" role="dialog" aria-labelledby="ModalDelete" aria-hidden="true">
                                <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h6 class="modal-title" id="modal-title-notification">Perhatian</h6>
                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                      </button>
                                    </div>
                                    <div class="modal-body">
                                      <div class="py-3 text-center">
                                        <i class="ni ni-bell-55 ni-3x"></i>
                                        <h4 class="text-gradient text-danger mt-4">Apakah Anda Yakin?</h4>
                                      </div>
                                    </div>
                                    <div class="modal-footer">
                                      <form method="post">
                                        <input type="hidden" name="idhapus" value="<?= $ujian['id_ujian'] ?>">
                                        <button type="submit" name="hapusujian" class="btn btn-white text-danger">Hapus
                                        </button>
                                      </form>
                                      <button type="button" class="btn btn-link text-secondary ml-auto" data-bs-dismiss="modal">Close</button>
                                    </div>
                                  </div>
                                </div>
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
  </main>
  <!-- /main content -->
</body>
<?php
if (isset($_POST['hapusujian'])) {
  $konek->query("delete from ujian WHERE id_ujian='$_POST[idhapus]'");
  $konek->query("delete from ujian WHERE id_ujian='$_POST[idhapus]'");
  echo "<script>alert('Ujian berhasil di hapus');</script>";
  echo "<script>location='ujian.php';</script>";
}
?>
<div class="modal fade" id="ModalUjian" tabindex="-1" role="dialog" aria-labelledby="ModalUjianLabel" aria-hidden="true">
  <form name="modal_popup" enctype="multipart/form-data" method="post">

    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="ModalUjianLabel">Tambah Ujian</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label>Tipe Ujian</label>
            <select name="tipeujian" class="form-control" required>
              <option value="UTS">UTS</option>
              <option value="UAS">UAS</option>
            </select>
          </div>

          <div class="form-group">
            <label>Kelas</label>
            <select name="kelas" class="form-control">
              <?php
              $kelas = $_GET['kode_kelas'];
              $sql = $konek->query("SELECT * from kelas");
              while ($data = $sql->fetch_assoc()) {
                echo "<option value='$data[id_kelas]'>$data[nama_kelas]</option>";
              }
              ?>
            </select>
          </div>

          <div class="form-group">
            <label>Guru</label>

            <select name="guru" class="form-control" required>

              <?php
              $guru = $_SESSION['Id_User'];
              $sql = $konek->query("select * from guru");
              while ($data = $sql->fetch_assoc()) {
                echo "<option value='$data[id_guru]'>$data[nama_guru]</option>";
              }
              ?>
            </select>
          </div>

          <div class="form-group">
            <label>Pelajaran</label>

            <select name="pelajaran" class="form-control" required>
              <?php
              $pelajaran = $_GET['kode_pelajaran'];

              $sql = $konek->query("select * from pelajaran");
              while ($data = $sql->fetch_assoc()) {
                echo "<option value='$data[id_pelajaran]'>$data[nama_pelajaran]</option>";
              }
              ?>
            </select>
          </div>

          <div class="form-group">
            <label>Soal Ujian</label>

            <input name="ujian" type="file" class="form-control" placeholder="pembahasan" required>
          </div>



          <div class="form-group">
            <label>Tanggal Ujian</label>
            <input name="tanggalujian" type="date" class="form-control" required>
          </div>

          <div class="form-group">
            <label>Waktu Mulai</label>
            <input name="waktumulai" type="time" class="form-control" required>
          </div>

          <div class="form-group">
            <label>Waktu Akhir</label>
            <input name="waktuakhir" type="time" class="form-control" required>
          </div>


        </div>
        <div class="modal-footer">
          <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Batal</button>
          <button class="btn bg-gradient-primary" name="ujiansimpan" type="submit">Tambah</button>
        </div>
      </div>
    </div>
  </form>

</div>
<?php
if (isset($_POST['ujiansimpan'])) {

  $tipeujian            = $_POST["tipeujian"];
  $kelas          = $_POST["kelas"];
  $guru            = $_POST["guru"];
  $pelajaran       = $_POST["pelajaran"];
  $ujian        = $_FILES['ujian']['name'];
  $tanggalujian     = $_POST["tanggalujian"];
  $waktumulai     = $_POST["waktumulai"];
  $waktuakhir     = $_POST["waktuakhir"];
  $file_tmp       = $_FILES['ujian']['tmp_name'];

  $CEK = mysqli_query($konek, "select * from ujian where id_pelajaran = '$pelajaran' and id_kelas='$kelas' and tipeujian='$tipeujian' ");
  if (mysqli_num_rows($CEK) > 0) {
?>
    <script>
      alert('Tipe Ujian Telah ada');
      window.location.href = "ujian.php";
    </script>
<?php
  } else {
    date_default_timezone_set("Asia/Jakarta");
    $ujian = "ujian_" . $tipeujian . "_" . $kelas . "_" . $pelajaran . "_" . date('Ymd_His_') . $ujian;

    move_uploaded_file($file_tmp, '../file/' . $ujian);
    if ($add = mysqli_query($konek, "INSERT INTO ujian (tipeujian, id_kelas, id_guru, id_pelajaran, soal, tanggalujian, waktumulai, waktuakhir) VALUES 
	('$tipeujian', '$kelas', '$guru', '$pelajaran', '$ujian', '$tanggalujian', '$waktumulai', '$waktuakhir')")) {
      echo "<script> location.href='ujian.php'; </script>";
      exit();
    }
    die("Terdapat kesalahan : " . mysqli_error($konek));
  }
}
?>
<!-- Modal Popup Plejaran Edit -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">

    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Upload Ujian</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="submit" class="btn bg-gradient-primary">Upload</button>
      </div>
    </div>

  </div>
</div>
<!-- /Modal Popup Plejaran Edit -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


<script type="text/javascript">
  $(document).ready(function() {

    // Siswa
    $(".open_modal_uts").click(function(e) {
      var m = $(this).attr("id")

      $.ajax({
        url: "api_upload_ujian.php",
        type: "GET",
        data: {
          Id_Jadwal: m,
          tipe: 0
        },
        success: function(ajaxData) {
          $("#exampleModal").html(ajaxData)
          $("#exampleModal").modal('show', {
            backdrop: 'true'
          })
        }
      })

    })
    $(".open_modal_uas").click(function(e) {
      var m = $(this).attr("id")

      $.ajax({
        url: "api_upload_ujian.php",
        type: "GET",
        data: {
          Id_Jadwal: m,
          tipe: 1
        },
        success: function(ajaxData) {
          $("#exampleModal").html(ajaxData)
          $("#exampleModal").modal('show', {
            backdrop: 'true'
          })
        }
      })

    })
  });
</script>

<?php require '../comp/footer.php' ?>