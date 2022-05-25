				<thead>
					<tr>
						<th>Nama Pelajaran</th>
						<th>Nama Guru</th>
						<th>Kelas</th>
						<th>Hari</th>
						<th>Jam</th>
						<th>Materi</th>
						<th>link</th>
					</tr>
				</thead>
				<tbody>
					<?php
						
				
							
							$queryjadwal = mysqli_query ($konek, "select id_kelas,id_pelajaran,pembahasan,nama_pelajaran,nama_kls, nama_hari, link_gmeet, Nama_guru,jam from jadwal inner join siswa on jadwal.id_kelas = siswa.kelas inner join pelajaran on jadwal.id_pelajaran = pelajaran.kode_pelajaran inner join hari on jadwal.hari = hari.id_hari inner join guru on jadwal.kode_guru = guru.kode_guru where siswa.nis ='$_SESSION[Id_User]'");
							if($queryjadwal == false){
								die ("Terjadi Kesalahan : ". mysqli_error($konek));
							}
							while ($jadwal = mysqli_fetch_array ($queryjadwal)){
							
								echo "
									<tr>
										<td><a href='tugas.php?kode_pelajaran=$jadwal[id_pelajaran]&kode_kelas=$jadwal[id_kelas]'>$jadwal[nama_pelajaran]</a></td>
										<td>$jadwal[Nama_guru]</td>
										<td>$jadwal[nama_kls]</td>
										<td>$jadwal[nama_hari]</td>
										<td>$jadwal[jam]</td>
										<td><a href=\"unduh_materi.php?file=$jadwal[pembahasan]\">$jadwal[pembahasan]</a></td>
										<td><a href='$jadwal[link_gmeet]'>Gabung</a></td>
									</tr>";
							}
							
						
					
						
					?>
				</tbody>