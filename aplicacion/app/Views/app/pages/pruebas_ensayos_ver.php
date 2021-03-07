<?= $this->extend('app/layout') ?>

<?= $this->section('title') ?>
Pruebas y ensayos
<?= $this->endSection() ?>

<?= $this->section('pruebas_ensayos_ver') ?>

<?php if (session('privilegio') == 'su' ): ?>
<div class="pd-x-0 pd-sm-x-30 pd-t-5 ">
  <a href="crear_prueba_ensayo" class="btn btn-info btn-with-icon">
    <div class="ht-40 justify-content-between">
      <span class="pd-x-10">Crear una nueva prueba o ensayo</span>
      <span class="icon wd-40"><i class="fa fa-file"></i></span>
    </div>
  </a>
</div>

<div class="br-pagebody ">
  <div class="br-section-wrapper pd-sm-t-30 pd-sm-x-30 ">
    <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10">Pruebas y ensayos registrados en el sistema </h6>

    <div class="pd-r-10 ">
      <div class="bd bd-gray-300 pd-sm-t-10 pd-sm-b-10 table-responsive pd-r-10 pd-l-10">
        <table id="tabla1" class="table table-striped table-bordered " style="width:100%">
          <thead class=" thead-colored thead-dark">
            <tr>
              <th>ID:</th>
              <th>Código:</th>
              <th>Descripción:</th>
              <th>Costo:</th>
              <th>Opciones:</th>

            </tr>
          </thead>
          <tbody>
            <?php foreach ($pruebas_ensayos_ver as $value) : ?>
              <tr>
                <th scope="row"><?= $value['idprueba_ensayo']; ?></th>
                <td><?= $value['codigo']; ?></td>
                <td><?= $value['descripcion']; ?></td>
                <td>Q.<?= $value['costo']; ?></td>
                <td>
                  <div class="btn-group">
                    <a href="#" class="btn btn-info" data-toggle="modal" data-target="#modalEditar" onClick="obtenerPruebaEnsayo(
                                  '<?php echo $value['idprueba_ensayo']; ?>',
                                  '<?php echo $value['codigo']; ?>',
                                  '<?php echo $value['descripcion']; ?>' , 
                                  '<?php echo $value['costo']; ?>', 
                                    
                                );">
                      <i class="fa fa-edit tx-16"></i>
                    </a>
                    <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#modalEliminar" onClick="eliminarUsuario('<?php echo $value['idprueba_ensayo']; ?>')">
                      <i class="fa fa-trash tx-16"></i>
                    </a>
                  </div>
                </td>


              </tr>
            <?php endforeach; ?>
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
        <form class="form-layout " action="<?php echo base_url() . '/AppController/deleteUser'; ?>" method="POST">
          <i class="icon icon ion-ios-close-outline tx-100 tx-danger lh-1 mg-t-20 d-inline-block"></i>
          <input type="hidden" id="idUsuario" name="idUsuario">
          <h4 class="tx-danger  tx-semibold mg-b-20">Alerta: Está seguro de eliminar este registro?</h4>
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

        <form class="form-layout form-layout-1" action="<?php echo base_url() . '/PruebasEnsayosController/actualizarPruebasEnsayos'; ?>" method="POST" enctype="multipart/form-data">
          <!--muy importante con esto le decimos a nuestro formulario que le podemos mandar acrchivos-->
          <div class="row mg-b-25">
            <div class="col-lg-12">
              <div class="form-group">
                <label class="form-control-label">Código:</label>
                <input class="form-control" type="text" id="mcodigo" name="codigo" required placeholder="Ingrese código.">
                <input type="hidden" id="midPruebaEnsayo" name="idPruebaEnsayo">
              </div>
            </div><!-- col-12 -->
            <div class="col-lg-12">
              <div class="form-group">
                <label class="form-control-label">Descripción: <span class="tx-danger">*</span> </label>
                <textarea rows="4" class="form-control" id="mdescripcion" name="descripcion" placeholder="Ingrese texto aquí."></textarea>
              </div>
            </div><!-- col-12 -->
            <div class="col-lg-12">
              <div class="form-group">
                <label class="form-control-label">Costo: <span class="tx-danger">*</span></label>
                <input class="form-control" type="text" id="mcosto" name="costo" required placeholder="Ingrese el costo.">
              </div>
            </div><!-- col-12 -->

          </div><!-- row -->

          <div class="form-layout-footer pd-x-0">
            <br>
            <button class="btn btn-info ">Guardar</button>
            <button class="btn btn-secondary " data-dismiss="modal" aria-label="Close">Cancelar</button>
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
<?= $this->endSection() ?>