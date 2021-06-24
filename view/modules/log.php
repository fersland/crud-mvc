<?php
    require_once ("controller/controller.php");
    $args = new GeneralController;
?>

<div class="container">
    <div class="row mt-5">
        <div class="col-md-12">
            <h3>CRUD DEPRESIVO</h3>

            <?php $args->guardarUsuarioController(); ?>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-4">
        <form method="post">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Usuario</label>
                <input type="text" class="form-control" name="usuario" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" id="exampleInputPassword1">
            </div>

            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Correo</label>
                <input type="text" class="form-control" name="email" id="exampleInputPassword1">
            </div>
            
            <button type="submit" class="btn btn-primary" name="procesar">Guardar Datos</button>
            </form>
        </div>

        <div class="col-md-8">
            <?php echo $args->vistaUsuariosController(); ?>
        </div>
    </div>
</div>