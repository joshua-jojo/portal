<?php

include "../koneksi.php";

$id = $_GET["id"];

if($delete = mysqli_query($konek, "DELETE FROM tagihan WHERE id_tagihan='$id'")){
	header("Location: tagihan_spp.php");
	exit();
}
die ("Terdapat Kesalahan : ".mysqli_error($konek));

?>