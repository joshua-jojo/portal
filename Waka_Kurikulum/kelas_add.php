<?php
include "../koneksi.php";

$Kode_Ruangan	= $_POST["id_kelas"];
$Nama_Ruangan	= $_POST["Nama_Kelas"];



$test = mysqli_query($konek,"select * from kelas where id_kelas='$Kode_Ruangan'");

if(mysqli_num_rows($test) > 0){
	?>
	<script>
		alert("maaf, kelas ini sudah ada..");
		window.location.href ='kelas.php';
	</script>
<?php
}else{
if($add = mysqli_query($konek, "INSERT INTO kelas (id_kelas, nama_kelas) VALUES ('$Kode_Ruangan', '$Nama_Ruangan')")){
	header("Location: kelas.php");
	exit();
}
die ("Terdapat Kesalahan : ". mysqli_error($konek));
}
?>