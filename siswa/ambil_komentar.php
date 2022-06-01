<?php
session_start();
include '../koneksi.php';

$id  = $_GET['kode_pelajaran'];
$kelas  = $_GET['kode_kelas'];

$output = "";

$query = "SELECT * FROM forum inner join pelajaran on forum.id_pelajaran = pelajaran.id_pelajaran WHERE id_comment_parent = 0 and forum.id_pelajaran = '$id' and forum.id_kelas = '$kelas' ORDER BY id_comment ASC";
$dewan1 = $konek->prepare($query);
$dewan1->execute();
$res1 = $dewan1->get_result();

while ($row = $res1->fetch_assoc()) {
  if ($row['status'] == 'guru') {
    $warna = "#cceeff";
  } else {
    $warna = "white";
  }
  echo "

  <fieldset class='$row[status]' style='background-color:$warna;'>
    <legend class='text-primary'>$row[nama_user]</legend>
        <table id='data'>
        <tr>
        <td width='800px'><p class='isi-komen'>
        $row[comment] aaaaaaaaaaa
        </p></td>
        
        <td style='width:100px; padding-left:10px;' valign='top' class='date'><div style='margin-top:-20px; margin-bottom:15px;'>$row[tanggal]</div></td>
       
        <td valign='top'><div class='col-sm-2' style='margin-top:0px; margin-left:-5px ; margin-right:10px; margin-bottom:10px;'>
        <button type='button' class='btn bg-gradient-info reply' id=" . $row['id_comment'] . " data-bs-toggle='modal' data-bs-target='#ModalAdd'>
        Reply <i class='fa fa-reply'></i>

        </div></td>
  <td valign='top'><div class='col-sm-2' style='margin-top:0px; margin-left:30px ; margin-bottom:10px;'>
  <button type='button' class='btn btn-danger delete-reply' id='$row[id_comment]' data-bs-toggle='modal' data-bs-target='#modal_delete'>Delete <i class='fa fa-trash'></i></button>
  </div></td>
  
    </tr>
    
        </table>
  </fieldset>
    ";
  $output .= ambil_reply($konek, $row["id_comment"]);
}

function ambil_reply($konek, $parent_id = 0, $marginleft = 0)
{


  $output = '';
  // $query = "SELECT * FROM tbl_komentar WHERE parent_komentar_id=?";
  // $query = "SELECT DISTINCT  komentar_id,parent_komentar_id,komentar,status,nama_pengirim,id_pelajaran,kode_kelas,date FROM forum WHERE parent_komentar_id=? ";
  $query = "SELECT * FROM forum WHERE id_comment_parent=? ";
  $dewan1 = $konek->prepare($query);
  $dewan1->bind_param("s", $parent_id);
  $dewan1->execute();
  $res1 = $dewan1->get_result();

  $count = $res1->num_rows;
  if ($parent_id == 0) {
    $marginleft = 0;
  } else {
    $marginleft = $marginleft + 100;
  }


  $tingkat = $marginleft / 100 + 1;

  if ($count > 0) {
    while ($row = $res1->fetch_assoc()) {
      if ($row['status'] == 'guru') {
        $warna = "#cceeff";
      } else {
        $warna = "white";
      }
      $output .= '

      <fieldset style="margin-left:' . $marginleft . 'px;background-color:' . $warna . ';" class=' . $row['status'] . '>
      <legend class="text-primary">' . $row['nama_user'] . '</legend>
          <table>
          <tr>
          <td width="800px"><p id="isi-komen">
          ' . $row['comment'] . '
          </p></td>
          
          <td style="width:100px; padding-left:10px;" valign="top" class="date"><div style="margin-top:-20px; margin-bottom:15px;">' . $row['tanggal'] . '</div></td>
      
          <td></td>
          <td valign="top" ><div class="col-sm-2" style="margin-top:0px; margin-left:-5px ; margin-right:10px; margin-bottom:10px;">
     
          <button type="button" class="btn bg-gradient-primary reply" id=' . $row['id_comment'] . ' data-bs-toggle="modal" data-bs-target="#ModalAdd">
          Reply <i class="fa fa-reply"></i>
          </button>
          
    </div></td>
    <td valign="top"><div class="col-sm-2" style="margin-top:0px; margin-left:30px ; margin-bottom:10px;">
    <button type="button" class="btn btn-danger delete-reply"  id=' . $row['id_comment'] . ' data-bs-toggle="modal" data-bs-target="#modal_delete">Delete <i class="fa fa-trash"></i></button>
    </div></td>
    
  <td>
 
  </td>
      </tr>
      
          </table>
    </fieldset>

        ';

      $output .= '    
          </div>
          </div>
        </div>
      ';
      echo $output;
      $output .= ambil_reply($konek, $row["id_comment"], $marginleft);
    }
  }
}

?>



<!-- Modal -->
<div class="modal fade" id="ModalAdd" tabindex="-1" role="dialog" aria-labelledby="ModalAddLabel" aria-hidden="true">
  <form method="POST" id="form_komen">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Balas</h5>
          <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <input type="text" name="nama_pengirim" id="nama_pengirim" class="form-control mb-2 rounded-0 border-0" value="<?php echo $_SESSION['Username'] ?>" readonly />

          <input type="hidden" name="pelajaran" class="form-control" value="<?php echo $id; ?>" readonly />

          <input type="hidden" name="kelas" class="form-control" value="<?php echo $kelas; ?>" readonly />

          <input type="hidden" name="status" class="form-control" value="guru" readonly />

          <textarea rows="5" id="komen" class="form-control" name="komen" placeholder="Tulis Komentar.."></textarea>
          <script>
            CKEDITOR.replace('komen');
          </script>
        </div>
        <div class="modal-footer">
          <input type="hidden" name="komentar_id" id="komentar_id" value="0" />

          <button type="submit" class="btn bg-gradient-primary" onclick="updateAllMessageForms()" data-bs-dismiss="modal">Balas</button>
        </div>
      </div>
    </div>
  </form>
</div>
<div class="modal fade" id="modal_delete">
  <div class="modal-dialog">
    <div class="modal-content" style="margin-top:100px;">
      <div class="modal-header">
        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 style="text-align:center;">Apakah anda yakin ingin menghapus komentar ini</h4>
      </div>
      <div class="modal-footer" style="margin:0px; border-top:0px; text-align:center;">
        <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Batal</button>
        <a href="#" class="btn btn-danger" id="delete_link">Delete</a>
      </div>
    </div>
  </div>
</div>
<script>
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
</script>