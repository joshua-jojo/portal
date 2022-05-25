<?php

include "../koneksi.php";

$kode_pengumuman  = $_GET["id_pengumuman"];

$querymatakuliah = mysqli_query($konek, "SELECT * FROM pengumuman WHERE id_pengumuman ='$kode_pengumuman'");
if ($querymatakuliah == false) {
  die("Terjadi Kesalahan : " . mysqli_error($konek));
}
while ($pengumuman = mysqli_fetch_array($querymatakuliah)) {


?>

  <form action="pengumuman_edit.php" name="modal_popup" enctype="multipart/form-data" method="post">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="ModalEditPengumumanLabel">Edit Pengumuman</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

          <!-- <div class="form-group">
            <label>ID</label> -->

          <input name="id" type="hidden" class="form-control" placeholder="Masukan id pengumuman" value="<?= $pengumuman['id_pengumuman'] ?>" />
          <!-- </div> -->

          <div class="form-group">
            <label>Judul</label>

            <input name="judul" type="text" class="form-control" placeholder="Masukan judul pengumuman" value="<?= $pengumuman['judul'] ?>" />
          </div>

          <div class="form-group">
            <label>Keterangan</label>
            <textarea rows="5" class="form-control" id="deskripsiedit" name="keterangan" placeholder="masukan text!"><?= $pengumuman['deskripsi']; ?></textarea>
            <script>
              CKEDITOR.replace('deskripsiedit');
            </script>
          </div>

          <div class="form-group">
            <label>Tanggal</label>
            <input type="date" name="tanggal" value="<?= $pengumuman['tanggal_pembuatan']; ?>" class="form-control">
          </div>

          <div class="form-group">
            <label>Lampiran</label>
            <input name="lampiran" type="file" class="form-control" />
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn bg-gradient-primary">Ubah</button>
        </div>
      </div>
    </div>
  </form>

<?php } ?>