<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-dark">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="dashboard" class="nav-link">Home</a>
        </li>
      </ul>
  
      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" data-widget="fullscreen" href="#" role="button">
            <i class="fas fa-expand-arrows-alt"></i>
          </a>
        </li>
        <li class="nav-item">
          <!--perfil usuario-->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">

                  <?php 
                      if($_SESSION["photo"] != ""){
                        echo '<img src="'.$_SESSION["photo"].'" class="user-image" alt="UserImage">';
                      } else{
                        echo '<img src="views/dist/img/user.jpg" class="user-image" alt="UserImage">';
                      }
                  ?>

                  <span class="hidden-xs">
                    <?php 
                      echo $_SESSION["name"];
                    ?>
                  </span>
                </a>

                <!--dropdown-->
                <ul class="dropdown-menu">
                  <li class="user-body">
                    <div class="pull-right">
                      <a href="logOut" class="btn btn-default btn-flat">Log out</a>
                    </div>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->
  