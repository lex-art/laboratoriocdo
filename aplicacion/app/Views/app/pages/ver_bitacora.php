<?=$this->extend('app/layout')?>

<?= $this->section('title') ?>
    Bitacora
<?= $this->endSection()?>

<?= $this->section('ver_bitacora') ?>
<?php if (session('privilegio') == 'su' ): ?>
<div class="br-pagebody ">
  <div class="br-section-wrapper pd-sm-t-30 pd-sm-x-30 ">
    <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10">Bitacora de búsquedas realizadas por clientes</h6>

    <div class="pd-r-10 ">
      <div class="bd bd-gray-300 pd-sm-t-10 pd-sm-b-10 table-responsive pd-r-10 pd-l-10">
        <table id="tabla1" class="table table-striped table-bordered " style="width:100%">
              <thead class=" thead-colored thead-dark">
              <tr>
                  <th>Código que búscaron</th>
                  <th>Nombre</th>
                  <th>Télefono</th>
                  <th>Correo</th>
                  <th>resultado</th>
                  <th>Fecha de búsqueda</th>
                  
                            
                </tr>
              </thead>
              <tbody>
              <?php foreach($bitacora as $value): ?>
                    <tr>
                      <th scope="row"><?=$value['codigo_orden'];?></th>
                      <td><?=$value['nombre'];?></td>
                      <td><?=$value['telefono'];?></td>
                      <td><?=$value['correo'];?></td>
                      <td><?=$value['resultado'];?></td>
                      <td><?=$value['creado'];?></td>
                      
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
        <form class="form-layout " action="<?php echo base_url().'/AppController/deleteUser';?>" method="POST" >
            <i class="icon icon ion-ios-close-outline tx-100 tx-danger lh-1 mg-t-20 d-inline-block"></i>
            <input type="hidden" id="idUsuario" name="idUsuario">
            <h4 class="tx-danger  tx-semibold mg-b-20">Alerta: Está seguro de eliminar este usuario?</h4>        
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

       <form class="form-layout form-layout-1"  action="<?php echo base_url().'/AppController/updateProfileAdmin';?>" method="POST" enctype="multipart/form-data"><!--muy importante con esto le decimos a nuestro formulario que le podemos mandar acrchivos-->
        <div class="row mg-b-25">
            <div class="col-lg-12">
                <div class="form-group">
                    <label class="form-control-label">Nombre: <span class="tx-danger">*</span></label>
                    <input class="form-control" type="text" id="nombre" name="nombre" required placeholder="Ingrese Nombre">
                    <input type="hidden" id="midUsuario" name="idUsuario">
                </div>
            </div><!-- col-12 -->
            <div class="col-lg-12">
                <div class="form-group">
                    <label class="form-control-label">Apellido: <span class="tx-danger">*</span></label>
                    <input class="form-control" type="text" id="apellido" name="apellido" required placeholder="Ingrese Apellido">
                </div>
            </div><!-- col-12 -->
            <div class="col-lg-12">
                <div class="form-group">
                    <label class="form-control-label">Género: <span class="tx-danger">*</span></label>
                    <select class="form-control" id="genero" name="genero"    required>                                               
                        <option value="Masculino">Masculino</option>
                        <option value="Femenino">Femenino</option>
                    </select>
                </div>
            </div><!-- col-12 -->  
            <div class="col-lg-12">
                    <div class="form-group mg-b-10-force">
                    <label class="form-control-label ">Nueva contraseña: <span class="tx-danger">*</span></label>
                    <input class="form-control" type="password" id="password" name="password" placeholder="Ingrese contraseña">
                </div>
            </div><!-- col-12 -->
            <div class="col-lg-12">
                <div class="form-group">
                    <label class="form-control-label">Puesto: <span class="tx-danger">*</span></label>
                    <select class="form-control" id="puesto" name="puesto"    required>
                                               
                        <option value="Administrador">Administrador</option>
                        <option value="Recepcionista">Recepcionista</option>
                        <option value="Evaluador">Evaluador</option>
                    </select>
                </div>
            </div><!-- col-12 -->
            <div class="col-lg-12">
                <div class="form-group">
                    <label class="form-control-label">Teléfono: <span class="tx-danger">*</span></label>
                    <input class="form-control" type="text" id="telefono" name="telefono" required placeholder="Ingrese su número de teléfono">
                </div>
            </div><!-- col-12 -->
            <div class="col-lg-12">
                <div class="form-group">
                    <label class="form-control-label">DPI:</label>
                    <input class="form-control" type="text" id="dpi" name="dpi" placeholder="Ingrese número de DPI">
                </div>
            </div><!-- col-12-->
            
            <div class="col-lg-12">
                
                <div class="form-group mg-b-0-force">
                    <label class="form-control-label">Foto de perfil:</label>
                    <input class="form-control-file" type="file" accept="image/jpeg, .png" name="foto_usuario" placeholder="Selecciones una Imagen.">
                </div>
            </div><!-- col-12 -->

        </div><!-- row -->

            <div class="form-layout-footer pd-x-0">
                <br>
            <button class="btn btn-info rounded-pill">Guardar</button>
            <button type="button" class="btn btn-secondary rounded-pill" data-dismiss="modal" aria-label="Close">Cancelar</button>       
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
