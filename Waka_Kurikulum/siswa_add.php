<?php
include "../koneksi.php";

$NIS				= $_POST["NIS"];
$Nama_siswa		= $_POST["Nama_siswa"];
$Tanggal_Lahir 		= $_POST["tanggal_lahir"];
$JK 				= $_POST["JK"];
$Alamat 			= $_POST["Alamat"];
$No_Telp 			= $_POST["No_Telp"];
$agama			 	= $_POST["agama"];
$kelas				= $_POST['kelas'];

$user_group = 3;
$user2 = 0;

$pecahkls = explode('.', $kelas);
$kelas1 = $pecahkls[0];
$kelas2 = $pecahkls[1];



$query = mysqli_query($konek, "select * from siswa where NIS='$NIS'");

$test = mysqli_num_rows($query);

if ($test > 0) {
?>

	<script>
		alert("siswa sudah terdaftar , periksa NIS yang anda masukan!");
		window.location.href = "siswa.php";
	</script>

<?php

} else {

	if ($add = mysqli_query($konek, "INSERT INTO siswa (NIS, nama_siswa, tanggal_lahir, gender, alamat, no_hp, agama, kelas, nama_kelas) VALUES 
('$NIS', '$Nama_siswa', '$Tanggal_Lahir', '$JK', '$Alamat', '$No_Telp', '$agama', '$kelas1','$kelas2')")) {
		header("Location: siswa.php");
		exit();
	}
	die("Terdapat kesalahan : " . mysqli_error($konek));
}

?>