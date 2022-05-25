<?php

// $id	= $_GET['kode_pelajaran'];
$nis = $_SESSION["Id_User"];
$kd_pelajaran = $_GET['kode_pelajaran'];
$carikelas = mysqli_query($konek, "select kelas from siswa where nis = $nis");

$hasil = mysqli_fetch_array($carikelas);

$res = $hasil['kelas'];

// $querymatakuliah = mysqli_query ($konek, "select  DATE_FORMAT(tanggal, '%d-%m-%Y')as tanggal,kode_tugas,nama_pelajaran,siswa,nama_kelas,Nama_guru,tugas,siswa,upload_jawaban,tanggal_upload from tugas inner join kelas on tugas.kode_kelas = kelas.id_kelas inner join guru on tugas.kode_guru = guru.NIP inner join pelajaran on tugas.kode_pelajaran = pelajaran.kode_pelajaran where tugas.kode_kelas = '$res' and tugas.kode_pelajaran = '$kd_pelajaran'");
$querymatakuliah = mysqli_query($konek, "select tugas.kode_tugas,kode_kelas,nama_kelas,Nama_guru,nama_pelajaran,tugas,DATE_FORMAT(tanggal, '%d-%m-%Y')as tanggal from tugas inner join kelas on tugas.kode_kelas = kelas.id_kelas inner join guru on tugas.kode_guru = guru.kode_guru inner join pelajaran on tugas.kode_pelajaran = pelajaran.kode_pelajaran where tugas.kode_pelajaran = '$kd_pelajaran' and tugas.kode_kelas = '$res'");

$CEK = mysqli_query($konek, "select tugas.kode_tugas,kode_kelas,nama_kelas,Nama_guru,nama_pelajaran,tugas,DATE_FORMAT(tanggal, '%d-%m-%Y')as tanggal,nama_siswa, DATE_FORMAT(tanggal_upload, '%d-%m-%Y')as tanggal_upload , upload_jawaban from tugas inner join kelas on tugas.kode_kelas = kelas.id_kelas inner join guru on tugas.kode_guru = guru.kode_guru inner join pelajaran on tugas.kode_pelajaran = pelajaran.kode_pelajaran inner join jawaban_tugas on tugas.kode_tugas = jawaban_tugas.kode_tugas where jawaban_tugas.nama_siswa = '$_SESSION[Username]' and tugas.kode_kelas = '$res' and tugas.kode_pelajaran = '$kd_pelajaran'");

if (mysqli_num_rows($CEK) > 0) {
    while ($tugas = mysqli_fetch_array($CEK)) {
        echo "
                                    <thead>
                                    <tr>
                                        <th>kelas</th>
                                        <th>guru</th>
                                        <th>pelajaran</th>
                                        <th>tugas</th>
                                        <th>batas akhir</th>
                                        <th>nama kamu</th>
                                        <th>jawaban kamu</th>
                                        <th>tanggal upload</th>
                                       
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                        <tr>
                                            
                                            <td>$tugas[nama_kelas]</td>
                                            <td><a>$tugas[Nama_guru]</a></td>
                                            <td><a>$tugas[nama_pelajaran]</a></td>
                                            <td>$tugas[tugas]</td>
                                            <td>$tugas[tanggal]</td>
                                            <td>$tugas[nama_siswa]</td>
                                            <td><a href=\"unduh_jawaban.php?file=$tugas[upload_jawaban]\">$tugas[upload_jawaban]</a></td>
                                            <td>$tugas[tanggal_upload]</td>
                                            <td><button class='btn btn-info'>kamu sudah upload</button></td>
                                        </tr>";
    }
}


if (mysqli_num_rows($querymatakuliah) < 1) {
?>
    <script>
        alert("ups.. saat ini belum ada tugas nih..");
    </script>
<?php
}

if (mysqli_num_rows($CEK) === 0) {
    while ($tugas = mysqli_fetch_array($querymatakuliah)) {
        echo "
                                    <thead>
                                    <tr>
                                        <th>kelas</th>
                                        <th>guru</th>
                                        <th>pelajaran</th>
                                        <th>tugas</th>
                                        <th>batas akhir</th>
                                        <th>Action</th>
                                    </tr>
                                     </thead>
                                        <tr>
                                            
                                            <td>$tugas[nama_kelas]</td>
                                            <td>$tugas[Nama_guru]</td>
                                            <td>$tugas[nama_pelajaran]</td>
                                            <td><a href=\"unduh_tugas.php?file=$tugas[tugas]\">$tugas[tugas]</a></td>
                                            <td>$tugas[tanggal]</td>
                                           
                                            <td>
                                                <a href='#' class='open_modal' id='$tugas[kode_tugas]'><button class='btn btn-success'>upload</button></a> 
                                            </td>
                                        </tr>";
    }
}

if ($querymatakuliah == false) {
    die("Terdapat Kesalahan : " . mysqli_error($konek));
}

?>