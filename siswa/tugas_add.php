<?php
session_start();
include "../koneksi.php";
include "auth_user.php";

$id				    = $_POST["id"];
$nama       		= $_POST['nama_siswa'];
$jawaban			= $_FILES['jawaban']['name'];
$tanggal			= $_POST['tanggal_upload'];
$kode				= $_POST['kode'];
$kelas				= $_POST['kelas'];

$file_tmp 			= $_FILES['jawaban']['tmp_name'];

date_default_timezone_set("Asia/Jakarta");
$jawaban = "tugas_"."_".$_SESSION["Id_User"]."_".$id."_".$kelas."_".date('Ymd_His_').$jawaban;

move_uploaded_file($file_tmp, '../jawaban_tugas/' . $jawaban);
if ($_SESSION['Username'] !== $nama) {
?>
	<script>
		alert('tolong masukan nama yang benar!');
		window.location.href = "jadwal.php";
	</script>
<?php
} else {

	if ($add = mysqli_query($konek, "INSERT INTO jawaban_tugas (id_tugas, nama_siswa, file_jawaban, tanggal_unggahan, id_siswa, nilai) VALUES 
	('$id', '$nama', '$jawaban' ,'$tanggal', '$_SESSION[Id_User]', '0')")) {
		header('Location: ' . $_SERVER['HTTP_REFERER']);
		exit();
	}
	die("Terdapat kesalahan : " . mysqli_error($konek));
}



?>