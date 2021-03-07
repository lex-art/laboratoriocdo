<?=$this->extend('app/layout')?>

<?= $this->section('title') ?>
    Editar resultado  
<?= $this->endSection()?>

<?= $this->section('editar_resultado') ?>



<div class="br-pagebody ">
  <div class="br-section-wrapper pd-sm-t-30 pd-sm-x-30 ">
    <h4 class="tx-gray-800 mg-b-10">Editar los resultados de las pruebas realizadas a la siguiente orden: <strong> <?=$codigo?> </strong> </h4>

    <form class="form-layout form-layout-1" action="<?php echo base_url().'/OrdenesController/editarResultados';?>" method="POST" enctype="multipart/form-data"><!--muy importante con esto le decimos a nuestro formulario que le podemos mandar acrchivos-->
        <div class="row mg-b-25">
            <div class="col-lg-9">
                <div class="form-group">
                    <label class="form-control-label">Observaciones: </label>
                    <textarea 
                      rows="6" 
                      class="form-control" 
                      name="observaciones"                      
                      placeholder="Ingrese texto aquí"
                      required
                    ><?=$resultado[0]->observacion ;?>
                    </textarea>
                    <input type="hidden" name="idResultado" value="<?= $resultado[0]->idinforme_resultado ?>">
                    <input type="hidden" name="codigo" value="<?= $codigo ?>">
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
                      value="<?= $resultado[0]->fecha;?>"
                      placeholder="MM/DD/YYYY"
                      name="fecha"
                      required
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
                        required
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

<?= $this->endSection()?>

