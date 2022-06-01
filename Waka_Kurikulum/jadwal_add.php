<?php

include "../koneksi.php";


$pelajaran				= $_POST["pelajaran"];
$kelas					= $_POST["kelas"];
$guru					= $_POST["guru"];
$hari					= $_POST["hari"];
$jam					= $_POST["jam"];
$materijadwal  			= $_FILES['berkas']['name'];
$file_tmp			= $_FILES['berkas']['tmp_name'];

date_default_timezone_set("Asia/Jakarta");
$materijadwal = "pelajaran_".$kelas."_".$guru."_".date('Y_m_d_H_i_s_').$materijadwal;

$link = $_POST['linkvidcon'];
move_uploaded_file($file_tmp, '../jadwal/' . $materijadwal);
if ($add = mysqli_query($konek, "INSERT INTO jadwal(id_pelajaran, id_kelas, id_guru, jam, no_hari, link_vidcon, materijadwal) VALUES ( '$pelajaran', '$kelas', '$guru', '$jam', '$hari','$link','$materijadwal')")) {
	header("Location: jadwal.php");
	exit();
}
die("Terdapat Kesalahan : " . mysqli_error($konek));
