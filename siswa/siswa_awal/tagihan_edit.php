<?php
include "../koneksi.php";

$id					= $_POST["id"];
$nama_siswa			= $_POST["siswa"];
$kode_kelas 		= $_POST["kelas"];
$total_tagihan		= $_POST["total_tagihan"];
$bulan			    = $_POST["bulan"];
$catatan		    = $_POST["catatan"];
$bukti_tf			= $_FILES["bukti_pembayaran"]["name"];
$file_tmp			= $_FILES["bukti_pembayaran"]["tmp_name"];



move_uploaded_file($file_tmp, '../bukti_pembayaran/'.$bukti_tf);



if($edit = mysqli_query($konek, "UPDATE tagihan SET id_siswa='$nama_siswa', id_bulan='$bulan', 
	kode_kelas='$kode_kelas', total_tagihan='$total_tagihan' ,catatan='$catatan', bukti_pembayaran='$bukti_tf' WHERE id_tagihan='$id'")){
		?>
		<script type="text/javascript">
			alert("kamu sudah upload");
			window.location.href='tagihan.php';
		</script>
		<?php
	}
die("Terdapat Kesalahan : ".mysqli_error($konek));


?>