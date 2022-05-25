<?php

include "../koneksi.php";

$kode_pengumuman	= $_GET["id_pengumuman"];


$querymatakuliah = mysqli_query($konek, "SELECT judul,keterangan, DATE_FORMAT(tanggal, '%d-%m-%Y')as tanggal, lampiran FROM pengumuman WHERE id_pengumuman ='$kode_pengumuman'");
if($querymatakuliah == false){
	die ("Terjadi Kesalahan : ". mysqli_error($konek));
}
while($pengumuman = mysqli_fetch_array($querymatakuliah)){

?>
	
	<script src="../aset/plugins/daterangepicker/moment.min.js"></script>
	<script src="../aset/plugins/daterangepicker/daterangepicker.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Architects+Daughter&display=swap" rel="stylesheet"> 
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
    <style>
        #tabel{
           font-family: monospace; 
           text-align: justify;
        }
        .header-pengumuman{
            width: 100%;
            display: flex;
            background-color:  #006699;
            color:white;
            font-family: 'Architects Daughter', cursive;
            text-align: center;
        }

       
    </style>
<!-- Modal Popup Dosen -->
			<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
				<div class="modal-content">
						<div class="header-pengumuman">
                            <div>
                                <h3 style="margin-left:10px; font-family: 'Architects Daughter', cursive;">Pengumuman</h3>
                            </div>
                            <div>
                            <button type="button" class="close " data-dismiss="modal" aria-label="Close" style="margin-top: 25px; margin-left:430px;"><span aria-hidden="true"><p style="font-size: 20px; color:red;">X</p></span></button>
                            </div>
                        </div>
					<div class="modal-body">
                        <table id="tabel">
                            <tr>
                                <td>Tanggal</td>
                                <td>&nbsp;  :     &nbsp; <?php echo $pengumuman['tanggal']?></td>
                            </tr>
                            <br>
                            <tr>
                                <td>Subjek</td>
                                <td> &nbsp;  :   &nbsp; <?php echo $pengumuman['judul'] ?></td>
                            </tr>
                            <tr>
                                <td><div style="margin-top: -153px;">Pesan &nbsp; &nbsp; &nbsp; &nbsp;</div></td>
                                <td>&nbsp; : &nbsp; <div style="width: 450px; height:300px; border:1px solid #999999; margin-left:49px; margin-top:-15px; padding:10px; background-color:#FFFFEE; overflow:auto;">
                                Dear siswa SMA, <br> <br>
                                <?php echo $pengumuman['keterangan']?> <br> <br> 


                                <?php 
                                
                                    if($pengumuman['lampiran'] === ""){
                                        echo "";
                                    }else{
                                        echo " <a href='unduh_pengumuman.php?file=$pengumuman[lampiran]'><i class='fa fa-paperclip'></i>lampiran</a><br> <br>";
                                    }
                                ?>

                                salam , <br>
                                SMA
                            
                            </div></td>
                            </tr>
                            
                        </table>

                                <!-- <p>pesan : </p> 
                                <textarea name="" id="" cols="60" rows="10" disabled><?php echo $pengumuman['keterangan'] ?></textarea> -->
					</div>
				</div>
			</div>
			
			
<?php
			}

?>

