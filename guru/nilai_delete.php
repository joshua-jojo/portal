<?php

include "../koneksi.php";

$Id_Nilai	= $_GET["kode_nilai"];

if($delete = mysqli_query($konek, "DELETE FROM nilai_siswa WHERE kode_nilai='$Id_Nilai'")){
	header("Location: nilai.php");
	exit();
}
die("Terdapat Kesalahan : ".mysqli_error($konek));

?>