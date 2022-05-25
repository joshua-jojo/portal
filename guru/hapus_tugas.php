<?php

include "../koneksi.php";

$id = $_GET["id"];
$r = mysqli_query($konek,"SELECT * FROM tugas WHERE id_tugas=$id");
$row = mysqli_fetch_array($r);
if($delete = mysqli_query($konek, "DELETE FROM tugas WHERE id_tugas='$id'")){
	header("Location: tugas.php");
	exit();
}
die ("Terdapat Kesalahan : ".mysqli_error($konek));

?>