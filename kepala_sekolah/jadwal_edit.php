<?php

include "../koneksi.php";

$id						= $_POST["id"];
$materijadwal  			= $_FILES['berkas']['name'];
$file_tmp			= $_FILES['berkas']['tmp_name'];
if (!empty($file_tmp)) {
	move_uploaded_file($file_tmp, '../jadwal/' . $materijadwal);
	if ($edit = mysqli_query($konek, "UPDATE jadwal SET materijadwal='$materijadwal' WHERE id_jadwal='$id'")) {
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
