<?php

include "../koneksi.php";

$kode_nilai  = $_GET["kode_nilai"];

$querynilai = mysqli_query($konek, "select * from nilai inner join pelajaran on nilai.id_pelajaran = pelajaran.id_pelajaran inner join siswa on nilai.id_siswa = siswa.nis WHERE id_nilai='$kode_nilai'");
if ($querynilai == false) {
    die("Terjadi Kesalahan : " . mysqli_error($konek));
}
?>

<?php while ($nilai = mysqli_fetch_array($querynilai)) : ?>
    <form action="nilai_edit.php" enctype="multipart/form-data" method="post">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahGuruLabel">Edit Data Nilai</h5>
                    <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <input type="hidden" name="id" value="<?php echo $nilai["id_nilai"]; ?>">

                    <!-- Form -->
                    <div class="form-group">
                        <label for="kode" class="form-control-label">Siswa</label>
                        <input name="siswa" class="form-control" value="<?= $nilai['nama_siswa'] ?>" readonly>

                    </div>
                    <div class="form-group">
                        <label>Pelajaran</label>

                        <select name="pelajaran" class="form-control" readonly>
                            <?php

                            $querynilaimtk = mysqli_query($konek, "select * from nilai inner join pelajaran on nilai.id_pelajaran = pelajaran.id_pelajaran inner join siswa on nilai.id_siswa = siswa.nis where id_nilai = '$nilai[id_nilai]'");

                            while ($nilaimtk = mysqli_fetch_array($querynilaimtk)) {
                                echo "<option value='$nilaimtk[id_pelajaran]' selected>$nilaimtk[nama_pelajaran]</option>";
                            }

                            $querymtk = mysqli_query($konek, "SELECT * FROM pelajaran");
                            if ($querymtk == false) {
                                die("Terdapat Kesalahan : " . mysqli_error($konek));
                            }
                            while ($mtk = mysqli_fetch_array($querymtk)) {
                                echo "<option value='$mtk[id_pelajaran]'>$mtk[nama_pelajaran]</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Nilai Tugas Offline</label>

                        <input type="number" name="tugas" class="form-control" id="" min="0" max="100" value="<?= $nilai['tugas_siswa'] ?>" placeholder="Nilai Tugas Offline" required>
                    </div>

                    <!-- <div class="form-group">
            <label>UTS</label>

            <input type="number" name="uts" class="form-control" id="" min="0" max="100" value="<?= $nilai['uts_siswa'] ?>" placeholder="masukan nilai uts" required>
          </div>

          <div class="form-group">
            <label>UAS</label>

            <input type="number" name="uas" class="form-control" id="" min="0" max="100" value="<?= $nilai['uas_siswa'] ?>" placeholder="masukan nilai uas" required>
          </div> -->

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