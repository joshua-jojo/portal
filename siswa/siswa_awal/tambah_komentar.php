<?php
session_start();
include '../koneksi.php';
 
function anti($text){
	return $id = stripslashes(strip_tags(htmlspecialchars($text, ENT_QUOTES)));
}

$id_kelas = $_POST["id_kelas"];
$id_pelajaran = $_POST["id_pelajaran"];

$nama_pengirim = anti($_POST["nama_pengirim"]);
$komen = anti($_POST["komen"]);
$komen_id = anti($_POST["komentar_id"]);
$pelajaran = $_POST['pelajaran'];
$kelas = $_POST['kelas'];
$status = $_POST['status'];



if ($add = mysqli_query($konek, "INSERT INTO forum (parent_komentar_id, komentar, nama_pengirim, status, id_pelajaran,kode_kelas) VALUES ('$komen_id', '$komen', '$nama_pengirim', '$status', '$pelajaran', '$kelas')")){

	
	header("Location: jadwal.php");
	exit();
}
die ("Terdapat kesalahan : ". mysqli_error($konek));
 
?>


