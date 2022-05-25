<?php
include "../koneksi.php";

$kode_nilai	= $_GET["kode_nilai"];

$daftarnilai[] = "A";
$daftarnilai[] = "B";
$daftarnilai[] = "C";
$daftarnilai[] = "D";

$querynilai = mysqli_query($konek, "select * from nilai_siswa inner join pelajaran on nilai_siswa.kode_pelajaran = pelajaran.kode_pelajaran inner join siswa on nilai_siswa.kode_siswa = siswa.nis WHERE kode_nilai='$kode_nilai'");
if ($querynilai == false) {
	die("Terjadi Kesalahan : " . mysqli_error($konek));
}
while ($nilai = mysqli_fetch_array($querynilai)) {

?>

	<script src="../aset/plugins/daterangepicker/moment.min.js"></script>
	<script src="../aset/plugins/daterangepicker/daterangepicker.js"></script>
	<!-- page script -->
	<script>
		$(function() {
			// Daterange Picker
			$('#Tanggal_Lahir2').daterangepicker({
				singleDatePicker: true,
				showDropdowns: true,
				format: 'YYYY-MM-DD'
			});
		});
	</script>
	<!-- Modal Popup Dosen -->
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Edit Nilai</h4>
			</div>
			<div class="modal-body">
				<form action="nilai_edit.php" name="modal_popup" enctype="multipart/form-data" method="post">
					<input type="hidden" name="id" value="<?php echo $nilai["kode_nilai"]; ?>">
					<div class="form-group">
						<label>siswa</label>
						<div class="input-group">
							<div class="input-group-addon">
								1
							</div>
							<select name="siswa" class="form-control">
								<?php

								echo "<option value='$nilai[kode_siswa]' selected>$nilai[Nama_siswa]</option>";

								$querymhs = mysqli_query($konek, "select nis,nama_kelas,Nama_siswa from jadwal inner join pelajaran on jadwal.id_pelajaran = pelajaran.kode_pelajaran inner join guru on jadwal.kode_guru = guru.kode_guru inner join kelas on jadwal.id_kelas = kelas.id_kelas inner join siswa on kelas.id_kelas = siswa.kelas where jadwal.id_pelajaran = '$nilai[kode_pelajaran]'");
								if ($querymhs == false) {
									die("Terdapat Kesalahan : " . mysqli_error($konek));
								}
								while ($mhs = mysqli_fetch_array($querymhs)) {

									echo "<option value='$mhs[nis]'>$mhs[Nama_siswa]</option>";
								}
								?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label>pelajaran</label>
						<div class="input-group">
							<div class="input-group-addon">
								2
							</div>
							<select name="pelajaran" class="form-control">
								<?php

								$querynilaimtk = mysqli_query($konek, "select kode_siswa, nama_pelajaran,id_pelajaran, kode_nilai,Nama_siswa from nilai_siswa inner join pelajaran on nilai_siswa.kode_pelajaran = pelajaran.kode_pelajaran inner join siswa on nilai_siswa.kode_siswa = siswa.nis where kode_nilai = '$nilai[kode_nilai]'");

								while ($nilaimtk = mysqli_fetch_array($querynilaimtk)) {
									echo "<option value='$nilaimtk[id_pelajaran]' selected>$nilaimtk[nama_pelajaran]</option>";
								}

								$querymtk = mysqli_query($konek, "SELECT * FROM pelajaran");
								if ($querymtk == false) {
									die("Terdapat Kesalahan : " . mysqli_error($konek));
								}
								while ($mtk = mysqli_fetch_array($querymtk)) {
									echo "<option value='$mtk[kode_pelajaran]'>$mtk[nama_pelajaran]</option>";
								}
								?>
							</select>
						</div>
					</div>

					<div class="form-group">
						<label>tugas</label>
						<div class="input-group">
							<div class="input-group-addon">
								3
							</div>
							<input type="number" name="tugas" class="form-control" id="" min="0" max="100" value="<?= $nilai['tugas'] ?>" placeholder="masukan nilai tugas" required>
						</div>
					</div>

					<div class="form-group">
						<label>uts</label>
						<div class="input-group">
							<div class="input-group-addon">
								4
							</div>
							<input type="number" name="uts" class="form-control" id="" min="0" max="100" value="<?= $nilai['uts'] ?>" placeholder="masukan nilai uts" required>
						</div>
					</div>

					<div class="form-group">
						<label>uas</label>
						<div class="input-group">
							<div class="input-group-addon">
								5
							</div>
							<input type="number" name="uas" class="form-control" id="" min="0" max="100" value="<?= $nilai['uas'] ?>" placeholder="masukan nilai uas" required>
						</div>
					</div>

					<div class="modal-footer">
						<button class="btn btn-warning" type="submit">
							Edit
						</button>

					</div>
				</form>
			</div>
		</div>
	</div>


<?php
}

?>