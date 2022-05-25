<?php

include "../koneksi.php";

$kelas	= $_GET["id_kelas"];



$cek = mysqli_query($konek, "select * from siswa where kelas = '$kelas'");



$total = mysqli_num_rows($cek);


if ($total > 0) {
?>

	<script type="text/javascript">
		alert("tidak dapat menghapus kelas , masih ada siswa terdaftar di kelas tersebut!");
		window.location.href = "kelas.php";
	</script>
<?php
} else {

	$delete = mysqli_query($konek, "DELETE FROM jadwal WHERE id_kelas='$kelas'");

	$delete = mysqli_query($konek, "DELETE FROM absensi WHERE id_kelas='$kelas'");
	$delete = mysqli_query($konek, "DELETE FROM kelas WHERE id_kelas='$kelas'");

?>

	<script type="text/javascript">
		alert("data kelas berhasil dihapus");
		window.location.href = "kelas.php";
	</script>
<?php
}

?>