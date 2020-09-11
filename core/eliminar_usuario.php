<?php
  include "../layouts/header.php";
include "../layouts/top-menu.php";
include "../layouts/aside.php";

if (empty($_REQUEST['id']))  //Si no hay id puesto entonces...
 {
    header ("location: lista_usuarios.php");
}else{
    include('../config/conexion.php');
    $idusuario=$_REQUEST['id'];
    $query = mysqli_query($cn, "SELECT u.nombre, u.usuario, u.rol
                                FROM usuario u
                                INNER JOIN
                                rol r
                                ON u.rol = r.idrol
                                WHERE u.idusuario = $idusuario");
    $result = mysqli_num_rows($query);
  //  var_dump ($result);

    if($result >0){
        while($data = mysqli_fetch_array($query)){
            $nombre = $data['nombre'];
            $usuario = $data['usuario'];
            $rol = $data['rol'];
        }
    }else {
        header ("location: lista_usuarios.php");
        
    }
}

?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Eliminar</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
  
          <!-- right col -->
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

 <?php include "../layouts/footer.php" ?>