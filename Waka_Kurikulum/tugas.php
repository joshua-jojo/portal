<!-- File ini bikin baru tanpa merubah file yang lama -->
<!-- Semua sintaks di sini dibuat sendiri kak -->

<?php
$title = 'Data Jadwal';
$path = '../';
require '../comp/header.php';

session_start();
include "../koneksi.php";
include "auth_user.php";

$bulan = date("i");
$tahun = date("s");

$format_id = $bulan . $tahun;
?>

<body class="g-sidenav-show bg-gray-100">
  <!-- aside -->
  <?php require 'comp/sidebar.php' ?>
  <!--/ aside -->

  <!-- main content -->
  <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg">

    <?php $title = "Tugas" ?>
    <!-- navbar -->
    <?php $title = 'Tugas' ?>
    <?php require '../comp/navbar.php' ?>

    <!-- /navbar -->

    <div class="container-fluid py-4">

      <div class="row mt-4">
        <div class="col-lg-12 mb-lg-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-lg-6">
                  <div class="d-flex flex-column h-100 mb-4">

                    <h5 class="font-weight-bolder">Tugas</h5>

                  </div>
                </div>
                <?php $id  = $_GET['kode_pelajaran'];
                $kelas  = $_GET['kode_kelas']; ?>

                <div class="row">

                  <div class="col-2">
                    <button type="button" class="btn bg-gradient-success" data-bs-toggle="modal" data-bs-target="#ModalTugas">
                      Tambah Tugas
                    </button>
                  </div>

                </div>

                <div class="col-12">


                  <div class="table-responsive">
                    <table class="table align-items-center mb-3">

                      <!-- Data Jadwal -->

                      <?php

                      $id  = $_GET['kode_pelajaran'];
                      $kelas  = $_GET['kode_kelas'];

                      // $querymatakuliah = mysqli_query($konek, "select * from tugas inner join kelas on tugas.kode_kelas = kelas.id_kelas inner join guru on tugas.kode_guru = guru.kode_guru inner join pelajaran on tugas.kode_pelajaran = pelajaran.kode_pelajaran where tugas.kode_kelas = '$kelas' and tugas.kode_pelajaran = '$id'");
                      $querymatakuliah = mysqli_query($konek, "select * from tugas inner join kelas on tugas.id_kelas = kelas.id_kelas inner join guru on tugas.id_guru = guru.id_guru inner join pelajaran on tugas.id_pelajaran = pelajaran.id_pelajaran where tugas.id_kelas = '$kelas' and tugas.id_pelajaran = '$id'");

                      $CEK = mysqli_query($konek, "select * from tugas inner join kelas on tugas.id_kelas = kelas.id_kelas inner join guru on tugas.id_guru = guru.id_guru inner join pelajaran on tugas.id_pelajaran = pelajaran.id_pelajaran inner join jawaban_tugas on tugas.id_tugas = jawaban_tugas.id_tugas where tugas.id_pelajaran = '$id' and tugas.id_kelas = '$kelas'");
                      ?>

                      <?php if (mysqli_num_rows($CEK) > 0) : ?>
                        <thead>
                          <tr>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No.</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Kelas</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Guru</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Pelajaran</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tugas</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Batas Akhir</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jawaban Siswa</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $no = 1;
                          while ($tugas = mysqli_fetch_array($CEK)) : ?>
                            <tr>
                              <td class="align-middle text-sm">
                                <span class="text-secondary text-xs font-weight-bolds">
                                  <?= $no ?>
                                </span>
                              </td>
                              <td class="align-middle text-sm">
                                <span class="text-secondary text-xs font-weight-bolds">
                                  <?= $tugas['nama_kelas'] ?>
                                </span>
                              </td>
                              <td class="align-middle text-center text-sm">
                                <span class="text-xs font-weight-bold">
                                  <?= $tugas['nama_guru'] ?>
                                </span>
                              </td>
                              <td class="align-middle text-center text-sm">
                                <span class="text-secondary text-xs font-weight-bolds">
                                  <?= $tugas['nama_pelajaran'] ?>
                                </span>
                              </td>
                              <td class="align-middle text-center text-sm">
                                <span class="text-secondary text-xs font-weight-bolds">
                                  <a href="unduh_tugas.php?file=<?= $tugas['file_tugas'] ?>"> <?= $tugas['file_tugas'] ?></a>
                                </span>
                              </td>
                              <td class="align-middle text-center text-sm">
                                <span class="text-secondary text-xs font-weight-bolds">
                                  <?= $tugas['tanggal'] ?>
                                </span>
                              </td>

                              <td class="align-middle text-center text-sm">
                                <span class="badge badge-sm bg-gradient-danger text-white" style="color:white">
                                  <a href="tugasjawaban.php?kode_pelajaran=<?= $tugas['id_pelajaran'] ?>&kode_kelas=<?= $tugas['id_kelas'] ?>&id_tugas=<?= $tugas['id_tugas'] ?>">Lihat Jawaban Siswa</a>
                                </span>
                              </td>
                              <td class="align-middle text-center text-sm">
                                <span class="badge badge-sm bg-gradient-info">
                                  <a class="text-white open_modal_edit" href="#" data-bs-toggle="modal" data-bs-target="#ModalEdit" id="<?= $tugas['id_tugas'] ?>">Edit</a>
                                </span>
                                <span class="badge badge-sm bg-gradient-danger" onClick='confirm_delete("tugas_delete.php?kode_tugas=<?= $tugas['id_jawaban'] ?>")'>
                                  <a class="text-white" href="#" data-bs-toggle="modal" data-bs-target="#ModalDelete">Delete</a>
                                </span>
                              </td>
                            </tr>
                          <?php endwhile; ?>
                        </tbody>
                      <?php endif; ?>

                      <?php if (mysqli_num_rows($CEK) === 0) : ?> // karena ini nilainya 0 maka logika ini berjalan kalo tidak nol maka logika yang di atasnya
                        <thead>
                          <tr>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Kelas</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Guru</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Pelajaran</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tugas</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Batas Akhir</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $no = 1;
                          while ($tugas = mysqli_fetch_array($querymatakuliah)) : ?>
                            <tr>
                              <td class="align-middle text-sm">
                                <span class="text-secondary text-xs font-weight-bolds">
                                  <?= $tugas['nama_kelas'] ?>
                                </span>
                              </td>
                              <td class="align-middle text-center text-sm">
                                <span class="text-xs font-weight-bold">
                                  <?= $tugas['nama_guru'] ?>
                                </span>
                              </td>
                              <td class="align-middle text-center text-sm">
                                <span class="text-secondary text-xs font-weight-bolds">
                                  <?= $tugas['nama_pelajaran'] ?>
                                </span>
                              </td>
                              <td class="align-middle text-center text-sm">
                                <span class="text-secondary text-xs font-weight-bolds">
                                  <a href="unduh_tugas.php?file=<?= $tugas['file_tugas'] ?>"> <?= $tugas['file_tugas'] ?></a>
                                </span>
                              </td>
                              <td class="align-middle text-center text-sm">
                                <span class="text-secondary text-xs font-weight-bolds">
                                  <?= $tugas['tanggal'] ?>
                                </span>
                              </td>

                              <td class="align-middle text-center text-sm">

                                <span class="badge badge-sm bg-gradient-info">
                                  <a class="text-white open_modal_edit" id="<?= $tugas['id_tugas'] ?>" href="#>" data-bs-toggle="modal" data-bs-target="#ModalEditTugas">Edit</a>
                                </span>
                                <span class="badge badge-sm bg-gradient-danger">
                                  <a class="text-white" href="#" data-bs-toggle="modal" data-bs-target="#modalhapus<?= $no ?>">Delete</a>
                                </span>
                              </td>
                            </tr>
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
                                      <input type="hidden" name="idhapus" value="<?= $tugas['id_tugas'] ?>">
                                      <button type="submit" name="hapustugas" class="btn btn-white text-danger">Hapus
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
                      <?php endif; ?>

                      <!-- /Data Jadwal -->

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
if (isset($_POST['hapustugas'])) {
  $konek->query("delete from tugas WHERE id_tugas='$_POST[idhapus]'");
  echo "<script>alert('Tugas berhasil di hapus');</script>";
  echo "<script>location='tugas.php?kode_pelajaran=$_GET[kode_pelajaran]&kode_kelas=$_GET[kode_kelas]';</script>";
}
?>
<!-- Modal Tugas -->
<div class="modal fade" id="ModalTugas" tabindex="-1" role="dialog" aria-labelledby="ModalTugasLabel" aria-hidden="true">
  <form action="tugas_add.php" name="modal_popup" enctype="multipart/form-data" method="post">

    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="ModalTugasLabel">Tambah Tugas</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

          <div class="form-group">
            <label>ID Tugas</label>

            <input name="id" type="text" class="form-control" placeholder="id tugas" value="<?php echo $format_id ?>" readonly />
          </div>

          <div class="form-group">
            <label>Kelas</label>
            <select name="kelas" class="form-control">
              <?php
              $kelas = $_GET['kode_kelas'];
              $sql = $konek->query("SELECT * from kelas where id_kelas = '$kelas'");
              while ($data = $sql->fetch_assoc()) {
                echo "<option value='$data[id_kelas]'>$data[nama_kelas]</option>";
              }
              ?>
            </select>
          </div>

          <div class="form-group">
            <label>Guru</label>

            <select name="guru" class="form-control">

              <?php
              $sql = $konek->query("SELECT * from guru");
              while ($data = $sql->fetch_assoc()) {
                echo "<option value='$data[id_guru]'>$data[nama_guru]</option>";
              }
              ?>
            </select>
          </div>

          <div class="form-group">
            <label>Pelajaran</label>

            <select name="pelajaran" class="form-control">
              <?php
              $pelajaran = $_GET['kode_pelajaran'];

              $sql = $konek->query("select * from pelajaran where id_pelajaran = '$pelajaran'");
              while ($data = $sql->fetch_assoc()) {
                echo "<option value='$data[id_pelajaran]'>$data[nama_pelajaran]</option>";
              }
              ?>
            </select>
          </div>

          <div class="form-group">
            <label>Tugas</label>

            <input name="tugas" type="file" class="form-control" placeholder="pembahasan" />
          </div>



          <div class="form-group">
            <label>Batas Akhir</label>
            <input name="tanggal" type="date" class="form-control" placeholder="batas akhir">
          </div>


        </div>
        <div class="modal-footer">
          <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Batal</button>
          <button class="btn bg-gradient-primary" type="submit">Tambah</button>
        </div>
      </div>
    </div>
  </form>

