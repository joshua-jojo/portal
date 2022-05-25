<?php {
}
session_start();
include "../koneksi.php";
include "auth_user.php";
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>SMA</title>
    <!-- Icon -->

    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="../aset/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../aset/fa/css/font-awesome.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="../aset/plugins/datatables/dataTables.bootstrap.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../aset/dist/css/AdminLTE.min.css">


    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="../aset/dist/css/skins/_all-skins.min.css">
    <script src="../aset/plugins/jQuery/jQuery-2.1.4.min.js"></script>
</head>
<style>
    .content-header {
        margin: 0px 50px;
    }

    /* #iseng{
           border: 1px solid black;
           margin-bottom: 10px;
           margin-right: 100px;
        }

        #button-reply{
            margin-top: 10px;
        } */

    #display_comment {
        overflow: auto;
    }
    fieldset {
        border: 1px solid #002E6F;
        margin-right: 10%;
        margin-top: 30px;
        margin-left: 6%;
                            
    }

    .guru{
        background-color: #A9E3F9;
    }

    .murid{
        background-color: #f4f4f4;
    }

    
    legend {
        background-color: #002E6F;
        color: white;
        border: none;
        width: auto;
        border-radius: 3px;
        padding: 0px 10px;
        font-size: 16px;
        margin-top: 10px;
        margin-left: 7px;

    }

    .isi-komen {
        margin-left: 13px;
        margin-top: -10px;
        text-align: justify;
        padding-right: 10px;
        
    }

    #display_comment{
        height: 500px;

        overflow: auto;
    }

    .hidden{
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
        include "content_header.php";
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

                    <li><a href="index.php"><span>Dashboard</span></a></li>
                    <li class="active"><a href="jadwal.php"> <span>Jadwal</span></a></li>
                    <li><a href="nilai.php"><span>Nilai Mahasiswa</span></a></li>
                    <li><a href="tagihan.php"><span>Tagihan</span></a></li>
                    <li><a href="absensi.php"><span>Absensi</span></a></li>
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

          


                <?php

                $id = $_GET['kode_pelajaran'];
                $kelas = $_GET['kode_kelas'];
                $queryjadwal = mysqli_query($konek, "select nama_pelajaran, nama_kelas from jadwal inner join pelajaran on jadwal.id_pelajaran = pelajaran.kode_pelajaran inner join kelas on jadwal.id_kelas = kelas.id_kelas where jadwal.id_pelajaran = '$id' and jadwal.id_kelas = '$kelas'");

                $jadwal = mysqli_fetch_array($queryjadwal)

                ?>
                <h3>Selamat datang di forum pelajaran <?= $jadwal['nama_pelajaran']; ?> kelas <?= $jadwal['nama_kelas']; ?> </h3>
                <input type="hidden" id="id_kelas" value="<?php echo $kelas ?>">
                <input type="hidden" id="id_pelajaran" value="<?php echo $id ?>">
                
                <a href="#"><button class="btn btn-info" style="margin-top: 10px;" type="button" data-target="#ModalAdd" data-toggle="modal">Reply &nbsp;<i class="mt-5 fa fa-reply"></i></button></a>
            </section>

            <!-- Main content -->


            <div id="ModalAdd" class="modal fade" tabindex="-1" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Tambah pertanyaan</h4>
                        </div>
                        <div class="modal-body">
                            <form method="POST" id="form_komen" name="modal_popup">
                                <div class="form-group">
                                </div>
                                <input type="text" name="nama_pengirim" id="nama_pengirim" class="form-control" value="<?php echo $_SESSION['Username']?>" readonly />
                                <input type="hidden" name="pelajaran" class="form-control" value="<?php echo $id; ?>" readonly />
                                <input type="hidden" name="kelas" class="form-control" value="<?php echo $kelas; ?>" readonly />
                                <input type="hidden" name="status" class="form-control" value="murid" readonly />
                                <div class="form-group">
                                    <textarea name="komen" id="komen" class="form-control" placeholder="Tulis Komentar" rows="5"></textarea>
                                </div>
                                
                                <div class="modal-footer">
                                <input type="hidden" name="komentar_id" id="komentar_id" value="0" />
								<button class="btn btn-info" type="submit" name="submit" class="submit">
									reply
								</button>
								<button type="reset" class="btn btn-danger" data-dismiss="modal" aria-hidden="true">
									Cancel
								</button>
							</div>
                            </form>
                        </div>
                    </div>




<!-- berarti gue kasih gua kasih ae 4 halaman cukup. -->
                    


                </div>
            </div>
            <span id="message"></span> 

            <div id="display_comment">
              
            </div>



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

            
<script>

 
</script>


            <script>
                $(document).ready(function() {
                    //Mengirimkan Token Keamanan

                    $('#form_komen').on('submit', function(event) {
                        event.preventDefault();
                        let nama_pengirim = $('#nama_pengirim').val();
                        let komen = $('#komen').val();

                        if (nama_pengirim == '') {
                            alert("Nama Pengirim Harus disii");
                        } else if (komen == '') {
                            alert("Komentar Harus disii");
                        } else {
                            var form_data = $(this).serialize();
                            $.ajax({
                                url: "tambah_komentar.php",
                                method: "POST",
                                data: form_data,
                                success: function(data) {
                                    $('#form_komen')[0].reset();
                                    $('#komentar_id').val('0');
                                    load_comment();
                                },
                                error: function(data) {
                                    console.log(data.responseText)
                                }
                            })
                        }
                    });

                   
                    
                   
                    function load_comment() {
                        let id_kelas = $('#id_kelas').val();
                        let id_pelajaran = $('#id_pelajaran').val();

                        console.log(id_kelas, id_pelajaran);
                        $.ajax({
                            url: `ambil_komentar.php?kode_kelas=${id_kelas}&kode_pelajaran=${id_pelajaran}`,
                            method: "POST",
                            success: function(data) {
                              
                                $("#display_comment").html(data);
                             
                            },
                            error: function(data) {
                                console.log(data.responseText)
                            }
                        })
                        
                    }

                    load_comment();
                 
                    $(document).on('click', '.reply', function() {
                        let komentar_id = $(this).attr("id");
                        $('#komentar_id').val(komentar_id);
                        // $('#nama_pengirim').focus();
                        
                       
                        // console.log(komentar_id);
                        // console.log($('#komentar_id').val(komentar_id));

                    
    
                    });

                    $(document).on('submit',function() {
                      
                        $('#ModalAdd').modal('hide');
                    });

                    

                   

                    $(document).on('click', '.delete-reply', function() {
                        let id_kelas = $('#id_kelas').val();
                        let id_pelajaran = $('#id_pelajaran').val();
                        let komentar_id = $(this).attr("id");
                        // $('#komentar_id').val(komentar_id);
                        // $('#nama_pengirim').focus();

                        console.log(komentar_id);
                        console.log($('#komentar_id').val(komentar_id));

                        $("#modal_delete").modal('show', {
                            backdrop: 'static'
                        });
                        document.getElementById('delete_link').setAttribute('href', `reply_delete.php?komentar_id=${komentar_id}&kode_kelas=${id_kelas}&kode_pelajaran=${id_pelajaran}`);

                    });

                });
            </script>
            <!-- jQuery 2.1.4 -->
            <!-- Bootstrap 3.3.5 -->
            <script src="../aset/bootstrap/js/bootstrap.min.js"></script>
            <!-- DataTables -->
            <script src="../aset/plugins/datatables/jquery.dataTables.min.js"></script>
            <script src="../aset/plugins/datatables/dataTables.bootstrap.min.js"></script>
            <!-- SlimScroll -->
            <script src="../aset/plugins/slimScroll/jquery.slimscroll.min.js"></script>
            <!-- FastClick -->
            <script src="../aset/plugins/fastclick/fastclick.min.js"></script>
            <!-- AdminLTE App -->
            <script src="../aset/dist/js/app.min.js"></script>
</body>

</html>