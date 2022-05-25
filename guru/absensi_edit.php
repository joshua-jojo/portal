<?php

include "../koneksi.php";


$id			= $_POST["id"];
$kelas		= $_POST["kelas"];
$siswa  	= $_POST["siswa"];


$pelajaran  = $_POST["pelajaran"];
$tanggal  	= $_POST["tanggal"];
$status		= $_POST["status"];

if ($edit = mysqli_query($konek, "UPDATE absensi SET  nama_siswa = '$siswa', id_kelas = '$kelas', id_pelajaran = '$pelajaran', tanggal = '$tanggal', status = '$status' WHERE id_absensi = '$id'")) {
	header("Location: absensi.php?pelajaran=$_POST[pelajaran]");
	exit();
}
die("Terdapat Kesalahan : " . mysqli_error($konek));
