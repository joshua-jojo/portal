				<thead>
					<tr>
						<th>Kode Ruangan</th>
						<th>Ruangan</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$queryruangan = mysqli_query ($konek, "SELECT * FROM kelas");
						
					
						
						if($queryruangan == false){
							die ("Terjadi Kesalahan : ". mysqli_error($konek));
						}
						while ($ruangan = mysqli_fetch_array ($queryruangan)){
							$q = mysqli_query ($konek, "SELECT * FROM siswa where kelas = '$ruangan[id_kelas]'");
							$temp = mysqli_fetch_array($q);
							echo "
								<tr>
									<td>$ruangan[id_kelas]</td>
									<td>$ruangan[nama_kelas]</td>
									<td>
										<a href='#' class='open_modal' id='$ruangan[id_kelas]'><button class='btn btn-warning'>Edit</button></a> 
										";
											if(mysqli_num_rows($q) > 0){
												echo "";
											}else{
												echo "| <a href='#' onClick='confirm_delete(\"kelas_delete.php?id_kelas=$ruangan[id_kelas]\")'><button class='btn btn-danger'>Delete</button></a>";
											}
									echo"
									</td>
								</tr>";
						}
					?>
				</tbody>