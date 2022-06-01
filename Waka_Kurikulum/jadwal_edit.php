<?php

include "../koneksi.php";

$id						= $_POST["id"];
$pelajaran				= $_POST["pelajaran"];
$kelas					= $_POST["kelas"];
$guru					= $_POST["guru"];
$hari					= $_POST["hari"];
$jam					= $_POST["jam"];
$materijadwal  			= $_FILES['berkas']['name'];
$file_tmp			= $_FILES['berkas']['tmp_name'];
$link = $_POST['linkvidcon'];

date_default_timezone_set("Asia/Jakarta");
$materijadwal = "pelajaran_".$kelas."_".$guru."_".date('Ymd_His_').$materijadwal;

if (!empty($file_tmp)) {
	move_uploaded_file($file_tmp, '../jadwal/' . $materijadwal);
	if ($edit = mysqli_query($konek, "UPDATE jadwal SET id_pelajaran='$pelajaran', id_kelas='$kelas', id_guru='$guru',
	jam='$jam', no_hari='$hari', link_vidcon='$link', materijadwal='$materijadwal' WHERE id_jadwal='$id'")) {
		header("Location: jadwal.php");
		exit();
	}
	die("Terdapat Kesalahan : " . mysqli_error($konek));
} else {
	if ($edit = mysqli_query($konek, "UPDATE jadwal SET id_pelajaran='$pelajaran', id_kelas='$kelas', id_guru='$guru',
	jam='$jam', no_hari='$hari', link_vidcon='$link' WHERE id_jadwal='$id'")) {
		header("Location: jadwal.php");
		exit();
	}
	die("Terdapat Kesalahan : " . mysqli_error($konek));
}
