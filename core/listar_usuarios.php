
<?php

include '../layouts/header.php';
include '../layouts/aside.php';
include '../config/conexion.php';


?>
<!--Contenido-->
     <!-- Content Wrapper. Contains page content -->
     <div class="content-wrapper">
       
       <!-- Main content -->
       <section class="content">
           <div class="row">
             <div class="col-md-12">
                 <div class="box">
                   <div class="box-header with-border">
                         <h1 class="box-title">USUARIOS  <button class="btn btn-success" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Agregar</button></h1>
                       <div class="box-tools pull-right">
                       </div>
                   </div>
                   <div class="box">
            <div class="box-header">
              <h3 class="box-title">Listado de Usuarios Registrados</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="listausuario" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Nombre y Apellidos</th>
                  <th>Email</th>
                  <th>Usuario</th>
                  <th>Rol</th>
                  <th>Opciones</th>
                </tr>
                </thead>
                <?php
                $query=mysqli_query($cn,"SELECT usuario.nombre, usuario.correo, usuario.usuario, rol.rol FROM rol INNER JOIN usuario ON rol.idrol = usuario.rol" );
                $result= mysqli_num_rows($query);?>
                <?php if ($result>0):?>

                 <?php  while($data = mysqli_fetch_array($query)):?>
  
                <tbody>
            
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
                  <button type="button" class="btn btn-info">Editar</button>
                  <button type="button" class="btn btn-danger">Eliminar</button>

                  </td>
              
        
                </tfoot>
                 <?php endwhile; ?>
                <?php endif; ?>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
                   <!-- centro -->
                   <div class="panel-body table-responsive" style="height: 400px;" id="listadoregistros">
                       
                   </div>
                   <!--Fin centro -->
                 </div><!-- /.box -->
             </div><!-- /.col -->
         </div><!-- /.row -->
     </section><!-- /.content -->

   </div><!-- /.content-wrapper -->
 <!--Fin-Contenido-->
<?php
include '../layouts/footer.php';

?>