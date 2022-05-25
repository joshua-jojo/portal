<?php

include "../koneksi.php";

$NIS  = $_GET["NIS"];

$querymhs = mysqli_query($konek, "SELECT * FROM siswa inner join kelas on siswa.kelas = kelas.id_kelas WHERE NIS = '$NIS'");
if ($querymhs == false) {
  die("Terjadi Kesalahan : " . mysqli_error($konek));
}
?>

<?php while ($mhs = mysqli_fetch_array($querymhs)) : ?>
  <form action="siswa_edit.php" enctype="multipart/form-data" method="post">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="tambahGuruLabel">Edit Data Siswa</h5>
          <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

          <!-- Form -->
          <div class="form-group">
            <label for="kode" class="form-control-label">NIS</label>
            <input class="form-control" type="text" name="NIS" placeholder="Masukkan NIS" value="<?= $mhs["NIS"] ?>" id="kode" required value="<?= $mhs['NIS'] ?>" readonly maxlength="10" minlength="4">
          </div>
          <div class="form-group">
            <label for="nama" class="form-control-label">Siswa</label>
            <input class="form-control" type="text" name="Nama_siswa" value="<?= $mhs['nama_siswa'] ?>" id="nama" required>
          </div>
          <div class="form-group">
            <label for="tanggal" class="form-control-label">Tanggal Lahir</label>
            <input class="form-control" type="date" name="Tanggal_lahir" id="tanggal" value="<?= $mhs["tanggal_lahir"]; ?>">
          </div>
          <div class="form-group">
            <label for="kelamin">Jenis Kelamin</label>
            <select class="form-control" id="kelamin" name="gender">
              <option value="<?= $mhs["gender"]; ?>" selected>
                <?php
                if ($mhs["gender"] == "L") {
                  echo "Laki - laki";
                } else {
                  echo "Perempuan";
                }
                ?>
              </option>
              <?php
              if ($mhs["gender"] == "L") {
                echo "<option value='P'>Perempuan</option>";
              } else {
                echo "<option value='L'>Laki - laki</option>";
              }
              ?>
            </select>
          </div>
          <div class="form-group">
            <label for="no_telp" class="no_telp">No. Telp</label>
            <input class="form-control" type="number" name="No_Telp" value="<?= $mhs["no_hp"]; ?>" id="no_telp" required>
          </div>
          <div class="form-group">
            <label for="alamat" class="form-control-label">Alamat</label>
            <input class="form-control" type="text" placeholder="Alamat" value="<?= $mhs["alamat"]; ?>" id="alamat" name="Alamat" required>
          </div>
          <div class="form-group">
            <label for="agama">Agama</label>
            <select name="agama" id='agama' class="form-control" required>
              <option value="<?= $mhs['agama'] ?>"><?= $mhs['agama'] ?></option>
              <option value="buddha">buddha</option>
              <option value="hindu">hindu</option>
              <option value="islam">islam</option>
              <option value="kristen">kristen</option>
              <option value="katolik">katolik</option>
              <option value="kong hu cu">kong hu cu</option>
            </select>
          </div>
          <div class="form-group">
            <label class="form-control-label">Kelas</label>
            <select name="kelas" class="form-control" required>
              <option value="<?= $mhs['id_kelas'] ?>.<?= $mhs['nama_kelas'] ?>"><?= $mhs['nama_kelas'] ?></option>
              <?php
              $sql = $konek->query("select * from kelas order by id_kelas");
              while ($data = $sql->fetch_assoc()) {
                echo "<option value='$data[id_kelas]'>$data[nama_kelas]</option>";
              }
              ?>
            </select>
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