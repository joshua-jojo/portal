<?php

include "../koneksi.php";

$id	= $_GET["kode_tugas"];

$querymhs = mysqli_query($konek, "SELECT * FROM tugas inner join kelas on tugas.kode_kelas = kelas.id_kelas inner join guru on tugas.kode_guru = guru.kode_guru inner join pelajaran on tugas.kode_pelajaran = pelajaran.kode_pelajaran WHERE kode_tugas='$id'");
if($querymhs == false){
	die ("Terjadi Kesalahan : ". mysqli_error($konek));
}

$tanggal_upload = date("Y-m-d");
while($tugas = mysqli_fetch_array($querymhs)){

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
						<h4 class="modal-title">Upload tugas</h4>
					</div>
					<div class="modal-body">
						<form action="tugas_add.php" name="modal_popup" enctype="multipart/form-data" method="post">
                        <div class="form-group">
								<label>id tugas</label>
									<div class="input-group">
										<div class="input-group-addon">
										1
										</div>
										<input name="id" type="text" class="form-control" placeholder="id tugas" value="<?php echo $tugas['kode_tugas']?>" readonly/>
									</div>
							</div>
                            <div class="form-group">
                            <label>Kelas</label>
									<div class="input-group">
										<div class="input-group-addon">
										2
										</div>
										<select name="kelas" class="form-control" readonly>
											<?php
                                            echo "<option value='$tugas[kode_kelas]' selected>$tugas[nama_kelas]</option>";
											?>
										</select>
									</div>
							</div>
                            <div class="form-group">
                                <label>guru</label>
									<div class="input-group">
										<div class="input-group-addon">
											3
										</div>
										<select name="guru" class="form-control" readonly>
											<?php
                                            echo "<option value='$tugas[kode_guru]' selected>$tugas[Nama_guru]</option>";
											
											?>
										</select>
									</div>
							</div>

                            <div class="form-group">
                                <label>pelajaran</label>
									<div class="input-group">
										<div class="input-group-addon">
											4
										</div>
										<select name="pelajaran" class="form-control" readonly>
										
											<?php
                                             echo "<option value='$tugas[kode_pelajaran]' selected>$tugas[nama_pelajaran]</option>";
											?>
										</select>
									</div>
							</div>

                           

                            <div class="form-group">
								<label>batas akhir</label>
									<div class="input-group date">
										<div class="input-group-addon">
											5
										</div>
										<input name="tanggal" type="date" class="form-control" placeholder="batas akhir" value="<?php echo $tugas['tanggal']?>" disabled>
									</div>
							</div>

							<div class="form-group">
								<label>siswa</label>
									<div class="input-group">
										<div class="input-group-addon">
											6
										</div>
										<input name="nama_siswa" type="text" class="form-control" placeholder="masukan nama kamu" />
									</div>
							</div>

                            <div class="form-group">
								<label>upload jawaban</label>
									<div class="input-group" readonly>
										<div class="input-group-addon">
											7
										</div>
										<input name="jawaban" type="file" class="form-control" placeholder="pembahasan"/>
									</div>
							</div>

                            <div class="form-group">
								<label>tanggal</label>
									<div class="input-group date">
										<div class="input-group-addon">
										8
										</div>
										<input name="tanggal_upload" type="date" class="form-control" placeholder="batas akhir" value="<?php echo $tanggal_upload; ?>">
									</div>
							</div>
								
						
							<div class="modal-footer">
								<button class="btn btn-primary" type="submit">
								Upload
								</button>
								
							</div>
						</form>
					</div>
				</div>
			</div>
			
			
<?php
			}

?>