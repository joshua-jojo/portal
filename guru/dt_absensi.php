<thead>
	
					<tr>
						<th>id absen</th>
						<th>Nama siswa</th>
						<th>nama kelas</th>
						<th>pelajaran</th>
                        <th>tanggal</th>
						<th>status</th>
						<th>Action</th>
						
					</tr>
				</thead>
				<tbody>
					<?php
                  
						$querydosen = mysqli_query ($konek, " select DISTINCT id_presensi,nama,kode_kelas,jadwal.id_pelajaran,nama_kelas, nama_pelajaran,DATE_FORMAT(tanggal,'%d-%m-%Y') as tanggal,statuss from presensi inner join jadwal on presensi.id_pelajaran = jadwal.id_pelajaran inner join pelajaran on presensi.id_pelajaran = pelajaran.kode_pelajaran inner join kelas on presensi.kode_kelas = kelas.id_kelas where jadwal.kode_guru='$_SESSION[Id_User]' and jadwal.id_pelajaran = '$_POST[pelajaran]'");
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

<script>
	function cetak(){
		window.print();
	}
</script>