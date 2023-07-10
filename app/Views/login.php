<?php
include_once('commons/head.php');
?>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <img src="images/igt_logo.png" atl="radicool-logo" height="100">
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <form action="" method="post">
        <div class="input-group mb-3">
          <input type="email" id="txtEmail" class="form-control" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" id="txtPassword" class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <!-- <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div> -->
            <!-- <p class="mb-1">
              <a href="forgot-password.html">I forgot my password</a>
            </p> -->
            <p class="mt-2">
              <a href="register" class="text-center">Register an Employee</a>
            </p>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="button" id="btnLogin" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
      <!-- <div class="social-auth-links text-center mb-3">
        <p>- OR -</p>
        <a href="#" class="btn btn-block btn-primary">
          <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
        </a>
        <a href="#" class="btn btn-block btn-danger">
          <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
        </a>
      </div> -->
      <!-- /.social-auth-links -->

      <!-- <p class="mb-1">
        <a href="forgot-password.html">I forgot my password</a>
      </p>
      <p class="mb-0">
        <a href="register.html" class="text-center">Register a new membership</a>
      </p> -->
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<?php
include_once('commons/foot.js.php');
?>
<link rel="stylesheet" href="<?php echo base_url(); ?>/plugins/sweetalert2/sweetalert2.min.css">

<script src="<?php echo base_url(); ?>/plugins/sweetalert2/sweetalert2.all.min.js"></script>
<script src="<?php echo base_url(); ?>/js/commons.js"></script>
<script src="<?php echo base_url(); ?>/js/login.js?v=1.0.<?=date('YmdHis');?>"></script>
</body>
<?php
include_once('commons/foot.php');
?>

