<?=$this->extend('webPage/layout')?>

<?= $this->section('title') ?>
    Nosotros
<?= $this->endSection()?>

<?= $this->section('nosotros') ?>
    <div class="container">
        <div class="padre">
            <div class="hijo">
                <div class="hijo-titulo">
                    <h1>CDO.Laboratorio</h1>
                </div>

                <div class="hijo-texto">
                    Somos una empresa quetzalteca que inicio en el año 2012 prestando servicios de ensayos de suelos y concreto. <br>
                    Año con año nos esforzamos en mejorar, para brindar un excelente servicio, además de ampliar nuestra cartera de servicios.
                </div>


                
            </div>
            <div class="hijo">                
                    <img src="<?php base_url();?>assets/img/mision.png" alt="Logo">
                
            </div>

            <div class="hijo">                
                    <img src="<?php base_url();?>assets/img/vision.png" alt="Logo">
                
            </div>

            <div class="hijo-vision">
                <div class="hijo-titulo">
                    <h1>Proposito</h1>
                </div>

                <div class="hijo-texto">
                    Prestar servicios confiables, de primera calidad en estudios geotécnicos, ensayos de suelos y concreto.
                </div>


                
            </div>
            
            
        </div>
        
    </div>
    
<?= $this->endSection()?>

