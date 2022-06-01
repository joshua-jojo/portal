<?php

include "../koneksi.php";


$id	= $_POST["id"];
$judul	= $_POST["judul"];
$keterangan	= $_POST["keterangan"];
$tanggal = $_POST["tanggal"];
$lampiran	= $_FILES['lampiran']['name'];

$file_tmp = $_FILES['lampiran']['tmp_name'];

date_default_timezone_set("Asia/Jakarta");
$lampiran = "lampiran_".date('Ymd_His_').$lampiran;

move_uploaded_file($file_tmp, '../lampiran_pengumuman/' . $lampiran);
if ($edit = mysqli_query($konek, "UPDATE pengumuman SET judul = '$judul', deskripsi = '$keterangan', tanggal_pembuatan = '$tanggal', lampiran = '$lampiran' WHERE id_pengumuman = '$id'")) {
	header("Location: pengumuman.php");
	exit();
}
die("Terdapat Kesalahan : " . mysqli_error($konek));
