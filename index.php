<?php
$alert =""; // Variable que guardará los mensajes
if(!empty($_POST)) // Si NO esta vacio!
{
    if(empty($_POST['usuario'])||empty($_POST['password'])){  // SI está VACIO las dos casillas
        $alert ="Ingrese sus credenciales"; // Se mostrará ese mensaje
    }else{   // pero si no esta vacio entonce...
        require_once('config/conexion.php'); // Se conecta a la base de datos
        $user=mysqli_real_escape_string($cn, $_POST['usuario']);  // asignamos el campo1 a una variable
        $pass=md5(mysqli_real_escape_string($cn,$_POST['password'])); // asignamos el campo2 a una variable
        $query=mysqli_query($cn, "SELECT * FROM usuario WHERE usuario='$user' AND clave='$pass'");// hacemos la consulta
        $result =mysqli_num_rows($query); // guardamos en una variable el nro de filas $result el resultado del query
        if ($result>0) {  // Si hay mas de 1 osea mayor que 0
            $data=mysqli_fetch_array($query); // guardamos el resultado como array en una variable $data
            session_start(); // Iniciamos la variable de Session:
            $_SESSION['active']= true;
            $_SESSION['idUser']=$data['idusuario'];
            $_SESSION['nombre']=$data['nombre'];
            $_SESSION['correo']=$data['correo'];
            $_SESSION['user']=$data['usuario'];
            $_SESSION['rol']=$data['rol'];
            header('location: core/'); // redirigimos donde querramos en este caso a la carpeta "core"
        }else{ // Si no ha cumplido nada de esto entonces le damos un mensaje 
          $alert ="El usuario o la clave son incorrectas"; // Esta alerta se mostrará donde se pinta la variable.
        }
    }
}


?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SISTEMA FACTURACIÓN | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="assets/plugins/iCheck/square/blue.css">

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
    <a href="/"><b>Administracion</b> FACTURACIÓN</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Iniciar Sesión</p>
  

    <form action="" method="post">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Usuario">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
     
        <div class="col-sm-12">
        <p class="text-red">
            <?php echo isset($alert)?$alert:''; ?>
        </p>
          <button type="submit" class="btn btn-primary btn-block btn-flat" >INGRESAR</button>
        </div>
       
        <!-- /.col -->
      </div>
    </form>

  
    <!-- /.social-auth-links -->

    <a href="#">Olvide mi contraseña</a><br>
    <a href="register.html" class="text-center">Registrarme</a>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 2.2.3 -->
<script src="asssets/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="asssets/bootstrap/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="asssets/plugins/iCheck/icheck.min.js"></script>
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
