<?php

include "../koneksi.php";


$tamp = $_POST['tamp'];

$sql = "SELECT *
    FROM siswa
    where kelas = '$tamp'";
$result = mysqli_query($konek, $sql);
if (mysqli_num_rows($result) > 0) {
?>
 <div class="form-group">
                                    <label>siswa</label>
									<div class="input-group">
                                        <div class="input-group-addon">
											<i class="fa fa-graduation-cap"></i>
										</div>
										<select name="siswa" class="form-control" id="abs_kelas">
                                            <option value="">pilih siswa</option>
											<?php
											while ($data = $result->fetch_assoc()) {
                                                echo "<option value='$data[NIS]'>$data[Nama_siswa]</option>";
											}
											?>
										</select>
									</div>
</div>
<?php
} else {
  
}

?>
