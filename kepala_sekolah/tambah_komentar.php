<?php
session_start();
include '../koneksi.php';

function anti($text)
{
	return $id = stripslashes(strip_tags(htmlspecialchars($text, ENT_QUOTES)));
}
$nama_pengirim = anti($_POST["nama_pengirim"]);
$komen = anti($_POST["komen"]);
$komen_id = anti($_POST["komentar_id"]);
$pelajaran = $_POST['pelajaran'];
$kelas = $_POST['kelas'];
$status = $_POST['status'];

$query = "INSERT INTO forum (id_comment_parent, comment, nama_user, status, id_pelajaran, id_kelas) VALUES (?, ?, ?, ?, ?, ?)";
$dewan1 = $konek->prepare($query);
$dewan1->bind_param("ssssss", $komen_id, $komen, $nama_pengirim, $status, $pelajaran, $kelas);
$dewan1->execute();

echo json_encode(['success' => 'Sukses']);
