<?php

include "../koneksi.php";

$id = $_GET["id"];

if($delete = mysqli_query($konek, "DELETE FROM presensi WHERE id_presensi='$id'")){
	header("Location: absensi.php");
	exit();
}
die ("Terdapat Kesalahan : ".mysqli_error($konek));

?>