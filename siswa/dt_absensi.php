<thead>
  <tr>
    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Siswa</th>
    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Kode Kelas</th>
    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Pelajaran</th>
    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tanggal</th>
    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>

  </tr>
</thead>
<tbody>
  <?php
  $id = $_POST['pelajaran'];

  // $querydosen = mysqli_query($konek, "select * from absensi inner join kelas on presensi.kode_kelas = kelas.id_kelas inner join pelajaran on presensi.id_pelajaran = pelajaran.kode_pelajaran where nama = '$_SESSION[Username]' and pelajaran.kode_pelajaran = '$id'");
  $querydosen = mysqli_query($konek, "select * from absensi inner join kelas on absensi.id_kelas = kelas.id_kelas inner join pelajaran on absensi.id_pelajaran = pelajaran.id_pelajaran where nama_siswa = '$_SESSION[Username]' and pelajaran.id_pelajaran = '$id'");
  if ($querydosen == false) {
    die("Terjadi Kesalahan : " . mysqli_error($konek));
  }
  if (mysqli_num_rows($querydosen) > 0) :
  ?>
    <?php while ($absen = mysqli_fetch_array($querydosen)) : ?>

      <tr>
        <td class="align-middle text-sm">
          <span class="text-secondary text-xs font-weight-bolds">
            <?= $absen['nama_siswa'] ?>
          </span>
        </td>
        <td class="align-middle text-center text-sm">
          <span class="text-xs font-weight-bold">
            <?= $absen['nama_kelas'] ?>
          </span>
        </td>
        <td class="align-middle text-center text-sm">
          <span class="text-secondary text-xs font-weight-bolds">
            <?= $absen['nama_pelajaran'] ?>
          </span>
        </td>
        <td class="align-middle text-center text-sm">
          <span class="text-secondary text-xs font-weight-bolds">
            <?= $absen['tanggal'] ?>
          </span>
        </td>

        <td class="align-middle text-center text-sm">
          <span class="badge badge-sm bg-gradient-info">
            <?= $absen['status'] ?>
          </span>
        </td>
      </tr>
    <?php endwhile; ?>
  <?php endif; ?>

</tbody>