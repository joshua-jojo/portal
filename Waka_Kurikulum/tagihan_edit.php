<?php
include "../koneksi.php";

$id					= $_POST["id"];
$nama_siswa			= $_POST["siswa"];
$kode_kelas 		= $_POST["kelas"];
$tanggal			= $_POST["tanggal"];
$total_tagihan		= $_POST["total_tagihan"];
$no_rekening		= $_POST["no_rekening"];
$bulan			    = $_POST["bulan"];
$catatan		    = $_POST["catatan"];



if($edit = mysqli_query($konek, "UPDATE tagihan SET id_siswa='$nama_siswa', tanggal='$tanggal', id_bulan='$bulan', 
	kode_kelas='$kode_kelas', total_tagihan='$total_tagihan' , no_rekening='$no_rekening', catatan='$catatan' WHERE id_tagihan='$id'")){
		header("Location: tagihan_spp.php");
		exit();
	}
die("Terdapat Kesalahan : ".mysqli_error($konek));


?>