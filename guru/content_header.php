<header class="main-header">
  <!-- Logo -->
  <div class="logo bg-orange">
<span class="logo-mini"></span>
<span class="logo-lg bg-orange"><b>SMA</b></span>
</div>
  <!-- Header Navbar: style can be found in header.less -->
  <nav class="navbar navbar-static-top bg-orange" role="navigation">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </a>
    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">

        <!-- User Account: style can be found in dropdown.less -->
        <li class="dropdown user user-menu" style="border: none; margin-top:10px; margin-right:5px">
        
         
    <span class="hidden-xs" style="text-transform:capitalize;"><?php echo "".$_SESSION["Username"]."" ?></span>
    <span style="color: black;">| &nbsp;<?php echo  date("d-m-Y"); ?></span>
          
          <ul class="dropdown-menu">
            <!-- User image -->
          
            <!-- Menu Footer-->
            <li class="user-footer">
    <div class="pull-left">
              
              </div>
              <div class="pull-right">
                <a href="../logout.php" class="btn btn-primary">Sign out <i class="fa fa-sign-out"></i></a>
              </div>
            </li>
        </li>
      </ul>
    </div>
  </nav>
</header>
