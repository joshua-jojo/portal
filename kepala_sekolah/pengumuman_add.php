<?php
include "../koneksi.php";

$judul	= $_POST["judul"];
$keterangan	= $_POST["keterangan"];
$tanggal = $_POST["tanggal"];
$lampiran	= $_FILES['lampiran']['name'];
$file_tmp = $_FILES['lampiran']['tmp_name'];

// $test = mysqli_query($konek, "select * from pelajaran where id_pelajaran='$Kode_Matakuliah'");

// if (mysqli_num_rows($test) > 0) {
?>
<!-- <script>
		alert("maaf, id pengumuman sudah ada..");
		window.location.href = 'pengumuman.php';
	</script> -->
<?php
// } else {
date_default_timezone_set("Asia/Jakarta");
$lampiran = "lampiran_" . date('Ymd_His_') . $lampiran;
move_uploaded_file($file_tmp, '../lampiran_pengumuman/' . $lampiran);
if ($add = mysqli_query($konek, "INSERT INTO pengumuman (judul, deskripsi, tanggal_pembuatan, lampiran) VALUES ('$judul','$keterangan','$tanggal','$lampiran')")) {
	header("Location: pengumuman.php");
	exit();
}
// die("Terdapat Kesalahan : " . mysqli_error($konek));
// }
?>