<?= $this->extend('webPage/layout') ?>

<?= $this->section('title') ?>
Inicio
<?= $this->endSection() ?>

<?= $this->section('inicio') ?>
<div class="margen-del-nav">
    <div class="container">  
        <form class="row g-3 " action="<?php echo base_url() . '/BuscarController/buscarOrdenInicio'; ?>" method="POST"">
            <div class=" col-md-3">
            <label for="input1" class="form-label">Código de la orden:</label>
            <input type="text" class="form-control" id="input1" name="codigo" required placeholder="Ingrese el código" <?php if (isset($mensaje['datos'])) {
                                                                                                                            echo ('
                         value="' . $mensaje['datos']['codigo_orden'] . '"
                        
                        ');
                                                                                                                        } ?>>
    </div>
    <div class="col-md-3">
        <label for="input2" class="form-label">Nombres:</label>
        <input type="text" class="form-control" id="input2" name="nombres" required placeholder="Ingrese sus nombres" <?php if (isset($mensaje['datos'])) {
                                                                                                                            echo ('
                         value="' . $mensaje['datos']['nombre'] . '"
                        
                        ');
                                                                                                                        } ?>>
    </div>
    <div class="col-md-2">
        <label for="input3" class="form-label">Email:</label>
        <input type="email" class="form-control" id="input3" name="email" required placeholder="Ingrese su correo " <?php if (isset($mensaje['datos'])) {
                                                                                                                        echo ('
                         value="' . $mensaje['datos']['correo'] . '"
                        
                        ');
                                                                                                                    } ?>>
    </div>
    <div class="col-md-2">
        <label for="input4" class="form-label">Teléfono:</label>
        <input type="text" class="form-control" id="input4" name="telefono" required placeholder="Número de teléfono" <?php if (isset($mensaje['datos'])) {
                                                                                                                            echo ('
                         value="' . $mensaje['datos']['telefono'] . '"
                        
                        ');
                                                                                                                        } ?>>
    </div>
    <div class="col-md-1 pt-4">
        <button class="btn btn-info ">Buscar</button>
    </div>


    <?php if (isset($mensaje['resultado'])) : ?>

        <div class="col-md-12 pt-2">
            <label for="observaciones" class="form-label">Observaciones:</label>
            <textarea rows="3" class="form-control" name="observaciones" placeholder="Ningunaí" disabled><?= $mensaje['resultado'][0]->observacion; ?>  
                    </textarea>
        </div>

    <?php endif; ?>

    </form>
    <hr>
</div>
</div>

<?php if (isset($mensaje['resultado'])) : ?>

    <div class="container">

        <embed src="<?=base_url().'/assets/informes/'.$mensaje['resultado'][0]->url_informe;?>#toolbar=0" type="application/pdf" width="100%" height="600px" />
    </div>

<?php endif; ?>
<!-- <div class="container-frame"> 
            <iframe class="responsive-iframe" src="http://localhost/laboratorio_app/informes/informe%20OT-1-4157N/Tarea%205.pdf"></iframe>
        </div>    -->

</div>
<div class="inicio-padre">
    <div class="inicio-hijo">
        <img src="<?php base_url(); ?>assets/img/logo-inicio.png" alt="Logo">
        <br>
        <br>
        <p> Somos una empresa lider en el merdado,
            dedicada a las pruebas y ensayos en hormigón.</p>
    </div>
    <div class="inicio-hijo">
        <img src="<?php base_url(); ?>assets/img/fondo1.png" alt="Logo">
    </div>
</div>
<?= $this->endSection() ?>