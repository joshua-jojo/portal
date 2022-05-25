<?php

include "../koneksi.php";

$id				= $_POST["id"];
$siswa			= $_POST["siswa"];
$pelajaran		= $_POST["pelajaran"];
$tugas			= $_POST["tugas"];
// $uts			= $_POST["uts"];
// $uas			= $_POST["uas"];


// if ($edit = mysqli_query($konek, "UPDATE nilai SET id_pelajaran='$pelajaran', id_siswa='$siswa', tugas_siswa = '$tugas', uts_siswa = '$uts', uas_siswa = '$uas' WHERE id_nilai='$id'")) {
// 	header("Location: nilai.php");
// 	exit();
// }
if ($edit = mysqli_query($konek, "UPDATE nilai SET tugas_siswa = '$tugas' WHERE id_nilai='$id'")) {
	header("Location: nilai.php");
	exit();
}
die("Terdapat Kesalahan : " . mysqli_error($konek));
