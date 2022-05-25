<?php

session_start();
include "../koneksi.php";
include "auth_user.php";


$Id_Nilai	= $_GET["Id_Nilai"];

$daftarnilai[] = "A";
$daftarnilai[] = "B";
$daftarnilai[] = "C";
$daftarnilai[] = "D";

$querynilai = mysqli_query($konek, "select pelajaran.kode_pelajaran,kode_siswa,	kode_nilai,Nama_siswa,nama_pelajaran,nama_kls,tugas,uts,uas from nilai_siswa inner join pelajaran on nilai_siswa.kode_pelajaran = pelajaran.kode_pelajaran inner join siswa on nilai_siswa.kode_siswa = siswa.NIS WHERE kode_nilai='$Id_Nilai'");

while($nilai = mysqli_fetch_array($querynilai)){

?>
	
	<script src="../aset/plugins/daterangepicker/moment.min.js"></script>
	<script src="../aset/plugins/daterangepicker/daterangepicker.js"></script>
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
											<i class="fa fa-users"></i>
										</div>
										<select name="siswa" class="form-control">
										<?php
										
										echo "<option value='$nilai[kode_siswa]' selected>$nilai[Nama_siswa]</option>";
										
										?>
										</select>
									</div>
							</div>
							<div class="form-group">
								<label>pelajaran</label>
									<div class="input-group">
										<div class="input-group-addon">
											<i class="fa fa-book"></i>
										</div>
										<select name="pelajaran" class="form-control">
										<?php
											echo "<option value='$nilai[kode_pelajaran]' selected>$nilai[nama_pelajaran]</option>";
										
											$querynilaimhs = mysqli_query($konek, "select DISTINCT id_pelajaran,nama_pelajaran from jadwal inner join pelajaran on jadwal.id_pelajaran = pelajaran.kode_pelajaran inner join guru on jadwal.kode_guru = guru.kode_guru inner join kelas on jadwal.id_kelas = kelas.id_kelas right join siswa on jadwal.id_kelas = siswa.kelas where guru.kode_guru = '$_SESSION[Password]'");
											while($mhs = mysqli_fetch_array($querynilaimhs)){
												
													echo "<option value='$mhs[kode_pelajaran]'>$mhs[nama_pelajaran]</option>";
											}
										?>
										</select>
									</div>
							</div>
							<div class="form-group">
								<label>tugas</label>
									<div class="input-group">
										<div class="input-group-addon">
											<i class="fa fa-book"></i>
										</div>
										<input type="number" name="tugas" class="form-control" value="<?php echo $nilai['tugas']?>" min="0" max="100">
									</div>
							</div>
							<div class="form-group">
								<label>tugas</label>
									<div class="input-group">
										<div class="input-group-addon">
											<i class="fa fa-book"></i>
										</div>
										<input type="number" name="uts" class="form-control" value="<?php echo $nilai['uts']?>" min="0" max="100">
									</div>
							</div>
							<div class="form-group">
								<label>tugas</label>
									<div class="input-group">
										<div class="input-group-addon">
											<i class="fa fa-book"></i>
										</div>
										<input type="number" name="uas" class="form-control" value="<?php echo $nilai['uas']?>" min="0" max="100">
									</div>
							</div>
							<div class="modal-footer">
								<button class="btn btn-success" type="submit">
									Save
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