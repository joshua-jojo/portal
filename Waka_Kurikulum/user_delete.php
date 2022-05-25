<?php

include "../koneksi.php";

$Id_User	= $_GET["Id_User"];

if($delete = mysqli_query($konek, "DELETE FROM users WHERE id_users = '$Id_User'")){
	header("Location: pengguna.php");
	exit();
}
die("Terapat Kesalahan :". mysqli_error($konek));
