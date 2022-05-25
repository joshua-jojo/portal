<?php

session_start();
include "../koneksi.php";
include "auth_user.php";


$Id_Nilai	= $_GET["Id_Nilai"];

$daftarnilai[] = "A";
$daftarnilai[] = "B";
$daftarnilai[] = "C";
$daftarnilai[] = "D";

$querynilai = mysqli_query($konek, "select * from nilai inner join pelajaran on nilai.id_pelajaran = pelajaran.id_pelajaran inner join siswa on nilai.id_siswa = siswa.NIS WHERE id_nilai='$Id_Nilai'");

while ($nilai = mysqli_fetch_array($querynilai)) {

?>

	<form action="nilai_edit.php" name="modal_popup" enctype="multipart/form-data" method="post">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="ModalEditLabel">Edit Nilai</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">

					<input type="hidden" name="id" value="<?php echo $nilai["id_nilai"]; ?>">
					<div class="form-group">
						<label>Siswa</label>

						<select name="siswa" class="form-control">
							<?php

							echo "<option value='$nilai[id_siswa]' selected>$nilai[nama_siswa]</option>";

							$querymhs = mysqli_query($konek, "select * from jadwal inner join pelajaran on jadwal.id_pelajaran = pelajaran.id_pelajaran inner join guru on jadwal.id_guru = guru.id_guru inner join kelas on jadwal.id_kelas = kelas.id_kelas inner join siswa on kelas.id_kelas = siswa.kelas where jadwal.id_pelajaran = '$nilai[id_pelajaran]'");
							if ($querymhs == false) {
								die("Terdapat Kesalahan : " . mysqli_error($konek));
							}
							while ($mhs = mysqli_fetch_array($querymhs)) {

								echo "<option value='$mhs[NIS]'>$mhs[nama_siswa]</option>";
							}
							?>
						</select>
					</div>

					<div class="form-group">
						<label>Pelajaran</label>
						<select name="pelajaran" class="form-control">
							<?php
							echo "<option value='$nilai[id_pelajaran]' selected>$nilai[nama_pelajaran]</option>";

							$querynilaimhs = mysqli_query($konek, "select * from jadwal inner join pelajaran on jadwal.id_pelajaran = pelajaran.id_pelajaran inner join guru on jadwal.id_guru = guru.id_guru inner join kelas on jadwal.id_kelas = kelas.id_kelas right join siswa on jadwal.id_kelas = siswa.kelas where guru.id_guru = '$_SESSION[Password]'");
							while ($mhs = mysqli_fetch_array($querynilaimhs)) {

								echo "<option value='$mhs[id_pelajaran]'>$mhs[nama_pelajaran]</option>";
							}
							?>
						</select>
					</div>

					<div class="form-group">
						<label>Tugas</label>

						<input type="number" name="tugas" class="form-control" value="<?php echo $nilai['tugas_siswa'] ?>" min="0" max="100">
					</div>

					<div class="form-group">
						<label>UTS</label>
						<input type="number" name="uts" class="form-control" value="<?php echo $nilai['uts_siswa'] ?>" min="0" max="100">
					</div>

					<div class="form-group">
						<label>UAS</label>
						<input type="number" name="uas" class="form-control" value="<?php echo $nilai['uas_siswa'] ?>" min="0" max="100">
					</div>

				</div>
				<div class="modal-footer">
					<button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Batal</button>
					<button type="submit" class="btn bg-gradient-primary">Ubah</button>
				</div>
			</div>
		</div>
	</form>

<?php
}

?>