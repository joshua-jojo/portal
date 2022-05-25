<?php
include "../koneksi.php";



$id			= $_POST["id"];
$kelas		= $_POST["kelas"];
$siswa  	= $_POST["siswa"];


$pelajaran  = $_POST["pelajaran"];
$tanggal  	= $_POST["tanggal"];
$status		= $_POST["status"];

$test = mysqli_query($konek, "select * from absensi where nama_siswa = '$siswa' and tanggal = '$tanggal' and id_pelajaran='$pelajaran'");

if (mysqli_num_rows($test) > 0) {
?>
	<script>
		alert("maaf, ini sudah diabsen tadi..");
		window.location.href = 'absensi.php';
	</script>
<?php
} else {

	if ($add = mysqli_query($konek, "INSERT INTO absensi (id_absensi, nama_siswa, id_kelas, id_pelajaran, tanggal, status ) VALUES 
('$id', '$siswa', '$kelas', '$pelajaran', '$tanggal','$status')")) {
		header("Location: absensi.php");
		exit();
	}
	die("Terdapat kesalahan : " . mysqli_error($konek));
}

?>