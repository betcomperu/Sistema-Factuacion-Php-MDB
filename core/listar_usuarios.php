<?php

include "../layouts/header.php";
include "../layouts/top-menu.php";
include "../layouts/aside.php";

?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Listado de Usuarios</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Listado de Usuarios</li>
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
                <h3 class="card-title">Tabla de usuarios</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip"
                        title="Remove">
                        <i class="fas fa-times"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div class="box-header with-border">
                    <a href="registro_usuario.php"
                                class="btn btn-primary"><i
                                class="fa fa-plus-circle"></i> Agregar usuario
                    </a>
                    <div class="box-tools pull-right">
                       <br>
                    </div>
                </div>
                <div class="box">
                    <table id="tabla1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Nombre completo</th>
                                <th>Correo</th>
                                <th>Usuario</th>
                                <th>Rol</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <?php
                include "../config/conexion.php";
                $query=mysqli_query($cn,"SELECT usuario.idusuario,usuario.nombre, usuario.correo, usuario.usuario, rol.rol 
                                        FROM rol INNER JOIN usuario 
                                        ON rol.idrol = usuario.rol" );
                $result= mysqli_num_rows($query);?>
                        <?php if ($result>0):?>

                        <?php  while($data = mysqli_fetch_array($query)):?>


                        <tr>
                            <td><?php echo $data['nombre'];?></td>
                            <td><?php echo $data['correo'];?></td>
                            <td><?php echo $data['usuario']; ?></td>
                            <td>
                                <?php 
                        $valrol=$data['rol'];
                        switch ($valrol) {
                            case 'Administrador':
                            //  echo '<p class="text-green">'.$valrol.'</p>';
                              echo '<small class="label bg-red">'.$valrol.'</small>';
                                break;
                            case 'Supervisor':
                              echo '<small class="label bg-green">'.$valrol.'</small>';
                                    break;
                            default:
                              echo '<small class="label bg-black">'.$valrol.'</small>';
                                break;
                                          }
                        ?>

                            </td>
                            <td>
                                
                                
                            <a class="btn btn-primary" href="editar_usuario.php?id=<?php echo $data['idusuario'];?>" role="button">Editar</a>
                                
                            <a class="btn btn-danger" href="#" role="button">Eliminar</a>
                            </td>

                        </tr>


                        <?php endwhile; ?>
                        <?php endif; ?>
                        <tfoot>
                            <tr>
                                <th>Nombre Completo</th>
                                <th>Correo</th>
                                <th>Usuario</th>
                                <th>Rol</th>
                                <th>Opciones</th>
                            </tr>
                        </tfoot>
                    </table>
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




<?php
include '../layouts/footer.php';

?>