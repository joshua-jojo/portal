<?php
session_start();
include "koneksi.php";

// Notif Error
$Err = "";
if(isset ($_GET ["Err"]) && !empty ($_GET ["Err"])){
	switch ($_GET ["Err"]){
		case 1:
			$Err = "Username dan Password Kosong";
		break;
		case 2:
			$Err = "Username Kosong";
		break;
		case 3:
			$Err = "Password Kosong";
		break;
		case 4:
			$Err = "Password salah";
		break;
		case 5:
			$Err = "Pastikan username dan password yang anda masukan sudah benar!";
		break;
		case 6:
			$Err = "Maaf, Terjadi Kesalahan";
		break;
    case 7:
			$Err = "id user tidak boleh kosong!";
		break;
    case 8:
			$Err = "username tidak boleh kosong!";
		break;
    case 9:
			$Err = "id user dan username tidak boleh kosong!";
		break;
    case 10:
			$Err = "id user dan username tidak dapat ditemukan!";
		break;
	}
}

// Notif
$Notif = "";
if(isset ($_GET["Notif"]) && !empty ($_GET["Notif"])){
	switch($_GET["Notif"]){
		case 1:
			$Notif = "User berhasil dibuat, silahkan Login";
		break;
	}
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>SMA</title>
	<!-- Icon -->
	<!-- <link rel="shortcut icon" type="image/icon" href="favicon.ico"> -->
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="aset/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="aset/fa/css/font-awesome.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="aset/dist/css/AdminLTE.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="aset/plugins/iCheck/square/blue.css">
  </head>
  <body class="hold-transition login-page " style="background-color: orange">
    <div class="login-box">
      <div class="login-logo">
        <b>SMA</b>
      </div><!-- /.login-logo -->
      <div class="login-box-body" style="border-radius: 10px;">
        <b><p class="login-box-msg">Reset Password</p></b>
        <form action="reset.php" method="post">
          <div class="form-group has-feedback">
            <input type="password" name="Id_User" class="form-control" placeholder="masukan NIS atau kode guru anda!" maxlength="255" required/>
            <span class="form-control-feedback"><i class="fa fa-lock"></i></span>
          </div>
          
          <div class="form-group has-feedback">
            <input type="text" name="Username" class="form-control" placeholder="Username" maxlength="30" required/>
            <span class="form-control-feedback"><i class="fa fa-user"></i></span>
          </div>
          
          <div class="form-group has-feedback">
            <input type="password" name="passwordbaru" class="form-control" placeholder="masukan password baru anda" maxlength="30" required/>
            <span class="form-control-feedback"><i class="fa fa-lock"></i></span>
          </div>
          <div class="row">
            <div class="col-xs-4">
            <button type="submit" class="btn btn-success">Reset</button>
            </div>
            <div class="col-xs-4">
            </div><!-- /.col -->
            <div class="col-xs-4">
           
            </div><!-- /.col -->
          </div>
		  <br>
			<center><font style="color:red;"><?php echo $Err ?></font></center>
			<center><font style="color:green;"><?php echo $Notif ?></font></center>
		</br>
        </form>
		
        <!-- <a href="vl_user.php"><i class="fa fa-users"></i> Register new User</a> -->
		
      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

    <!-- jQuery 2.1.4 -->
    <script src="aset/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="aset/bootstrap/js/bootstrap.min.js"></script>
    <!-- iCheck -->
    <script src="aset/plugins/iCheck/icheck.min.js"></script>
  </body>
</html>