<?php

include "../koneksi.php";

$Id_Jadwal  = $_GET["Id_Jadwal"];

$queryjadwal = mysqli_query($konek, "SELECT * FROM jadwal inner join pelajaran on  jadwal.id_pelajaran = pelajaran.id_pelajaran inner join kelas on jadwal.id_kelas = kelas.id_kelas inner join guru on jadwal.id_guru = guru.id_guru inner join hari on jadwal.no_hari = hari.id_hari WHERE Id_Jadwal='$Id_Jadwal'");
if ($queryjadwal == false) {
  die("Terjadi Kesalahan : " . mysqli_error($konek));
}
?>

<?php while ($jadwal = mysqli_fetch_array($queryjadwal)) : ?>
  <form action="jadwal_edit.php" enctype="multipart/form-data" method="post">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="tambahGuruLabel">Edit Jadwal</h5>
          <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

          <!-- Form -->
          <!-- <div class="form-group">
            <label for="kode" class="form-control-label">ID</label> -->
          <input class="form-control" type="hidden" name="id" id="kode" required readonly value="<?= $Id_Jadwal ?>" readonly>
          <!-- </div> -->
          <div class="form-group">
            <label for="pelajaran" class="form-control-label">Pelajaran</label>
            <select name="pelajaran" class="form-control">
              <option value="">Pilih pelajaran</option>
              <?php
              echo "<option value='$jadwal[id_pelajaran]' selected>$jadwal[nama_pelajaran]</option>";
              $sql = $konek->query("select * from pelajaran order by id_pelajaran");
              while ($data = $sql->fetch_assoc()) {
                echo "<option value='$data[id_pelajaran]'>$data[nama_pelajaran]</option>";
              }
              ?>
            </select>

          </div>

          <div class="form-group">
            <label for="pembahasan" class="form-control-label">Pembahasan</label>
            <input class="form-control" type="file" name="berkas" id="pembahasan">
          </div>

          <div class="form-group">
            <label>Kelas</label>

            <select name="kelas" class="form-control">
              <option value="">Pilih Kelas</option>
              <?php
              $sql = $konek->query("select * from kelas order by id_kelas");
              echo "<option value='$jadwal[id_kelas]' selected>$jadwal[nama_kelas]</option>";
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
              $sql = $konek->query("select * from guru ");
              echo "<option value='$jadwal[id_guru]' selected>$jadwal[nama_guru]</option>";
              while ($data = $sql->fetch_assoc()) {
                echo "<option value='$data[id_guru]'>$data[nama_guru]</option>";
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
              <option value="">Pilih hari</option>
              <?php
              echo "<option value='$jadwal[id_hari]' selected>$jadwal[nama_hari]</option>";
              $sql = $konek->query("select * from hari order by id_hari");
              while ($data = $sql->fetch_assoc()) {
                echo "<option value='$data[id_hari]'>$data[nama_hari]</option>";
              }
              ?>
            </select>
          </div>


          <div class="form-group">
            <label>Link</label>

            <input name="berkas" type="text" class="form-control" placeholder="link gmeet" value="<?php echo $jadwal["link_vidcon"] ?>" required />

          </div>

          <!-- /Form -->

        </div>
        <div class="modal-footer">
          <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn bg-gradient-primary" type="submit">Ubah</button>
        </div>
      </div>
    </div>
  </form>
<?php endwhile; ?>