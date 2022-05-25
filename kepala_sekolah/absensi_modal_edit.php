<?php

include "../koneksi.php";

$id	= $_GET["id_presensi"];

$querymhs = mysqli_query($konek, " select * from absensi inner join kelas on absensi.id_kelas = kelas.id_kelas inner join pelajaran on absensi.id_pelajaran = pelajaran.id_pelajaran WHERE id_absensi='$id'");
if ($querymhs == false) {
	die("Terjadi Kesalahan : " . mysqli_error($konek));
}
while ($abs = mysqli_fetch_array($querymhs)) {

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
				<h4 class="modal-title">Edit kehadiran</h4>
			</div>
			<div class="modal-body">
				<form action="absensi_edit.php" name="modal_popup" enctype="multipart/form-data" method="post">
					<div class="form-group">
						<label>id absen</label>
						<div class="input-group">
							<div class="input-group-addon">
								1
							</div>
							<input name="id" type="text" class="form-control" placeholder="siswa" value="<?php echo $abs['id_absensi'] ?>" readonly />
						</div>
					</div>
					<div class="form-group">
						<label>siswa</label>
						<div class="input-group">
							<div class="input-group-addon">
								2
							</div>
							<input name="siswa" type="text" class="form-control" placeholder="Nama siswa" value="<?php echo $abs['nama_siswa'] ?>" required />
						</div>
					</div>
					<div class="form-group">
						<label>Tanggal</label>
						<div class="input-group date">
							<div class="input-group-addon">
								3
							</div>
							<input name="tanggal" type="date" class="form-control" placeholder="Tanggal Lahir" value="<?php echo $abs['tanggal'] ?>" required>
						</div>
					</div>
					<div class="form-group">
						<label>Kelas</label>
						<div class="input-group">
							<div class="input-group-addon">
								4
							</div>
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
					</div>
					<div class="form-group">
						<label>pelajaran</label>
						<div class="input-group">
							<div class="input-group-addon">
								5
							</div>
							<select name="pelajaran" class="form-control" required>
								<option value="">pilih pelajaran</option>
								<?php
								echo "<option value='$abs[id_pelajaran]' selected>$abs[nama_pelajaran]</option>";
								$sql = $konek->query("select * from pelajaran order by nama_pelajaran asc");
								while ($data = $sql->fetch_assoc()) {
									echo "<option value='$data[kode_pelajaran]'>$data[nama_pelajaran]</option>";
								}
								?>
							</select>
						</div>
					</div>

					<div class="form-group">
						<label>status</label>
						<div class="input-group">
							<div class="input-group-addon">
								6
							</div>
							<select name="status" class="form-control" required>
								<?php echo "<option value='$abs[status]' selected>$abs[status]</option>"; ?>
								<option value="">Pilih status</option>
								<option value="hadir">hadir</option>
								<option value="tidak hadir">tidak hadir</option>
								<option value="izin">izin</option>
							</select>
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