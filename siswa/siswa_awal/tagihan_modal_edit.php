<?php

include "../koneksi.php";

$id	= $_GET["id_tagihan"];

$querymhs = mysqli_query($konek, "select id_tagihan ,no_rekening, id_kelas, id_siswa, Nama_siswa,id_bulan_spp, DATE_FORMAT(tanggal, '%d-%m-%Y')as tanggal, nama_kelas,nama_bulan,catatan,total_tagihan from tagihan inner join bulan on tagihan.id_bulan  = bulan.id_bulan_spp inner join kelas on tagihan.kode_kelas = kelas.id_kelas inner join siswa on tagihan.id_siswa = siswa.NIS WHERE id_tagihan='$id'");
if($querymhs == false){
	die ("Terjadi Kesalahan : ". mysqli_error($konek));
}
while($mhs = mysqli_fetch_array($querymhs)){

?>

<style>
	.hidden{
		display: none;
	}
</style>
	
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
						<h4 class="modal-title">upload bukti pembayaran</h4>
					</div>
					<div class="modal-body">
						<form action="tagihan_edit.php" name="modal_popup" enctype="multipart/form-data" method="post">
                        <div class="hidden form-group">
								<label>id</label>
									<div class="input-group">
										<div class="input-group-addon">
											1
										</div>
										<input name="id" type="text" class="form-control" placeholder="id" value="<?php echo $mhs['id_tagihan']?>" readonly/>
									</div>
							</div>
							<div class="form-group">
								<label>siswa</label>
									<div class="input-group">
										<div class="input-group-addon">
											2
										</div>
										<input name="siswa" type="text" class="form-control" placeholder="Nama siswa" value="<?php echo $mhs['id_siswa']?>" readonly style="display: none;"/>
										<input type="text" class="form-control" placeholder="Nama siswa" value="<?php echo $mhs['Nama_siswa']?>" readonly/>
									</div>
							</div>
							
								<div class="form-group">
								<label>Kelas</label>
									<div class="input-group">
										<div class="input-group-addon">
										3
										</div>
										<select name="kelas" class="form-control" readonly>
											<option value="">pilih Kelas</option>
											<?php
												echo "<option value='$mhs[id_kelas]' selected>$mhs[nama_kelas]</option>";
											?>
										</select>
									</div>
								</div>
                                <div class="form-group">
								<label>tagihan bulan</label>
									<div class="input-group">
										<div class="input-group-addon">
											4
										</div>
										<select name="bulan" class="form-control" readonly>
											
											<?php
												echo "<option value='$mhs[id_bulan_spp]' selected>$mhs[nama_bulan]</option>";
											?>
										</select>
									</div>
								</div>

                                <div class="form-group">
								<label>total tagihan</label>
									<div class="input-group">
										<div class="input-group-addon">
											5
										</div>
										<input name="total_tagihan" type="text" class="form-control" value="<?php echo $mhs['total_tagihan']?>" readonly/>
									</div>
							    </div>
								<div class="form-group">
								<label>nomor rekening</label>
									<div class="input-group">
										<div class="input-group-addon">
										6
										</div>
										<input name="total_tagihan" type="text" class="form-control" value="<?php echo $mhs['no_rekening']?>" readonly/>
									</div>
							    </div>

                                <div class="form-group">
								<label>catatan</label>
									<div class="input-group" readonly>
										<div class="input-group-addon">
											7
										</div>
										<select name="catatan" class="form-control" readonly>
											<?php
                                                echo "<option value='$mhs[catatan]' selected>$mhs[catatan]</option>"
                                            ?>
										</select>
									</div>
								</div>

                                <div class="form-group">
								<label>bukti tf</label>
									<div class="input-group">
										<div class="input-group-addon">
										8
										</div>
										<input name="bukti_pembayaran" type="file" class="form-control" placeholder="pembahasan"/>
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