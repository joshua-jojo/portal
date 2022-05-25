<?php
session_start();
include "../koneksi.php";
include "auth_user.php";

$password = $_POST['password'];



if ($add = mysqli_query($konek, "UPDATE users set password = '$password' where id_users = '$_SESSION[Id_User]'")) {
?>

    <script>
        alert("password berhasil di rubah");
        window.location.href = "profil.php";
    </script>

<?php
}
die("Terdapat kesalahan : " . mysqli_error($konek));

?>