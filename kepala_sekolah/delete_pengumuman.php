<?php

include "../koneksi.php";

$Id_Jadwal	= $_GET["kode_pengumuman"];

if($delete = mysqli_query($konek, "DELETE FROM pengumuman WHERE id_pengumuman='$Id_Jadwal'")){
	header("Location: pengumuman.php");
	exit();
}
die ("Terdapat Kesalahan : ". mysqli_error($konek));

?>