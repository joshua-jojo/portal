
				<tbody>
					<?php
                       
						$querydosen = mysqli_query ($konek, "select * from siswa where Nama_siswa = '$_SESSION[Username]'");
						if($querydosen == false){
							die ("Terjadi Kesalahan : ". mysqli_error($konek));
						}
						while ($tagihan = mysqli_fetch_array ($querydosen)){
							
							
							echo "
                                <tr>
                                    <td>nama</td>
                                    <td>$tagihan[Nama_siswa]</td>
                                </tr>
                                <tr>
                                    <td>Tanggal lahir</td>
                                    <td>$tagihan[Tanggal_Lahir]</td>
                                </tr>
                                <tr>
                                    <td>jenis kelamin</td>
                                    <td>
                                        ";
                                        if($tagihan["gender"] == "L"){
                                            echo "Laki - laki";
                                        }
                                        else{
                                            echo "Perempuan";
                                        }
                                    echo "
                                    </td>
                                </tr>";
                               
                                echo"
                                <tr>
                                    <td>nomor teelepon</td>
                                    <td>$tagihan[No_Telp]</td>
                                </tr>
                                <tr>
                                    <td>Alamat</td>
                                     <td>$tagihan[Alamat]</td>
                                </tr>
                                <tr>
                                    <td>Agama</td>
                                     <td>$tagihan[Agama]</td>
                                </tr>
                                <tr>
                                    <td>kelas</td>
                                     <td>$tagihan[nama_kls]</td>
                                </tr>";
						}
					?>
				</tbody>