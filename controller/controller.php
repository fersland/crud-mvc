<?php
    require_once ("model/model.php");

    class GeneralController {

        public static function template() {
            include "view/template.php";
        }

        public static function enlacesPaginasController() {
            if (isset($_GET['action'])) {
                $enlaces = $_GET['action'];
            }else{
                $enlaces = "log";
            }

            $response = GeneralModel::enlacesPaginasModel($enlaces);
            include $response;
        }

        public static function guardarUsuarioController() {
            if (isset($_POST['procesar'])) {
                $data = array(
                                "usuario"   => $_POST['usuario'],
                                "password"  => $_POST['password'],
                                "email"     => $_POST['email']
                );

                $response = GeneralModel::guardarUsuarioModel($data, "usuarios");

                if ($response == "success") {
                    echo '<div class="alert alert-success">
							<p><b><i class="fa fa-check"></i> Se ha guardado correctamente.</b></p>                        
						  </div>';
                }elseif($response == "error"){
                    echo '<div class="alert alert-warning">
							<p><b><i class="fa fa-check"></i> No se ha procedido a guardar</b></p>
						  </div>';
                }elseif($response == "repet") {
                    echo '<div class="alert alert-warning">
							<p><b><i class="fa fa-close"></i> Error, usuario repetido!</b></p>
						  </div>';
                }
            }
        }

        public static function vistaUsuariosController(){
            $response = GeneralModel::vistaUsuarioModel("usuarios");

                echo '
                        <table class="table table-striped table-hover">
                            <thead>
                                <th>Usuarios</th>
                                <th>Correo</th>
                                <th>Nombres</>
                                <th></th>
                                <th></th>
                            </thead>';

                        foreach((array) $response as $values) { ?>
                            <tbody>
                                <td><?php echo $values['usuario']; ?></td>
                                <td><?php echo $values['email']; ?></td>
                                <td><?php echo $values['nombres']. ' ' .$values['apellidos']; ?></td>
                                <td><?php echo $values['nombres']. ' ' .$values['apellidos']; ?></td>
                                <td><a href="index.php?action=edit&id=<?php echo $values['id']; ?>">Editar</a></td>
                                <td><a href="index.php?action=del&id=<?php echo $values['id']; ?>">Eliminar</a></td>
                            </tbody>
                        <?php }
                echo '</table>';
        }

        public static function editUsuariosController() {
            $data = $_GET['id'];
            $response = GeneralModel::editUsuariosModel($data, "usuarios");

            echo '
            <form method="post">
            <input type="hidden" name="paramid" value="'.$response["id"].'">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Usuario</label>
                <input type="text" class="form-control" name="usuario" value="'.$response["usuario"].'" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" class="form-control" name="passw" value="'.$response["passw"].'" id="exampleInputPassword1">
            </div>

            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Correo</label>
                <input type="text" class="form-control" name="email" value="'.$response["email"].'" id="exampleInputPassword1">
            </div>
            
            <button type="submit" class="btn btn-primary" name="procesar">Guardar Datos</button>
            </form>
            
                ';
        }

        public static function editarUsuariosController(){
            if (isset($_POST['procesar'])) {
                $data = array(
                                "id"        => $_POST['paramid'],
                                "usuario"   => $_POST['usuario'],
                                "email"     => $_POST['email'],
                                "passw"     => $_POST['passw']
                );

                $response = GeneralModel::editarUsuariosModel($data, "usuarios");
                if ($response == "success") {
                    echo '<div class="alert alert-success">
							<p><b><i class="fa fa-check"></i> Se ha editado correctamente.</b></p>                        
						  </div>';
                }elseif($response == "error"){
                    echo '<div class="alert alert-warning">
							<p><b><i class="fa fa-check"></i> No se ha procedido a editar</b></p>
						  </div>';
                }
            }
        }

        public static function delUsuariosController() {
            $data = $_GET['id'];
            $response = GeneralModel::delUsuariosModel($data, "usuarios");

            echo '
            <form method="post">
            <input type="hidden" name="paramid" value="'.$response["id"].'">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Usuario</label>
                <input type="text" class="form-control" value="'.$response["usuario"].'" aria-describedby="emailHelp" readonly >
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" class="form-control" value="'.$response["passw"].'" id="exampleInputPassword1" readonly>
            </div>

            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Correo</label>
                <input type="text" class="form-control" value="'.$response["email"].'" id="exampleInputPassword1" readonly>
            </div>
            
            <button type="submit" class="btn btn-primary" name="procesar">Guardar Datos</button>
            </form>
            
                ';
        }

        public static function eliminarUsuariosController(){
            if (isset($_POST['procesar'])) {
                $data = array("id" => $_POST['paramid']);

                $response = GeneralModel::eliminarUsuariosModel($data, "usuarios");
                if ($response == "success") {
                    echo '<div class="alert alert-success">
                            <p><b><i class="fa fa-check"></i> Se ha eliminado correctamente.</b></p>                        
                          </div>';
                }elseif($response == "error"){
                    echo '<div class="alert alert-warning">
                            <p><b><i class="fa fa-check"></i> No se ha procedido a eliminar</b></p>
                          </div>';
                }
            }
        }
    }