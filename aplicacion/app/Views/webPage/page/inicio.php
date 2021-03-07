<?= $this->extend('webPage/layout') ?>

<?= $this->section('title') ?>
Inicio
<?= $this->endSection() ?>

<?= $this->section('inicio') ?>

<div class="container">
    <div class="row mt-4 ">

        <div class="col-xl">
            <div class="row justify-content-center">
                <div class="mx-auto">
                    <img src="<?php base_url(); ?>assets/img/logo-inicio.png" alt="Logo" class="img-tam-logo">
                    <div class="py-2">
                        <h5 class="text-dark text-center texto">ENSAYOS DE SUELOS Y CONCRETO <br> ESTUDIOS GEOTÉCNICOS</h5>
                    </div>
                </div>
            </div>

            <div class="col-xl">
            <div class="row justify-content-center">
                <div class="mx-auto col-8 ">
                    <h3 class="text-dark text-center font-weight-bold texto-form"><?php echo $evento[0]['titulo'] ?></h3>
                    <p class="text-dark text-center"><?php echo $evento[0]['description'] ?></p>
                </div>
            </div>
        </div>
        </div>
        
    </div>
    <div class="row">

        <div class="col-xl">
            <div class="row justify-content-center">
                <div class="mx-auto">
                    <img src="<?php base_url(); ?>assets/img/fondo1.png" alt="Logo" class="img-tam">
                    <p class="text-dark text-center ">Puedes contactarnos mediante el siguiente enlace:</p>
                    <a href="https://api.whatsapp.com/send?phone=77618422" class="nav-link-button" target="_blank">
                        <h3 class="text-dark text-center "><i class="fa fa-whatsapp"></i></i> 7761 8422</h3>
                    </a>
                    
                </div>
            </div>

        </div>

        <div class="col-xl">
            <div class="row justify-content-center">
                <div class="mx-auto col-8 ">
                    <form action="<?php echo base_url() . '/BuscarController/buscarOrden'; ?>" method="POST">
                        <div class="form-group">
                            <h2 class="text-dark text-center font-weight-bold texto-form">Consultas de ensayos</h2>
                        </div>
                        <div class="form-group">
                            <label for="codigo">Código de la orden:</label>
                            <input type="text" name="codigo" class="form-control" id="codigo" placeholder="Ingrese el código de su orden" required>
                        </div>
                        <div class="form-group">
                            <label for="nombres">Nombres: </label>
                            <input type="text" name="nombres" class="form-control" id="nombres" placeholder="Ingrese sus nombres" required>
                        </div>
                        <div class="form-group">
                            <label for="correo">Correo:</label>
                            <input type="email" name="email" class="form-control" id="correo" aria-describedby="emailHelp" placeholder="Ingrese su correo" required>

                        </div>
                        <div class="form-group">
                            <label for="telefono">Teléfono: </label>
                            <input type="text" name="telefono" class="form-control" id="telefono" placeholder="Ingrese número de teléfono" required>
                        </div>
                        <div class="row">
                            <div class="mx-auto">
                                <button type="submit" class="btn btn-info">Búscar</button>
                            </div>
                        </div>


                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
<?= $this->endSection() ?>