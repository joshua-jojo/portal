<?php

include "../koneksi.php";

$kode_pelajaran  = $_GET["kode_pelajaran"];

$querymatakuliah = mysqli_query($konek, "SELECT * FROM pelajaran WHERE id_pelajaran ='$kode_pelajaran'");
if ($querymatakuliah == false) {
  die("Terjadi Kesalahan : " . mysqli_error($konek));
}
?>

<?php while ($matakuliah = mysqli_fetch_array($querymatakuliah)) : ?>
  <form action="pelajaran_edit.php" enctype="multipart/form-data" method="post">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="tambahGuruLabel">Edit Pelajaran</h5>
          <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

          <!-- Form -->
          <!-- <div class="form-group">
            <label for="kode" class="form-control-label">ID Pelajaran</label> -->
          <input class="form-control" type="hidden" name="kode_pelajaran" placeholder="Masukkan Kode Kelas" id="kode" required value="<?= $matakuliah['id_pelajaran'] ?>" readonly>
          <!-- </div> -->
          <div class="form-group">
            <label for="pelajaran" class="form-control-label">Pelajaran</label>
            <input class="form-control" type="text" name="nama_pelajaran" value="<?= $matakuliah['nama_pelajaran'] ?>" id="pelajarab" required>
          </div>
          <div class="form-group">
            <label for="pembahasan" class="form-control-label">Pembahasan</label>
            <input class="form-control" type="file" name="berkas" id="pembahasan">
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