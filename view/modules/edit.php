<?php
    require_once ("controller/controller.php");
    $args = new GeneralController;
?>

<div class="container">
    <div class="row mt-5">
        <div class="col-md-12">
            <h3>EDITAR DATOS  <a href="index.php" style="float:right">Volver</a></h3>
            <?php echo $args->editarUsuariosController(); ?>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-4">
        </div>

        <div class="col-md-8"> <?php echo $args->editUsuariosController(); ?> </div>
    </div>
</div>