<?=$this->extend('app/layout')?>

<?= $this->section('title') ?>
  Resultados
    
<?= $this->endSection()?>

<?= $this->section('resultados') ?>

<?php if (session('privilegio') == 'su' || session('privilegio') == 'Evaluador' ): ?> 

<div class="br-pagebody ">
  <div class="br-section-wrapper pd-sm-t-30 pd-sm-x-30 ">
    <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10">Ordenes pendientes de subir resultados</h6>

    <div class="pd-r-10 ">
      <div class="bd bd-gray-300 pd-sm-t-10 pd-sm-b-10 table-responsive pd-r-10 pd-l-10">
        <table id="tabla1" class="table table-striped table-bordered " style="width:100%">
              <thead class=" thead-colored thead-dark">
              <tr>
                  <th>Código</th>
                  <th>Proyecto</th>
                  <th>Ejecutá</th>
                  <th>Fecha</th>
                  <th>Costo</th>
                  <th>Abono</th>
                  <th>Saldo</th>
                  <th>Estado</th>
                  <th>Opciones</th>    
                            
                </tr>
              </thead>
              <tbody>
              <?php foreach($ordenes as $value): ?>
                    <tr>
                      <th scope="row"><?=$value['codigo'];?></th>
                      <td><?=$value['nombre_proyecto'];?></td>
                      <td><?=$value['ejecutado_por'];?></td>
                      <td><?=$value['fecha_recepcion'];?></td>
                      <td><?=$value['costo_total'];?></td>
                      <td><?=$value['abono'];?></td>
                      <td><?=$value['saldo'];?></td> 
                      <td><?=$value['estado'];?></td> 
                      <td>
                        <div class="btn-group">                           
                            <a 
                              href= "subir_resultado?codigo=<?php echo $value['codigo'];?>"
                              class = "btn btn-info"
                            >
                                Subir resultado
                            </a>
                        </div>
                      </td> 
                    </tr> 
                <?php endforeach;?>
              </tbody>
        </table>
      </div><!-- bd -->
    </div><!-- row -->
  </div><!-- br-section-wrapper -->
</div><!-- br-pagebody -->

<div class="br-pagebody ">
  <div class="br-section-wrapper pd-sm-t-30 pd-sm-x-30 ">
    <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10">Ordenes y sus resultados</h6>

    <div class="pd-r-10 ">
      <div class="bd bd-gray-300 pd-sm-t-10 pd-sm-b-10 table-responsive pd-r-10 pd-l-10">
        <table id="tabla2" class="table table-striped table-bordered " style="width:100%">
              <thead class=" thead-colored thead-dark">
              <tr>
                  <th>Código</th>
                  <th>Proyecto</th>                  
                  <th>Fecha</th>
                  <th>Costo</th>
                  <th>Abono</th>
                  <th>Saldo</th>
                  <th>Estado</th>
                  <th>Opciones</th>   
                            
                </tr>
              </thead>
              <tbody>
              
              <?php foreach($ordenes_terminadas as $value): ?>
                    <tr>
                      <th scope="row"><?=$value->codigo ;?></th>
                      <td><?=$value->nombre_proyecto;?></td>
                      <td><?=$value->fecha_recepcion;?></td>
                      <td>Q.<?=$value->costo_total;?></td>
                      <td>Q.<?=$value->abono;?></td>
                      <td>Q.<?=$value->saldo;?></td> 
                      <td <?php
                            if ($value->estado=="Pendiente de pago") {
                            echo('class="text-danger"');
                            }
                            elseif ($value->estado=="Finalizado") {
                            echo('class="text-success"');
                            } 
                            elseif ($value->estado=="En proceso") {
                            echo('class="text-warning"');
                            }
                            elseif ($value->estado=="Pendiente de confirmar") {
                            echo('class="text-info"');
                            }                     
                        ?>  
                    ><?php
                           echo('<strong>'.$value->estado.'</strong> ');
                              if ($value->estado == "Pendiente de pago") {
                                echo(
                                '<a 
                                    href="#"
                                    class = "btn btn-danger"
                                    data-toggle="modal"
                                    data-target="#modalCancelar"
                                    onClick = "cancelarOrden(
                                      `'.$value->idorden_de_trabajo.'`,
                                      `'.$value->costo_total.'`,
                                      `'.$value->saldo.'`,
                                      )"
                                  >                       
                                  <i class="fa fa-dollar-sign tx-16"></i>
                                  </a>'
                                );
                              }
                          ?> 
                      </td> 
                      <td>
                        <div class="btn-group">                            
                           
                          <a 
                            href= "ver_orden_evaluador?codigo=<?php echo $value->codigo;?>"
                            class="btn btn-warning ">
                            <i class="fa fa-eye tx-16"></i>
                          </a><!-- br-menu-link -->          
                          <a 
                            href= "<?php echo base_url().'/assets/informes/'.$value->url_informe;?>"
                            target="_blank"
                            class = "btn btn-info"
                          >
                            <i class="fa fa-file-alt tx-16"></i>
                          </a>
                          <a 
                            href= "editar_resultado?codigo=<?php echo $value->codigo;?>"                            
                            class = "btn btn-success"
                          >
                            <i class="fa fa-edit tx-16"></i>
                          </a>
                        </div>
                      </td> 
                    </tr> 
                <?php endforeach;?>
              </tbody>
        </table>
      </div><!-- bd -->
    </div><!-- row -->
  </div><!-- br-section-wrapper -->
