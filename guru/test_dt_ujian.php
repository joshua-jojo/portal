<thead>
  <tr>
    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Siswa</th>
    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Mapel</th>
    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jawaban UTS</th>
    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jawaban UAS</th>
    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
  </tr>
</thead>
<tbody>
  <?php
  $querynilai = mysqli_query($konek, "SELECT pelajaran.id_pelajaran, pelajaran.nama_pelajaran, siswa.NIS, siswa.nama_siswa, ujian_murid.uts, ujian_murid.uas , nilai.uts_siswa, nilai.uas_siswa, nilai.id_nilai
  FROM ujian_murid 
  LEFT JOIN jadwal ON jadwal.id_jadwal = ujian_murid.id_jadwal 
  LEFT JOIN pelajaran ON pelajaran.id_pelajaran = jadwal.id_pelajaran 
  LEFT JOIN siswa ON siswa.NIS = ujian_murid.id_murid 
  LEFT JOIN nilai ON nilai.id_pelajaran = pelajaran.id_pelajaran AND nilai.id_siswa = siswa.NIS
  WHERE jadwal.id_guru = '$_SESSION[Id_User]'");
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
          <?php
          if ($nilai['uts'] == null) {
            echo "Belum Ada UTS";
          } else { ?>
            <a href="../ujian_murid/<?= $nilai['uts'] ?>">JAWABAN UTS</a>
            <br>
          <?php if ($nilai['uts_siswa'] == null) {
              echo "Belum Ada Baris Nilai";
            } else {
              echo $nilai['uts_siswa'];
            }
          }
          ?>
        </span>
      </td>
      <td class="align-middle text-center text-sm">
        <span class="text-secondary text-xs font-weight-bolds">
          <?php
          if ($nilai['uas'] == null) {
            echo "Belum Ada UAS";
          } else { ?>
            <a href="../ujian_murid/<?= $nilai['uas'] ?>">JAWABAN UAS</a>
            <br>
          <?php
            if ($nilai['uts_siswa'] == null) {
              echo "Belum Ada Baris Nilai";
            } else {
              echo $nilai['uts_siswa'];
            }
          }
          ?>
        </span>
      </td>
      <td class="align-middle text-center text-sm">
        <?php
        if ($nilai['uts_siswa'] == null) {
          echo "Belum Ada Baris Nilai";
        } else { ?>
          <span class="badge badge-sm bg-gradient-info">
            <a class="text-white open_modal_uts" id="<?= $nilai['id_nilai'] ?>" data-bs-toggle="modal" data-bs-target="#exampleModal" href="#">NILAI UTS</a>
          </span>
          <span class="badge badge-sm bg-gradient-info">
            <a class="text-white open_modal_uas" id="<?= $nilai['id_nilai'] ?>" data-bs-toggle="modal" data-bs-target="#exampleModal" href="#">NILAI UAS</a>
          </span>
        <?php }
        ?>

      </td>
    </tr>
  <?php endwhile; ?>

</tbody>