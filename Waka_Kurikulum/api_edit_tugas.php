<?php

include "../koneksi.php";

$id  = $_GET["kode_tugas"];

$querymhs = mysqli_query($konek, "SELECT * FROM tugas inner join kelas on tugas.kode_kelas = kelas.id_kelas inner join guru on tugas.kode_guru = guru.kode_guru inner join pelajaran on tugas.kode_pelajaran = pelajaran.kode_pelajaran WHERE kode_tugas='$id'");
if ($querymhs == false) {
  die("Terjadi Kesalahan : " . mysqli_error($konek));
}
while ($tugas = mysqli_fetch_array($querymhs)) {

?>
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

          <div class="form-group">
            <!-- <label>ID Tugas</label> -->

            <input name="id" type="hidden" class="form-control" placeholder="ID Tugas" value="<?= $tugas['kode_tugas'] ?>" readonly />
          </div>

          <div class="form-group">
            <label>Kelas</label>
            <select name="kelas" class="form-control">
              <option value="">Pilih Kelas</option>
              <?php
              echo "<option value='$tugas[kode_kelas]' selected>$tugas[nama_kelas]</option>";
              $sql = $konek->query("select * from kelas order by id_kelas");
              while ($data = $sql->fetch_assoc()) {
                echo "<option value='$data[id_kelas]'>$data[nama_kelas]</option>";
              }
              ?>
            </select>
          </div>

          <div class="form-group">
            <label>Guru</label>
            <select name="guru" class="form-control">
              <option value="">Pilih guru</option>
              <?php
              echo "<option value='$tugas[kode_guru]' selected>$tugas[Nama_guru]</option>";
              $sql = $konek->query("select * from guru");
              while ($data = $sql->fetch_assoc()) {
                echo "<option value='$data[kode_guru]'>$data[Nama_guru]</option>";
              }
              ?>
            </select>
          </div>

          <div class="form-group">
            <label>Pelajaran</label>
            <select name="pelajaran" class="form-control">
              <option value="">Pilih Pelajaran</option>
              <?php
              echo "<option value='$tugas[kode_pelajaran]' selected>$tugas[nama_pelajaran]</option>";
              $sql = $konek->query("select * from pelajaran order by kode_pelajaran");
              while ($data = $sql->fetch_assoc()) {
                echo "<option value='$data[kode_pelajaran]'>$data[nama_pelajaran]</option>";
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

            <input name="tanggal" type="date" class="form-control" placeholder="Batas Akhir" value="<?php echo $tugas['tanggal'] ?>">
          </div>

        </div>
        <div class="modal-footer">
          <button type="submit" class="btn bg-gradient-primary">Edit</button>
          <button type="button" class="btn btn-link  ml-auto" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </form>

<?php } ?>