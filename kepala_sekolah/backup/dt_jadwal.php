<thead style="text-align: center;">
	<tr>
		<th>Pelajaran</th>
		<th>Kelas</th>
		<th>Nama guru</th>
		<th>jam</th>
		<th>materi</th>
		<th>hari</th>
		<th>link gmeet</th>

	</tr>
</thead>
<tbody>
	<?php
	$queryjadwal = mysqli_query($konek, "select * from jadwal inner join pelajaran on jadwal.id_pelajaran = pelajaran.kode_pelajaran inner join kelas on jadwal.id_kelas = kelas.id_kelas inner join guru on jadwal.kode_guru = guru.kode_guru inner join hari on jadwal.hari = hari.id_hari  WHERE jadwal.kode_guru='$_SESSION[Id_User]'");
	if ($queryjadwal == false) {
		die("Terjadi Kesalahan : " . mysqli_error($konek));
	}
	while ($jadwal = mysqli_fetch_array($queryjadwal)) {

		echo "
								<tr>
									<td><a href='tugas.php?kode_pelajaran=$jadwal[id_pelajaran]&kode_kelas=$jadwal[id_kelas]'>$jadwal[nama_pelajaran]</a></td>
									<td>$jadwal[nama_kelas]</td>
									<td>$jadwal[Nama_guru]</td>
									<td>$jadwal[jam]</td>
									<td><a href=\"../Waka_Kurikulum/unduh_materi.php?file=$jadwal[Pembahasan]\">$jadwal[Pembahasan]</a></td>
									<td>$jadwal[nama_hari]</td>
									<td ><a href='$jadwal[link_gmeet]'>Masuk</a></a></td>
									
								</tr>";
	}
	?>
</tbody>