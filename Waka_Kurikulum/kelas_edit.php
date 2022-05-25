<?php
include "../koneksi.php";

$Kode_Ruangan	= $_POST["id_kelas"];
$Nama_Ruangan	= $_POST["nama_kelas"];

if ($edit = mysqli_query($konek, "UPDATE kelas SET nama_kelas='$Nama_Ruangan' WHERE id_kelas='$Kode_Ruangan'")){
	header("Location: kelas.php");
	exit();
}
die ("Terdapat Kesalahan : ". mysqli_error($konek));

?>