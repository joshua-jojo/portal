<?php

include "../koneksi.php";

$NIS	= $_GET["id_tagihan"];

$querymhs = mysqli_query($konek, "select * from tagihan inner join siswa on tagihan.id_siswa = siswa.nis inner join kelas on tagihan.kode_kelas = kelas.id_kelas inner join bulan on tagihan.id_bulan = bulan.id_bulan_spp where id_tagihan = '$NIS';");
if($querymhs == false){
	die ("Terjadi Kesalahan : ". mysqli_error($konek));
}
while($mhs = mysqli_fetch_array($querymhs)){

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
						<h4 class="modal-title">Edit siswa</h4>
					</div>
					<div class="modal-body">
						<form action="tagihan_edit.php" name="modal_popup" enctype="multipart/form-data" method="post">
							

						<div class="form-group">
								<label>id</label>
									<div class="input-group">
										<div class="input-group-addon">
											1
										</div>
										<input name="id" type="text" class="form-control" placeholder="id" value="<?= $mhs['id_tagihan']?>" readonly/>
									</div>
							</div>
							<div class="form-group">
								<label>siswa</label>
									<div class="input-group">
										<div class="input-group-addon">
											2
										</div>
										<select name="siswa" class="form-control">
										
											<?php
											echo "<option value='$mhs[NIS]'>$mhs[Nama_siswa]</option>";
											$sql = $konek->query("select * from siswa order by Nama_siswa");
											while ($data = $sql->fetch_assoc()) {
												echo "<option value='$data[NIS]'>$data[Nama_siswa]</option>";
											}
											?>
										</select>
									</div>
							</div>
							<div class="form-group">
								<label>Tanggal</label>
									<div class="input-group date">
										<div class="input-group-addon">
											3
										</div>
										<input name="tanggal" type="date" class="form-control" placeholder="Tanggal" value="<?php echo $mhs['tanggal']?>" required>
									</div>
							</div>
						
						
								<div class="form-group">
								<label>Kelas</label>
									<div class="input-group">
										<div class="input-group-addon">
											4
										</div>
										<select name="kelas" class="form-control" readonly>
											
											<?php
												echo "<option value='$mhs[id_kelas]' selected>$mhs[nama_kelas]</option>";
											$sql = $konek->query("select * from kelas order by id_kelas");
											while ($data = $sql->fetch_assoc()) {
												echo "<option value='$data[id_kelas]'>$data[nama_kelas]</option>";
											}
											?>
										</select>
									</div>
								</div>
                                <div class="form-group">
								<label>bulan</label>
									<div class="input-group">
										<div class="input-group-addon">
											5
										</div>
										<select name="bulan" class="form-control" required>
											
											<?php
												echo "<option value='$mhs[id_bulan_spp]'>$mhs[nama_bulan]</option>";
											$sql = $konek->query("select * from bulan order by id_bulan_spp");
											while ($data = $sql->fetch_assoc()) {
												echo "<option value='$data[id_bulan_spp]'>$data[nama_bulan]</option>";
											}
											?>
										</select>
									</div>
								</div>

								<div class="form-group">
								<label>jumlah tagihan</label>
									<div class="input-group">
										<div class="input-group-addon">
											6
										</div>
										<input name="total_tagihan" type="text" class="form-control" value="150000" readonly/>
									</div>
								</div>
								<div class="form-group">
									<label>nomor rekening</label>
									<div class="input-group">
										<div class="input-group-addon">
											7
										</div>
										<input name="no_rekening" type="text" class="form-control" value="080 481 737 6" readonly />
									</div>
								</div>
                                <div class="form-group">
								<label>catatan</label>
								
									<div class="input-group">
										<div class="input-group-addon">
											8
										</div>
										<select name="catatan" class="form-control" required>
											<option value="">pilih Kelas</option>
											<option value="lunas">lunas</option>
											<option value="belum lunas">belum lunas</option>
										</select>
									</div>
								</div>
								<!-- <div class="form-group">
								<label>bukti tf</label>
									<div class="input-group">
										<div class="input-group-addon">
											<i class="fa fa-book"></i>
										</div>
										<input name="bukti_pembayaran" type="file" class="form-control" placeholder="pembahasan"/>
									</div>
								</div> -->

	  
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