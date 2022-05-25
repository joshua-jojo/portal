<?php

include "../koneksi.php";

$Id_Usergroup_User	= $_POST["id_users"];

$user			= $_POST["User_siswa"];

$pecah = explode('.', $user);

$pecah1 = $pecah[0];
$pecah2 = $pecah[1];

$query = mysqli_query($konek, "select * from users where username='$pecah2'");

$test = mysqli_num_rows($query);

if ($test > 0) {
?>

	<script>
		alert("user sudah ada..");
		window.location.href = "pengguna.php";
	</script>

<?php

} else {


	if ($add = mysqli_query($konek, "INSERT INTO users (id_users, no_role_users, username, password) VALUES ('$pecah1','$Id_Usergroup_User', '$pecah2', '12345')")) {
		header("Location: pengguna.php");
		exit();
	}
	die("Terdapat Kesalahan : " . mysqli_error($konek));
}

?>