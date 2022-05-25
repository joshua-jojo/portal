<?php
include "../koneksi.php";



$id			= $_POST["id"];
$kelas		= $_POST["kelas"];
$siswa  	= $_POST["siswa"];


$pelajaran  = $_POST["pelajaran"];
$tanggal  	= $_POST["tanggal"];
$status		= $_POST["status"];


$test = mysqli_query($konek, "select * from absensi where nama_siswa = '$siswa' and tanggal = '$tanggal' and id_pelajaran = '$pelajaran'");

if (mysqli_num_rows($test) > 0) {
?>
	<script>
		alert("maaf, ini sudah diabsen tadi..");
		window.location.href = 'tugas.php?kode_pelajaran=<?= $pelajaran ?>&kode_kelas=<?= $kelas ?>';
	</script>
	<?php
	// header("Location: tugas.php?kode_pelajaran=$pelajaran&kode_kelas=$kelas");
	?>
<?php
} else {

	if ($add = mysqli_query($konek, "INSERT INTO absensi (id_absensi, nama_siswa, id_kelas, id_pelajaran, tanggal, status) VALUES 
('$id', '$siswa', '$kelas', '$pelajaran', '$tanggal','$status')")) {
		header("Location: tugas.php?kode_pelajaran=$pelajaran&kode_kelas=$kelas");
		exit();
	}
	die("Terdapat kesalahan : " . mysqli_error($konek));
}

?>