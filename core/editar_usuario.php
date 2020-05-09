<?php
  include "../config/conexion.php";
if (!empty($_POST)) {
  $alert="";
  if (empty($_POST['nombre']) || empty($_POST['correo']) || empty($_POST['usuario']) || empty($_POST['rol']) ) {
    $alert= '<div class="alert alert-danger alert-dismissible">Campos vacios</div>';
}else{
  include "../config/conexion.php";
  $idusuario=$_POST['idusuario'];
  $nombre =$_POST['nombre'];
  $email =$_POST['correo'];
  $user =$_POST['usuario'];
 // $clave =md5($_POST['password']);
  $rol =$_POST['rol'];
  // Verificamos si existe usuario y email iguales

  $query=mysqli_query($cn, "SELECT * FROM usuario
                           WHERE (usuario='$user' AND idusuario!=$idusuario) 
                          OR (correo='$email' AND idusuario!=$idusuario)");
  $result=mysqli_fetch_array($query);
 // var_dump($result);
//  exit();
  if ($result>0) {
    $alert ='<div class="alert alert-warning alert-dismissible">Este usuario o correo esta registrado</div>';
  }else{
    if(empty($_POST['clave']))
    {
      $sql_update =mysqli_query($cn, "UPDATE usuario
                                      SET nombre='$nombre', correo='$email', usuario='$user', rol='$rol'
                                      WHERE idusuario=$idusuario");
    }else{
$sql_update =mysqli_query($cn, "UPDATE usuario
                                      SET nombre='$nombre', correo='$email', usuario='$user',clave='$clave', rol='$rol'
                                      WHERE idusuario=$idusuario");

    }
    
    if ($sql_update) {
      $alert = '<div class="alert alert-success alert-dismissible">Registro Actualizado!</div>';
    }else{
      $alert = '<div class="alert alert-info alert-dismissible">No se pudo Actualizar!</div>';
    }
  }


}


}

// Recuperar datos
#Que no venga vacio el id :
if (empty($_GET['id'])) {
  header('location: listar_usuarios.php');
}
#Validamos que el id exista en la BD
$iduser=$_GET['id']; //El id que viene del crud por GET
#Hacemos una consulta para sacar los registros segun el ID
$sql = mysqli_query($cn, "SELECT usuario.idusuario,usuario.nombre, usuario.correo, usuario.usuario, rol.idrol ,rol.rol
FROM rol INNER JOIN usuario 
ON rol.idrol = usuario.rol
WHERE idusuario=$iduser");
$rs_sql= mysqli_num_rows($sql); // Muestra la cantidad de registros que cumplen la condición

#Condicionamos el resultado:
 
if($rs_sql==0){
    header('location: listar_usuarios.php');
}else{ // jalamos los datos del resultado del a consulta:
  while ($data=mysqli_fetch_array($sql)) {
    $iduser=$data['idusuario'];
    $nombre=$data['nombre'];
    $correo=$data['correo'];
    $usuario=$data['usuario'];
    $idrol=$data['idrol'];
    $rol=$data['rol'];
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
            <h1>Editar Usuarios</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Editar usuario</li>
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
          <h3 class="card-title">Actualización de Registro</h3>

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
    <input type="hidden" name="idusuario" value="<?php echo $iduser;?>">
     <div class="form-group has-feedback">
      <label>Nombre y Apellidos:</label>
       <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Nombre y Apellidos" value="<?php echo $nombre; ?>" required>
       <span class="glyphicon glyphicon-user form-control-feedback"></span>
     </div>
     <div class="form-group has-feedback">
      <label>Correo electrónico:</label>
       <input type="email" id="correo" name="correo" class="form-control" placeholder="Email" required value="<?php echo $correo; ?>">
       <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
     </div>
     <div class="form-group has-feedback">
      <label>Usuario:</label>
       <input type="text" id="usuario" name="usuario" class="form-control" placeholder="Usuario" required value="<?php echo $usuario; ?>">
       <span class="glyphicon glyphicon-user form-control-feedback"></span>
     </div>
     <div class="form-group has-feedback">
      <label>Password:</label>
       <input type="password" id="password" name="password" class="form-control" placeholder="Password" disabled="">
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
    
       <!-- /.col -->
       <div class="col-xs-4">
         <button type="submit" class="btn btn-primary btn-block btn-flat">Actualizar Registro</button>
       </div>
       <!-- /.col -->
     </div>
   </form>

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