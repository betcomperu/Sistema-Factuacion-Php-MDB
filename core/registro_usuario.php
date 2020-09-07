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


  include "../layouts/header.php";
include "../layouts/top-menu.php";
include "../layouts/aside.php"

?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Registro de Usuarios</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Blank Page</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Formulario de Registro</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fas fa-times"></i></button>
          </div>
        </div>
        <div class="card-body">
        <div class="register-box-body">
   
   <div class="alert"> <?php echo isset($alert)?$alert:''; ?></div>
   <form action="" method="post">
     <div class="form-group has-feedback">
       <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Nombre y Apellidos" required>
       <span class="glyphicon glyphicon-user form-control-feedback"></span>
     </div>
     <div class="form-group has-feedback">
       <input type="email" id="correo" name="correo" class="form-control" placeholder="Email" required>
       <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
     </div>
     <div class="form-group has-feedback">
       <input type="text" id="usuario" name="usuario" class="form-control" placeholder="Usuario" required>
       <span class="glyphicon glyphicon-user form-control-feedback"></span>
     </div>
     <div class="form-group has-feedback">
       <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
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
             <input type="checkbox"><a href="#">Aceptar términos</a>
           </label>
         </div>
       </div><br>
       <!-- /.col -->
       <div class="col-xs-3">
         <button type="submit" class="btn btn-primary btn-block btn-flat">Registar</button>
       </div>
       <!-- /.col -->
     </div>
   </form>

  

   <a href="index.php" class="text-center">Ya tengo una cuenta</a>
 </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          Footer
        </div>
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
<?php include "../layouts/footer.php" ?>