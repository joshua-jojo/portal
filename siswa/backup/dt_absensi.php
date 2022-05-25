<thead>
					<tr>
						
						<th>Nama siswa</th>
						<th>kode kelas</th>
						<th>pelajaran</th>
                        <th>tanggal</th>
						<th>status</th>
						
						
					</tr>
				</thead>
				<tbody>
					<?php
						$id = $_POST['pelajaran'];

						$querydosen = mysqli_query ($konek, "select * from presensi inner join kelas on presensi.kode_kelas = kelas.id_kelas inner join pelajaran on presensi.id_pelajaran = pelajaran.kode_pelajaran where nama = '$_SESSION[Username]' and pelajaran.kode_pelajaran = '$id'");
						if($querydosen == false){
							die ("Terjadi Kesalahan : ". mysqli_error($konek));
						}
						if(mysqli_num_rows($querydosen) > 0){
							while ($absen = mysqli_fetch_array ($querydosen)){
							
								echo "
									<tr>
										<td>$absen[nama]</td>
										<td>$absen[nama_kelas]</td>
										<td>$absen[nama_pelajaran]</td>
									";
									
								echo "
										</td>
										<td>$absen[tanggal]</td>
										<td>$absen[statuss]</td>
										
									</tr>";
							}
						}else{
							echo "";
						}
						
					?>
				</tbody>