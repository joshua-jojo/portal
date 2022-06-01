<?php

include "../koneksi.php";

$Kode_Matakuliah	= $_POST["kode_pelajaran"];
$nama_pelajaran		= $_POST["nama_pelajaran"];
$Pembahasan			= $_FILES['berkas']['name'];
$file_tmp 			= $_FILES['berkas']['tmp_name'];

$test = mysqli_query($konek, "SELECT * from pelajaran where id_pelajaran='$Kode_Matakuliah'");

date_default_timezone_set("Asia/Jakarta");
$Pembahasan = "pelajaran_".date('Y_m_d_H_i_s_').$Pembahasan;

if (mysqli_num_rows($test) > 0) {
?>
	<script>
		alert("maaf, pelajaran ini sudah ada..");
		window.location.href = 'pelajaran.php';
	</script>
<?php
} else {
	move_uploaded_file($file_tmp, '../materi/' . $Pembahasan);
	if ($add = mysqli_query($konek, "INSERT INTO pelajaran (id_pelajaran, nama_pelajaran, materi) VALUES ('$Kode_Matakuliah', '$nama_pelajaran', '$Pembahasan')")) {
		header("Location: pelajaran.php");
		exit();
	}
	die("Terdapat Kesalahan : " . mysqli_error($konek));
}

?>