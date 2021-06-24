<?php
    require_once ("controller/controller.php");
    $args = new GeneralController;
?>
<div class="container">
    <div class="row mt-5">
        <div class="col-md-12">
            <h3>ELIMINAR DATOS  <a href="index.php" style="float:right">Volver</a></h3>
            <?php $args->eliminarUsuariosController(); ?>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-4"></div>

        <div class="col-md-8"> <?php echo $args->delUsuariosController(); ?> </div>
    </div>
</div>