</div><!-- br-pagebody -->

<!-- #################################################### MODAL  Agregar ###################################### -->
<div id="modalLiberar" class="modal fade">
  <div class="modal-dialog" role="document">
    <div class="modal-content tx-size-sm">
    <div class="modal-body tx-center pd-y-20 pd-x-20">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <i class="icon ion-ios-checkmark-outline tx-100 tx-success lh-1 mg-t-20 d-inline-block"></i>
        <p class="mg-b-20 mg-x-20">¿Cuantas pruebas desea agregar?</p>
        <input class="form-control tx-bold" type="number"  id="monto" name="monto" min="1" value="1"  placeholder="Ingrese cantidad" required>
        <br>
        <button type="button" class="btn btn-info tx-18" data-dismiss="modal" aria-label="Close">Aceptar</button>
        </div><!-- modal-body -->
      </div><!-- modal-content -->
    </div><!-- modal-dialog -->
</div><!-- modal -->

<!-- ###################################### MODAL CANCELAR  ############################################### -->
<div id="modalCancelar" class="modal fade">
   <div class="modal-dialog modal-dialog-vertical-center" role="document">
     <div class="modal-content bd-0 tx-14">
       <div class="modal-header pd-b-0 pd-x-25">
         <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Cancelar la orden de trabajo</h6>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
       </div>
       <div class="modal-body pd-25">

       <form class="form-layout form-layout-1"  action="<?php echo base_url().'/OrdenesController/pagarOrden';?>" method="POST" ><!--muy importante con esto le decimos a nuestro formulario que le podemos mandar acrchivos-->
        <div class="row mg-b-5">
            <div class="col-lg-12">
                <div class="form-group">
                    <label class="form-control-label">Costo: <span class="tx-danger">*</span></label>
                    <input 
                      class="form-control" 
                      type="text" 
                      id="costoTotal"
                      name="total" 
                      disabled 
                      required 
                      placeholder="Ingrese total de la orden."
                    >
                    <input type="hidden" id="mcodOrden" name="codOrden">
                </div>
            </div><!-- col-12 -->
            <div class="col-lg-12">
                <div class="form-group">
                    <label class="form-control-label">saldo: <span class="tx-danger">*</span></label>
                    <input 
                      class="form-control"
                      type="text"
                      id="pendiente"
                      name="saldo"
                      required
                      disabled
                      placeholder="Ingrese el saldo de la orden."                     
                    >                    
                </div>
            </div><!-- col-12 -->
            <div class="col-lg-12">
                <div class="form-group">
                  <label class="form-control-label ">Abono: <span class="tx-danger">*</span></label>
                  <input 
                    class="form-control"
                    type=[number]::-webkit-outer-spin-button { 
                      -webkit-appearance: none; 
                      margin: 0; 
                    }
                    id="abono"
                    min = "1"
                    name="abono"
                    required placeholder="Ingrese el abono correspondiente."
                    oninput="sumarModal(this.value);"
                  >
                </div>
            </div><!-- col-12 -->  
            <div class="col-lg-12">
                    <div class="form-group mg-b-10-force">
                    <label class="form-control-label ">Saldo nuevo: <span class="tx-danger">*</span></label>
                    <input 
                      class="form-control"
                      type="number"
                      id="saldo" 
                      name="saldo_nuevo" 
                      disabled 
                      required 
                      placeholder="Ingrese saldo nuevo"
                    >
                </div>
            </div><!-- col-12 -->
        </div><!-- row -->
            <div class="form-layout-footer pd-x-0">
                <br>
            <button class="btn btn-info">Guardar</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close">Cancelar</button>       
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

