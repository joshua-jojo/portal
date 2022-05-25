<thead>
					<tr>
						<th>Kode Matakuliah</th>
						<th>Nama Matakuliah</th>
						<th>Pembahasan</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
                    
                        $id	= $_GET["id_tagihan"];
						$querymatakuliah = mysqli_query ($konek, "SELECT * FROM pelajaran");
						if($querymatakuliah == false){
							die ("Terdapat Kesalahan : ". mysqli_error($konek));
						}
						while($matakuliah = mysqli_fetch_array($querymatakuliah)){
							echo "
								<tr>
									<td>$matakuliah[kode_pelajaran]</td>
									<td><a href='tugas.php?kode_pelajaran=$matakuliah[kode_pelajaran]'>$matakuliah[nama_pelajaran]</a></td>
									<td><a href=''>$matakuliah[Pembahasan]</a></td>
									<td>
										<a href='#' class='open_modal' id='$matakuliah[kode_pelajaran]'>Edit</a> |
										<a href='#' onClick='confirm_delete(\"pelajaran_delete.php?kode_pelajaran=$matakuliah[kode_pelajaran]\")'>Delete</a>
									</td>
								</tr>";
						}
					?>
				</tbody>