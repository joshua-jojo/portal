<?php

include "../koneksi.php";
$nilai			= $_POST["nilai"];
$id				    = $_POST["id_nilai"];

if($tipe == 0 ){
    if ($edit = mysqli_query($konek, "UPDATE nilai SET uts_siswa = '$nilai' WHERE id_nilai='$id'")) {
        header("Location: ujian.php");
        exit();
    }
}else{
    if ($edit = mysqli_query($konek, "UPDATE nilai SET uas_siswa = '$nilai' WHERE id_nilai='$id'")) {
        header("Location: ujian.php");
        exit();
    }
}

die("Terdapat Kesalahan : " . mysqli_error($konek));
