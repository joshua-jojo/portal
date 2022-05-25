				<thead>
					<tr>
						<th>Nama siswa</th>
						<th>nama pelajaran</th>
						<th>nama kelas</th>
						<th>tugas</th>
						<th>Uts</th>
						<th>Uas</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$querynilai = mysqli_query ($konek, "select DISTINCT kode_nilai,nama_pelajaran,Nama_siswa,nama_kls,tugas,uts,uas from nilai_siswa inner join jadwal on nilai_siswa.kode_pelajaran = jadwal.id_pelajaran inner join siswa on nilai_siswa.kode_siswa = siswa.nis inner join pelajaran on jadwal.id_pelajaran = pelajaran.kode_pelajaran inner join kelas on jadwal.id_kelas = kelas.id_kelas where jadwal.kode_guru = '$_SESSION[Id_User]'");
						if($querynilai == false){
							die ("Terjadi Kesalahan : ". mysqli_error($konek));
						}
						while ($nilai = mysqli_fetch_array ($querynilai)){
							
							echo "
								<tr>
									<td>$nilai[Nama_siswa]</td>
									<td>$nilai[nama_pelajaran]</td>
									<td>$nilai[nama_kls]</td>
									<td>$nilai[tugas]</td>
									<td>$nilai[uts]</td>
									<td>$nilai[uas]</td>
									<td>
										<a href='#' class='open_modal' id='$nilai[kode_nilai]'><button class='btn btn-warning'>Edit</button></a> |
										<a href='#' onClick='confirm_delete(\"nilai_delete.php?kode_nilai=$nilai[kode_nilai]\")'><button class='btn btn-danger'>Delete</button></a>
									</td>
								</tr>";
						}
					?>
				</tbody>