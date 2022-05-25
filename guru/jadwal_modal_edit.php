<?php

include "../koneksi.php";

$Id_Jadwal	= $_GET["Id_Jadwal"];

$daftarhari[] = "Senin";
$daftarhari[] = "Selasa";
$daftarhari[] = "Rabu";
$daftarhari[] = "Kamis";
$daftarhari[] = "Jumat";
$daftarhari[] = "Sabtu";
$daftarhari[] = "Minggu";

$queryjadwal = mysqli_query($konek, "SELECT * FROM jadwal inner join pelajaran on  jadwal.id_pelajaran = pelajaran.kode_pelajaran inner join kelas on jadwal.id_kelas = kelas.id_kelas inner join guru on jadwal.kode_guru = guru.kode_guru inner join hari on jadwal.hari = hari.id_hari WHERE Id_Jadwal='$Id_Jadwal'");
if($queryjadwal == false){
	die ("Terjadi Kesalahan : ". mysqli_error($konek));
}
while($jadwal = mysqli_fetch_array($queryjadwal)){

?>
	<link rel="stylesheet" href="../aset/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css">
	<script src="../aset/plugins/daterangepicker/moment.min.js"></script>
	<script src="../aset/plugins/daterangepicker/daterangepicker.js"></script>
	<script src="../aset/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
	<!-- page script -->
    <script>
      $(function () {	
		// Daterange Picker
		  $('#Tanggal_Lahir2').daterangepicker({
			  singleDatePicker: true,
			  showDropdowns: true,
			  format: 'YYYY-MM-DD'
		  });
      });
    </script>
	<!-- Date Time Picker -->
	<script>
		$(function (){
			$('#Jam_Mulai2').datetimepicker({
				format: 'HH:mm'
			});
			
			$('#Jam_Selesai2').datetimepicker({
				format: 'HH:mm'
			});
		});
	</script>
<!-- Modal Popup Dosen -->
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title">Edit Jadwal</h4>
					</div>
					<div class="modal-body">
						<form action="jadwal_edit.php" name="modal_popup" enctype="multipart/form-data" method="post">
						<div class="form-group">
								<label>id</label>
									<div class="input-group">
										<div class="input-group-addon">
											<i class="fa fa-id-card"></i>
										</div>
										<input name="id"type="text" class="form-control" placeholder="Masukan id jadwal" readonly value="<?php echo $jadwal['Id_Jadwal']?>" readonly/>
									</div>
							</div>
							<div class="form-group">
								<label>pelajaran</label>
									<div class="input-group">
										<div class="input-group-addon">
											<i class="fa fa-graduation-cap"></i>
										</div>
										<select name="pelajaran" class="form-control" disabled>
											<option value="">pilih pelajaran</option>
											<?php
											echo "<option value='$jadwal[kode_pelajaran]' selected>$jadwal[nama_pelajaran]</option>";
											$sql = $konek->query("select * from pelajaran order by kode_pelajaran");
											while ($data = $sql->fetch_assoc()) {
												echo "<option value='$data[kode_pelajaran]'>$data[nama_pelajaran]</option>";
											}
											?>
										</select>
									</div>
								</div>

								<div class="form-group">
								<label>Kelas</label>
									<div class="input-group">
										<div class="input-group-addon">
											<i class="fa fa-graduation-cap"></i>
										</div>
										<select name="kelas" class="form-control" disabled>
											<option value="">pilih Kelas</option>
											<?php
											$sql = $konek->query("select * from kelas order by id_kelas");
											echo "<option value='$jadwal[id_kelas]' selected>$jadwal[nama_kelas]</option>";
											while ($data = $sql->fetch_assoc()) {
												echo "<option value='$data[id_kelas]'>$data[nama_kelas]</option>";
											}
											?>
										</select>
									</div>
								</div>

								<div class="form-group">
								<label>Guru</label>
									<div class="input-group">
										<div class="input-group-addon">
											<i class="fa fa-graduation-cap"></i>
										</div>
										<select name="guru" class="form-control" disabled>
											<option value="">pilih guru</option>
											<?php
											$sql = $konek->query("select * from guru ");
											echo "<option value='$jadwal[kode_guru]' selected>$jadwal[Nama_guru]</option>";
											while ($data = $sql->fetch_assoc()) {
												echo "<option value='$data[kode_guru]'>$data[Nama_guru]</option>";
											}
											?>
										</select>
									</div>
								</div>
								
								<div class="form-group">
								<label>jam</label>
									<div class="input-group">
											<div class="input-group-addon">
												<i class="fa fa-id-card"></i>
											</div>
										<input name="jam"type="text" class="form-control" placeholder="masukan jam belajar" value="<?php echo $jadwal['jam'] ?>" readonly/>
									</div>
								</div>
											
								<div class="form-group">
								<label>Hari</label>
									<div class="input-group">
										<div class="input-group-addon">
											<i class="fa fa-graduation-cap"></i>
										</div>
										<select name="hari" class="form-control" disabled>
											<option value="">pilih hari</option>
											<?php
											echo "<option value='$jadwal[id_hari]' selected>$jadwal[nama_hari]</option>";
											$sql = $konek->query("select * from hari order by id_hari");
											while ($data = $sql->fetch_assoc()) {
												echo "<option value='$data[id_hari]'>$data[nama_hari]</option>";
											}
											?>
										</select>
									</div>
								</div>

								<div class="form-group">
								<label>Materi</label>
									<div class="input-group">
										<div class="input-group-addon">
											<i class="fa fa-book"></i>
										</div>
										<input name="materi" type="file" class="form-control"/>
									</div>
								</div>
								
						
							<div class="modal-footer">
								<button class="btn btn-success" type="submit">
									Add
								</button>
								<button type="reset" class="btn btn-danger"  data-dismiss="modal" aria-hidden="true">
									Cancel
								</button>
							</div>
						</form>
					</div>
				</div>
			</div>
			
			
<?php
			}

?>