<!-- File ini bikin baru tanpa merubah file yang lama -->
<!-- Semua sintaks di sini dibuat sendiri kak -->

<?php
$title = 'Jadwal';
$path = '../';
require '../comp/header.php';

session_start();
include "../koneksi.php";
include "auth_user.php";
?>
<style>
  #display_comment {
    overflow: auto;
    padding: 1rem;
  }

  fieldset {
    box-shadow: 0px 0px 10px rgba(0, 0, 0, .2);
    margin-bottom: 2rem;
    padding: 1rem;
    border-radius: 5px;
  }

  fieldset legend {
    font-size: 14px;
    font-weight: 700;
    color: royalblue;
  }

  fieldset .date {
    font-weight: 400;
    font-size: 12px;
  }
</style>

<body class="g-sidenav-show bg-gray-100">
  <!-- aside -->
  <?php require '../comp/sidebar.php' ?>
  <!--/ aside -->

  <!-- main content -->
  <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg">

    <!-- navbar -->
    <?php $title = 'Forum' ?>
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

                    <?php

                    $id = $_GET['kode_pelajaran'];
                    $kelas = $_GET['kode_kelas'];

                    $queryjadwal = mysqli_query($konek, "SELECT *  from jadwal inner join pelajaran on jadwal.id_pelajaran = pelajaran.id_pelajaran inner join kelas on jadwal.id_kelas = kelas.id_kelas where jadwal.id_pelajaran = '$id' and jadwal.id_kelas = '$kelas'");

                    $jadwal = mysqli_fetch_array($queryjadwal);

                    ?>

                    <h5 class="font-weight-bolder">Selamat datang di forum pelajaran <?= $jadwal['nama_pelajaran']; ?> kelas <?= $jadwal['nama_kelas']; ?> </h5>

                    <h3></h3>
                    <input type="hidden" id="id_kelas" value="<?php echo $kelas ?>">
                    <input type="hidden" id="id_pelajaran" value="<?php echo $id ?>">

                  </div>
                </div>

                <div class="col-12">

                  <span id="message"></span>

                  <div id="display_comment" class="border mb-4" style="height: 450px;">

                  </div>
                  <button type="button" class="btn bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#AddChat">
                    Tambah Komentar
                  </button>

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

<!-- Modal Add Chat -->
<div class="modal fade" id="AddChat" tabindex="-1" role="dialog" aria-labelledby="AddChatLabel" aria-hidden="true">

  <form method="POST" id="form_komen" name="modal_popup">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="AddChatLabel">Tambah Komentar</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

          <div class="form-group">
          </div>
          <input type="text" name="nama_pengirim" id="nama_pengirim" class="text-center form-control rounded-0 border-0" value="<?php echo $_SESSION['Username'] ?>" readonly />

          <input type="hidden" name="pelajaran" class="form-control" value="<?= $id; ?>" readonly />

          <input type="hidden" name="kelas" class="form-control" value="<?= $kelas; ?>" readonly />

          <input type="hidden" name="status" class="form-control" value="guru" readonly />

          <textarea name="komen" id="chat" class="form-control rounded-0 border-0" placeholder="Tulis Komentar" rows="5"></textarea>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn bg-gradient-primary" data-bs-dismiss="modal">Kirim</button>
        </div>
      </div>
    </div>
  </form>
</div>



<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
  $('#form_komen').on('submit', function(event) {
    event.preventDefault();
    let nama_pengirim = $('#nama_pengirim').val();
    let komen = $('#chat').val();

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

        console.log(data);


        $("#display_comment").html(data);

      },
      error: function(data) {
        console.log(data.responseText)
      }
    })

  }

  load_comment();

  // Fungsi Balas Chat
  $(document).on('click', '.reply', function() {
    console.log('jalan');

    let komentar_id = $(this).attr("id");
    $('#komentar_id').val(komentar_id);
  });

  $(document).on('submit', function() {

    $('#ModalAdd').modal('hide');
  });


  $(document).on('click', '.delete-reply', function() {
    let id_kelas = $('#id_kelas').val();
    let id_pelajaran = $('#id_pelajaran').val();
    let komentar_id = $(this).attr("id");

    console.log($('#komentar_id').val(komentar_id));

    $("#modal_delete").modal('show', {
      backdrop: 'static'
    });
    document.getElementById('delete_link').setAttribute('href', `reply_delete.php?komentar_id=${komentar_id}&kode_kelas=${id_kelas}&kode_pelajaran=${id_pelajaran}`);

  });
</script>

<?php require '../comp/footer.php' ?>