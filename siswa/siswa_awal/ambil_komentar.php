<?php
session_start();
include '../koneksi.php';

$id	= $_GET['kode_pelajaran'];
$kelas	= $_GET['kode_kelas']; 

$output= "";

$query = "SELECT DISTINCT komentar_id,parent_komentar_id,komentar,status,nama_pengirim,id_pelajaran,kode_kelas,date FROM forum inner join pelajaran on forum.id_pelajaran = pelajaran.kode_pelajaran WHERE parent_komentar_id= 0 and forum.id_pelajaran = '$id' and forum.kode_kelas = '$kelas' ORDER BY komentar_id ASC ";
$dewan1 = $konek->prepare($query);
$dewan1->execute();
$res1 = $dewan1->get_result();
while ($row = $res1->fetch_assoc()) {
    echo "

  <fieldset class='$row[status]'>
    <legend>$row[nama_pengirim]</legend>
        <table id='data'>
        <tr>
        <td width='800px'><p class='isi-komen'>
        $row[komentar]
        </p></td>
        
        <td style='width:100px; padding-left:10px;' valign='top'><div style='margin-top:-20px; margin-bottom:15px;'>$row[date]</div></td>
    </tr>
    <tr>
        <td></td>
        <td valign='top'><div class='col-sm-2' style='margin-top:0px; margin-left:-5px ; margin-right:10px; margin-bottom:10px;'>
    <button type='button' class='btn btn-primary reply' data-target='#ModalAdd' data-toggle='modal' id='$row[komentar_id]'>Reply &nbsp;<i class='mt-5 fa fa-reply'></i></button>

  </div></td>

  </div></td>
  
    </tr>
    
        </table>
  </fieldset>
    ";
  $output .= ambil_reply($konek, $row["komentar_id"]);

  
  // echo $row['komentar_id'];
}
 
// echo json_encode([$output]);
 
// kasih echo di ambil_reply, jangan $output itu jelek.
// kalau masih ga bisa cek satu satu coba keluarin pake table tr td
// kalau bisa yaudah.
// tinggal bagusin css doang.
 
function ambil_reply($konek, $parent_id = 0, $marginleft = 0){


  $output='';
  // $query = "SELECT * FROM tbl_komentar WHERE parent_komentar_id=?";
  $query = "SELECT DISTINCT  komentar_id,parent_komentar_id,komentar,status,nama_pengirim,id_pelajaran,kode_kelas,date FROM forum WHERE parent_komentar_id=? ";
  $dewan1 = $konek->prepare($query);
  $dewan1->bind_param("s", $parent_id);
  $dewan1->execute();
  $res1 = $dewan1->get_result();
 
  $count = $res1->num_rows;
  if($parent_id == 0) {
    $marginleft = 0;
  } else {
    $marginleft = $marginleft + 100;
  }
 
  $tingkat = $marginleft/100+1;
  
  if($count > 0){
    while ($row = $res1->fetch_assoc()) {
      $output .= '

      <fieldset style="margin-left:'.$marginleft.'px;" class='.$row['status'].'>
      <legend>'.$row['nama_pengirim'].'</legend>
          <table>
          <tr>
          <td width="800px"><p id="isi-komen" value='.$row['komentar'].'>
          '.$row['komentar'].'
          </p></td>
          
          <td style="width:100px; padding-left:10px;" valign="top"><div style="margin-top:-20px; margin-bottom:15px;">'.$row['date'].'</div></td>
      </tr>
      <tr>
          <td></td>
          <td valign="top" ><div class="col-sm-2" style="margin-top:0px; margin-left:-5px ; margin-right:10px; margin-bottom:10px;">
      <button type="button" class="btn btn-primary reply "  data-target="#ModalAdd" data-toggle="modal" id='.$row['komentar_id'].'>Reply &nbsp;<i class="mt-5 fa fa-reply"></i></button>
    </div></td>
    
  <td>
 
  </td>
      </tr>
      
          </table>
    </fieldset>

        ';
        // if($tingkat < 4){
        //   $output .= '
        //       <div class="col-sm-2" align="right" style="margin-top:0px; margin-left:-5px ; margin-bottom:10px;">
        //         <button type="button" class="btn btn-primary reply" id="'.$row["komentar_id"].'">Reply</button>
        //       </div>';
        // }
        
 
        $output .= '    
          </div>
          </div>
        </div>
      ';
      echo $output;
      $output .= ambil_reply($konek, $row["komentar_id"], $marginleft);
    }
  }
 
}
?>


<script>
 
</script>