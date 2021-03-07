<?= $this->extend('app/layout') ?>

<?= $this->section('title') ?>
Actualizar Orden

<?= $this->endSection() ?>

<?= $this->section('orden_actualizar')  ?>

<div class="br-pagebody" id="contenido">
  <div class="br-section-wrapper  pd-sm-t-30 pd-sm-x-30">
    <h6 class="tx-gray-800 tx-uppercase tx-bold tx-18 mg-b-0 "><span class="icon wd-40"><i class="ion-ios-list-outline tx-24"></i> </span> Actualizar los datos de esta orden de trabajo.</h6>
    <p class="mg-b-5">Este sistema generá ordenes de trabajo, para pruebas y ensayos.</p>
    <div class="row justify-content-between text-center px-3">
      <span class="col-6 tx-gray-800  tx-14 mg-b-10">Fecha: <strong><?php echo $myTime = date('d-m-y'); ?></strong></span>
      <span class="col-6 tx-gray-800  tx-14 mg-b-10">Encargado de realizar la orden:<strong class="tx-uppercase"> <?php echo session('nombre') ?> <?php echo session('apellido') ?></span>
    </div>


    <form id="formularioOrden" class="form-layout form-layout-1"  action="<?php echo base_url().'/OrdenesController/actualizarOrden';?>" method="POST">
      <div class="row mg-b-25">
        <div class="col-lg-6">
          <div class="form-group ">
            <label class="form-control-label font-weight-normal ">Nombre del proyecto : <span class="tx-danger">*</span></label>
            <input type="text" class="form-control tx-bold" value="<?= $orden[0]->nombre_proyecto ?>" name="nombre_proyecto" placeholder="Ingrese nombre del proyecto">
            <input type="hidden" class="form-control tx-bold" value="<?= $orden[0]->idorden_de_trabajo ?>" name="id_orden" placeholder="Ingrese nombre del proyecto">
          </div>
        </div><!-- col--->
        <div class="col-lg-3">
          <div class="form-group">
            <label class="form-control-label font-weight-normal">Ejecutado por:</label>
            <input type="text" name="ejecutado_por" value="<?= $orden[0]->ejecutado_por ?>" class="form-control tx-bold" placeholder="Ingrese nombre">
          </div>
        </div><!-- col-3 -->
        <div class="col-lg-3">
          <div class="form-group mg-b-10-force">
            <label class="form-control-label font-weight-normal">Fecha: <span class="tx-danger">*</span></label>
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-calendar tx-16 lh-0 op-6"></i></span>
              <input type="date" class="form-control" id="fecha" name="fecha_recepcion" value="<?= $orden[0]->fecha_recepcion ?>" placeholder="MM/DD/YYYY">

            </div>
          </div>
        </div><!-- col-3 -->

        <div class="col-lg-2">
          <p class="">Atencion a:</p>
        </div><!-- col-2 -->
        <div class="col-lg-10">
          <hr>
        </div><!-- col-10 -->

        <div class="col-lg-6">
          <div class="form-group mg-b-10-force">
            <label class="form-control-label font-weight-normal">Nombre: <span class="tx-danger">*</span></label>
            <input class="form-control tx-bold" type="text" id="nombreCliente" value="<?= $orden[0]->nombre ?>" name="nombre_cliente" placeholder="Ingrese nombre">
            <input class="form-control tx-bold" type="hidden" id="id_cliente" value="<?= $orden[0]->identrega_cliente ?>" name="id_cliente" placeholder="Ingrese nombre">
          </div>
        </div><!-- col-6 -->
        <div class="col-lg-3">
          <div class="form-group mg-b-10-force">
            <label class="form-control-label font-weight-normal">Nit:</label>
            <input class="form-control tx-bold" type="text" id="clienteNit" value="<?= $orden[0]->nit ?>" name="nit_cliente" placeholder="Ingrese nit"> 
          </div>
        </div><!-- col-3 -->
        <div class="col-lg-3">
          <div class="form-group mg-b-10-force">
            <label class="form-control-label font-weight-normal">Teléfono:</label>
            <input class="form-control tx-bold" type="text" id="telefonoCliente" value="<?= $orden[0]->telefono ?>" name="telefono_cliente" placeholder="Ingrese número de teléfono">
          </div>
        </div><!-- col-3 -->
        <div class="col-lg-3">
          <div class="form-group mg-b-10-force">
            <label class="form-control-label font-weight-normal">Correo:</label>
            <input class="form-control tx-bold" type="email" id="correoCliente" value="<?= $orden[0]->correo ?>" name="correo_cliente" placeholder="Ingrese correo">
          </div>
        </div><!-- col-3 -->
        <div class="col-lg-3">
          <div class="form-group mg-b-10-force">
            <label class="form-control-label font-weight-normal">Empresa:</label>
            <input class="form-control tx-bold" type="text" id="empresaCliente" value="<?= $orden[0]->empresa ?>" name="empresa_cliente" placeholder="Nombre de la empresa">
          </div>
        </div><!-- col-3 -->


        <div class="col-lg-12">
          <div class="form-group">
            <label class="form-control-label font-weight-normal">Observaciones:</label>
            <textarea rows="2" class="form-control" id="observaciones" name="observaciones" placeholder="Ingrese  observacion aquí"><?= $orden[0]->observacion ?></textarea>


            <hr>
          </div>
        </div><!-- col-12 -->

        
        <div class="col-lg-12">
              <h6 class="tx-gray-800 tx-bold tx-14 mg-b-10">Listado de ordenes y ensayos que la empresa realiza </h6>
             
                <div class="pd-r-10  mg-b-10">
                  <div class="bd bd-gray-300 pd-sm-t-10 pd-sm-b-10 table-responsive pd-r-10 pd-l-10">
                  <table id="tabla1" class="table table-striped table-bordered " style="width:100%" disabled = "true">
                    <thead class=" thead-colored thead-dark">
                    <tr>         
                    <th>ID:</th>               
                        <th>Código:</th>
                        <th>Descripción:</th>
                        <th>Cantidad:</th>
                        <th>Costo:</th> 
                        <th>Sub Total:</th>                                
                      </tr>
                    </thead>
                    <tbody>
                    <?php foreach($pruebaEnsayos as $value): ?>
                          <tr>         
                            <td><?=$value->idprueba_ensayos;?></td>                   
                            <td><?=$value->codigo;?></td>
                            <td><?=$value->descripcion;?></td>
                            <td><?=$value->cantidad;?></td> 
                            <td>Q.<?=$value->costo_prueba;?></td> 
                            <td>Q.<?=$value->sub_total;?></td> 
                          </tr> 
                      <?php endforeach;?>       
                    </tbody>
              </table>












            </div><!-- bd -->
          </div><!-- row -->
        </div><!-- col-12 -->
        <div class="col-lg-3 ">
          <div class="form-group mg-b-10-force">
            <label class="form-control-label font-weight-normal ">Costo total: <span class="tx-danger">*</span></label>
            <input id="costoTotal" class="form-control  tx-bold" step="any" type="number" min="0" value="<?= $orden[0]->costo_total ?>" name="costo_total" disabled placeholder="Q.00.00">
          </div>
        </div><!-- col-3 -->
        <div class="col-lg-3">
          <div class="form-group mg-b-10-force">
            <label class="form-control-label font-weight-normal">Abono:</label>
            <input id="abono" class="form-control tx-bold" step="any" type=[number]::-webkit-outer-spin-button { -webkit-appearance: none; margin: 0; } min="0" value="<?= $orden[0]->abono ?>" name="abono" placeholder="Q.00.00" onKeyUp="sumar()" disabled>
          </div>
        </div><!-- col-3 -->
        <div class="col-lg-3">
          <div class="form-group mg-b-10-force">
            <label class="form-control-label font-weight-normal">Saldo:</label>
            <input id="saldo" class="form-control tx-bold" step="any" type="number" min="0" value="<?= $orden[0]->saldo ?>" name="saldo" disabled placeholder="Q.00.00">
          </div>
        </div><!-- col-3 -->
        <span class="tx-danger tx-10 pl-3">Para no tener inconvenientes con los abonos y saldos, si desea editar las pruebas o ensayos es necesario elimianr la orden de trabajo y volver a crear uno nuevo.</span>
      </div><!-- row 25-->

      <div class="form-layout-footer">
        <button class="btn btn-info tx-18" id="enviar">Actualizar Orden</button>
        <a href="ver_ordenes" class="btn btn-secondary tx-18">Regresar</a>
      </div><!-- form-layout-footer -->
    </form><!-- form-layout -->
  </div><!-- br-section-wrapper -->
</div><!-- br-pagebody -->


<?= $this->endSection() ?>