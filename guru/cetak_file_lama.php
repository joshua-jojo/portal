<?php

session_start();
include "../koneksi.php";
include "auth_user.php";
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>SMA</title>
    <!-- Library CSS -->
    <?php
    include "bundle_css.php";

    $bulan = date("i");
    $tahun = date("s");

    $format_id = $bulan . $tahun;
    ?>
</head>
<style>
    li {
        border-bottom: 1px solid white;
        margin-top: -10px;
    }
</style>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <?php
        include 'content_header.php';
        ?>
        <!-- Left side column. contains the logo and sidebar -->
        <aside class="main-sidebar">
            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">
                <!-- Sidebar user panel -->

                <ul class="sidebar-menu">

                    <li><a href="index.php"><span>Dashboard</span></a></li>
                    <li><a href="jadwal.php"><span>Jadwal</span></a></li>
                    <li><a href="nilai.php"><span>Nilai siswa</span></a></li>
                    <li class="active"><a href="absensi.php"></i><span>Absensi</span></a></li>
                    <li><a href="pengumuman.php"><span>Pengumuman</span></a></li>
                    <li><a href="profil.php"><span>Profil</span></a></li>

                    <li style='background-color:red' class="logout"><a href="../logout.php">keluar</a></li>
                </ul>
                </ul>
            </section>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->

            <br><br>





            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">
                            <div class="box-header">
                            </div><!-- /.box-header -->
                            <div class="box-body">
                                <!-- <a href="#"><button class="btn btn-success" type="button" data-target="#ModalAdd" data-toggle="modal">Tambah data</button></a> -->
                                <br></br>
                                <h1>absensi</h1>
                                <table id="data" class="table table-bordered table-striped table-scalable">
                                    <tr>
                                        <th>id absen</th>
                                        <th>Nama siswa</th>
                                        <th>nama kelas</th>
                                        <th>pelajaran</th>
                                        <th>tanggal</th>
                                        <th>status</th>


                                    </tr>
                                    <?php
                                    if ($_POST['tanggal'] !== "") {
                                        $querydosen = mysqli_query($konek, " select DISTINCT id_presensi,nama,kode_kelas,jadwal.id_pelajaran,nama_kelas, nama_pelajaran,DATE_FORMAT(tanggal,'%d-%m-%Y') as tgl,statuss from presensi inner join jadwal on presensi.id_pelajaran = jadwal.id_pelajaran inner join pelajaran on presensi.id_pelajaran = pelajaran.kode_pelajaran inner join kelas on presensi.kode_kelas = kelas.id_kelas where jadwal.kode_guru='$_POST[namaGuru]' and presensi.id_pelajaran = '$_POST[pelajaran]' and presensi.kode_kelas='$_POST[kelas]' and presensi.tanggal='$_POST[tanggal]' order by tanggal desc");
                                        if ($querydosen == false) {
                                            die("Terjadi Kesalahan : " . mysqli_error($konek));
                                        }
                                        while ($absen = mysqli_fetch_array($querydosen)) {

                                            echo "
                                           <tr>
                                               <td>$absen[id_presensi]</td>
                                               <td>$absen[nama]</td>
                                               <td>$absen[nama_kelas]</td>
                                           ";

                                            echo "
                                               </td>
                                               <td>$absen[nama_pelajaran]</td>
                                               <td>$absen[tgl]</td>
                                               <td>$absen[statuss]</td>
                                              
                                           </tr>";
                                        }
                                    } else {
                                        $querydosen = mysqli_query($konek, " select DISTINCT id_presensi,nama,kode_kelas,jadwal.id_pelajaran,nama_kelas, nama_pelajaran,DATE_FORMAT(tanggal,'%d-%m-%Y') as tanggal,statuss from presensi inner join jadwal on presensi.id_pelajaran = jadwal.id_pelajaran inner join pelajaran on presensi.id_pelajaran = pelajaran.kode_pelajaran inner join kelas on presensi.kode_kelas = kelas.id_kelas where jadwal.kode_guru='$_POST[namaGuru]' and presensi.id_pelajaran = '$_POST[pelajaran]' and presensi.kode_kelas='$_POST[kelas]'");
                                        if ($querydosen == false) {
                                            die("Terjadi Kesalahan : " . mysqli_error($konek));
                                        }
                                        while ($absen = mysqli_fetch_array($querydosen)) {

                                            echo "
                                           <tr>
                                               <td>$absen[id_presensi]</td>
                                               <td>$absen[nama]</td>
                                               <td>$absen[nama_kelas]</td>
                                           ";

                                            echo "
                                               </td>
                                               <td>$absen[nama_pelajaran]</td>
                                               <td>$absen[tanggal]</td>
                                               <td>$absen[statuss]</td>
                                              
                                           </tr>";
                                        }
                                    }
                                    ?>

                            </div><!-- /.box-body -->
                        </div><!-- /.box -->
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </section><!-- /.content -->

            <!-- Modal Popup Dosen -->
            <div id="ModalAdd" class="modal fade" tabindex="-1" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Absensi</h4>
                        </div>
                        <div class="modal-body">
                            <form action="absensi_add.php" name="modal_popup" enctype="multipart/form-data" method="post">
                                <div class="form-group">
                                    <label>id absen</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            1
                                        </div>
                                        <input name="id" type="text" class="form-control" value="<?php echo $format_id ?>" readonly />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>siswa</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            2
                                        </div>
                                        <input name="siswa" type="text" class="form-control" placeholder="Nama siswa" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Tanggal</label>
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            3
                                        </div>
                                        <input name="tanggal" type="date" class="form-control" placeholder="Tanggal Lahir">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Kelas</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            4
                                        </div>
                                        <select name="kelas" class="form-control">
                                            <option value="">pilih Kelas</option>
                                            <?php
                                            $sql = $konek->query("select * from kelas order by id_kelas");
                                            while ($data = $sql->fetch_assoc()) {
                                                echo "<option value='$data[id_kelas]'>$data[nama_kelas]</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>pelajaran</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            5
                                        </div>
                                        <select name="pelajaran" class="form-control">
                                            <option value="">pilih pelajaran</option>
                                            <?php
                                            $sql = $konek->query("select * from pelajaran order by nama_pelajaran asc");
                                            while ($data = $sql->fetch_assoc()) {
                                                echo "<option value='$data[kode_pelajaran]'>$data[nama_pelajaran]</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>status</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            6
                                        </div>
                                        <select name="status" class="form-control">
                                            <option value="">Pilih status</option>
                                            <option value="hadir">hadir</option>
                                            <option value="tidak hadir">tidak hadir</option>
                                            <option value="izin">izin</option>
                                        </select>
                                    </div>
                                </div>



                                <div class="modal-footer">
                                    <button class="btn btn-info" type="submit">
                                        Tambah
                                    </button>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Popup Dosen Edit -->
    <div id="ModalEditAbsensi" class="modal fade" tabindex="-1" role="dialog">

    </div>

    <!-- Modal Popup untuk delete-->
    <div class="modal fade" id="modal_delete">
        <div class="modal-dialog">
            <div class="modal-content" style="margin-top:100px;">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" style="text-align:center;">Apakah anda yakin ingin menghapus data ini?</h4>
                </div>
                <div class="modal-footer" style="margin:0px; border-top:0px; text-align:center;">
                    <a href="#" class="btn btn-danger" id="delete_link">hapus</a>

                </div>
            </div>
        </div>
    </div>

    </div><!-- ./wrapper -->
    <!-- Library Scripts -->
    <?php
    include "bundle_script.php";
    ?>
    <script>
        window.print()
    </script>
</body>

</html>


<!-- <?php
        session_start();
        include "../koneksi.php";
        include "auth_user.php";
        ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<table  id="data" class="table table-bordered table-striped table-scalable">
                                <thead>
                                    
                                    <tr>
                                        <th>id absen</th>
                                        <th>Nama siswa</th>
                                        <th>nama kelas</th>
                                        <th>pelajaran</th>
                                        <th>tanggal</th>
                                        <th>status</th>
                                       
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $querydosen = mysqli_query($konek, " select DISTINCT id_presensi,nama,kode_kelas,jadwal.id_pelajaran,nama_kelas, nama_pelajaran,DATE_FORMAT(tanggal,'%d-%m-%Y') as tanggal,statuss from presensi inner join jadwal on presensi.id_pelajaran = jadwal.id_pelajaran inner join pelajaran on presensi.id_pelajaran = pelajaran.kode_pelajaran inner join kelas on presensi.kode_kelas = kelas.id_kelas where jadwal.kode_guru='$_POST[namaGuru]' and presensi.id_pelajaran = '$_POST[pelajaran]'");
                                    if ($querydosen == false) {
                                        die("Terjadi Kesalahan : " . mysqli_error($konek));
                                    }
                                    while ($absen = mysqli_fetch_array($querydosen)) {

                                        echo "
                                                <tr>
                                                    <td>$absen[id_presensi]</td>
                                                    <td>$absen[nama]</td>
                                                    <td>$absen[nama_kelas]</td>
                                                ";

                                        echo "
                                                    </td>
                                                    <td>$absen[nama_pelajaran]</td>
                                                    <td>$absen[tanggal]</td>
                                                    <td>$absen[statuss]</td>
                                                    <td>
                                                  
                                                </td>
                                                </tr>";
                                    }
                                    ?>
                                </tbody>
                                </table>
                                
<script>
    window.print();
</script>

</body>
</html> -->