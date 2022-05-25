<!-- File ini bikin baru tanpa merubah file yang lama -->
<!-- Semua sintaks di sini dibuat sendiri kak -->

<?php
$title = 'Jadwal';
$path = '../';
require '../comp/header.php';

session_start();
include "../koneksi.php";
include "auth_user.php";

$bulan = date("i");
$tahun = date("s");

$format_id = $bulan . $tahun;
?>

<body class="g-sidenav-show bg-gray-100">
    <!-- aside -->
    <?php require '../comp/sidebar.php' ?>
    <!--/ aside -->

    <!-- main content -->
    <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg">

        <!-- navbar -->
        <?php $title = 'Tugas' ?>
        <?php require '../comp/navbar.php' ?>

        <!-- /navbar -->

        <div class="container-fluid py-4">

            <div class="row mt-4">
                <div class="col-lg-12 mb-lg-0 mb-4">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="d-flex flex-column h-100 mb-4">

                                        <h5 class="font-weight-bolder">Jawaban Tugas Siswa</h5>

                                    </div>
                                </div>
                                <?php $id  = $_GET['kode_pelajaran'];
                                $kelas  = $_GET['kode_kelas']; ?>

                                <div class="col-12">


                                    <div class="table-responsive">
                                        <table class="table align-items-center mb-3">

                                            <!-- Data Jadwal -->

                                            <?php

                                            $id  = $_GET['kode_pelajaran'];
                                            $kelas  = $_GET['kode_kelas'];
                                            $idtugas  = $_GET['id_tugas'];

                                            $CEK = mysqli_query($konek, "select * from tugas inner join kelas on tugas.id_kelas = kelas.id_kelas inner join guru on tugas.id_guru = guru.id_guru inner join pelajaran on tugas.id_pelajaran = pelajaran.id_pelajaran inner join jawaban_tugas on tugas.id_tugas = jawaban_tugas.id_tugas where tugas.id_pelajaran = '$id' and tugas.id_kelas = '$kelas' and jawaban_tugas.id_tugas = '$idtugas'");


                                            ?>

                                            <thead>
                                                <tr>
                                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Siswa</th>
                                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jawaban Siswa</th>
                                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tanggal Upload</th>
                                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nilai</th>
                                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $no = 1;
                                                while ($tugas = mysqli_fetch_array($CEK)) : ?>
                                                    <tr>
                                                        <td class="align-middle text-center text-sm">
                                                            <span class="text-secondary text-xs font-weight-bolds">
                                                                <?= $tugas['nama_siswa'] ?>
                                                            </span>
                                                        </td>
                                                        <td class="align-middle text-center text-sm">
                                                            <span class="text-secondary text-xs font-weight-bolds">
                                                                <a href="unduh_jawaban.php?file=<?= $tugas['file_jawaban'] ?>"><?= $tugas['file_jawaban'] ?></a>
                                                            </span>
                                                        </td>
                                                        <td class="align-middle text-center text-sm">
                                                            <span class="text-secondary text-xs font-weight-bolds">
                                                                <?= $tugas['tanggal_unggahan'] ?>
                                                            </span>
                                                        </td>
                                                        <td class="align-middle text-center text-sm">
                                                            <span class="text-secondary text-xs font-weight-bolds">
                                                                <?= $tugas['nilai'] ?>
                                                            </span>
                                                        </td>
                                                        <td class="align-middle text-center text-sm">
                                                            <span class="badge badge-sm bg-gradient-info">
                                                                <a class="text-white" href="#" data-bs-toggle="modal" data-bs-target="#modalnilai<?= $no ?>" id="<?= $tugas['id_tugas'] ?>">Nilai</a>
                                                            </span>
                                                        </td>
                                                    </tr>
                                                    <div class="modal fade" id="modalnilai<?= $no ?>" tabindex="-1" role="dialog" aria-labelledby="ModalEdit" aria-hidden="true">
                                                        <form name="modal_popup" enctype="multipart/form-data" method="post">
                                                            <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h6 class="modal-title" id="modal-title-default">Edit Tugas</h6>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">×</span>
                                                                        </button>
                                                                    </div>
                                                                    <form action="" method="post">
                                                                        <div class="modal-body">
                                                                            <div class="form-group">
                                                                                <label>Nilai Tugas</label>
                                                                                <input type="hidden" name="idjawaban" value="<?= $tugas['id_jawaban'] ?>">
                                                                                <input class="form-control" type="number" name="nilaitugas" value="<?= $tugas['nilai'] ?>" required>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="submit" name="save" class="btn bg-gradient-primary">Simpan</button>
                                                                            <button type="button" class="btn btn-link  ml-auto" data-bs-dismiss="modal">Tutup</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                <?php
                                                    $no++;
                                                endwhile; ?>
                                            </tbody>


                                        </table>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </main>
    <!-- /main content -->
