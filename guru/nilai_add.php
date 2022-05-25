<?php

include "../koneksi.php";

$id				= $_POST["id"];
$siswa			= $_POST["siswa"];
$pelajaran		= $_POST["pelajaran"];
$tugas			= $_POST["tugas"];
$uts			= $_POST["uts"];
$uas			= $_POST["uas"];



$cek = mysqli_query($konek, "select * from nilai where id_siswa='$siswa'");

$total = mysqli_fetch_assoc($cek);


if ($total['id_siswa'] === $siswa && $total['id_pelajaran'] === $pelajaran) {
?>
	<script type="text/javascript">
		alert("nilai sudah terisi!");
		window.location.href = "nilai.php";
	</script>
<?php
} else {
	$add = mysqli_query($konek, "INSERT INTO nilai (id_nilai, id_pelajaran, id_siswa, tugas_siswa, uts_siswa, uas_siswa) VALUES ('$id', '$pelajaran', '$siswa','$tugas','$uts','$uas')");
	header("Location: nilai.php");
	exit();
}


?>