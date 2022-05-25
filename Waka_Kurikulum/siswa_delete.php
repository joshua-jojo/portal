<?php

include "../koneksi.php";

$NIS = $_GET["NIS"];


$delete = mysqli_query ($konek, "DELETE FROM nilai WHERE id_siswa='$NIS'");
// $delete = mysqli_query ($konek, "DELETE FROM tagihan WHERE id_siswa='$NIS'");
$delete = mysqli_query ($konek, "DELETE FROM siswa WHERE nis='$NIS'");


if($delete){
	header("Location: siswa.php");
	exit();
}
die ("Terdapat Kesalahan : ".mysqli_error($konek));



?>