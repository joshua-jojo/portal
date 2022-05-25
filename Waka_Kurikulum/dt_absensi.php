<thead>
					<tr>
						<th>id absen</th>
						<th>Nama siswa</th>
						<th>kode kelas</th>
						<th>pelajaran</th>
                        <th>tanggal</th>
						<th>status</th>
						<th>action</th>
						
					</tr>
				</thead>
				<tbody>
					<?php
						$querydosen = mysqli_query ($konek, "SELECT id_presensi, nama, nama_pelajaran, DATE_FORMAT(tanggal, '%d-%m-%Y')as tanggal, nama_kelas, id_pelajaran, statuss , kode_kelas FROM presensi inner join kelas on presensi.kode_kelas = kelas.id_kelas inner join pelajaran on presensi.id_pelajaran = pelajaran.kode_pelajaran order by kode_kelas");
						if($querydosen == false){
							die ("Terjadi Kesalahan : ". mysqli_error($konek));
						}
						while ($absen = mysqli_fetch_array ($querydosen)){
							
							echo "
								<tr>
									<td>$absen[id_presensi]</td>
									<td>$absen[nama]</td>
									<td>$absen[nama_kelas]</td>
								";
								
							echo "
									</td>
									<td>$absen[nama_pelajaran]</td>
									<td>$absen[tanggal]</td>
									<td>$absen[statuss]</td>
									<td>
										<a href='#' class='open_modal' id='$absen[id_presensi]'><button class='btn btn-warning'>edit</button></a>
										<a href='#' onClick='confirm_delete(\"hapus_absensi.php?id=$absen[id_presensi]\")'><button class='btn btn-danger'>Delete</button></a>
									</td>
								</tr>";
						}
					?>
</tbody>