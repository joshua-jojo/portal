<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
  <div class="container-fluid py-1 px-3">
    <nav aria-label="breadcrumb">
      <!-- <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm">
        </li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">
          <?= $title ?>
        </li>
      </ol> -->
      <!-- <h6 class="font-weight-bolder mb-0">
        <?= $title ?>
      </h6> -->
    </nav>
    <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
      <div class="ms-md-auto pe-md-3 d-flex align-items-center">
        <!-- <div class="input-group">
          <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
          <input type="text" class="form-control" placeholder="Type here..." />
        </div> -->
      </div>
      <ul class="navbar-nav justify-content-end">
        <li class="nav-item dropdown pe-2 d-flex align-items-center">
          <a href="javascript:;" class="nav-link text-body p-0" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fa fa-user cursor-pointer"></i> &nbsp;<?= $_SESSION['Username'] ?>
          </a>
          <ul class="dropdown-menu  dropdown-menu-end  px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton">
            <li class="mb-2">
              <a class="dropdown-item border-radius-md" href="profil.php">
                <div class="d-flex py-1">
                  Profil
                </div>
              </a>
            </li>
            <li class="mb-2">
              <a class="dropdown-item border-radius-md" data-bs-toggle="modal" data-bs-target="#gantipasswordmodal">
                <div class="d-flex py-1">
                  Ganti Password
                </div>
              </a>
            </li>
            <li class="mb-2">
              <a class="dropdown-item border-radius-md" data-bs-toggle="modal" data-bs-target="#keluarlogout">
                <div class="d-flex py-1">
                  Logout
                </div>
              </a>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>
<div class="modal fade" id="gantipasswordmodal" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-body p-0">
        <div class="card card-plain">
          <div class="card-header pb-0 text-left">
            <h3 class="font-weight-bolder text-info text-gradient">Ubah Password</h3>
          </div>
          <div class="card-body">
            <form role="form text-left" action="update_pass.php" name="modal_popup" enctype="multipart/form-data" method="post">
              <?php
              $sql = $konek->query("select * from users where id_users = '$_SESSION[Id_User]'");
              while ($data = $sql->fetch_assoc()) :
              ?>
                <label>Username</label>
                <div class="input-group mb-3">
                  <input type="username" name="siswa" class="form-control" placeholder="Username" value="<?= $data['username'] ?>" aria-label="Email" aria-describedby="email-addon" readonly>
                </div>
                <label>Password</label>
                <div class="input-group mb-3">
                  <input type="password" class="form-control" name="password" placeholder="Password" value="<?= $data['password'] ?>" aria-label="Password" aria-describedby="password-addon">
                </div>
              <?php endwhile; ?>

              <div class="text-center">
                <button type="submit" class="btn btn-round bg-gradient-info btn-lg w-100 mt-4 mb-0">Ubah</button>
              </div>
            </form>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>

<!-- <div class="modal fade" id="keluarlogout">
  <div class="modal-dialog">
    <div class="modal-content" style="margin-top:100px;">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" style="text-align:center;">Apakah anda yakin ingin keluar</h4>
      </div>
      <div class="modal-footer" style="margin:0px; border-top:0px; text-align:center;">
        <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Batal</button>
        <a href="logout.php" class="btn btn-danger" id="delete_link">Keluar</a>
      </div>
    </div>
  </div>
</div> -->

<div class="col-md-4">
  <div class="modal fade" id="keluarlogout" tabindex="-1" role="dialog" aria-labelledby="modal_delete" aria-hidden="true">
    <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h6 class="modal-title" id="modal-title-notification">Peringatan</h6>
          <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="py-3 text-center">
            <i class="ni ni-bell-55 ni-3x"></i>
            <h4 class="text-gradient text-danger mt-4">Apakah anda yakin ingin keluar</h4>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary text-white ml-auto" data-bs-dismiss="modal">Batal</button>
          <a class="btn btn-danger" href="../logout.php">Keluar</a>
        </div>
      </div>
    </div>
  </div>
</div>