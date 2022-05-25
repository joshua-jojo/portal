<?php
include "../koneksi.php";
$kodepelajaran        = $_POST["kodepelajaran"];
$kodekelas            = $_POST["kodekelas"];
$id                    = $_POST["id"];
$tanggal            = $_POST["tanggal"];
$tugas              = $_FILES['tugas']['name'];
$file_tmp            = $_FILES['tugas']['tmp_name'];

if (!empty($file_tmp)) {

    move_uploaded_file($file_tmp, '../file/' . $tugas);
    if ($edit = mysqli_query($konek, "UPDATE tugas SET file_tugas='$tugas', tanggal='$tanggal' WHERE id_tugas='$id'")) {
        header("Location: tugas.php?kode_pelajaran=$kodepelajaran&kode_kelas=$kodekelas");
        exit();
    }
} else {
    if ($edit = mysqli_query($konek, "UPDATE tugas SET tanggal='$tanggal' WHERE id_tugas='$id'")) {
        header("Location: tugas.php?kode_pelajaran=$kodepelajaran&kode_kelas=$kodekelas");
        exit();
    }
}
die("Terdapat Kesalahan : " . mysqli_error($konek));
