<?php
$title = 'Data Nilai';
$path = '../';
require 'comp/header.php';

session_start();
$bulan = date("i");
$tahun = date("s");

$format_id = $bulan . $tahun;
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
                    <h5 class="font-weight-bolder">Data Nilai</h5>
                  </div>
                </div>

                <div class="container-fluid py-4">
                  <form action="cetak_nilai.php" method="post" target="_blank">
                    <div class="form-group row">
                      <div class="col-lg-3 col-md-12 col-12 col-xs-12">
                        <select name="kelas" class="form-control">
                          <option value="">Pilih Kelas</option>
                          <?php

                          $sql = $konek->query("select * from kelas");
                          while ($data = $sql->fetch_assoc()) {
                            echo "<option value='$data[nama_kelas]'>$data[nama_kelas]</option>";
                          }
                          ?>
                        </select>
                      </div>
                      <div class="col-lg-3 col-md-12 col-12 col-xs-12">
                        <input type="submit" class="btn btn-success" name="submit" value="cetak">
                      </div>
                    </div>
                  </form>
                  <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#tambahDataNilai">Tambah Data Nilai</button>
                </div>


                <div class="table-responsive">
                  <table id="tabel" class="table align-items-center mb-3">

                    <!-- Data Jadwal -->
                    <thead>
                      <tr>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Siswa</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nama Pelajaran</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Kelas</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nilai Tugas Offline</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nilai Tugas Online</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">UTS</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">UAS</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $querynilai = mysqli_query($konek, "select * from nilai inner join pelajaran on nilai.id_pelajaran = pelajaran.id_pelajaran inner join siswa on nilai.id_siswa = siswa.nis;");
                      // $querynilai = mysqli_query($konek, "select * from users left join jawaban_tugas on users.id_users = jawaban_tugas.id_siswa left join tugas on jawaban_tugas.id_tugas = tugas.id_tugas inner join kelas on tugas.id_kelas = kelas.id_kelas inner join guru on tugas.id_guru = guru.id_guru inner join pelajaran on tugas.id_pelajaran = pelajaran.id_pelajaran left join ujian_murid on users.id_users = ujian_murid.id_murid group by users.id_users");
                      if ($querynilai == false) {
                        die("Terjadi Kesalahan : " . mysqli_error($konek));
                      }
                      ?>
                      <?php while ($nilai = mysqli_fetch_array($querynilai)) : ?>
                        <tr>

                          <td class="align-middle text-sm">
                            <span class="text-secondary text-xs font-weight-bolds">
                              <?= $nilai['nama_siswa'] ?>
                            </span>
                          </td>
                          <td class="align-middle text-sm">
                            <span class="text-secondary text-xs font-weight-bolds">
                              <?= $nilai['nama_pelajaran'] ?>
                            </span>
                          </td>
                          <td class="align-middle text-center text-sm">
                            <span class="text-xs font-weight-bold">
                              <?= $nilai['nama_kelas'] ?>
                            </span>
                          </td>
                          <td class="align-middle text-center text-sm">
                            <span class="text-secondary text-xs font-weight-bolds">
                              <?= $nilai['tugas_siswa'] ?>
                            </span>
                          </td>
                          <?php
                          $querynilaitugas = mysqli_query($konek, "select * from tugas left join jawaban_tugas on tugas.id_tugas = jawaban_tugas.id_tugas where jawaban_tugas.id_siswa = '$nilai[id_siswa]' and tugas.id_pelajaran = '$nilai[id_pelajaran]'");
                          $nilaitugascek = mysqli_num_rows($querynilaitugas);
                          if ($nilaitugascek > 0) {
                            $nilaitugas = 0;
                            $jumlah = '0';
                            while ($datanilai = mysqli_fetch_array($querynilaitugas)) :
                          ?>
                              <?php $nilaitugas += $datanilai['nilai'] ?>
                            <?php
                              $jumlah++;
                            endwhile; ?>
                            <td class="align-middle text-center text-sm">
                              <span class="text-secondary text-xs font-weight-bolds">
                                <?php
                                if ($nilaitugas != '0') {
                                  echo round($nilaitugas / $jumlah, 2);
                                } else {
                                  echo "-";
                                }
                                ?>
                              </span>
                            </td>
                          <?php
                          } else { ?>
                            <td class="align-middle text-center text-sm">
                              <span class="text-secondary text-xs font-weight-bolds">
                                -
                              </span>
                            </td>
                          <?php
                          }
                          ?>

                          <?php
                          $querynilaiuts = mysqli_query($konek, "select * from ujian left join ujian_murid on ujian.id_ujian = ujian_murid.id_ujianjawaban where ujian_murid.id_murid = '$nilai[id_siswa]' and ujian.tipeujian = 'UTS' and ujian.id_pelajaran = '$nilai[id_pelajaran]' limit 1");
                          $nilaiuts = mysqli_fetch_array($querynilaiuts);
                          $nilaiutscek = mysqli_num_rows($querynilaiuts);

                          if ($nilaiutscek > 0) { ?>
                            <td class="align-middle text-center text-sm">
                              <span class="text-secondary text-xs font-weight-bolds">
                                <?= $nilaiuts['nilai'] ?>
                              </span>
                            </td>
                          <?php
                          } else { ?>
                            <td class="align-middle text-center text-sm">
                              <span class="text-secondary text-xs font-weight-bolds">
                                -
                              </span>
                            </td>
                          <?php
                          }
                          $querynilaiuas = mysqli_query($konek, "select * from ujian left join ujian_murid on ujian.id_ujian = ujian_murid.id_ujianjawaban where ujian_murid.id_murid = '$nilai[id_siswa]' and ujian.tipeujian = 'UAS' and ujian.id_pelajaran = '$nilai[id_pelajaran]' limit 1");
                          $nilaiuas = mysqli_fetch_array($querynilaiuas);
                          $nilaiuascek = mysqli_num_rows($querynilaiuas);

                          if ($nilaiuascek > 0) { ?>
                            <td class="align-middle text-center text-sm">
                              <span class="text-secondary text-xs font-weight-bolds">
                                <?= $nilaiuas['nilai'] ?>
                              </span>
                            </td>
                          <?php } else { ?>
                            <td class="align-middle text-center text-sm">
                              <span class="text-secondary text-xs font-weight-bolds">
                                -
                              </span>
                            </td>
                          <?php
                          } ?>
                          <td class="align-middle text-center text-sm">
                            <span class="badge badge-sm bg-gradient-info">
                              <a class="text-white open_modal" onclick="edit(<?= $nilai['id_nilai'] ?>)" href="#>" data-bs-toggle="modal" data-bs-target="#ModalEditNilai">Edit</a>
                            </span>
                            <span class="badge badge-sm bg-gradient-danger">
                              <a class="text-white" href="#" onclick="confirm_delete(`nilai_delete.php?kode_nilai=<?= $nilai['id_nilai'] ?>`)">Delete</a>
                            </span>
                          </td>


                        </tr>
                      <?php endwhile; ?>

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
<div class="modal fade" id="tambahDataNilai" tabindex="-1" role="dialog" aria-labelledby="tambahDataNilaiLabel" aria-hidden="true">
  <form action="nilai_add.php" enctype="multipart/form-data" method="post">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Tambah Nilai
          </h5>
          <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

          <!-- Form -->
          <div class="form-group">
            <label for="kode" class="form-control-label"> ID</label>
            <input type="number" name="id" class="form-control" placeholder="masukan id nilai" value="<?= $format_id; ?>" readonly>
          </div>
          <div class="form-group">
            <label>Siswa</label>

            <select name="siswa" class="form-control" required>
              <option value="">Pilih Siswa</option>
              <?php

              $querymhs = mysqli_query($konek, "select * from siswa order by nama_siswa");
              if ($querymhs == false) {
                die("Terdapat Kesalahan : " . mysqli_error($konek));
              }
              while ($mhs = mysqli_fetch_array($querymhs)) {
                echo "<option value='$mhs[NIS]'>$mhs[nama_siswa]</option>";
              }
              ?>
            </select>
          </div>
          <div class="form-group">
            <label>Pelajaran</label>

            <select name="pelajaran" class="form-control" required>
              <option value="">Pilih Pelajaran</option>
              <?php

              $querypel = mysqli_query($konek, "select * from pelajaran order by nama_pelajaran");
              if ($querypel == false) {
                die("Terdapat Kesalahan : " . mysqli_error($konek));
              }
              while ($pel = mysqli_fetch_array($querypel)) {
                echo "<option value='$pel[id_pelajaran]'>$pel[nama_pelajaran]</option>";
              }
              ?>
            </select>
          </div>
          <div class="form-group">
            <label>Nilai Tugas Offline</label>

            <input type="number" name="tugas" class="form-control" id="" min="0" max="100" placeholder="Masukkan Nilai Tugas Offline" required>
          </div>

          <!-- <div class="form-group">
            <label>UTS</label>

            <input type="number" name="uts" class="form-control" id="" min="0" max="100" placeholder="Masukan Nilai UTS" required>
          </div>

          <div class="form-group">
            <label>UAS</label>

            <input type="number" name="uas" class="form-control" id="" min="0" max="100" placeholder="masukan nilai uas" required>
          </div> -->


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
<div class="modal fade" id="ModalEditNilai" tabindex="-1" role="dialog" aria-labelledby="ModalEditNilaiLabel" aria-hidden="true">
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
<!-- /Modal Popup Plejaran Edit -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


<script type="text/javascript">
  function edit(m) {
    $.ajax({
      url: "api_edit_nilai.php",
      type: "GET",
      data: {
        kode_nilai: m,
      },
      success: function(ajaxData) {

        $("#ModalEditNilai").html(ajaxData);

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