<?php
session_start();
include "../koneksi.php";
include "auth_user.php";

$id				    = $_POST["id"];
$nama       		= $_POST['nama_siswa'];
$jawaban			= $_FILES['jawaban']['name'];
$tanggal			= $_POST['tanggal_upload'];

$file_tmp 			= $_FILES['jawaban']['tmp_name'];

move_uploaded_file($file_tmp, '../jawaban_tugas/' . $jawaban);
if ($_SESSION['Username'] !== $nama) {
?>
	<script>
		alert('tolong masukan nama yang benar!');
		window.location.href = "jadwal.php";
	</script>
<?php
} else {

	if ($add = mysqli_query($konek, "INSERT INTO jawaban_tugas (id_tugas, nama_siswa, file_jawaban, tanggal_unggahan) VALUES 
	('$id', '$nama', '$jawaban' ,'$tanggal ')")) {
		header("Location: jadwal.php");
		exit();
	}
	die("Terdapat kesalahan : " . mysqli_error($konek));
}



?>