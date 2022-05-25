<?php

include "../koneksi.php";

$kode_nilai	= $_GET["kode_nilai"];

if ($delete = mysqli_query($konek, "DELETE FROM nilai WHERE id_nilai='$kode_nilai'")) {
	header("Location: nilai.php");
	exit();
}
die("Terdapat Kesalahan : " . mysqli_error($konek));
