<?php

include "../koneksi.php";

$id = $_GET["kode_tugas"];

$delete = mysqli_query($konek, "DELETE FROM jawaban_tugas WHERE id_jawaban='$id'");

if($delete){
	header("Location: jadwal.php");
	exit();
}
die ("Terdapat Kesalahan : ".mysqli_error($konek));

?>