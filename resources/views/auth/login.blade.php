<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Finanzas - Login</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  {!! IAStyle('adminlte/bootstrap/css/bootstrap.min.css')!!}
  <!-- Font Awesome -->
  {!! IAStyle('adminlte/bootstrap/css/bootstrap.min.css')!!}
  <!-- Theme style -->
  {!! IAStyle('adminlte/dist/css/AdminLTE.min.css')!!}
  <!-- iCheck -->
  {!! IAStyle('adminlte/plugins/iCheck/square/blue.css')!!}
  {!! IAStyle('assets/font-awesome/css/font-awesome.min.css') !!}

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="#"><b>Finanzas</b> personales</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">
	
	@if($errors->any())
		<code>{{ $errors->first() }}</code>
	@else
		Credencial de acceso
	@endif
	
	</p>

    <form action="{{ url('/atlogin') }}" method="post">
      <div class="form-group has-feedback">
        <input type="email" class="form-control" placeholder="Email" name="email" required>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Password" name="password" required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox" name="rememberme"> Recordarme
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Ingresar</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    <div class="social-auth-links text-center">
      <p>- O -</p>
      <a href="{{ url('auth/facebook') }}" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i>Ingresar con Facebook</a>
    </div>
    <!-- /.social-auth-links -->

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 2.2.3 -->
{!! IAScript('adminlte/plugins/jQuery/jquery-2.2.3.min.js')!!}
<!-- Bootstrap 3.3.6 -->
{!! IAScript('adminlte/bootstrap/js/bootstrap.min.js')!!}
<!-- iCheck -->
{!! IAScript('adminlte/plugins/iCheck/icheck.min.js')!!}
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
</body>
</html>