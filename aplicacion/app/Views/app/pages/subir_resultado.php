<?=$this->extend('app/layout')?>

<?= $this->section('title') ?>
    Subir resultados    
<?= $this->endSection()?>

<?= $this->section('subir_resultado') ?>

<?php if (session('privilegio') == 'su' || session('privilegio') == 'Evaluador' ): ?> 

 <div class="pd-x-0 pd-sm-x-30 pd-t-10 pd-sm-t-10">
  <a href="ordenes" class="btn btn-info btn-with-icon">
      <div class="ht-40 justify-content-between">
        <span class="pd-x-10">Cancelar</span>
        <span class="icon wd-40"><i class="fa fa-eye "></i></span>
      </div>      
  </a>
</div>

<div class="br-pagebody ">
  <div class="br-section-wrapper pd-sm-t-30 pd-sm-x-30 ">
    <h4 class="tx-gray-800 mg-b-10">Subir resultados de las pruebas realizadas a la siguiente orden: <strong> <?=$codigo?> </strong> </h4>

    <form class="form-layout form-layout-1" action="<?php echo base_url().'/OrdenesController/resultados';?>" method="POST" enctype="multipart/form-data"><!--muy importante con esto le decimos a nuestro formulario que le podemos mandar acrchivos-->
        <div class="row mg-b-25">
            <div class="col-lg-9">
                <div class="form-group">
                    <label class="form-control-label">Observaciones: </label>
                    <textarea rows="6" class="form-control" name="observaciones" placeholder="Ingrese texto aquí"></textarea>
                    <input type="hidden" name="codigo" value="<?= $codigo?>">
                </div>
            </div><!-- col-9 --> 
            <div class="col-lg-3">
              <div class="form-group mg-b-10-force">
                <label class="form-control-label font-weight-normal">Fecha: <span class="tx-danger">*</span></label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-calendar tx-16 lh-0 op-6"></i></span>                    
                    <input 
                      type="date"
                      class="form-control"
                      name="fecha"
                      value='<?php echo  $myTime = date('Y-m-d');?>'
                      placeholder="MM/DD/YYYY"
                    >                    
                  </div>
              </div>          
            </div><!-- col-3 -->
            <div class="col-lg-6">                
                <div class="form-group mg-b-0-force">
                    <label class="form-control-label">Infomre:  <span class="tx-danger">*</span></label>
                      <input
                        class="form-control-file"
                        type="file"
                        accept="application/pdf, .doc  image/jpeg, .png "
                        name="informe"
                        placeholder="Selecciones una Imagen."
                      >
                </div>
            </div><!-- col-6 -->           
              
        </div><!-- row -->

            <div class="form-layout-footer ">
                <br>
            <button class="btn btn-info ">Guardar</button>
            <a href="resultados" class="btn btn-secondary ">Cancelar</a>          
            </div><!-- form-layout-footer -->
    </form><!-- form-layout -->


  </div><!-- br-section-wrapper -->
</div><!-- br-pagebody -->
<?php else: ?>
    <?php redirect()->to(base_url('/app'))?>

<?php endif; ?>

<?= $this->endSection()?>

