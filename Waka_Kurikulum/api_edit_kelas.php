<?php

include "../koneksi.php";

$Kode_Ruangan  = $_GET["id_kelas"];

$queryruangan = mysqli_query($konek, "SELECT * FROM kelas WHERE id_kelas='$Kode_Ruangan'");
if ($queryruangan == false) {
  die("Terjadi Kesalahan : " . mysqli_error($konek));
}
?>

<?php while ($ruangan = mysqli_fetch_array($queryruangan)) : ?>
  <form action="kelas_edit.php" enctype="multipart/form-data" method="post">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="tambahGuruLabel">Edit Data Kelas</h5>
          <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

          <!-- Form -->
          <div class="form-group">
            <label for="kode" class="form-control-label">Kode Kelas</label>
            <input class="form-control" type="text" name="id_kelas" placeholder="Masukkan Kode Kelas" id="kode" required value="<?= $ruangan['id_kelas'] ?>" readonly>
          </div>
          <div class="form-group">
            <label for="nama" class="form-control-label">Nama Kelas</label>
            <input class="form-control" type="text" name="nama_kelas" value="<?= $ruangan['nama_kelas'] ?>" id="nama" required>
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