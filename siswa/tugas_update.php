<?php

include "../koneksi.php";
session_start();

$id  = $_GET["kode_tugas"];

$querymhs = mysqli_query($konek, "SELECT * FROM tugas inner join kelas on tugas.id_kelas = kelas.id_kelas inner join guru on tugas.id_guru = guru.id_guru inner join pelajaran on tugas.id_pelajaran = pelajaran.id_pelajaran WHERE id_tugas='$id'");
if ($querymhs == false) {
  die("Terjadi Kesalahan : " . mysqli_error($konek));
}

$tanggal_upload = date("Y-m-d");
while ($tugas = mysqli_fetch_array($querymhs)) {

?>
  <form action="tugas_updated.php" name="modal_popup" enctype="multipart/form-data" method="post">
    <div class="modal-dialog modal-dialog-centered" role="document">

      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Upload Jawaban Tugas</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">

          <div class="form-group">
            <label>ID Tugas</label>
            <input name="id" type="text" class="form-control" placeholder="id tugas" value="<?= $tugas['id_tugas'] ?>" readonly />
          </div>

          <div class="form-group">
            <label>Kelas</label>
            <select name="kelas" class="form-control" readonly>
              <?= "<option value='$tugas[kode_kelas]' selected>$tugas[nama_kelas]</option>"; ?>
            </select>
          </div>

          <div class="form-group">
            <label>Guru</label>
            <select name="guru" class="form-control" readonly>
              <?= "<option value='$tugas[id_guru]' selected>$tugas[nama_guru]</option>"; ?>
            </select>
          </div>

          <div class="form-group">
            <label>Pelajaran</label>
            <select name="pelajaran" class="form-control" readonly>
              <?= "<option value='$tugas[kode_pelajaran]' selected>$tugas[nama_pelajaran]</option>"; ?>
            </select>
          </div>

          <div class="form-group">
            <label>Batas Akhir</label>
            <input name="tanggal" type="date" class="form-control" placeholder="batas akhir" value="<?= $tugas['tanggal'] ?>" disabled>
          </div>

          <div class="form-group">
            <label>Siswa</label>
            <input name="nama_siswa" type="text" class="form-control" value="<?= $_SESSION['Username'] ?>" placeholder="Masukan Nama Kamu" readonly>
          </div>

          <div class="form-group">
            <label>Jawaban</label>
            <input name="jawaban" type="file" class="form-control" placeholder="pembahasan" />
          </div>

          <div class="form-group">
            <label>Tanggal</label>
            <input disabled readonly name="tanggal_upload" type="date" class="form-control" placeholder="batas akhir" value="<?= $tanggal_upload; ?>">
          </div>

        </div>

        <div class="modal-footer">
          <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn bg-gradient-primary">Upload</button>
        </div>
      </div>

    </div>
  </form>

<?php } ?>