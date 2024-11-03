<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <img src="views/dist/img/pill2.png" class="brand-image img-circle elevation-3" style="opacity: .8"><br>
      <b>Inventory System</b> Admin
    </div>
    <div class="card-body">

      <form method="post">

        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="User" name="loginUser" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>

        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" name="loginPassword" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>

        <div class="row">
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>

        <?php
            $login = new UserController();
            $login -> ctrlogInUser();
        ?>


      </form>

    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->
