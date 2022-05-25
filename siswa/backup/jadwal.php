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
  <style>
    	li {
		border-bottom: 1px solid white;
		margin-top: -10px;
	}
	th,tr,td{
			text-align: center;
			text-transform: capitalize;
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
					<li class="active"><a href="jadwal.php"><span>Jadwal</span></a></li>
					<li><a href="nilai.php"><span>Nilai</span></a></li>
					<li><a href="absensi.php"><span>Absensi</span></a></li>
					<li><a href="tagihan.php"><span>Tagihan</span></a></li>
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
			<h5>Have a nice day, <?php echo $_SESSION["Username"] ?></h5>
        
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                </div><!-- /.box-header -->
                <div class="box-body">
				<!-- <a href="#"><button class="btn btn-success" type="button" data-target="#ModalAdd" data-toggle="modal"><i class="fa fa-plus"></i> Add</button></a> -->
                  <br></br>
				  <table id="data" class="table table-bordered table-striped table-scalable">
						<?php
							include "dt_jadwal.php";
						?>
                  </table>
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
						<h4 class="modal-title">Tambah Mahasiswa</h4>
					</div>
					<div class="modal-body">
						<form action="tagihan_add.php" name="modal_popup" enctype="multipart/form-data" method="post">
							<div class="form-group">
								<label>id</label>
									<div class="input-group">
										<div class="input-group-addon">
											<i class="fa fa-id-card"></i>
										</div>
										<input name="id" type="text" class="form-control" placeholder="id"/>
									</div>
							</div>
							<div class="form-group">
								<label>siswa</label>
									<div class="input-group">
										<div class="input-group-addon">
											<i class="fa fa-user"></i>
										</div>
										<select name="siswa" class="form-control">
											<option value="">pilih siswa</option>
											<?php
											$sql = $konek->query("select * from siswa order by Nama_siswa");
											while ($data = $sql->fetch_assoc()) {
												echo "<option value='$data[NIS]'>$data[Nama_siswa]</option>";
											}
											?>
										</select>
									</div>
							</div>
							<div class="form-group">
								<label>Tanggal</label>
									<div class="input-group date">
										<div class="input-group-addon">
											<i class="fa fa-calendar"></i>
										</div>
										<input name="tanggal" type="date" class="form-control" placeholder="Tanggal">
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
								<label>bulan</label>
									<div class="input-group">
										<div class="input-group-addon">
											<i class="fa fa-graduation-cap"></i>
										</div>
										<select name="bulan" class="form-control">
											<option value="">pilih Kelas</option>
											<?php
											$sql = $konek->query("select * from bulan order by id_bulan_spp");
											while ($data = $sql->fetch_assoc()) {
												echo "<option value='$data[id_bulan_spp]'>$data[nama_bulan]</option>";
											}
											?>
										</select>
									</div>
								</div>

								<div class="form-group">
								<label>jumlah tagihan</label>
									<div class="input-group">
										<div class="input-group-addon">
											<i class="fa fa-id-card"></i>
										</div>
										<input name="total_tagihan" type="text" class="form-control" value="150000" readonly/>
									</div>
								</div>
							
                                <div class="form-group">
								<label>catatan</label>
									<div class="input-group">
										<div class="input-group-addon">
											<i class="fa fa-graduation-cap"></i>
										</div>
										<select name="catatan" class="form-control">
											<option value="">pilih Kelas</option>
											<option value="lunas">lunas</option>
											<option value="belum lunas">belum lunas</option>
										</select>
									</div>
								</div>
								<div class="form-group">
								<label>bukti tf</label>
									<div class="input-group">
										<div class="input-group-addon">
											<i class="fa fa-book"></i>
										</div>
										<input name="bukti_pembayaran" type="file" class="form-control" placeholder="pembahasan"/>
									</div>
								</div>
								
						
							<div class="modal-footer">
								<button class="btn btn-success" type="submit">
									Add
								</button>
								<button type="reset" class="btn btn-danger"  data-dismiss="modal" aria-hidden="true">
									Cancel
								</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		
		<!-- Modal Popup Dosen Edit -->
		<div id="ModalEditTagihan" class="modal fade" tabindex="-1" role="dialog">

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
		
    </div><!-- /.content-wrapper -->
  
    </div><!-- ./wrapper -->
	<!-- Library Scripts -->
	<?php
		include "bundle_script.php";
	?>
  </body>
</html>
