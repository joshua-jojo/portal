<?php
include "../koneksi.php";

$kode_guru 			= $_POST["NIP"];
$Nama_guru 		= $_POST["Nama_guru"];
$Tanggal_Lahir 	= $_POST["Tanggal_Lahir"];
$JK 			= $_POST["JK"];
$Alamat 		= $_POST["Alamat"];
$No_Telp 		= $_POST["No_Telp"];


$query = mysqli_query($konek, "SELECT * from guru where id_guru='$kode_guru'");

$test = mysqli_num_rows($query);

if ($test > 0) {
?>

	<script>
		alert("guru sudah terdaftar , periksa kode guru yang anda masukan!");
		window.location.href = "guru.php";
	</script>

<?php

} else {
	if ($add = mysqli_query($konek, "INSERT INTO guru (id_guru, nama_guru, tanggal_lahir, gender, alamat, no_hp) VALUES 
	('$kode_guru', '$Nama_guru', '$Tanggal_Lahir', '$JK', '$Alamat', '$No_Telp')")) {
		header("Location: guru.php");
		exit();
	}
	die("Terdapat kesalahan : " . mysqli_error($konek));
}

?>