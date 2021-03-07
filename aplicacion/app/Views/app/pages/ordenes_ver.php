<?= $this->extend('app/layout') ?>

<?= $this->section('title') ?>
Ordenes de trabajo

<?= $this->endSection() ?>

<?= $this->section('ordenes_ver') ?>

<?php if (session('privilegio') == 'su' || session('privilegio') == 'Recepcionista' ): ?> 
<div class="pd-x-0 pd-sm-x-30 pd-t-10 pd-sm-t-10">
  <a href="ordenes" class="btn btn-info btn-with-icon">
    <div class="ht-40 justify-content-between">
      <span class="pd-x-10">Crear orden de trabajo</span>
      <span class="icon wd-40"><i class="menu-item-icon icon ion-ios-list-outline tx-24"></i></i></span>
    </div>
  </a>
</div>

<div class="br-pagebody ">
  <div class="br-section-wrapper pd-sm-t-30 pd-sm-x-30 ">
    <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10">Ordenes pendientes de confirmar</h6>

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
              <th>Observaciones</th>
              <th>Opciones</th>

            </tr>
          </thead>
          <tbody>
            <?php foreach ($pendiente_de_confirmar as $value) : ?>
              <tr>

                <th scope="row"><?= $value['codigo']; ?></th>
                <td><?= $value['nombre_proyecto']; ?></td>
                <td><?= $value['ejecutado_por']; ?></td>
                <td><?php
                    $date = date_create($value['fecha_recepcion']);
                    echo date_format($date, "d-m-Y "); ?></td>
                <td><?= $value['costo_total']; ?></td>
                <td><?= $value['abono']; ?></td>
                <td><?= $value['saldo']; ?></td>
                <td><?= $value['observacion']; ?></td>
                <td>
                  <div class="btn-group">

                    <a href="#" class="btn btn-info" data-toggle="modal" data-target="#modalLiberar" onClick="liberarOrden('<?php echo $value['idorden_de_trabajo']; ?>')">
                      Confirmar
                    </a>
                    <a 
                      href="imprimir?codigo=<?php echo $value['codigo']; ?>"
                      class="btn btn-dark"
                      title="Imprimir orden de trabajo"                    
                    >
                      <i class="fas fa-print tx-16"></i>
                    </a>

                    <?php
                    if (session('privilegio') == 'Administrador' || session('privilegio') == 'su') {
                      echo ('<a 
                              href="#"
                              title="Eliminar orden de trabajo"
                              class = "btn btn-danger "
                              data-toggle="modal"
                              data-target="#modalEliminar"
                                `' . $value['idorden_de_trabajo'] . '`,                                     
                                )"
                            >                       
                              <i class="fa fa-trash tx-16"></i>
                            </a>');
                    }
                    ?>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div><!-- bd -->
    </div><!-- row -->

  </div><!-- br-section-wrapper -->
</div><!-- br-pagebody -->

<div class="br-pagebody ">
  <div class="br-section-wrapper pd-sm-t-30 pd-sm-x-30 ">
    <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10">Ordenes Registradas en el sistema</h6>

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
            <?php foreach ($ordenes as $value) : ?>
              <tr>
                <th scope="row"><?= $value['codigo']; ?></th>
                <td><?= $value['nombre_proyecto']; ?></td>
                <td><?= $value['fecha_recepcion']; ?></td>
                <td><?= $value['costo_total']; ?></td>
                <td><?= $value['abono']; ?></td>
                <td><?= $value['saldo']; ?></td>
                <td <?php
                    if ($value['estado'] == "Pendiente de pago") {
                      echo ('class="text-danger"');
                    } elseif ($value['estado'] == "Finalizado") {
                      echo ('class="text-success"');
                    } elseif ($value['estado'] == "En proceso") {
                      echo ('class="text-warning"');
                    } elseif ($value['estado'] == "Pendiente de confirmar") {
                      echo ('class="text-info"');
                    }
                    ?>><strong><?= $value['estado']; ?></strong>
                </td>

                <td>
                  <div class="btn-group">
                    <a
                     href="ver_orden?codigo=<?php echo $value['codigo']; ?>" 
                     class="btn btn-warning "
                     title="Ver orden de trabajo" 
                     >
                      <i class="fa fa-eye tx-16"></i>
                    </a><!-- br-menu-link -->
                    <a 
                    href="actualizar_orden?codigo=<?php echo $value['codigo']; ?>"
                     class="btn btn-info "
                     title="Actualizar orden de trabajo" 
                     >
                      <i class="fa fa-edit tx-16"></i>
                    </a><!-- br-menu-link -->
                    <a 
                      href="imprimir?codigo=<?php echo $value['codigo']; ?>"
                      class="btn btn-dark"
                      title="Imprimir orden de trabajo"                    
                    >
                      <i class="fas fa-print tx-16"></i>
                    </a>
                    <?php
                    if (session('privilegio') == 'Administrador' || session('privilegio') == 'su') {
                      echo ('<a 
                                    href="#"
                                    class = "btn btn-danger "
                                    title="Eliminar orden de trabajo" 
                                    data-toggle="modal"
                                    data-target="#modalEliminar"
                                      `' . $value['idorden_de_trabajo'] . '`,                                     
                                      )"
                                  >                       
                                    <i class="fa fa-trash tx-16"></i>
                                  </a>');
                    }
                    ?>
                    

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


<!-- #################################################### MODAL  LIBERAR ###################################### -->
<div id="modalLiberar" class="modal fade">
  <div class="modal-dialog" role="document">
    <div class="modal-content tx-size-sm">
      <div class="modal-body tx-center pd-y-20 pd-x-20">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <i class="icon ion-ios-checkmark-outline tx-100 tx-info lh-1 mg-t-20 d-inline-block"></i>
        <h4 class="tx-info  tx-semibold mg-b-20">¿Esta seguro de confirmar esta orden?</h4>
        <form class="form-layout" action="<?php echo base_url() . '/OrdenesController/confirmarOrden'; ?>" method="POST">
          <input class="form-control tx-bold" type="hidden" id="midOrden" name="midOrden" placeholder="Ingrese cantidad" required>
          <br>
          <button class="btn btn-info tx-18">Aceptar</button>
        </form>
      </div><!-- modal-body -->
    </div><!-- modal-content -->
  </div><!-- modal-dialog -->
</div><!-- modal -->

<!-- #################################################### MODAL  ELIMINAR ###################################### -->
<div id="modalEliminar" class="modal fade">
  <div class="modal-dialog" role="document">
    <div class="modal-content tx-size-sm">
      <div class="modal-body tx-center pd-y-20 pd-x-20">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <i class="icon ion-ios-checkmark-outline tx-100 tx-danger lh-1 mg-t-20 d-inline-block"></i>
        <h4 class="tx-danger  tx-semibold mg-b-20">¿Esta seguro de eliminar esta orden?</h4>
        <form class="form-layout" action="<?php echo base_url() . '/OrdenesController/eliminar'; ?>" method="POST">
          <input class="form-control tx-bold" type="hidden" id="midOrdeneliminar" name="midOrdeneliminar" placeholder="Ingrese cantidad" required>
          <br>
          <button class="btn btn-danger tx-18">Aceptar</button>
        </form>
      </div><!-- modal-body -->
    </div><!-- modal-content -->
  </div><!-- modal-dialog -->
</div><!-- modal -->

<?php else: ?>
    <?php redirect()->to(base_url('/app'))?>

<?php endif; ?>

<?= $this->endSection() ?>