<?php
    include_once 'db_unimmerce.php';
    $conn = pg_connect("host=$host dbname=$db user=$user password=$pass")
    or die("No se pudo conectar: " . pg_last_error());
    if(isset($_POST['guardar'])){
        
        $nombre = $_POST['nombre'];
        $email = $_POST['email'];
        $pass = $_POST['pass'];
        $user = $_POST['user'];
        $id = $_POST['id'];
        $query = "UPDATE usuarios SET nombre = '$nombre', correo_electrónico = '$email', contraseña = '$pass_hashed', tipo_usuario = '$user' WHERE id = $id";
        $pass_hashed = password_hash($pass, PASSWORD_DEFAULT);
        $result = pg_query($conn, $query);
        if($result){
            echo '<meta http-equiv="refresh" content="0; url=panel.php?modulo=usuarios&mensaje=Usuario '.$nombre.' editado exitosamente" />  ';
        }else {
            ?>
                    <div class="alert alert-danger" role="alert">
                        Error al crear usuario <?php echo pg_error($conn); ?>
                    </div>
            <?php
        }
    } 

    $id = pg_escape_string($_REQUEST['id'] ?? '');
    $query = "SELECT id, nombre, correo_electrónico, contraseña, tipo_usuario FROM usuarios WHERE id = '" . $id . "';";
    $res = pg_query($query);
    $row = pg_fetch_assoc($res);


?>



<div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
          <div class="container-fluid">
              <div class="row mb-2">
                  <div class="col-sm-6">
                      <h1>Editar Usuario</h1>
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
                      <form action="panel.php?modulo=editarUsuario" method="post">
                            <div class="form-group">
                                <label>Nombre</label>
                                <input type="text" name="nombre" class="form-control" value="<?php echo $row['nombre'] ?>" required="required">
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control" value="<?php echo $row['correo_electrónico'] ?>" required="required">
                            </div>
                            <div class="form-group">
                                <label>Contraseña</label>
                                <input type="password" name="pass" class="form-control" required="required">
                            </div>
                            <div class="form-group">
                                <label>Tipo de Usuario</label>
                                <input type="text" name="user" class="form-control" value="<?php echo $row['tipo_usuario'] ?>" required="required">
                            </div>
                            
                            
                            <div class="form-group">
                                <input type="hidden" name="id" value="<?php echo $row['id'] ?>" >
                                <button type="submit" class="btn btn-primary" name="guardar">Guardar</button>
                            </div>
                        </form>


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