<?php
session_start();
include "../koneksi.php";
include "auth_user.php";

$id				    = $_POST["id_jadwal"];
$tipe          		= $_POST['tipe'];
$ujian			    = $_FILES['ujian']['name'];
$file_tmp 			= $_FILES['ujian']['tmp_name'];
$querymhs = mysqli_query($konek, "SELECT uts, uas FROM jadwal WHERE id_jadwal=$id");
if ($querymhs == false) {
    die("Terjadi Kesalahan : " . mysqli_error($konek));
}
$jadwal = mysqli_fetch_array($querymhs);
    if($tipe == 0 ){
        if ($add = mysqli_query($konek, "UPDATE jadwal SET uts='$ujian' WHERE id_jadwal = $id")) {
            unlink('../ujian/' .$jadwal['uts']);
            move_uploaded_file($file_tmp, '../ujian/' . $ujian);
            header("Location: ujian.php");
            exit();
        }
    }else{
        if ($add = mysqli_query($konek, "UPDATE jadwal SET uas='$ujian' WHERE id_jadwal = $id")) {
            unlink('../ujian/' .$jadwal['uas']);
            move_uploaded_file($file_tmp, '../ujian/' . $ujian);
            header("Location: ujian.php");
            exit();
        }
    }
	
	die("Terdapat kesalahan : " . mysqli_error($konek));

?>