<?php

include "../koneksi.php";

$kelas    = $_GET["id_kelas"];





$delete = mysqli_query($konek, "DELETE FROM absensi WHERE id_absensi='$kelas'");

?>

<script type="text/javascript">
    alert("Data Absensi berhasil dihapus");
    window.location.href = "absensi.php";
</script>