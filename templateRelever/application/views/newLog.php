
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>LOGIN | ICAB demo</title>

  <!-- CSS -->
  <?php include "vendors/components/login/css.php" ?>
  <!-- CSS -->

</head>
<body class="hold-transition login-page">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="index2.html" class="h1"><b>ICAB</b>DEMO</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Connectez-Vous </p>
        <!-- Error -->
       <div class="alert alert-success" style="text-align: center;" id="success"></div>
       <div class="alert alert-danger" style="text-align: center;" id="errors"></div>
       <script type="text/javascript"> $("#success").hide(); $("#errors").hide();</script>
      <form  action="javascript:void(0)" id="from_login" method="post">
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="login" placeholder="Login">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="password" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- JS -->
  <?php include "vendors/components/login/js.php" ?>
<!-- JS -->

</body>
</html>
