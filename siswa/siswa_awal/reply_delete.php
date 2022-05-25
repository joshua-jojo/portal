<?php

include "../koneksi.php";

$id = $_GET["komentar_id"];

$id_pelajaran	= $_GET['kode_pelajaran'];
$kelas	= $_GET['kode_kelas']; 


if($delete = mysqli_query($konek, "DELETE FROM tbl_komentar WHERE komentar_id='$id'")){
	header("Location: forum.php?kode_kelas=$kelas&kode_pelajaran=$id_pelajaran");
	exit();
}
die ("Terdapat Kesalahan : ".mysqli_error($konek));

?>