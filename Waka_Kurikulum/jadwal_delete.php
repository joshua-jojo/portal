<?php

include "../koneksi.php";

$Id_Jadwal  = $_GET["Id_Jadwal"];
$kode_pelajaran  = $_GET["id_pelajaran"];





$cek = mysqli_query($konek, "select * from tugas where id_pelajaran = '$kode_pelajaran'");



$total = mysqli_fetch_assoc($cek);

$kode_tugas = $total['kode_tugas'];

$delete = mysqli_query($konek, "DELETE FROM jawaban_tugas WHERE id_tugas='$kode_tugas'");
$delete = mysqli_query($konek, "DELETE FROM tugas WHERE id_pelajaran='$kode_pelajaran'");
$delete = mysqli_query($konek, "DELETE FROM nilai_siswa WHERE id_pelajaran='$kode_pelajaran'");
$delete = mysqli_query($konek, "DELETE FROM jadwal WHERE id_jadwal='$Id_Jadwal'");


header("location: jadwal.php");
