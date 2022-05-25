<?php
session_start();
include "../koneksi.php";
include "auth_user.php";

$password            = $_POST['password'];



if ($add = mysqli_query($konek, "UPDATE users set Password = '$password' where id_users = '$_SESSION[Id_User]'")) {
?>

    <script>
        alert("Password berhasil di ubah");
        window.location.href = "profil.php";
    </script>

<?php
}
die("Terdapat kesalahan : " . mysqli_error($konek));

?>