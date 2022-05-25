<?php

include "../koneksi.php";

$Id_Nilai  = $_GET["Id_Nilai"];
$tipe  = $_GET["tipe"];

$querymhs = mysqli_query($konek, "SELECT * FROM nilai WHERE id_nilai='$Id_Nilai'");
if ($querymhs == false) {
  die("Terjadi Kesalahan : " . mysqli_error($konek));
}
$nilai = mysqli_fetch_array($querymhs) ?>
?>
  <form action="nilai_edit_ujian.php" method="post">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="tambahGuruLabel">Nilai <?=$tipe==0?"UTS":"UAS"?></h5>
          <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

          <!-- Form -->
          
          <?php
            if($tipe==0){?>
              <div class="form-group">
                <label>UTS</label>
                <input type="number" name="nilai" class="form-control" value="<?php echo $nilai['uts_siswa'] ?>" min="0" max="100" value="<?=$nilai['uts_siswa']?>">
              </div>
          <?php }else{?>
            <div class="form-group">
              <label>UAS</label>
              <input type="number" name="nilai" class="form-control" value="<?php echo $nilai['uas_siswa'] ?>" min="0" max="100" value="<?=$nilai['uas_siswa']?>">
            </div>
          <?php }
          ?>
          

					
            <input class="form-control d-none" type="text" name="id_nilai" id="pembahasan" required readonly value="<?=$Id_Nilai?>">
            <input class="form-control d-none" type="text" name="tipe" id="pembahasan" required readonly value="<?=$tipe?>">
          <!-- /Form -->

        </div>
        <div class="modal-footer">
          <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn bg-gradient-primary">SIMPAN</button>
        </div>
      </div>
    </div>
  </form>