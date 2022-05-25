				<thead>
					<tr>
						<th>Pelajaran</th>
						<th>kelas</th>
						<th>pengajar</th>
						<th>jam</th>
						<th>Hari</th>
						<!-- <th>Jam</th> -->
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$queryjadwal = mysqli_query ($konek, "select kode_pelajaran,jadwal.id_kelas,Id_Jadwal,nama_pelajaran,nama_kelas,Nama_guru,jam,nama_hari from jadwal inner join pelajaran on  jadwal.id_pelajaran = pelajaran.kode_pelajaran inner join kelas on jadwal.id_kelas = kelas.id_kelas inner join guru on jadwal.kode_guru = guru.kode_guru inner join hari on jadwal.hari = hari.id_hari order by jadwal.id_kelas");
						if($queryjadwal == false){
							die ("Terjadi Kesalahan : ". mysqli_error($konek));
						}
						while ($jadwal = mysqli_fetch_array ($queryjadwal)){
							
							echo "
								<tr>
									<td><a href='tugas.php?kode_pelajaran=$jadwal[kode_pelajaran]&nama_guru=$jadwal[Nama_guru]&kode_kelas=$jadwal[id_kelas]'>$jadwal[nama_pelajaran]</a></td>
									<td>$jadwal[nama_kelas]</td>
									<td>$jadwal[Nama_guru]</td>
									<td>$jadwal[jam]</td>
									<td>$jadwal[nama_hari]</td>
									<td>
										<a href='#' class='open_modal' id='$jadwal[Id_Jadwal]'><button class='btn btn-warning'>Edit</button></a> |
										<a href='#' onClick='confirm_delete(\"jadwal_delete.php?Id_Jadwal=$jadwal[Id_Jadwal]&kode_pelajaran=$jadwal[kode_pelajaran]\")'><button class='btn btn-danger'>Delete</button></a>
									</td>
								</tr>";
						}
					?>
				</tbody>