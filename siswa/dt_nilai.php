				<thead>
					<tr>
						<th>Nama siswa</th>
						<th>Pelajaran</th>
						<th>Tugas</th>
						<th>UTS</th>
						<th>UAS</th>
					</tr>
				</thead>
				<tbody>
					<?php
						
						$querynilai = mysqli_query ($konek, "select kode_siswa, kode_nilai,Nama_siswa, nama_pelajaran, tugas,uts,uas from nilai_siswa inner join pelajaran on nilai_siswa.kode_pelajaran = pelajaran.kode_pelajaran inner join siswa on nilai_siswa.kode_siswa = siswa.nis where kode_siswa = '$_SESSION[Id_User]'");
						if($querynilai == false){
							die ("Terjadi Kesalahan : ". mysqli_error($konek));
						}
						while ($nilai = mysqli_fetch_array ($querynilai)){
							
							echo "
								<tr>
									<td>$nilai[Nama_siswa]</td>
									<td>$nilai[nama_pelajaran]</td>
									<td>$nilai[tugas]</td>
									<td>$nilai[uts]</td>
									<td>$nilai[uas]</td>
								</tr>";
						}
					?>
				</tbody>