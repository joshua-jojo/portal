<?php
$title = 'Data Ujian';
$path = '../';
require 'comp/header.php';

session_start();
include "../koneksi.php";
include "auth_user.php";
?>

<body class="g-sidenav-show bg-gray-100">
    <!-- aside -->
    <?php require 'comp/sidebar.php' ?>
    <!--/ aside -->

    <!-- main content -->
    <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg">

        <!-- navbar -->
        <?php require '../comp/navbar.php' ?>
        <!-- /navbar -->

        <div class="container-fluid py-4">

            <div class="row mt-4">
                <div class="col-lg-12 mb-lg-0 mb-4">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="d-flex flex-column h-100">

                                        <h5 class="font-weight-bolder">Data Hasil Ujian</h5>

                                    </div>
                                </div>

                                <div class="container-fluid py-4">
                                    <div class="row">
                                        <div class="col-12">

                                            <div class="table-responsive">
                                                <table class="table align-items-center mb-3">

                                                    <!-- Data Jadwal -->

                                                    <?php

                                                    $id_ujian  = $_GET['id_ujian'];

                                                    $queryujian = mysqli_query($konek, "select * from ujian_murid left join ujian on ujian_murid.id_ujianjawaban = ujian.id_ujian left join siswa on ujian_murid.id_murid = siswa.NIS inner join kelas on ujian.id_kelas = kelas.id_kelas inner join guru on ujian.id_guru = guru.id_guru inner join pelajaran on ujian.id_pelajaran = pelajaran.id_pelajaran where id_ujianjawaban = '$id_ujian'");


                                                    ?>

                                                    <thead>
                                                        <tr>
                                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Siswa</th>
                                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jawaban Siswa</th>
                                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Waktu Submit</th>
                                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nilai</th>
                                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $no = 1;
                                                        while ($ujian = mysqli_fetch_array($queryujian)) : ?>
                                                            <tr>
                                                                <td class="align-middle text-center text-sm">
                                                                    <span class="text-secondary text-xs font-weight-bolds">
                                                                        <?= $ujian['nama_siswa'] ?>
                                                                    </span>
                                                                </td>
                                                                <td class="align-middle text-center text-sm">
                                                                    <span class="text-secondary text-xs font-weight-bolds">
                                                                        <a href="unduh_jawaban_ujian.php?file=<?= $ujian['jawaban'] ?>"><?= $ujian['jawaban'] ?></a>
                                                                    </span>
                                                                </td>
                                                                <td class="align-middle text-center text-sm">
                                                                    <span class="text-secondary text-xs font-weight-bolds">
                                                                        <?= $ujian['waktusubmit'] ?>
                                                                    </span>
                                                                </td>
                                                                <td class="align-middle text-center text-sm">
                                                                    <span class="text-secondary text-xs font-weight-bolds">
                                                                        <?= $ujian['nilai'] ?>
                                                                    </span>
                                                                </td>
                                                                <td class="align-middle text-center text-sm">
                                                                    <span class="badge badge-sm bg-gradient-info">
                                                                        <a class="text-white" href="#" data-bs-toggle="modal" data-bs-target="#modalnilai<?= $no ?>" id="<?= $ujian['id_ujian'] ?>">Nilai</a>
                                                                    </span>
                                                                </td>
                                                            </tr>
                                                            <div class="modal fade" id="modalnilai<?= $no ?>" tabindex="-1" role="dialog" aria-labelledby="ModalEdit" aria-hidden="true">
                                                                <form name="modal_popup" enctype="multipart/form-data" method="post">
                                                                    <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h6 class="modal-title" id="modal-title-default">Edit Ujian</h6>
                                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                                                    <span aria-hidden="true">×</span>
                                                                                </button>
                                                                            </div>
                                                                            <form action="" method="post">
                                                                                <div class="modal-body">
                                                                                    <div class="form-group">
                                                                                        <label>Nilai Ujian</label>
                                                                                        <input type="hidden" name="idjawaban" value="<?= $ujian['id_jawaban'] ?>">
                                                                                        <input class="form-control" type="number" name="nilaiujian" value="<?= $ujian['nilai'] ?>" required>
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
    $konek->query("UPDATE ujian_murid SET nilai='$_POST[nilaiujian]' WHERE id_jawaban='$_POST[idjawaban]'");
    echo "<script>alert('Nilai berhasil di Simpan');</script>";
    echo "<script>location='ujianjawaban.php?id_ujian=$_GET[id_ujian]';</script>";
}
?>
<?php
if (isset($_POST['hapusujian'])) {
    $konek->query("delete from ujian WHERE id_ujian='$_POST[idhapus]'");
    $konek->query("delete from ujian WHERE id_ujian='$_POST[idhapus]'");
    echo "<script>alert('Ujian berhasil di hapus');</script>";
    echo "<script>location='ujian.php';</script>";
}
?>
<div class="modal fade" id="ModalUjian" tabindex="-1" role="dialog" aria-labelledby="ModalUjianLabel" aria-hidden="true">
    <form name="modal_popup" enctype="multipart/form-data" method="post">

        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalUjianLabel">Tambah Ujian</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Tipe Ujian</label>
                        <select name="tipeujian" class="form-control" required>
                            <option value="UTS">UTS</option>
                            <option value="UAS">UAS</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Kelas</label>
                        <select name="kelas" class="form-control">
                            <?php
                            $kelas = $_GET['kode_kelas'];
                            $sql = $konek->query("SELECT * from kelas");
                            while ($data = $sql->fetch_assoc()) {
                                echo "<option value='$data[id_kelas]'>$data[nama_kelas]</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Guru</label>

                        <select name="guru" class="form-control" required>

                            <?php
                            $guru = $_SESSION['Id_User'];
                            $sql = $konek->query("select * from guru");
                            while ($data = $sql->fetch_assoc()) {
                                echo "<option value='$data[id_guru]'>$data[nama_guru]</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Pelajaran</label>

                        <select name="pelajaran" class="form-control" required>
                            <?php
                            $pelajaran = $_GET['kode_pelajaran'];

                            $sql = $konek->query("select * from pelajaran");
                            while ($data = $sql->fetch_assoc()) {
                                echo "<option value='$data[id_pelajaran]'>$data[nama_pelajaran]</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Soal Ujian</label>

                        <input name="ujian" type="file" class="form-control" placeholder="pembahasan" required>
                    </div>



                    <div class="form-group">
                        <label>Tanggal Ujian</label>
                        <input name="tanggalujian" type="date" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Waktu Mulai</label>
                        <input name="waktumulai" type="time" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Waktu Akhir</label>
                        <input name="waktuakhir" type="time" class="form-control" required>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Batal</button>
                    <button class="btn bg-gradient-primary" name="ujiansimpan" type="submit">Tambah</button>
                </div>
            </div>
        </div>
    </form>

</div>
<?php
if (isset($_POST['ujiansimpan'])) {

    $tipeujian            = $_POST["tipeujian"];
    $kelas          = $_POST["kelas"];
    $guru            = $_POST["guru"];
    $pelajaran       = $_POST["pelajaran"];
    $ujian        = $_FILES['ujian']['name'];
    $tanggalujian     = $_POST["tanggalujian"];
    $waktumulai     = $_POST["waktumulai"];
    $waktuakhir     = $_POST["waktuakhir"];
    $file_tmp       = $_FILES['ujian']['tmp_name'];

    $CEK = mysqli_query($konek, "select * from ujian where id_pelajaran = '$pelajaran' and id_kelas='$kelas' and tipeujian='$tipeujian' ");

    move_uploaded_file($file_tmp, '../file/' . $ujian);
    if ($add = mysqli_query($konek, "INSERT INTO ujian (tipeujian, id_kelas, id_guru, id_pelajaran, soal, tanggalujian, waktumulai, waktuakhir) VALUES 
	('$tipeujian', '$kelas', '$guru', '$pelajaran', '$ujian', '$tanggalujian', '$waktumulai', '$waktuakhir')")) {
        echo "<script> location.href='ujian.php'; </script>";
        exit();
    }
    die("Terdapat kesalahan : " . mysqli_error($konek));
}
?>
<!-- Modal Popup Plejaran Edit -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">

        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Upload Ujian</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn bg-gradient-primary">Upload</button>
            </div>
        </div>

    </div>
</div>
<!-- /Modal Popup Plejaran Edit -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


<script type="text/javascript">
    $(document).ready(function() {

        // Siswa
        $(".open_modal_uts").click(function(e) {
            var m = $(this).attr("id")

            $.ajax({
                url: "api_upload_ujian.php",
                type: "GET",
                data: {
                    Id_Jadwal: m,
                    tipe: 0
                },
                success: function(ajaxData) {
                    $("#exampleModal").html(ajaxData)
                    $("#exampleModal").modal('show', {
                        backdrop: 'true'
                    })
                }
            })

        })
        $(".open_modal_uas").click(function(e) {
            var m = $(this).attr("id")

            $.ajax({
                url: "api_upload_ujian.php",
                type: "GET",
                data: {
                    Id_Jadwal: m,
                    tipe: 1
                },
                success: function(ajaxData) {
                    $("#exampleModal").html(ajaxData)
                    $("#exampleModal").modal('show', {
                        backdrop: 'true'
                    })
                }
            })

        })
    });
</script>

<?php require '../comp/footer.php' ?>