<?php
include "../koneksi.php";

$id					= $_POST["id"];
$nama_siswa			= $_POST["siswa"];
$kode_kelas 		= $_POST["kelas"];
$tanggal			= $_POST["tanggal"];
$total				= $_POST["total_tagihan"];
$no_rekening		= $_POST["no_rekening"];
$bulan			    = $_POST["bulan"];
$catatan		    = $_POST["catatan"];
$bukti_tf			= $_FILES["bukti_pembayaran"]["name"];


if ($add = mysqli_query($konek, "INSERT INTO tagihan (id_tagihan,id_siswa,kode_kelas,tanggal,total_tagihan,no_rekening,id_bulan,catatan,bukti_pembayaran) VALUES 
	('$id','$nama_siswa','$kode_kelas','$tanggal','$total','$no_rekening','$bulan','$catatan','$bukti_tf')")){
		header("Location: tagihan_spp.php");
		exit();
	}
die ("Terdapat kesalahan : ". mysqli_error($konek));

?>