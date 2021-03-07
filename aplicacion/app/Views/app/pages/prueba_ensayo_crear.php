<?=$this->extend('app/layout')?>

<?= $this->section('title') ?>
    Usuarios
<?= $this->endSection()?>

<?= $this->section('prueba_ensayo_crear') ?>
<?php if (session('privilegio') == 'su' ): ?>

<div class="br-pagebody">
  <div class="br-section-wrapper  pd-sm-t-30 pd-sm-x-30">
    <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10">Registrar una nueva prueba o ensayo</h6>
  
    <form class="form-layout form-layout-1" action="<?php echo base_url().'/PruebasEnsayosController/crearPruebasEnsayos';?>" method="POST" ><!--muy importante con esto le decimos a nuestro formulario que le podemos mandar acrchivos-->
        <div class="row mg-b-25">
        <div class="col-lg-12">
                <div class="form-group">
                    <label class="form-control-label">Código:</label>
                    <input class="form-control" type="text" name="codigo"  placeholder="Ingrese el codigo.">                    
                </div>
            </div><!-- col-12 -->
            <div class="col-lg-12">
                <div class="form-group">
                    <label class="form-control-label">Descripción:  <span class="tx-danger">*</span> </label>
                    <textarea rows="4" class="form-control" name="descripcion" placeholder="Ingrese texto aqu.í" required></textarea>
                </div>
            </div><!-- col-12 --> 
            <div class="col-lg-4">
                <div class="form-group">
                    <label class="form-control-label">Costo: <span class="tx-danger">*</span></label>
                    <input class="form-control" type="number" name="costo" required placeholder="Ingrese costo.">
                </div>
            </div><!-- col-4 --> 
        </div><!-- row -->

            <div class="form-layout-footer ">
                <br>
            <button class="btn btn-info">Crear</button>
            <a href="ver_pruebas_ensayos" class="btn btn-secondary ">Cancelar</a>          
            </div><!-- form-layout-footer -->
    </form><!-- form-layout -->

</div><!-- br-section-wrapper -->
</div><!-- br-pagebody -->
    
<?php else: ?>
    <?php redirect()->to(base_url('/app'))?>

<?php endif; ?>
<?= $this->endSection()?>
