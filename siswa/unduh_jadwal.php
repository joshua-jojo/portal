<?php
// Downloads files
// Tentukan folder file yang boleh di download
$folder = "../jadwal/";
$filename = $_GET['file'];
$file_extension = strtolower(substr(strrchr($filename, "."), 1));

// Lalu cek menggunakan fungsi file_exist
if (!file_exists($folder . $_GET['file'])) {
?>
    <script>
        alert("maaf, file tidak dapat ditemukan.");
        window.location.href = 'jadwal.php';
    </script>
<?php
} else if ($file_extension == 'php') {
?>
    <script>
        alert("maaf, file tidak dapat diakses.");
        window.location.href = 'jadwal.php';
    </script>
<?php
}
// Apabila mendownload file di folder 
else {

    //header("Cache-Control: public");
    //header("Content-Description: File Transfer");
    header("Content-Disposition: attachment; filename=" . basename($filename));
    header("Content-Type: application/octet-stream;");
    //header("Content-Transfer-Encoding: binary");
    readfile("../jadwal/" . $filename);
}
?>