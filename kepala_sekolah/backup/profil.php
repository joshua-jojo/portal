<?php

session_start();
include "../koneksi.php";
include "auth_user.php";
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title> SMA</title>
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

					<li><a href="index.php"><span>Dashboard</span></a></li>
					<li><a href="jadwal.php"><span>Jadwal</span></a></li>
					<li><a href="nilai.php"><span>Nilai siswa</span></a></li>
					<li><a href="absensi.php"></i><span>Absensi</span></a></li>
					<li><a href="pengumuman.php"><span>Pengumuman</span></a></li>
					<li class="active"><a href="profil.php"><span>Profil</span></a></li>

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
								<a href="#"><button class="btn btn-warning" type="button" data-target="#ModalUbahPassword" data-toggle="modal">Ubah Password</button></a>
								<br></br>
								<table id="data" class="table table-bordered table-striped table-scalable">
									<?php
									include "dt_profil.php";
									?>
								</table>
							</div><!-- /.box-body -->
						</div><!-- /.box -->
					</div><!-- /.col -->
				</div><!-- /.row -->
			</section><!-- /.content -->

			<!-- Modal Popup Dosen -->
			<div id="ModalUbahPassword" class="modal fade" tabindex="-1" role="dialog">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title">Ubah Password</h4>
						</div>
						<div class="modal-body">
							<form action="update_pass.php" name="modal_popup" enctype="multipart/form-data" method="post">

								<div class="form-group">
									<div class="input-group">
										<div class="input-group-addon">
											<label> Username : </label>
										</div>
										<select name="siswa" class="form-control" disabled>
											<?php
											$sql = $konek->query("select * from pengguna where Id_user = '$_SESSION[Id_User]'");
											while ($data = $sql->fetch_assoc()) {
												echo "<option value='$data[Username]' selected>$data[Username]</option>";
											}
											?>
										</select>
									</div>
								</div>

								<div class="form-group">
									<label>Password</label>
									<div class="input-group">
										<?php
										$sql = $konek->query("select * from pengguna where Id_User = '$_SESSION[Id_User]'");
										while ($data = $sql->fetch_assoc()) {
											echo "<input type='password' name='password' class='form-control checkboxx' value='$data[Password]' minlength='6'> ";
										}
										?>
										<div class="input-group-addon">
											<i class="fa fa-eye" style="cursor: pointer;" id="cek"></i>
										</div>
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