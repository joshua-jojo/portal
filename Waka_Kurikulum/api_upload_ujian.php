<?php

include "../koneksi.php";

$Id_Jadwal  = $_GET["Id_Jadwal"];
$tipe  = $_GET["tipe"];
?>
  <form action="upload_ujian.php" enctype="multipart/form-data" method="post">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="tambahGuruLabel">Upload Ujian <?=$tipe==0?"UTS":"UAS"?></h5>
          <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

          <!-- Form -->
          
          
          <div class="form-group">
            <label for="pembahasan" class="form-control-label">Ujian</label>
            <input class="form-control" type="file" name="ujian" id="pembahasan" required>
          </div>
            <input class="form-control d-none" type="text" name="id_jadwal" id="pembahasan" required readonly value="<?=$Id_Jadwal?>">
            <input class="form-control d-none" type="text" name="tipe" id="pembahasan" required readonly value="<?=$tipe?>">
          <!-- /Form -->

        </div>
        <div class="modal-footer">
          <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn bg-gradient-primary">Upload</button>
        </div>
      </div>
    </div>
  </form>