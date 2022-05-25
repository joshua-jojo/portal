<?php

include "../koneksi.php";

$kelas    = $_GET["id_kelas"];





$delete = mysqli_query($konek, "DELETE FROM absensi WHERE id_absensi='$kelas'");
header("Location: absensi.php?pelajaran=$_GET[pelajaran]");
exit();
