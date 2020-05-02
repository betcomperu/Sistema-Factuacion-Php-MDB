<?php
  include "../config/conexion.php";
if (!empty($_POST)) {
  $alert="";
  if (empty($_POST['nombre']) || empty($_POST['correo']) || empty($_POST['usuario']) || empty($_POST['password']) || empty($_POST['rol']) ) {
    $alert= '<div class="alert alert-danger alert-dismissible">Campos vacios</div>';
}else{
  include "../config/conexion.php";
  $nombre =$_POST['nombre'];
  $email =$_POST['correo'];
  $user =$_POST['usuario'];
  $clave =md5($_POST['password']);
  $rol =$_POST['rol'];
  $query=mysqli_query($cn, "SELECT * FROM usuario WHERE usuario='$user' OR correo='$email'");
  $result=mysqli_fetch_array($query);
 // var_dump($result);
//  exit();
  if ($result>0) {
    $alert ='<div class="alert alert-warning alert-dismissible">Este usuario o correo esta registrado</div>';
  }else{
    $query_insert = mysqli_query($cn, "INSERT INTO usuario(nombre, correo , usuario, clave , rol) VALUES ('$nombre', '$email', '$user','$clave', '$rol' )");
    if ($query_insert) {
      $alert = '<div class="alert alert-success alert-dismissible">Registro Exitoso!</div>';
    }else{
      $alert = '<div class="alert alert-info alert-dismissible">No se pudo registrar!</div>';
    }
  }


}


}

include '../layouts/header.php';
include '../layouts/aside.php';
?>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
    <a href="../../index2.html"><b>Admininstración</b> USUARIOS</a>
  </div>

  <div class="register-box-body">
   
    <div class="alert"> <?php echo isset($alert)?$alert:''; ?></div>
    <form action="" method="post">
      <div class="form-group has-feedback">
        <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Nombre y Apellidos">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="email" id="correo" name="correo" class="form-control" placeholder="Email">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="text" id="usuario" name="usuario" class="form-control" placeholder="Usuario">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" id="password" name="password" class="form-control" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        
            <?php
              $query_rol = mysqli_query($cn, "SELECT * FROM rol");
              $result_rol = mysqli_num_rows($query_rol);
            ?>
            <select name="rol" id="rol" class="form-control select2" style="width: 100%;">
                  <?php 
                  if ($result_rol>0) {
                  
                  while($rol=mysqli_fetch_array($query_rol)):?>
                  
                    <!-- HTML codigo -->   
                    <option value="<?php echo $rol['idrol']; ?>"><?php echo $rol['rol'] ;?></option>                 
                    <!-- HTML codigo --> 
                  <?php endwhile; }?>
            </select>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox"> Aceptar términos <a href="#">términos</a>
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Registar</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

   

    <a href="login.html" class="text-center">I already have a membership</a>
  </div>
  <!-- /.form-box -->
</div>
<!-- /.register-box -->
<?php
 include '../layouts/footer.php';
 ?>