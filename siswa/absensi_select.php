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
    ?>
</head>

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
                <div class="user-panel">
                    <div class="pull-left image">
                        <p></p>
                    </div>
                </div><!-- sidebar menu: : style can be found in sidebar.less -->
                <ul class="sidebar-menu">
                    <li class="header">
                        <h4><b>
                                <center>Menu Panel</center>
                            </b></h4>
                    </li>
                    <li class="active"><a href="index.php"><i class="fa fa-home"></i><span>Dashboard</span></a></li>
                    <li><a href="jadwal.php"><i class="fa fa-calendar"></i><span>Jadwal</span></a></li>
                    <li><a href="nilai.php"><i class="fa fa-book"></i><span>Nilai</span></a></li>
                    <li><a href="tagihan.php"><i class="fa fa-book"></i><span>Tagihan</span></a></li>
                    <li class="active"><a href="absensi.php"><i class="fa fa-book"></i><span>Absensi</span></a></li>
                    <li><a href="about.php"><i class="fa fa-info-circle"></i><span>Tentang Aplikasi</span></a></li>
                </ul>
                </ul>
            </section>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    Siswa
                </h1>
                <ol class="breadcrumb">

                </ol>
            </section>

            <form action="" method="post">





            </form>
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
                                <table id="data" class="table table-bordered table-striped table-scalable">
                                    <?php
                                    include 'dt_absensi';
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
                                            <i class="fa fa-id-card"></i>
                                        </div>
                                        <input name="id" type="text" class="form-control" placeholder="siswa" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>siswa</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-user"></i>
                                        </div>
                                        <input name="siswa" type="text" class="form-control" placeholder="Nama siswa" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Tanggal</label>
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input name="tanggal" type="date" class="form-control" placeholder="Tanggal Lahir">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Kelas</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-graduation-cap"></i>
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
                                            <i class="fa fa-graduation-cap"></i>
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
                                            <i class="fa fa-graduation-cap"></i>
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
                                    <button class="btn btn-success" type="submit">
                                        Add
                                    </button>
                                    <button type="reset" class="btn btn-danger" data-dismiss="modal" aria-hidden="true">
                                        Cancel
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
                    <h4 class="modal-title" style="text-align:center;">Are you sure to delete this information ?</h4>
                </div>
                <div class="modal-footer" style="margin:0px; border-top:0px; text-align:center;">
                    <a href="#" class="btn btn-danger" id="delete_link">Delete</a>
                    <button type="button" class="btn btn-success" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    </div><!-- ./wrapper -->
    <!-- Library Scripts -->
    <?php
    include "bundle_script.php";
    ?>
</body>

</html>