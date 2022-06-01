<?php
session_start();
include "../koneksi.php";
include "auth_user.php";

$id_userr = $_SESSION['Id_User'];
$foto = null;
$nama_foto                  = $_FILES['foto']['name'];
$file_tmp                   = $_FILES['foto']['tmp_name'];
$sql = $konek->query("select foto from foto_profil where id_user = '$id_userr'");
while ($data = mysqli_fetch_array($sql)) {
    $foto = $data["foto"];
}
date_default_timezone_set("Asia/Jakarta");
$nama_foto = "profil_" . $id_userr . "_" . date('Y_m_d_H_i_s_') . $nama_foto;
if (!empty($foto)) {
    move_uploaded_file($file_tmp, '../foto_profil/' . $nama_foto);
    $sql = $konek->query("UPDATE `foto_profil` SET `foto`='$nama_foto' WHERE id_user = '$id_userr'");
    echo ' <script>
    alert("Foto Berhasil Diubah");
    window.location.href = "profil.php";
</script>';
} else {
    move_uploaded_file($file_tmp, '../foto_profil/' . $nama_foto);
    $sql = $konek->query("INSERT INTO `foto_profil`(`id_user`, `foto`) VALUES ('$id_userr','$nama_foto')");
    echo ' <script>
    alert("Foto Berhasil Diubah");
    window.location.href = "profil.php";
</script>';
}
die("Terdapat kesalahan : " . mysqli_error($konek));
