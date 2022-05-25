<?php

include "../koneksi.php";

$id_pelajaran	= $_GET["id_pelajaran"];


$cek = mysqli_query($konek,"select * from tugas where id_pelajaran = '$id_pelajaran'");



$total = mysqli_fetch_assoc($cek);

if($total > 0){
	$kode_tugas = $total['kode_tugas'];


	$delete = mysqli_query ($konek, "DELETE FROM jawaban_tugas WHERE kode_tugas='$kode_tugas'");
	$delete = mysqli_query ($konek, "DELETE FROM tugas WHERE kode_tugas ='$kode_tugas'");
	$delete = mysqli_query ($konek, "DELETE FROM jadwal WHERE id_pelajaran='$id_pelajaran'");
	$delete = mysqli_query ($konek, "DELETE FROM absensi WHERE id_pelajaran='$id_pelajaran'");
	$delete = mysqli_query ($konek, "DELETE FROM tbl_komentar WHERE id_pelajaran='$id_pelajaran'");
	$delete = mysqli_query ($konek, "DELETE FROM nilai_siswa WHERE id_pelajaran='$id_pelajaran'");
	$delete = mysqli_query ($konek, "DELETE FROM forum WHERE id_pelajaran='$id_pelajaran'");
	$delete = mysqli_query ($konek, "DELETE FROM pelajaran WHERE id_pelajaran='$id_pelajaran'");
}else{
	

$delete = mysqli_query ($konek, "DELETE FROM jadwal WHERE id_pelajaran='$id_pelajaran'");
$delete = mysqli_query ($konek, "DELETE FROM absensi WHERE id_pelajaran='$id_pelajaran'");
// $delete = mysqli_query ($konek, "DELETE FROM tbl_komentar WHERE id_pelajaran='$id_pelajaran'");
$delete = mysqli_query ($konek, "DELETE FROM nilai WHERE id_pelajaran='$id_pelajaran'");
$delete = mysqli_query ($konek, "DELETE FROM forum WHERE id_pelajaran='$id_pelajaran'");
$delete = mysqli_query ($konek, "DELETE FROM pelajaran WHERE id_pelajaran='$id_pelajaran'");
}


header("location: pelajaran.php");


 echo "$id_pelajaran";

?>