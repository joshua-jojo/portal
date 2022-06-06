<?php
session_start();
include "../koneksi.php";
include "auth_user.php";

$id                    = $_POST["id_ujian"];
$ujian                  = $_FILES['ujian']['name'];
$file_tmp               = $_FILES['ujian']['tmp_name'];
$id_user                 = $_SESSION["Id_User"];
$nama_user             = $_SESSION["Username"];
$tipe = "";
$nama_pelajaran = "";
$query = mysqli_query($konek, "SELECT * FROM `ujian` WHERE id_ujian = '$id'");
while ($ujian_data = mysqli_fetch_array($query)) :
    $tipe = $ujian_data['tipeujian'];
endwhile;
$query = mysqli_query($konek, "SELECT * FROM `ujian` INNER JOIN pelajaran ON ujian.id_pelajaran = pelajaran.id_pelajaran WHERE ujian.id_ujian = '$id'");
while ($ujian_data = mysqli_fetch_array($query)) :
    $nama_pelajaran = $ujian_data['nama_pelajaran'];
endwhile;
date_default_timezone_set("Asia/Jakarta");
$ujian = "jawaban_" . $tipe . "_" . "_" . $id . "_" . $nama_user . "_".$nama_pelajaran."_" . date('Ymd_His_') . $ujian;
$querymhs = mysqli_query($konek, "SELECT * FROM ujian_murid WHERE id_ujianjawaban='$id' AND id_murid='$id_user'");

if ($querymhs == false) {
    die("Terjadi Kesalahan : " . mysqli_error($konek));
}
$jadwal = mysqli_fetch_array($querymhs);
if ($jadwal == null) {
    if ($add = mysqli_query($konek, "INSERT INTO ujian_murid (id_murid,id_ujianjawaban,jawaban) VALUES ('$id_user','$id','$ujian')")) {
        move_uploaded_file($file_tmp, '../ujian_murid/' . $ujian);
        header("Location: ujian.php");
        exit();
    }
} else {
    if ($add = mysqli_query($konek, "UPDATE ujian_murid SET jawaban='$ujian' WHERE id_ujianjawaban = '$id' and id_murid = '$id_user'")) {
        unlink('../ujian_murid/' . $jadwal['soal']);
        move_uploaded_file($file_tmp, '../ujian_murid/' . $ujian);
        header("Location: ujian.php");
        exit();
    }
}

die("Terdapat kesalahan : " . mysqli_error($konek));
