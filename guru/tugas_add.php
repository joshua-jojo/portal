<?php
include "../koneksi.php";

$id				    = $_POST["id"];
$kelas  		    = $_POST["kelas"];
$guru        		= $_POST["guru"];
$pelajaran 			= $_POST["pelajaran"];
$tugas  			= $_FILES['tugas']['name'];
$batas_akhir 		= $_POST["tanggal"];
$file_tmp 			= $_FILES['tugas']['tmp_name'];
date_default_timezone_set("Asia/Jakarta");
$tugas = "tugas_"."_".$id."_".date('Ymd_His_').$tugas;

$CEK = mysqli_query($konek, "select * from tugas where id_pelajaran = '$pelajaran' and id_kelas='$kelas'");

move_uploaded_file($file_tmp, '../file/' . $tugas);
if ($add = mysqli_query($konek, "INSERT INTO tugas (id_tugas, id_kelas, id_guru, id_pelajaran, file_tugas, tanggal) VALUES 
	('$id', '$kelas', '$guru', '$pelajaran', '$tugas', '$batas_akhir')")) {
	header("Location: tugas.php?kode_pelajaran=$pelajaran&kode_kelas=$kelas");
	exit();
}
die("Terdapat kesalahan : " . mysqli_error($konek));
