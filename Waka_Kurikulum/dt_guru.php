				<thead>
					<tr>
						<th>kode_Guru</th>
						<th>Nama guru</th>
						<th>Tanggal Lahir</th>
						<th>Jenis Kelamin</th>
						<th>Telpon</th>
						<th>Alamat</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$querydosen = mysqli_query($konek, "SELECT * FROM guru");
					if ($querydosen == false) {
						die("Terjadi Kesalahan : " . mysqli_error($konek));
					}
					while ($dosen = mysqli_fetch_array($querydosen)) {

						echo "
								<tr>
									<td>$dosen[id_guru]</td>
									<td>$dosen[nama_guru]</td>
									<td>$dosen[tanggal_lahir]</td>
									<td>
								";
						if ($dosen["gender"] == "L") {
							echo "Laki - laki";
						} else {
							echo "Perempuan";
						}
						echo "
									</td>
									<td>$dosen[no_hp]</td>
									<td>$dosen[alamat]</td>
									<td>
										<a href='#' class='open_modal' id='$dosen[kode_guru]'><button class='btn btn-warning'>Edit</button></a> |
										<a href='#' onClick='confirm_delete(\"dosen_delete.php?kode_guru=$dosen[kode_guru]\")'><button class='btn btn-danger'>Delete</button></a>
									</td>
								</tr>";
					}
					?>
				</tbody>