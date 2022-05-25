<thead>
  <tr>
    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Siswa</th>
    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Mapel</th>
    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Kelas</th>
    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tugas</th>
    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">UTS</th>
    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">UAS</th>
    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
  </tr>
</thead>
<tbody>
  <?php
  // // $querynilai = mysqli_query($konek, "select DISTINCT kode_nilai,nama_pelajaran,Nama_siswa,nama_kls,tugas,uts,uas from nilai_siswa inner join jadwal on nilai_siswa.kode_pelajaran = jadwal.id_pelajaran inner join siswa on nilai_siswa.kode_siswa = siswa.nis inner join pelajaran on jadwal.id_pelajaran = pelajaran.kode_pelajaran inner join kelas on jadwal.id_kelas = kelas.id_kelas where jadwal.kode_guru = '$_SESSION[Id_User]'");
  // $querynilai = mysqli_query($konek, "SELECT * FROM nilai INNER JOIN jadwal ON nilai.id_pelajaran = jadwal.id_pelajaran INNER JOIN siswa ON nilai.id_siswa = siswa.nis INNER JOIN pelajaran ON jadwal.id_pelajaran = pelajaran.id_pelajaran INNER JOIN kelas ON jadwal.id_kelas = kelas.id_kelas WHERE jadwal.id_guru = '$_SESSION[Id_User]'");
  $querynilai = mysqli_query($konek, "select DISTINCT nilai.id_nilai, pelajaran.nama_pelajaran, siswa.nama_siswa, kelas.nama_kelas, nilai.tugas_siswa, nilai.uts_siswa, nilai.uas_siswa from nilai inner join jadwal on nilai.id_pelajaran = jadwal.id_pelajaran inner join siswa on nilai.id_siswa = siswa.nis inner join pelajaran on jadwal.id_pelajaran = pelajaran.id_pelajaran inner join kelas on jadwal.id_kelas = kelas.id_kelas where jadwal.id_guru = '$_SESSION[Id_User]'");
  if ($querynilai == false) {
    die("Terjadi Kesalahan : " . mysqli_error($konek));
  }
  ?>
  <?php while ($nilai = mysqli_fetch_array($querynilai)) : ?>

    <tr>
      <td class="align-middle text-sm">
        <span class="text-secondary text-xs font-weight-bolds" style="padding-left: 15px;">
          <?= $nilai['nama_siswa'] ?>
        </span>
      </td>
      <td class="align-middle text-sm">
        <span class="text-secondary text-xs font-weight-bolds">
          <?= $nilai['nama_pelajaran'] ?>
        </span>
      </td>
      <td class="align-middle text-center text-sm">
        <span class="text-xs font-weight-bold">
          <?= $nilai['nama_kelas'] ?>
        </span>
      </td>
      <td class="align-middle text-center text-sm">
        <span class="text-secondary text-xs font-weight-bolds">
          <?= $nilai['tugas_siswa'] ?>
        </span>
      </td>
      <td class="align-middle text-center text-sm">
        <span class="text-secondary text-xs font-weight-bolds">
          <?= $nilai['uts_siswa'] ?>
        </span>
      </td>
      <td class="align-middle text-center text-sm">
        <span class="text-secondary text-xs font-weight-bolds">
          <?= $nilai['uas_siswa'] ?>
        </span>
      </td>
      <td class="align-middle text-center text-sm">
        <span class="badge badge-sm bg-gradient-info">
          <a class="text-white open_modal" id="<?= $nilai['id_nilai'] ?>" data-bs-toggle="modal" data-bs-target="#ModalEdit">Edit</a>
        </span>
        <span class="badge badge-sm bg-gradient-danger">
          <a class="text-white" href="#" onclick="confirm_delete(`nilai_delete.php?id_nilai=<?= $nilai['id_nilai'] ?>`">Delete</a>
        </span>
      </td>
    </tr>
  <?php endwhile; ?>

</tbody>