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
				<!-- sidebar menu: : style can be found in sidebar.less -->
				<ul class="sidebar-menu">

					<li><a href="index.php"><span>Dashboard</span></a></li>
					<li><a href="jadwal.php"><span>Jadwal</span></a></li>
					<li><a href="nilai.php"><span>Nilai siswa</span></a></li>
					<li><a href="absensi.php"></i><span>Absensi</span></a></li>
					<li class="active"><a href="pengumuman.php"><span>Pengumuman</span></a></li>
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
								<!-- <a href="#"><button class="btn btn-success" type="button" data-target="#ModalAdd" data-toggle="modal"><i class="fa fa-plus"></i> Add</button></a> -->
								<br></br>
								<table id="data" class="table table-bordered table-striped table-scalable">

									<thead>
										<tr>
											<th>NO</th>
											<th>judul</th>
										</tr>
									</thead>
									<tbody>
										<?php

										$no = 1;
										$querymatakuliah = mysqli_query($konek, "SELECT * FROM pengumuman");
										if ($querymatakuliah == false) {
											die("Terdapat Kesalahan : " . mysqli_error($konek));
										}
										while ($pengumuman = mysqli_fetch_array($querymatakuliah)) {

											echo "
                                        <tr>
                                            <td>$no</td>
                                            <td>  <a href='#' class='open_modal' id='$pengumuman[id_pengumuman]'>$pengumuman[judul]</a></td>
											
                                        </tr>";
											$no++;
										}
										?>
									</tbody>

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
							<h4 class="modal-title">Masukan pengumuman</h4>
						</div>
						<div class="modal-body">
							<form action="pengumuman_add.php" name="modal_popup" enctype="multipart/form-data" method="post">
								<div class="form-group">
									<label>id</label>
									<div class="input-group">
										<div class="input-group-addon">
											<i class="fa fa-id-card"></i>
										</div>
										<input name="id" type="text" class="form-control" placeholder="Masukan id pengumuman" />
									</div>
								</div>
								<div class="form-group">
									<label>judul</label>
									<div class="input-group">
										<div class="input-group-addon">
											<i class="fa fa-graduation-cap"></i>
										</div>
										<input name="judul" type="text" class="form-control" placeholder="Masukan judul pengumuman" />
									</div>
								</div>

								<div class="form-group">
									<label>Keterangan</label>
									<div class="input-group">
										<div class="input-group-addon">
											<i class="fa fa-graduation-cap"></i>
										</div>
										<textarea rows="5" cols="65" name="keterangan" placeholder="masukan text!"></textarea>
									</div>
								</div>


								<div class="form-group">
									<label>Lampiran</label>
									<div class="input-group">
										<div class="input-group-addon">
											<i class="fa fa-book"></i>
										</div>
										<input name="lampiran" type="file" class="form-control" />
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
			<div id="ModalPengumuman" class="modal fade" tabindex="-1" role="dialog">

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