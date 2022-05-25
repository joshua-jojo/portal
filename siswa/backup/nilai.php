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
		 			
					<li ><a href="index.php"><span>Dashboard</span></a></li>
					<li><a href="jadwal.php"><span>Jadwal</span></a></li>
					<li class="active"><a href="nilai.php"><span>Nilai</span></a></li>
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
					<a href="cetak_nilai.php" class="btn btn-success">cetak</a>
                </div><!-- /.box-header -->
                <div class="box-body">
				<!-- <a href="#"><button class="btn btn-success" type="button" data-target="#ModalAdd" data-toggle="modal"><i class="fa fa-plus"></i> Add</button></a> -->
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
		<div id="ModalAdd" class="modal fade" tabindex="-1" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title">Tambah Nilai</h4>
					</div>
					<div class="modal-body">
						<form action="nilai_add.php" name="modal_popup" enctype="multipart/form-data" method="post">

						<div class="form-group">
								<label>id</label>
									<div class="input-group">
										<div class="input-group-addon">
											<i class="fa fa-users"></i>
										</div>
										<input type="number" name="id" class="form-control" placeholder="masukan id nilai">
									</div>
							</div>
							
							<div class="form-group">
								<label>siswa</label>
									<div class="input-group">
										<div class="input-group-addon">
											<i class="fa fa-users"></i>
										</div>
										<select name="siswa" class="form-control">
											<option value="">pilih siswa</option>
											<?php
												
												$querymhs = mysqli_query($konek, "select nis,nama_kelas,Nama_siswa from jadwal inner join pelajaran on jadwal.id_pelajaran = pelajaran.kode_pelajaran inner join guru on jadwal.kode_guru = guru.kode_guru inner join kelas on jadwal.id_kelas = kelas.id_kelas inner join siswa on kelas.id_kelas = siswa.kelas where guru.kode_guru = '$_SESSION[Password]	'");
												if($querymhs == false){
													die("Terdapat Kesalahan : ". mysqli_error($konek));
												}
												while($mhs = mysqli_fetch_array($querymhs)){
													echo "<option value='$mhs[nis]'>$mhs[Nama_siswa]</option>";
												}
											?>
										</select>
									</div>
							</div>
							<div class="form-group">
								<label>pelajaran</label>
									<div class="input-group">
										<div class="input-group-addon">
											<i class="fa fa-book"></i>
										</div>
										<select name="pelajaran" class="form-control">
											<option value="">pilih pelajaran</option>
										<?php
										
											$querypel = mysqli_query($konek, "select id_pelajaran,nama_pelajaran from jadwal inner join pelajaran on jadwal.id_pelajaran = pelajaran.kode_pelajaran inner join guru on jadwal.kode_guru = guru.kode_guru where jadwal.kode_guru = '$_SESSION[Password]';");
											if($querypel == false){
												die("Terdapat Kesalahan : ". mysqli_error($konek));
											}
											while($pel = mysqli_fetch_array($querypel)){
												echo "<option value='$pel[id_pelajaran]'>$pel[nama_pelajaran]</option>";
											}
										?>
										</select>
									</div>
							</div>
							<div class="form-group">
								<label>tugas</label>
									<div class="input-group">
										<div class="input-group-addon">
											<i class="fa fa-book"></i>
										</div>
										<input type="number" name="tugas" class="form-control" id="" min="0" max="100" placeholder="masukan nilai tugas" required>
									</div>
							</div>

							<div class="form-group">
								<label>uts</label>
									<div class="input-group">
										<div class="input-group-addon">
											<i class="fa fa-book"></i>
										</div>
										<input type="number" name="uts" class="form-control" id="" min="0" max="100" placeholder="masukan nilai uts" required>
									</div>
							</div>

							<div class="form-group">
								<label>uas</label>
									<div class="input-group">
										<div class="input-group-addon">
											<i class="fa fa-book"></i>
										</div>
										<input type="number" name="uas" class="form-control" id="" min="0" max="100" placeholder="masukan nilai uas" required>
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
