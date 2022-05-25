<?php

include "../koneksi.php";

$NIP  = $_GET["kode_guru"];

$querydosen = mysqli_query($konek, "SELECT * FROM guru WHERE id_guru='$NIP'");
if ($querydosen == false) {
  die("Terjadi Kesalahan : " . mysqli_error($konek));
}
?>

<?php while ($dosen = mysqli_fetch_array($querydosen)) : ?>
  <form action="dosen_edit.php" enctype="multipart/form-data" method="post">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="tambahGuruLabel">Edit Data Guru</h5>
          <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

          <!-- Form -->
          <div class="form-group">
            <label for="kode" class="form-control-label">Kode</label>
            <input class="form-control" type="text" name="NIP" placeholder="Masukkan Kode Guru" id="kode" required value="<?= $dosen['id_guru'] ?>" readonly>
          </div>
          <div class="form-group">
            <label for="nama" class="form-control-label">Nama</label>
            <input class="form-control" type="text" name="Nama_guru" value="<?= $dosen['nama_guru'] ?>" id="nama" required>
          </div>
          <div class="form-group">
            <label for="tanggal" class="form-control-label">Tanggal Lahir</label>
            <input class="form-control" type="date" name="Tanggal_Lahir" id="tanggal" value="<?= $dosen["tanggal_lahir"]; ?>">
          </div>
          <div class="form-group">
            <label for="kelamin">Jenis Kelamin</label>
            <select class="form-control" id="kelamin" name="gender">
              <option value="<?php echo $dosen["gender"]; ?>" selected>
                <?php
                if ($dosen["gender"] == "L") {
                  echo "Laki - laki";
                } else {
                  echo "Perempuan";
                }
                ?>
              </option>
              <?php
              if ($dosen["gender"] == "L") {
                echo "<option value='P'>Perempuan</option>";
              } else {
                echo "<option value='L'>Laki - laki</option>";
              }
              ?>
            </select>
          </div>
          <div class="form-group">
            <label for="no_telp" class="no_telp">No. Telp</label>
            <input class="form-control" type="number" name="No_Telp" value="<?= $dosen["no_hp"]; ?>" id="no_telp" required>
          </div>
          <div class="form-group">
            <label for="alamat" class="form-control-label">Alamat</label>
            <input class="form-control" type="text" placeholder="Alamat" value="<?= $dosen["alamat"]; ?>" id="alamat" name="Alamat" required>
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