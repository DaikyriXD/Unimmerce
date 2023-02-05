<?php
include_once "db_unimmerce.php";
$conn = pg_connect("host=$host dbname=$db user=$user password=$pass")
  or die("No se pudo conectar: " . pg_last_error());
if(isset($_REQUEST['idBorrar'])){
    $id= pg_escape_string($conn,$_REQUEST['idBorrar']??'');
    $query="DELETE from usuarios  where id='".$id."';";
    $res=pg_query($conn,$query);
    if($res){
        ?>
        <div class="alert alert-warning float-right" role="alert">
            Usuario borrado con éxito
        </div>
        <?php
    }else{
        ?>
        <div class="alert alert-danger float-right" role="alert">
            Error al borrar <?php echo pg_last_error($conn); ?>
        </div>
        <?php
    }
}
  ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
          <div class="container-fluid">
              <div class="row mb-2">
                  <div class="col-sm-6">
                      <h1>Usuarios</h1>
                  </div>
              </div>
          </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
          <div class="row">
              <div class="col-12">
                  <div class="card">
                      <!-- /.card-header -->
                      <div class="card-body">
                          <table id="example2" class="table table-bordered table-hover">
                              <thead>
                                  <tr>
                                      <th>Nombre</th>
                                      <th>Email</th>
                                      <th>Tipo de usuario</th>
                                      <th>Acciones
                                          <a href="panel.php?modulo=crearUsuario"><i class="fa fa-plus" aria-hidden="true"></i></a>
                                      </th>
                                  </tr>
                              </thead>
                              <tbody>
                                  <?php
                                   $query = "SELECT id, nombre, correo_electrónico, tipo_usuario FROM usuarios";
                                   $result = pg_query($conn, $query);
                                   while($row = pg_fetch_assoc($result)){
                                     ?>
                                     <td> <?php echo $row['nombre'] ?> </td>
                                     <td> <?php echo $row['correo_electrónico'] ?> </td>
                                     <td> <?php echo $row['tipo_usuario'] ?> </td>
                                     <td>
                                       <a href="panel.php?modulo=editarUsuario&id=<?php echo $row['id'] ?>" style="margin-right: 5px;"> <i class="fas fa-edit"></i> </a>
                                       <a href="panel.php?modulo=usuarios&idBorrar=<?php echo $row['id'] ?>" class="text-danger"> <i class="fas fa-trash"></i>
                                     </td>
                                     </tr>
                                     <?php
                                     }
                                     ?>
                              </tbody>
                          </table>
                      </div>
                      <!-- /.card-body -->
                  </div>
                  <!-- /.card -->

              </div>
              <!-- /.col -->
          </div>
          <!-- /.row -->
      </section>
      <!-- /.content -->
  </div>