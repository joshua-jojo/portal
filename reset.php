<?php
session_start();
include "koneksi.php";

$kd_unik = $_POST["Id_User"];
$Username = $_POST["Username"];
$newpass = $_POST["passwordbaru"];

$query = mysqli_query($konek, "SELECT * FROM users WHERE username='$Username' AND id_users='$kd_unik'");

$test = mysqli_num_rows($query);

if (empty($kd_unik) === "") {
    header("Location: reset_password.php?Err=7");
    exit();
}

if (empty($Username)) {
    header("Location: reset_password.php?Err=8");
    exit();
}

if (empty($Username) && empty($kd_unik)) {
    header("Location: reset_password.php?Err=9");
    exit();
}

if ($test < 1) {
    header("Location: reset_password.php?Err=10");
    exit();
}
if ($test > 0) {
    $queryuser = mysqli_query($konek, "SELECT * FROM users WHERE username='$Username' And id_users='$kd_unik'");

    $user = mysqli_fetch_array($queryuser);

    if ($user) {
        mysqli_query($konek, "UPDATE users set Password='$newpass' where id_users='$kd_unik'");
?>
        <script>
            alert("Password berhasil direset, silahkan login ulang");
            window.location.href = 'index.php';
        </script>
<?php
    }
}

?>