</div>


<!-- Modal Delete -->
<div class="modal fade" id="ModalDelete" tabindex="-1" role="dialog" aria-labelledby="ModalDelete" aria-hidden="true">
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
        <button type="button" class="btn btn-white text-danger">
          <a href="" id="delete_link">
            Hapus
          </a>
        </button>
        <button type="button" class="btn btn-link text-secondary ml-auto" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Edit -->
<div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="ModalEdit" aria-hidden="true">
  <form action="tugas_edit.php" name="modal_popup" enctype="multipart/form-data" method="post">
    <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h6 class="modal-title" id="modal-title-default">Edit Tugas</h6>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">

        </div>
        <div class="modal-footer">
          <button type="submit" class="btn bg-gradient-primary">Edit</button>
          <button type="button" class="btn btn-link  ml-auto" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </form>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<!-- Javascript Delete -->
<script>
  function confirm_delete(delete_url) {
    $("#modal_delete").modal('show', {
      backdrop: 'static'
    });
    document.getElementById('delete_link').setAttribute('href', delete_url);
  }

  $(".open_modal_edit").click(function(e) {
    var m = $(this).attr("id");


    console.log('kode Tugas: , ', m);


    $.ajax({
      url: "api_modal_edit.php",
      type: "GET",
      data: {
        id_tugas: m,
      },
      success: function(ajaxData) {

        console.log(ajaxData);


        $("#ModalEdit").html(ajaxData);
        $("#ModalEdit").modal('show', {
          backdrop: 'true'
        });
      }
    });
  });
</script>
<?php require '../comp/footer.php' ?>