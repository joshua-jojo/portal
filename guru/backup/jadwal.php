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

	tr,
	th {
		text-align: center;
	}
</style>

<body class="hold-transition skin-red sidebar-mini">
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
					<li><a href="nilai.php"><span>Nilai siswa</span></a></li>
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

			</section>

			<!-- Main content -->
			<section class="content">
				<div class="row">
					<div class="col-xs-12">
						<div class="box">
							<div class="box-header">

							</div><!-- /.box-header -->
							<div class="box-body">

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
							<h4 class="modal-title">Masukan Jadwal</h4>
						</div>
						<div class="modal-body">
							<form action="jadwal_add.php" name="modal_popup" enctype="multipart/form-data" method="post">

								<div class="form-group">
									<label>pelajaran</label>
									<div class="input-group">
										<div class="input-group-addon">
											<i class="fa fa-graduation-cap"></i>
										</div>
										<select name="pelajaran" class="form-control" required>
											<option value="">pilih pelajaran</option>
											<?php
											$sql = $konek->query("select * from pelajaran order by kode_pelajaran");
											while ($data = $sql->fetch_assoc()) {
												echo "<option value='$data[kode_pelajaran]'>$data[nama_pelajaran]</option>";
											}
											?>
										</select>
									</div>
								</div>

								<div class="form-group">
									<label>Kelas</label>
									<div class="input-group">
										<div class="input-group-addon">
											<i class="fa fa-graduation-cap"></i>
										</div>
										<select name="kelas" class="form-control" required>
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
									<label>Guru</label>
									<div class="input-group">
										<div class="input-group-addon">
											<i class="fa fa-graduation-cap"></i>
										</div>
										<select name="guru" class="form-control" required>
											<option value="">pilih guru</option>
											<?php
											$sql = $konek->query("select * from guru ");
											while ($data = $sql->fetch_assoc()) {
												echo "<option value='$data[kode_guru]'>$data[Nama_guru]</option>";
											}
											?>
										</select>
									</div>
								</div>

								<div class="form-group">
									<label>jam</label>
									<div class="input-group">
										<div class="input-group-addon">
											<i class="fa fa-id-card"></i>
										</div>
										<input name="jam" type="text" class="form-control" placeholder="masukan jam belajar" required />
									</div>
								</div>

								<div class="form-group">
									<label>Hari</label>
									<div class="input-group">
										<div class="input-group-addon">
											<i class="fa fa-graduation-cap"></i>
										</div>
										<select name="hari" class="form-control" required>
											<option value="">pilih hari</option>
											<?php
											$sql = $konek->query("select * from hari order by id_hari");
											while ($data = $sql->fetch_assoc()) {
												echo "<option value='$data[id_hari]'>$data[nama_hari]</option>";
											}
											?>
										</select>
									</div>
								</div>

								<div class="form-group">
									<label>Link</label>
									<div class="input-group">
										<div class="input-group-addon">
											<i class="fa fa-book"></i>
										</div>
										<input name="berkas" type="file" class="form-control" placeholder="link gmeet" required />
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

			<!-- Modal Popup Dosen Edit -->
			<div id="ModalEditJadwal" class="modal fade" tabindex="-1" role="dialog">

			</div>

			<!-- Modal Popup untuk delete-->
			<div class="modal fade" id="modal_delete">
				<div class="modal-dialog">
					<div class="modal-content" style="margin-top:100px;">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h4 class="modal-title" style="text-align:center;">Apakah anda yakin untuk menghapus data ini?</h4>
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