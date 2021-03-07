<?=$this->extend('app/layout')?>

<?= $this->section('title') ?>
 Publicar evento o actividad
<?= $this->endSection()?>

<?= $this->section('publicar_evento') ?>
<?php if (session('privilegio') == 'su' ): ?>
<div class="br-pagebody ">
  <div class="br-section-wrapper pd-sm-t-30 pd-sm-x-30 ">
    <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10">Publica un evento o acticidad en la pagina de inicio</h6>

    <div class="pd-r-10 ">
      <div class="bd bd-gray-300 pd-sm-t-10 pd-sm-b-10 table-responsive pd-r-10 pd-l-10">
        <table id="tabla1" class="table table-striped table-bordered " style="width:100%">
              <thead class=" thead-colored thead-dark">
              <tr>
                  <th>Opciones</th>
                  <th>Tipo</th>
                  <th>Titulo</th>
                  <th>Descripción</th> 
                            
                </tr>
              </thead>
              <tbody>
              <?php foreach($eventos as $value): ?>
                    <tr>
                    <td>
                  <div class="btn-group">
                    <a href="#" class="btn btn-info" data-toggle="modal" data-target="#modalEditar" onClick="eventoActividad(
                                    '<?php echo $value['id_evento']; ?>',
                                    '<?php echo $value['titulo']; ?>' , 
                                    '<?php echo $value['description']; ?>',
                                );">
                      <i class="fa fa-edit tx-16"></i>
                    </a>
                    <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#modalEliminar" onClick="eliminarEventoActividad('<?php echo $value['id_evento']; ?>')">
                      <i class="fa fa-trash tx-16"></i>
                    </a>
                  </div>
                </td>
                      <th scope="row"><?=$value['evento_actividad'];?></th>
                      <td><?=$value['titulo'];?></td>
                      <td><?=$value['description'];?></td>                    
                      
                    </tr> 
                <?php endforeach;?>       
              </tbody>
        </table>
      </div><!-- bd -->
    </div><!-- row -->

  </div><!-- br-section-wrapper -->
</div><!-- br-pagebody -->


<!-- #################################################### MODAL ELIMINAR ###################################### -->
<div id="modalEliminar" class="modal fade">
  <div class="modal-dialog" role="document">
    <div class="modal-content tx-size-sm">
      <div class="modal-body tx-center pd-y-20 pd-x-20">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <form class="form-layout " action="<?php echo base_url().'/AppController/deleteEvento';?>" method="POST" >
            <i class="icon icon ion-ios-close-outline tx-100 tx-danger lh-1 mg-t-20 d-inline-block"></i>
            <input type="hidden" id="midEventoElimianar" name="idEvento">
            <h4 class="tx-danger  tx-semibold mg-b-20">Alerta: Está seguro de eliminar la publicación?</h4>        
            <button class="btn btn-danger">Continuar</button>              
        </form>
        </div><!-- modal-body -->
      </div><!-- modal-content -->
    </div><!-- modal-dialog -->
</div><!-- modal -->

<!-- ###################################### MODAL EDITAR ############################################### -->
<div id="modalEditar" class="modal fade">
   <div class="modal-dialog modal-dialog-vertical-center" role="document">
     <div class="modal-content bd-0 tx-14">
       <div class="modal-header pd-y-20 pd-x-25">
         <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Actualizar registro</h6>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
       </div>
       <div class="modal-body pd-25">

       <form class="form-layout form-layout-1"  action="<?php echo base_url().'/AppController/updateEvento';?>" method="POST" enctype="multipart/form-data"><!--muy importante con esto le decimos a nuestro formulario que le podemos mandar acrchivos-->
        <div class="row mg-b-25">
            <div class="col-lg-12">
                <div class="form-group">
                    <label class="form-control-label">Titulo: <span class="tx-danger">*</span></label>
                    <input class="form-control" type="text" id="mtitulo" name="titulo" required placeholder="Ingrese Nombre">
                    <input type="hidden" id="midEvento" name="idEvento">
                </div>
            </div><!-- col-12 -->
            <div class="col-lg-12">
                <div class="form-group">
                    <label class="form-control-label">Descripción: <span class="tx-danger">*</span></label>
                    <textarea rows="6" class="form-control" id="mdescription" name="description" placeholder="Ingrese texto aquí"></textarea>
                </div>
            </div><!-- col-12 -->            

            <div class="form-layout-footer pd-x-0">
                <br>
            <button class="btn btn-info">Guardar</button>
            <button type="button" class="btn btn-secondary " data-dismiss="modal" aria-label="Close">Cancelar</button>       
            </div><!-- form-layout-footer -->
    </form><!-- form-layout -->
          
          
          <!-- form-layout -->
       </div><!-- modal-body pd-25 -->            
     </div><!-- modal-content -->  
   </div><!-- modal-dialog -->
</div><!-- modal -->
<?php else: ?>
    <?php redirect()->to(base_url('/app'))?>

<?php endif; ?>
<?= $this->endSection()?>
