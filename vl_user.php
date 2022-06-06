<?php
session_start();
include "koneksi.php";

$Username = $_POST["Username"];
$Password = $_POST["Password"];
$queryuser = mysqli_query($konek, "SELECT * FROM users WHERE username='$Username'");

$user = mysqli_fetch_array($queryuser);


$query = mysqli_query($konek, "SELECT * FROM users WHERE username='$Username' AND password='$Password'");

$test = mysqli_num_rows($query);


if ($test > 0) {


	echo '<pre>';
	print_r($user);
	echo '</pre>';
	// die;

	if ($user) {


		$_SESSION["Username"] 			= $user["username"];
		$_SESSION["Password"] 			= $user["password"];
		$_SESSION["id_users_1"] 		= $user["no_role_users"];
		$_SESSION["Id_User"] 			= $user["id_users"];


		// $_SESSION["Foto"]				= $user["Foto"];
		$_SESSION["Login"] 				= true;

		if (!empty($_POST["remember"])) {
			//buat cookie
			setcookie("user_login", $_POST["Username"], time() + (3600 * 365 * 24 * 60 * 60));
			setcookie("userpassword", $_POST["Password"], time() + (3600 * 365 * 24 * 60 * 60));
		} else {
			if (isset($_COOKIE["user_login"])) {
				setcookie("user_login", "");
			}
			if (isset($_COOKIE["userpassword"])) {
				setcookie("userpassword", "");
			}
		}


		if ($_SESSION["id_users_1"] == 1) {
			header("Location: Waka_Kurikulum/index.php");
			exit();
		} else if ($_SESSION["id_users_1"] == 2) {
			header("Location: guru/index.php");
			exit();
		} else if ($_SESSION["id_users_1"] == 3) {
			header("Location: siswa/index.php");
			exit();
		} else if ($_SESSION["id_users_1"] == 4) {
			header("Location: kepala_sekolah/index.php");
			exit();
		} else {
			header("Location :pagenotfound.php");
			exit();
		}
	}
}
if ($user < 1) {
	header("Location: index.php?Err=11");
	exit();
} else {
	if (empty($Username) && empty($Password)) {
		header("Location: index.php?Err=1");
		exit();
	} elseif (empty($Username)) {
		header("Location: index.php?Err=2");
		exit();
	} elseif (empty($Password)) {
		header("Location: index.php?Err=3");
		exit();
	} elseif ($test < 1) {
		header("Location: index.php?Err=4");
		exit();
	} else {
		header("Location: index.php?Err=5");
		exit();
	}
}
