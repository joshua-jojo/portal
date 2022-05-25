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
	.hidden {
		display: none;
	}

	li {
		border-bottom: 1px solid white;
		margin-top: -10px;
	}
</style>

<body class="hold-transition skin-blue sidebar-mini">
	<div class="wrapper">
		<?php
		include 'content_header.php';
		$bulan = date("i");
		$tahun = date("s");

		$format_id = $bulan . $tahun;
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
				<h1>
					aktvitas guru
				</h1>
			</section>

			<!-- Main content -->
			<section class="content">
				<div class="row">
					<div class="col-xs-12">
						<div class="box">
							<div class="box-header">

							</div><!-- /.box-header -->
							<div class="box-body">
								<?php $id	= $_GET['kode_pelajaran'];
								$kelas	= $_GET['kode_kelas']; ?>
								<a href="#"><button class="btn btn-success" type="button" data-target="#ModalAddTugas" data-toggle="modal"></i> Add</button></a>
								<a href="#"><button class="btn btn-warning" type="button" data-target="#ModalAddAbsensi" data-toggle="modal"></i>Absensi</button></a>
								<a href="#"><button class="btn btn-danger" type="button" data-target="#ModalAddNilai" data-toggle="modal"></i>Nilai</button></a>
								<a href="forum.php?kode_kelas=<?= $kelas ?>&kode_pelajaran=<?= $id ?>"><button class="btn btn-info" type="button"></i>forum</button></a>
								<br></br>
								<table id="data" class="table table-bordered table-striped table-scalable">
									<?php
									// bagaimana caranya ketika kita klik kelas bisa langsung keurut gitu data kelas dari yang upload 
									$id	= $_GET['kode_pelajaran'];
									$kelas	= $_GET['kode_kelas'];

									$querymatakuliah = mysqli_query($konek, "select * from tugas inner join kelas on tugas.kode_kelas = kelas.id_kelas inner join guru on tugas.kode_guru = guru.kode_guru inner join pelajaran on tugas.kode_pelajaran = pelajaran.kode_pelajaran where tugas.kode_kelas = '$kelas' and tugas.kode_pelajaran = '$id'");

									$CEK = mysqli_query($konek, "select id_jawaban,tugas.kode_tugas,kode_kelas,nama_kelas,Nama_guru,nama_pelajaran,tugas,DATE_FORMAT(tanggal, '%d-%m-%Y')as tanggal,nama_siswa, DATE_FORMAT(tanggal_upload, '%d-%m-%Y')as tanggal_upload , upload_jawaban from tugas inner join kelas on tugas.kode_kelas = kelas.id_kelas inner join guru on tugas.kode_guru = guru.kode_guru inner join pelajaran on tugas.kode_pelajaran = pelajaran.kode_pelajaran inner join jawaban_tugas on tugas.kode_tugas = jawaban_tugas.kode_tugas where tugas.kode_pelajaran = '$id' and tugas.kode_kelas = '$kelas'");

									if (mysqli_num_rows($CEK) > 0) {
										echo "
									<thead>
                                    <tr>
                                        <th>kelas</th>
                                        <th>guru</th>
                                        <th>pelajaran</th>
                                        <th>tugas</th>
                                        <th>batas akhir</th>
                                        <th>nama siswa</th>
                                        <th>jawaban </th>
                                        <th>tanggal upload</th>
										<th>action</th>
                                       
                                      
                                    </tr>
                                </thead>
									
									";
										while ($tugas = mysqli_fetch_array($CEK)) {
											echo "
                                        <tr>
                                            
                                            <td>$tugas[nama_kelas]</td>
                                            <td><a>$tugas[Nama_guru]</a></td>
                                            <td><a href='jadwal.php'>$tugas[nama_pelajaran]</a></td>
											<td><a href=\"unduh_tugas.php?file=$tugas[tugas]\">$tugas[tugas]</a></td>	
                                            <td>$tugas[tanggal]</td>
                                            <td>$tugas[nama_siswa]</td>
                                            <td>$tugas[upload_jawaban]</td>
                                            <td>$tugas[tanggal_upload]</td>
                                            <td> <a href='#' onClick='confirm_delete(\"tugas_delete.php?kode_tugas=$tugas[id_jawaban]\")'><button class='btn btn-danger'>Delete</button></a></td>
                                        </tr>";
										}
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
                                            <td><a>$tugas[Nama_guru]</a></td>
                                            <td><a href='jadwal.php'>$tugas[nama_pelajaran]</a></td>
											<td><a href=\"unduh_tugas.php?file=$tugas[tugas]\">$tugas[tugas]</a></td>
                                            <td>$tugas[tanggal]</td>
                                           
                                            <td>
                                               <button class='btn btn-info'>belum ada jawaban</button>
                                            </td>
                                        </tr>";
										}
									}

									if ($querymatakuliah == false) {
										die("Terdapat Kesalahan : " . mysqli_error($konek));
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
			<div id="ModalAddTugas" class="modal fade" tabindex="-1" role="dialog">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title">Tambah Tugas</h4>
						</div>
						<div class="modal-body">
							<form action="tugas_add.php" name="modal_popup" enctype="multipart/form-data" method="post">
								<div class="form-group">
									<label>id tugas</label>
									<div class="input-group">
										<div class="input-group-addon">
											<i class="fa fa-id-card"></i>
										</div>
										<input name="id" type="text" class="form-control" placeholder="id tugas" value="<?php echo $format_id ?>" readonly />
									</div>
								</div>
								<div class="form-group">
									<label>Kelas</label>
									<div class="input-group">
										<div class="input-group-addon">
											<i class="fa fa-graduation-cap"></i>
										</div>
										<select name="kelas" class="form-control">

											<?php
											$kelas = $_GET['kode_kelas'];
											$sql = $konek->query("select * from kelas where id_kelas = '$kelas'");
											while ($data = $sql->fetch_assoc()) {
												echo "<option value='$data[id_kelas]'>$data[nama_kelas]</option>";
											}
											?>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label>guru</label>
									<div class="input-group">
										<div class="input-group-addon">
											<i class="fa fa-graduation-cap"></i>
										</div>
										<select name="guru" class="form-control">

											<?php
											$guru = $_SESSION['Id_User'];
											$sql = $konek->query("select * from guru where kode_guru = '$guru'");
											while ($data = $sql->fetch_assoc()) {
												echo "<option value='$data[kode_guru]'>$data[Nama_guru]</option>";
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
											<?php
											$pelajaran = $_GET['kode_pelajaran'];

											$sql = $konek->query("select * from pelajaran where kode_pelajaran = '$pelajaran'");
											while ($data = $sql->fetch_assoc()) {
												echo "<option value='$data[kode_pelajaran]'>$data[nama_pelajaran]</option>";
											}
											?>
										</select>
									</div>
								</div>

								<div class="form-group">
									<label>Tugas</label>
									<div class="input-group">
										<div class="input-group-addon">
											<i class="fa fa-book"></i>
										</div>
										<input name="tugas" type="file" class="form-control" placeholder="pembahasan" />
									</div>
								</div>



								<div class="form-group">
									<label>batas akhir</label>
									<div class="input-group date">
										<div class="input-group-addon">
											<i class="fa fa-calendar"></i>
										</div>
										<input name="tanggal" type="date" class="form-control" placeholder="batas akhir">
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


			<!-- modal add absensi -->

			<div id="ModalAddAbsensi" class="modal fade" tabindex="-1" role="dialog">
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
										<input name="id" type="text" class="form-control" value="<?php echo $format_id ?>" readonly />
									</div>
								</div>
								<div class="form-group">
									<label>siswa</label>
									<div class="input-group">
										<div class="input-group-addon">
											<i class="fa fa-user"></i>
										</div>
										<select name="siswa" class="form-control">

											<?php
											$kelas = $_GET['kode_kelas'];
											$pelajaran = $_GET['kode_pelajaran'];


											$sql = $konek->query("select nama_pelajaran,Nama_guru,nama_kelas,nama_kls,Nama_siswa from jadwal inner join pelajaran on jadwal.id_pelajaran = pelajaran.kode_pelajaran inner join kelas on jadwal.id_kelas = kelas.id_kelas inner join guru on jadwal.kode_guru = guru.kode_guru inner join siswa on kelas.id_kelas = siswa.kelas where siswa.kelas = '$kelas' and jadwal.id_pelajaran = '$pelajaran';");
											while ($data = $sql->fetch_assoc()) {
												echo "<option value='$data[Nama_siswa]'>$data[Nama_siswa]</option>";
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
										<input name="tanggal" type="date" class="form-control" placeholder="Tanggal Lahir" value="<?php echo $tanggal_upload = date("Y-m-d"); ?>">
									</div>
								</div>
								<div class="form-group">
									<label>Kelas</label>
									<div class="input-group">
										<div class="input-group-addon">
											<i class="fa fa-graduation-cap"></i>
										</div>
										<select name="kelas" class="form-control">

											<?php
											$kelas = $_GET['kode_kelas'];
											$sql = $konek->query("select * from kelas where id_kelas = '$kelas'");
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
											<?php
											$pelajaran = $_GET['kode_pelajaran'];

											$sql = $konek->query("select * from pelajaran where kode_pelajaran = '$pelajaran'");
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

			<div id="ModalAddNilai" class="modal fade" tabindex="-1" role="dialog">
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
										<input type="number" name="id" class="form-control" placeholder="masukan id nilai" value="<?php echo $format_id ?>" readonly>
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

											$querymhs = mysqli_query($konek, "select DISTINCT NIS,Nama_siswa from jadwal inner join kelas on jadwal.id_kelas = kelas.id_kelas inner join siswa on kelas.id_kelas = siswa.kelas where kelas = '$kelas' and id_pelajaran = '$id'");
											if ($querymhs == false) {
												die("Terdapat Kesalahan : " . mysqli_error($konek));
											}
											while ($mhs = mysqli_fetch_array($querymhs)) {
												echo "<option value='$mhs[NIS]'>$mhs[Nama_siswa]</option>";
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

											$querypel = mysqli_query($konek, "select DISTINCT id_pelajaran,nama_pelajaran from jadwal inner join kelas on jadwal.id_kelas = kelas.id_kelas inner join siswa on kelas.id_kelas = siswa.kelas inner join pelajaran on jadwal.id_pelajaran = pelajaran.kode_pelajaran where kelas = '$kelas' and id_pelajaran = '$id'");
											if ($querypel == false) {
												die("Terdapat Kesalahan : " . mysqli_error($konek));
											}
											while ($pel = mysqli_fetch_array($querypel)) {
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
			<div id="ModalEditTugas" class="modal fade" tabindex="-1" role="dialog">

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