<?php

session_start();
include "../koneksi.php";
include "auth_user.php";

$daftarnilai[] = "A";
$daftarnilai[] = "B";
$daftarnilai[] = "C";
$daftarnilai[] = "D";

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
<style>
  li {
    border-bottom: 1px solid white;
    margin-top: -10px;
  }

  .box-body {
    height: 500px;
    overflow: scroll;
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
          <li class="active"><a href="nilai.php"><span>Nilai siswa</span></a></li>
          <li><a href="absensi.php"></i><span>Absensi</span></a></li>
          <li><a href="pengumuman.php"><span>Pengumuman</span></a></li>
          <li><a href="profil.php"><span>Profil</span></a></li>

          <li style='background-color:red' class="logout"><a href="../logout.php">keluar</a></li>
        </ul>
      </section>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Nilai
        </h1>
        <ol class="breadcrumb">
          <li><i class="fa fa-book"></i> Nilai</li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-xs-12">
            <div class="box">
              <div class="box-header">
                <form action="cetak_nilai.php" method="post" class="mt-5" style="float:right; width:500px; ">
                  <div class=" form-group col-md-5" style="margin-left: -583px;">
                    <label>Cetak Nilai</label>
                    <div class="input-group">

                      <select name="kelas" class="form-control">
                        <option value="">pilih kelas</option>
                        <?php

                        $sql = $konek->query("select * from kelas");
                        while ($data = $sql->fetch_assoc()) {
                          echo "<option value='$data[nama_kelas]'>$data[nama_kelas]</option>";
                        }
                        ?>
                      </select>

                    </div>
                    <br>
                    <input type="submit" class="btn btn-success" name="submit" value="cetak">
                  </div>
                </form>
              </div><!-- /.box-header -->
              <div class="box-body">

                <br></br>
                <table id="data" class="table table-bordered table-striped table-scalable">
                  <?php
                  include "dt_nilai.php";
                  ?>
                </table>
              </div><!-- /.box-body -->
            </div><!-- /.box -->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </section><!-- /.content -->

      <!-- Modal Popup Dosen -->


      <!-- Modal Popup Dosen Edit -->
      <div id="ModalEditNilai" class="modal fade" tabindex="-1" role="dialog"></div>

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

    </div><!-- /.content-wrapper -->

  </div><!-- ./wrapper -->
  <!-- Library Scripts -->
  <?php
  include "bundle_script.php";
  ?>
</body>

</html>