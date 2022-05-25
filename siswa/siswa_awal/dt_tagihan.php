
<thead>
					<tr>
						<th>nama kelas</th>
						<th>nama siswa</th>
						<th>tanggal jatuh tempo</th>
						<th>nomor rekening</th>
						<th>pembayaran bulan</th>
						<th>catatan</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
                     
						
						$querydosen1 = mysqli_query ($konek, "select kelas from siswa where nis = '$_SESSION[Id_User]'");
						$res = mysqli_fetch_array($querydosen1);
						
						$res1 = $res['kelas'];

						
						$querydosen = mysqli_query ($konek, "select nama_kelas,no_rekening,id_tagihan,nama_kls,Nama_siswa,DATE_FORMAT(tanggal, '%d-%m-%Y')as jatuh_tempo,nama_bulan as pembayaran_bulan , catatan from tagihan inner join kelas on tagihan.kode_kelas = kelas.id_kelas inner join siswa on tagihan.id_siswa = siswa.NIS inner join bulan on tagihan.id_bulan = bulan.id_bulan_spp where siswa.nis = '$_SESSION[Id_User]' and tagihan.kode_kelas = '$res1'");
						if($querydosen == false){
							die ("Terjadi Kesalahan : ". mysqli_error($konek));
						}
						
						$test = mysqli_num_rows($querydosen);

						if($test < 1){
							echo "<div class='alert alert-info'>Saat ini belum ada tagihan buat kamu...</div>";
						}else{
							while ($tagihan = mysqli_fetch_array ($querydosen)){
							
								echo "
									<tr>
										<td>$tagihan[nama_kelas]</td>
										<td>$tagihan[Nama_siswa]</td>
										<td>$tagihan[jatuh_tempo]</td>
										<td>$tagihan[no_rekening]</td>
									";
								echo "
										<td>$tagihan[pembayaran_bulan]</td>
										<td>
										";
											if($tagihan['catatan'] === 'lunas'){
												echo "<p style='text-transform:uppercase; color:green; font-size:18px'>$tagihan[catatan]</p>";
											}else{
												echo "<p style='text-transform:uppercase; color:red;'>$tagihan[catatan]</p>";
											}

										echo"
										</td>
										<td>
									";
										if($tagihan['catatan'] === 'belum lunas'){
											echo "<a href='#' class='open_modal' id='$tagihan[id_tagihan]'><button class='btn btn-success'>Upload</button></a>";
										}else{
											echo "<a href='#'><button class='btn btn-info'>sudah masuk..</button></a>";
										}

									echo"
										</td>
									</tr>";
							}
						}
					?>
				</tbody>