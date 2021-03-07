<?=$this->extend('app/layout')?>

<?= $this->section('title') ?>
    Usuarios
<?= $this->endSection()?>

<?= $this->section('usuarios_crear') ?>


<?php if (session('privilegio') == 'su' ): ?>
<div class="br-pagebody">
  <div class="br-section-wrapper  pd-sm-t-30 pd-sm-x-30">
    <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10">Registrar un usuario nuevo</h6>
  
    <form class="form-layout form-layout-1" action="<?php echo base_url().'/AppController/crearUsuario';?>" method="POST" enctype="multipart/form-data"><!--muy importante con esto le decimos a nuestro formulario que le podemos mandar acrchivos-->
        <div class="row mg-b-25">
            <div class="col-lg-8">
                <div class="form-group">
                    <label class="form-control-label">Correo: <span class="tx-danger">*</span></label>
                    <input class="form-control" id="email" name="email" type="email"  required placeholder="Ingrese correo electrónico">
                </div>
            </div><!-- col-4 -->            
            <div class="col-lg-4">
                <div class="form-group">
                    <label class="form-control-label">Puesto: <span class="tx-danger">*</span></label>
                    <select class="form-control" id="puesto" name="puesto"    required>
                        <option value="" hidden selected>Seleccione una opción</option>                        
                        <option value="Administrador">Administrador</option>
                        <option value="Recepcionista">Recepcionista</option>
                        <option value="Evaluador">Evaluador</option>
                    </select>
                </div>
            </div><!-- col-4 -->  
        </div><!-- row -->

            <div class="form-layout-footer ">
                <br>
            <button class="btn btn-info ">Crear</button>
            <a href="usuarios_listar" class="btn btn-secondary">Cancelar</a>          
            </div><!-- form-layout-footer -->
    </form><!-- form-layout -->

</div><!-- br-section-wrapper -->
</div><!-- br-pagebody -->
<?php else: ?>
    <?php redirect()->to(base_url('/app'))?>

<?php endif; ?>

<?= $this->endSection()?>
