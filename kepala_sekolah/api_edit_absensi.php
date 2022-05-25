<?php

include "../koneksi.php";

$id  = $_GET["id_presensi"];

$querymhs = mysqli_query($konek, " select * from absensi inner join kelas on absensi.id_kelas = kelas.id_kelas inner join pelajaran on absensi.id_pelajaran = pelajaran.id_pelajaran WHERE id_absensi='$id'");
if ($querymhs == false) {
    die("Terjadi Kesalahan : " . mysqli_error($konek));
}
?>

<?php while ($abs = mysqli_fetch_array($querymhs)) : ?>
    <form action="absensi_edit.php" enctype="multipart/form-data" method="post">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahGuruLabel">Edit Absensi</h5>
                    <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <!-- Form -->
                    <div class="form-group">
                        <label for="kode" class="form-control-label">ID Absensi</label>
                        <input class="form-control" type="text" name="id" placeholder="Masukkan Kode Kelas" id="kode" required value="<?= $abs['id_absensi'] ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="pelajaran" class="form-control-label">Siswa</label>
                        <select name="siswa" class="form-control">
                            <?php
                            echo "<option value='$abs[nama_siswa]' selected>$abs[nama_siswa]</option>";
                            $sql = $konek->query("select * from siswa order by Nama_siswa");
                            while ($data = $sql->fetch_assoc()) {
                                echo "<option value='$data[nama_siswa]'>$data[nama_siswa]</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Tanggal</label>

                        <input name="tanggal" type="date" class="form-control" placeholder="Tanggal Lahir" value="<?php echo $abs['tanggal'] ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Kelas</label>

                        <select name="kelas" class="form-control" required>
                            <option value="">pilih Kelas</option>
                            <?php
                            echo "<option value='$abs[id_kelas]' selected>$abs[nama_kelas]</option>";
                            $sql = $konek->query("select * from kelas order by id_kelas");
                            while ($data = $sql->fetch_assoc()) {
                                echo "<option value='$data[id_kelas]'>$data[nama_kelas]</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Pelajaran</label>

                        <select name="pelajaran" class="form-control" required>
                            <option value="">pilih pelajaran</option>
                            <?php
                            echo "<option value='$abs[id_pelajaran]' selected>$abs[nama_pelajaran]</option>";
                            $sql = $konek->query("select * from pelajaran order by nama_pelajaran asc");
                            while ($data = $sql->fetch_assoc()) {
                                echo "<option value='$data[id_pelajaran]'>$data[nama_pelajaran]</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Status</label>

                        <select name="status" class="form-control" required>
                            <option <?php if ($abs['status'] == 'hadir') echo 'selected'; ?> value="hadir">Hadir</option>
                            <option <?php if ($abs['status'] == 'tidak hadir') echo 'selected'; ?> value="tidak hadir">Tidak Hadir</option>
                            <option <?php if ($abs['status'] == 'izin') echo 'selected'; ?> value="izin">Izin</option>
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