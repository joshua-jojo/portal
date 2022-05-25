<?php

include "../koneksi.php";

$kode_pengumuman	= $_GET["id_pengumuman"];

$querymatakuliah = mysqli_query($konek, "SELECT * FROM pengumuman WHERE id_pengumuman ='$kode_pengumuman'");
if($querymatakuliah == false){
	die ("Terjadi Kesalahan : ". mysqli_error($konek));
}
while($pengumuman = mysqli_fetch_array($querymatakuliah)){


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
						<h4 class="modal-title">Edit pengumuman</h4>
					</div>
					<div class="modal-body">
						<form action="pengumuman_edit.php" name="modal_popup" enctype="multipart/form-data" method="post">
                        <div class="form-group">
								<label>id</label>
									<div class="input-group">
										<div class="input-group-addon">
											1
										</div>
										<input name="id"type="text" class="form-control" placeholder="Masukan id pengumuman" value="<?= $pengumuman['id_pengumuman'] ?>"/>
									</div>
							</div>
							<div class="form-group">
								<label>judul</label>
									<div class="input-group">
										<div class="input-group-addon">
											2
										</div>
										<input name="judul"type="text" class="form-control" placeholder="Masukan judul pengumuman" value="<?= $pengumuman['judul']?>"/>
									</div>
								</div>

								<div class="form-group">
								<label>Keterangan</label>
									<div class="input-group">
										<div class="input-group-addon">
											3
										</div>
										<textarea rows="5" cols="65" name="keterangan" placeholder="masukan text!" ><?php echo $pengumuman['keterangan'];?></textarea>
									</div>
								</div>

								<div class="form-group">
								<label>tanggal</label>
									<div class="input-group">
										<div class="input-group-addon">
											4
										</div>
										 <input type="date" name="tanggal" class="form-control">
									</div>
								</div>


								<div class="form-group">
								<label>Lampiran</label>
									<div class="input-group">
										<div class="input-group-addon">
											5
										</div>
										<input name="lampiran" type="file" class="form-control"/>
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