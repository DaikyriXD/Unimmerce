<?php
    if(isset($_POST['guardar'])){
        include_once 'db_unimmerce.php';
        $conn = pg_connect("host=$host dbname=$db user=$user password=$pass")
            or die("No se pudo conectar: " . pg_last_error());
        $nombre = $_POST['nombre'];
        $email = $_POST['email'];
        $pass = $_POST['pass'];
        $user = $_POST['user'];
        //$pass = password_hash($pass, PASSWORD_DEFAULT);
        $query = "INSERT INTO usuarios (nombre, correo_electrónico, contraseña, tipo_usuario) VALUES ('$nombre','$email', '$pass', '$user' )";
        $result = pg_query($conn, $query);
        if($result){
            echo '<meta http-equiv="refresh" content="0 ; url=panel.php?modulo=usuarios&mensaje=Usuario creado correctamente" />';
        }else {
            ?>
                    <div class="alert alert-danger" role="alert">
                        Error al crear usuario <?php echo pg_error($conn); ?>
                    </div>
            <?php
        }
    }    
?>

<div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
          <div class="container-fluid">
              <div class="row mb-2">
                  <div class="col-sm-6">
                      <h1>Crear Usuario</h1>
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
                      <form action="panel.php?modulo=crearUsuario" method="post">
                            <div class="form-group">
                                <label>Nombre</label>
                                <input type="text" name="nombre" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Contraseña</label>
                                <input type="password" name="pass" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Tipo de Usuario</label>
                                <input type="text" name="user" class="form-control">
                            </div>
                            
                            
                            <div class="form-group">
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