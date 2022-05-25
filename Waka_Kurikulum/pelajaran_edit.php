<?php

include "../koneksi.php";

$kode_pelajaran		= $_POST["kode_pelajaran"];
$nama_pembahasan	= $_POST["nama_pelajaran"];
$Pembahasan			= $_FILES['berkas']['name'];

$file_tmp 			= $_FILES['berkas']['tmp_name'];
if (!empty($file_tmp)) {
	move_uploaded_file($file_tmp, '../materi/' . $Pembahasan);
	// echo $kode_pelajaran;
	// echo $nama_pembahasan;

	if ($edit = mysqli_query($konek, "UPDATE pelajaran SET nama_pelajaran='$nama_pembahasan', materi = '$Pembahasan' WHERE id_pelajaran='$kode_pelajaran'")) {
		header("Location: pelajaran.php");
		exit();
	}
	die("Terdapat Kesalahan : " . mysqli_error($konek));
} else {
	echo "kode pelajaran" . $kode_pelajaran . "<br/>";
	echo "nama pelajaran" . $nama_pembahasan;
	if ($edit = mysqli_query($konek, "UPDATE pelajaran SET nama_pelajaran='$nama_pembahasan' WHERE id_pelajaran='$kode_pelajaran'")) {
		header("Location: pelajaran.php");
		exit();
	}
	die("Terdapat Kesalahan : " . mysqli_error($konek));
}
