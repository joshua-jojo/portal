<!-- File ini bikin baru tanpa merubah file yang lama -->
<!-- Semua sintaks di sini dibuat sendiri kak -->

<?php
$title = 'Jadwal';
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
                  <div class="d-flex flex-column h-100">

                    <h5 class="font-weight-bolder">Upload Tugas</h5>

                  </div>
                </div>
                <?php $id  = $_GET['kode_pelajaran'];
                $kelas  = $_GET['kode_kelas']; ?>
                <a href="forum.php?kode_kelas=<?= $kelas ?>&kode_pelajaran=<?= $id ?>"><button class="btn btn-info" type="button"><i class="fa fa-plus"></i>forum</button></a>
                <form action="">

                  <div class="container-fluid py-4">
                    <div class="row">
                      <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                        <div class="form-group">
                          <label for="exampleFormControlSelect1">Show Entries</label>
                          <select class="form-control" id="exampleFormControlSelect1" name="data_length">
                            <option selected>10</option>
                            <option>25</option>
                            <option>50</option>
                            <option>100</option>
                          </select>
                        </div>

                      </div>
                    </div>

                </form>
                <div class="col-12">
                  <!-- <div class="table-responsive"> -->
                  <!-- <table class="table align-items-center mb-3"> -->

                  <!-- Data Jadwal -->
                  <!-- <thead>
                        <tr>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Kelas</th>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Guru</th>
                          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Pelajaran</th>
                          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tugas</th>
                          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Batas Akhir</th>
                          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Kamu</th>
                          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jawaban Kamu</th>
                          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tanggal Upload</th>
                          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
                        </tr>
                      </thead> -->
                  <?php


                  // $nis = $_SESSION["Id_User"];
                  // $kd_pelajaran = $_GET['kode_pelajaran'];
                  // $carikelas = mysqli_query($konek, "select kelas from siswa where nis = $nis");
                  // $hasil = mysqli_fetch_array($carikelas);
                  // $res = $hasil['kelas'];

                  // $querymatakuliah = mysqli_query($konek, "select * from tugas inner join kelas on tugas.id_kelas = kelas.id_kelas inner join guru on tugas.id_guru = guru.id_guru inner join pelajaran on tugas.id_pelajaran = pelajaran.id_pelajaran where tugas.id_pelajaran = '$kd_pelajaran' and tugas.id_kelas = '$res'");

                  // $CEK = mysqli_query($konek, "select * from tugas inner join kelas on tugas.id_kelas = kelas.id_kelas inner join guru on tugas.id_guru = guru.id_guru inner join pelajaran on tugas.id_pelajaran = pelajaran.id_pelajaran inner join jawaban_tugas on tugas.id_tugas = jawaban_tugas.id_tugas where jawaban_tugas.nama_siswa = '$_SESSION[Username]' and tugas.id_kelas = '$res' and tugas.id_pelajaran = '$kd_pelajaran'");
                  ?>
                  <?php
                  // if (mysqli_num_rows($CEK) > 0) : 
                  ?>
                  <?php

                  // while ($tugas = mysqli_fetch_array($CEK)) : 
                  ?>

                  <form action="tugas_add.php" name="modal_popup" enctype="multipart/form-data" method="post">
                    <div class="form-group">
                      <label>Id Tugas</label>

                      <input name="id" type="text" class="form-control" placeholder="id tugas" value="<?php echo $tugas['kode_tugas'] ?>" readonly />
                    </div>
                    <div class="form-group">
                      <label>Kelas</label>

                      <select name="kelas" class="form-control" readonly>
                        <?php
                        echo "<option value='$tugas[kode_kelas]' selected>$tugas[nama_kelas]</option>";
                        ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Guru</label>

                      <select name="guru" class="form-control" readonly>
                        <?php
                        echo "<option value='$tugas[kode_guru]' selected>$tugas[Nama_guru]</option>";

                        ?>
                      </select>
                    </div>

                    <div class="form-group">
                      <label>Pelajaran</label>

                      <select name="pelajaran" class="form-control" readonly>

                        <?php
                        echo "<option value='$tugas[kode_pelajaran]' selected>$tugas[nama_pelajaran]</option>";
                        ?>
                      </select>
                    </div>



                    <div class="form-group">
                      <label>Batas Akhir</label>

                      <input name="tanggal" type="date" class="form-control" placeholder="batas akhir" value="<?php echo $tugas['tanggal'] ?>" disabled>
                    </div>

                    <div class="form-group">
                      <label>Siswa</label>

                      <input name="nama_siswa" type="text" class="form-control" placeholder="masukan nama kamu" />
                    </div>

                    <div class="form-group">
                      <label>Upload jawaban</label>

                      <input name="jawaban" type="file" class="form-control" placeholder="pembahasan" />
                    </div>

                    <div class="form-group">
                      <label>Tanggal</label>

                      <input name="tanggal_upload" type="date" class="form-control" placeholder="batas akhir" value="<?php echo $tanggal_upload; ?>">
                    </div>


                    <div class="modal-footer">
                      <button class="btn btn-primary" type="submit">
                        Upload
                      </button>

                    </div>
                  </form>

                  <?php

                  // endwhile; 
                  ?>
                  <?php
                  //  endif; 
                  ?>

                  <!-- /Data Jadwal -->


                  <!-- </div> -->

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

<?php require '../comp/footer.php' ?>