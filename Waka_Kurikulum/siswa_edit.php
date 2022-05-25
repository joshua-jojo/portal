<?php

include "../koneksi.php";

$NIS			= $_POST["NIS"];
$Nama_siswa			= $_POST["Nama_siswa"];
$Tanggal_Lahir		= $_POST["Tanggal_lahir"];
$JK					= $_POST["gender"];
$No_Telp			= $_POST["No_Telp"];
$Alamat				= $_POST["Alamat"];
$Agama				= $_POST["agama"];
$kelas				= $_POST['kelas'];

$pecahk = explode('.', $kelas);
$pecahkelas1 = $pecahk[0];
$pecahkelas2 = $pecahk[1];

if ($edit = mysqli_query($konek, "UPDATE siswa SET nama_siswa = '$Nama_siswa', tanggal_lahir = '$Tanggal_Lahir', gender='$JK', 
	no_hp ='$No_Telp', alamat = '$Alamat', agama = '$Agama' , kelas = '$pecahkelas1', nama_kelas='$pecahkelas2' WHERE NIS='$NIS'") && mysqli_query($konek, "UPDATE users SET username = '$Nama_siswa' where id_users = '$NIS'")) {
	header("Location: siswa.php");
	exit();
}
die("Terdapat Kesalahan : " . mysqli_error($konek));
