<?=$this->extend('webPage/layout')?>

<?= $this->section('title') ?>
    Resultado
<?= $this->endSection()?>

<?= $this->section('consulta_pendiente_pago') ?>

<div class="margen-del-nav">
    <div class="container">
        <h1>Pendiente de actualización financiera.</h1>  
        <p>Favor de resolver la situación financiera de esta orden.</p>  
        <a 
            class="btn btn-dark"
            href="consultas"
            >Regresar</a>  
    
    </div>
</div>


   
    
<?= $this->endSection()?>