</body>

<?php
if (isset($_POST['save'])) {
    $konek->query("UPDATE jawaban_tugas SET nilai='$_POST[nilaitugas]' WHERE id_jawaban='$_POST[idjawaban]'");
    echo "<script>alert('Nilai berhasil di simpan');</script>";
    echo "<script>location='tugasjawaban.php?kode_pelajaran=$_GET[kode_pelajaran]&kode_kelas=$_GET[kode_kelas]&id_tugas=$_GET[id_tugas]';</script>";
}
?>
<!-- Modal Tugas -->
<div class="modal fade" id="ModalTugas" tabindex="-1" role="dialog" aria-labelledby="ModalTugasLabel" aria-hidden="true">
    <form action="tugas_add.php" name="modal_popup" enctype="multipart/form-data" method="post">

        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalTugasLabel">Tambah Tugas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">


                    <div class="form-group">
                        <label>ID Tugas</label>

                        <input name="id" type="text" class="form-control" placeholder="id tugas" value="<?php echo $format_id ?>" readonly />
                    </div>

                    <div class="form-group">
                        <label>Kelas</label>
                        <select name="kelas" class="form-control">
                            <?php
                            $kelas = $_GET['kode_kelas'];
                            $sql = $konek->query("SELECT * from kelas where id_kelas = '$kelas'");
                            while ($data = $sql->fetch_assoc()) {
                                echo "<option value='$data[id_kelas]'>$data[nama_kelas]</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Guru</label>

                        <select name="guru" class="form-control">

                            <?php
                            $guru = $_SESSION['Id_User'];
                            $sql = $konek->query("select * from guru where id_guru = '$guru'");
                            while ($data = $sql->fetch_assoc()) {
                                echo "<option value='$data[id_guru]'>$data[nama_guru]</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Pelajaran</label>

                        <select name="pelajaran" class="form-control">
                            <?php
                            $pelajaran = $_GET['kode_pelajaran'];

                            $sql = $konek->query("select * from pelajaran where id_pelajaran = '$pelajaran'");
                            while ($data = $sql->fetch_assoc()) {
                                echo "<option value='$data[id_pelajaran]'>$data[nama_pelajaran]</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Tugas</label>

                        <input name="tugas" type="file" class="form-control" placeholder="pembahasan" />
                    </div>



                    <div class="form-group">
                        <label>Batas Akhir</label>
                        <input name="tanggal" type="date" class="form-control" placeholder="batas akhir">
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Batal</button>
                    <button class="btn bg-gradient-primary" type="submit">Tambah</button>
                </div>
            </div>
        </div>
    </form>

</div>

<!-- Modal Absen-->
<div class="modal fade" id="ModalAbsen" tabindex="-1" role="dialog" aria-labelledby="ModalAbsenLabel" aria-hidden="true">
    <form action="absensi_add.php" name="modal_popup" enctype="multipart/form-data" method="post">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalAbsenLabel">Absensi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label>ID Absen</label>

                        <input name="id" type="text" class="form-control" value="<?php echo $format_id ?>" readonly />
                    </div>

                    <div class="form-group">
                        <label>Siswa</label>
                        <select name="siswa" class="form-control">

                            <?php
                            $kelas = $_GET['kode_kelas'];
                            $pelajaran = $_GET['kode_pelajaran'];


                            // $sql = $konek->query("select * from jadwal inner join pelajaran on jadwal.id_pelajaran = pelajaran.id_pelajaran inner join kelas on jadwal.id_kelas = kelas.id_kelas inner join guru on jadwal.id_guru = guru.id_guru inner join siswa on kelas.id_kelas = siswa.kelas where siswa.kelas = '$kelas' and jadwal.id_pelajaran = '$pelajaran';");
                            $sql = $konek->query("select * from siswa");
                            while ($data = $sql->fetch_assoc()) {
                                echo "<option value='$data[nama_siswa]'>$data[nama_siswa]</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Tanggal</label>

                        <input name="tanggal" type="date" class="form-control" placeholder="Tanggal Lahir" value="<?php echo $tanggal_upload = date("Y-m-d"); ?>">
                    </div>

                    <div class="form-group">
                        <label>Kelas</label>

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

                    <div class="form-group">
                        <label>Pelajaran</label>

                        <select name="pelajaran" class="form-control">
                            <?php
                            $pelajaran = $_GET['kode_pelajaran'];

                            $sql = $konek->query("select * from pelajaran where id_pelajaran = '$pelajaran'");
                            while ($data = $sql->fetch_assoc()) {
                                echo "<option value='$data[id_pelajaran]'>$data[nama_pelajaran]</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Status</label>

                        <select name="status" class="form-control">
                            <option value="">Pilih status</option>
                            <option value="hadir">hadir</option>
                            <option value="tidak hadir">tidak hadir</option>
                            <option value="izin">izin</option>
                        </select>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn bg-gradient-primary">Tambah</button>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- Modal Nilai -->
<div class="modal fade" id="ModalNilai" tabindex="-1" role="dialog" aria-labelledby="ModalNilaiLabel" aria-hidden="true">
    <form action="nilai_add.php" name="modal_popup" enctype="multipart/form-data" method="post">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalNilaiLabel">Tambah Nilai</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label>ID</label>
                        <input type="number" name="id" class="form-control" placeholder="masukan id nilai" value="<?php echo $format_id ?>" readonly>
                    </div>

                    <div class="form-group">
                        <label>Siswa</label>

                        <select name="siswa" class="form-control">
                            <option value="">Pilih Siswa</option>
                            <?php
                            // $querymhs = mysqli_query($konek, "select DISTINCT NIS,Nama_siswa from jadwal inner join kelas on jadwal.id_kelas = kelas.id_kelas inner join siswa on kelas.id_kelas = siswa.kelas where kelas = '$kelas' and id_pelajaran = '$id'");
                            $querymhs = mysqli_query($konek, "select * from jadwal inner join kelas on jadwal.id_kelas = kelas.id_kelas inner join siswa on kelas.id_kelas = siswa.kelas where kelas = '$kelas' and id_pelajaran = '$id'");
                            if ($querymhs == false) {
                                die("Terdapat Kesalahan : " . mysqli_error($konek));
                            }
                            while ($mhs = mysqli_fetch_array($querymhs)) {
                                echo "<option value='$mhs[NIS]'>$mhs[nama_siswa]</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Pelajaran</label>

                        <select name="pelajaran" class="form-control">
                            <?php

                            // $querypel = mysqli_query($konek, "select * from jadwal inner join kelas on jadwal.id_kelas = kelas.id_kelas inner join siswa on kelas.id_kelas = siswa.kelas inner join pelajaran on jadwal.id_pelajaran = pelajaran.id_pelajaran where kelas = '$kelas' and id_pelajaran = '$id'");
                            $querypel = mysqli_query($konek, "SELECT * FROM pelajaran WHERE id_pelajaran = '$id'");
                            if ($querypel == false) {
                                die("Terdapat Kesalahan : " . mysqli_error($konek));
                            }
                            while ($pel = mysqli_fetch_array($querypel)) {
                                echo "<option value='$pel[id_pelajaran]'>$pel[nama_pelajaran]</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Tugas</label>
                        <input type="number" name="tugas" class="form-control" id="" min="0" max="100" placeholder="masukan nilai tugas" required>
                    </div>

                    <div class="form-group">
                        <label>UTS</label>
                        <input type="number" name="uts" class="form-control" id="" min="0" max="100" placeholder="masukan nilai uts" required>
                    </div>

                    <div class="form-group">
                        <label>UAS</label>

                        <input type="number" name="uas" class="form-control" id="" min="0" max="100" placeholder="masukan nilai uas" required>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn bg-gradient-primary">Tambah</button>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- Modal Delete -->
<div class="modal fade" id="ModalDelete" tabindex="-1" role="dialog" aria-labelledby="ModalDelete" aria-hidden="true">
    <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="modal-title-notification">Perhatian</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="py-3 text-center">
                    <i class="ni ni-bell-55 ni-3x"></i>
                    <h4 class="text-gradient text-danger mt-4">Apakah Anda Yakin?</h4>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white text-danger">
                    <a href="" id="delete_link">
                        Hapus
                    </a>
                </button>
                <button type="button" class="btn btn-link text-secondary ml-auto" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit -->
<div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="ModalEdit" aria-hidden="true">
    <form action="tugas_edit.php" name="modal_popup" enctype="multipart/form-data" method="post">
        <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="modal-title-default">Edit Tugas</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn bg-gradient-primary">Edit</button>
                    <button type="button" class="btn btn-link  ml-auto" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </form>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<!-- Javascript Delete -->
<script>
    function confirm_delete(delete_url) {
        $("#modal_delete").modal('show', {
            backdrop: 'static'
        });
        document.getElementById('delete_link').setAttribute('href', delete_url);
    }

    $(".open_modal_edit").click(function(e) {
        var m = $(this).attr("id");


        console.log('kode Tugas: , ', m);


        $.ajax({
            url: "api_modal_edit.php",
            type: "GET",
            data: {
                id_tugas: m,
            },
            success: function(ajaxData) {

                console.log(ajaxData);


                $("#ModalEdit").html(ajaxData);
                $("#ModalEdit").modal('show', {
                    backdrop: 'true'
                });
            }
        });
    });
</script>
<?php require '../comp/footer.php' ?>