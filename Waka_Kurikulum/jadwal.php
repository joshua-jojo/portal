<?php
$title = 'Data Jadwal';
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

                    <h5 class="font-weight-bolder">Data Jadwal</h5>

                  </div>
                </div>

                <div class="container-fluid py-4">

                  <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#tambahPelajaran">Tambah Jadwal</button>
                </div>
                <div class="table-responsive">
                  <table id="tabel" class="table align-items-center mb-3">

                    <!-- Data Jadwal -->
                    <thead>
                      <tr>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Pelajaran</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Kelas</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Pengajar</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Materi Jadwal</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Link Vidcon</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jam</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Hari</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $queryjadwal = mysqli_query($konek, "select * from jadwal inner join pelajaran on  jadwal.id_pelajaran = pelajaran.id_pelajaran inner join kelas on jadwal.id_kelas = kelas.id_kelas inner join guru on jadwal.id_guru = guru.id_guru inner join hari on jadwal.no_hari = hari.id_hari order by jadwal.id_kelas");
                      if ($queryjadwal == false) {
                        die("Terjadi Kesalahan : " . mysqli_error($konek));
                      }
                      ?>
                      <?php
                      $no = 1;
                      while ($jadwal = mysqli_fetch_array($queryjadwal)) : ?>
                        <tr>
                          <td class="align-middle text-sm">
                            <span class="badge badge-sm badge-success">
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
                            <span class="text-xs font-weight-bold">
                              <a target="_blank" href="unduh_jadwal.php?file=<?= $jadwal['materijadwal'] ?>"><?= $jadwal['materijadwal'] ?></a>
                            </span>
                          </td>
                          <td class="align-middle text-center text-sm">
                            <span class="text-xs font-weight-bold">
                              <?php
                              if ($jadwal['link_vidcon'] == 'https://') { ?>

                                <a target="_blank">-</a>
                              <?php
                              } else { ?>
                                <a target="_blank" href="<?= $jadwal['link_vidcon'] ?>"><?= $jadwal['link_vidcon'] ?></a>

                              <?php

                              }
                              ?>
                            </span>
                          </td>
                          <td class="align-middle text-center text-sm">
                            <span class="text-secondary text-xs font-weight-bolds">
                              <?= $jadwal['jam'] ?>
                            </span>
                          </td>
                          <td class="align-middle text-center text-sm">
                            <span class="text-secondary text-xs font-weight-bolds">
                              <?= $jadwal['nama_hari'] ?>
                            </span>
                          </td>
                          <td class="align-middle text-center text-sm">
                            <span class="badge badge-sm bg-gradient-info">
                              <a class="text-white open_modal" id="<?= $jadwal['id_jadwal'] ?>" href="#" data-bs-toggle="modal" data-bs-target="#ModalEditJadwal<?= $no ?>">Edit</a>
                            </span>
                            <span class="badge badge-sm bg-gradient-danger">
                              <a class="text-white" href="#" onclick="confirm_delete(`jadwal_delete.php?Id_Jadwal=<?= $jadwal['id_jadwal'] ?>&kode_pelajar=<?= $jadwal['id_pelajaran'] ?>`)">Delete</a>
                            </span>
                          </td>


                        </tr>
                        <div class="modal fade" id="ModalEditJadwal<?= $no ?>" tabindex="-1" role="dialog" aria-labelledby="ModalEditJadwalLabel<?= $no ?>" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="ModalEditJadwalLabel<?= $no ?>">Edit Jadwal</h5>
                                <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <form action="jadwal_edit.php" enctype="multipart/form-data" method="post">
                                <div class="modal-body">
                                  <input class="form-control" type="hidden" name="id" id="kode" required value="<?= $jadwal['id_jadwal'] ?>" readonly>
                                  <div class="form-group">
                                    <label for="pelajaran" class="form-control-label">Pelajaran</label>
                                    <select name="pelajaran" class="form-control">
                                      <option value="">Pilih pelajaran</option>
                                      <?php
                                      $sql = $konek->query("select * from pelajaran order by id_pelajaran");
                                      while ($data = $sql->fetch_assoc()) {
                                        if ($jadwal['id_pelajaran'] == $data['id_pelajaran']) {
                                          echo "<option selected value='$data[id_pelajaran]'>$data[nama_pelajaran]</option>";
                                        } else {
                                          echo "<option value='$data[id_pelajaran]'>$data[nama_pelajaran]</option>";
                                        }
                                      }
                                      ?>
                                    </select>

                                  </div>

                                  <div class="form-group">
                                    <label>Kelas</label>

                                    <select name="kelas" class="form-control">
                                      <option value="">Pilih Kelas</option>
                                      <?php
                                      $sql = $konek->query("select * from kelas order by id_kelas");
                                      while ($data = $sql->fetch_assoc()) {
                                        if ($jadwal['id_kelas'] == $data['id_kelas']) {
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

                                    <select name="guru" class="form-control">
                                      <option value="">Pilih guru</option>
                                      <?php
                                      $sql = $konek->query("select * from guru ");
                                      while ($data = $sql->fetch_assoc()) {
                                        if ($jadwal['id_guru'] == $data['id_guru']) {
                                          echo "<option selected value='$data[id_guru]'>$data[nama_guru]</option>";
                                        } else {
                                          echo "<option value='$data[id_guru]'>$data[nama_guru]</option>";
                                        }
                                      }
                                      ?>
                                    </select>
                                  </div>

                                  <div class="form-group">
                                    <label>Jam</label>

                                    <input name="jam" type="text" class="form-control" placeholder="Masukkan Jam Belajar" value="<?php echo $jadwal['jam'] ?>" />
                                  </div>

                                  <div class="form-group">
                                    <label>Hari</label>

                                    <select name="hari" class="form-control">
                                      <option value="">Pilih Hari</option>
                                      <?php
                                      $sql = $konek->query("select * from hari order by id_hari");
                                      while ($data = $sql->fetch_assoc()) { ?>
                                        <option <?php if ($jadwal['no_hari'] == $data['id_hari']) echo 'selected'; ?> value="<?= $data['id_hari'] ?>"><?= $data['nama_hari'] ?></option>";
                                      <?php }
                                      ?>
                                    </select>
                                  </div>

                                  <div class="form-group">
                                    <label for="pembahasan" class="form-control-label">Pembahasan</label>
                                    <input class="form-control" type="file" name="berkas" id="pembahasan">
                                  </div>

                                  <div class="form-group">
                                    <label>Link</label>

                                    <input name="linkvidcon" type="text" class="form-control" placeholder="link gmeet" value="<?php echo $jadwal["link_vidcon"] ?>" required />

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
                      <?php
                        $no++;
                      endwhile; ?>

                    </tbody>
                    <!--/ Data Jadwal -->

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

<!-- Modal Tambah Pelajaran -->
<div class="modal fade" id="tambahPelajaran" tabindex="-1" role="dialog" aria-labelledby="tambahPelajaranLabel" aria-hidden="true">
  <form action="jadwal_add.php" enctype="multipart/form-data" method="post">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Tambah Jadwal
          </h5>
          <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

          <!-- Form -->
          <div class="form-group">
            <label for="kode" class="form-control-label"> Pelajaran</label>
            <select id="kode" name="pelajaran" class="form-control" required>
              <option value="">Pilih Pelajaran</option>
              <?php
              $sql = $konek->query("select * from pelajaran order by id_pelajaran");
              while ($data = $sql->fetch_assoc()) {
                echo "<option value='$data[id_pelajaran]'>$data[nama_pelajaran]</option>";
              }
              ?>
            </select>
          </div>
          <div class="form-group">
            <label for="kelas" class="form-control-label">Kelas</label>
            <select name="kelas" class="form-control" required>
              <option value="">Pilih Kelas</option>
              <?php
              $sql = $konek->query("select * from kelas order by id_kelas");
              while ($data = $sql->fetch_assoc()) {
                echo "<option value='$data[id_kelas]'>$data[nama_kelas]</option>";
              }
              ?>
            </select>
          </div>
          <div class="form-group">
            <label for="guru" class="form-control-label">Guru</label>
            <select name="guru" class="form-control" required>
              <option value="">Pilih Guru</option>
              <?php
              $sql = $konek->query("select * from guru ");
              while ($data = $sql->fetch_assoc()) {
                echo "<option value='$data[id_guru]'>$data[nama_guru]</option>";
              }
              ?>
            </select>
          </div>

          <div class="form-group">
            <label>Jam</label>

            <input name="jam" type="text" class="form-control" placeholder="masukan jam belajar" required />
          </div>

          <div class="form-group">
            <label>Hari</label>

            <select name="hari" class="form-control" required>
              <option value="">Pilih Hari</option>
              <?php
              $sql = $konek->query("select * from hari order by id_hari");
              while ($data = $sql->fetch_assoc()) {
                echo "<option value='$data[id_hari]'>$data[nama_hari]</option>";
              }
              ?>
            </select>
          </div>

          <div class="form-group">
            <label for="pembahasan" class="form-control-label">Pembahasan</label>
            <input class="form-control" type="file" name="berkas" id="pembahasan" required>
          </div>
          <div class="form-group">
            <label>Link</label>
            <input name="linkvidcon" type="text" class="form-control" placeholder="Link" value="https://" required />

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

<!-- /Modal Popup Plejaran Edit -->

<script type="text/javascript">
  $(document).ready(function() {

    // Siswa
    // $(".open_modal").click(function(e) {
    //   var m = $(this).attr("id");

    //   $.ajax({
    //     url: "api_edit_jadwal.php",
    //     type: "GET",
    //     data: {
    //       Id_Jadwal: m,
    //     },
    //     success: function(ajaxData) {

    //       $("#ModalEditJadwal").html(ajaxData);

    //     }
    //   });
    // });
  });



  function confirm_delete(delete_url) {
    $("#modal_delete").modal('show', {
      backdrop: 'static'
    });

    document.getElementById('delete_link').setAttribute('href', delete_url);
  }
</script>

<?php require '../comp/footer.php' ?>