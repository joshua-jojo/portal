<?php
include "../koneksi.php";

$NIP 			= $_POST["NIP"];
$Nama_guru 	= $_POST["Nama_guru"];
$Tanggal_Lahir 	= $_POST["Tanggal_Lahir"];
$JK 			= $_POST["gender"];
$Alamat 		= $_POST["Alamat"];
$No_Telp 		= $_POST["No_Telp"];

if ($edit = mysqli_query($konek, "UPDATE guru SET nama_guru='$Nama_guru', tanggal_lahir='$Tanggal_Lahir', gender='$JK', 
	alamat='$Alamat', no_hp ='$No_Telp' WHERE id_guru='$NIP'") && mysqli_query($konek, "UPDATE users set username='$Nama_guru' where id_users ='$NIP'")) {
	header("Location: guru.php");
	exit();
}
die("Terdapat kesalahan : " . mysqli_error($konek));
