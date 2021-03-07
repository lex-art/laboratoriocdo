<?= $this->extend('app/layout') ?>

<?= $this->section('title') ?>
Reporte
<?= $this->endSection() ?>

<?= $this->section('reportes') ?>


<div class="br-pagebody">
    <div class="br-section-wrapper  pd-sm-t-30 pd-sm-x-30">
        <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10">Sección de reportes</h6>

        <form class="form-layout form-layout-1"  action="<?php echo base_url().'/ReportesController/tipoReporte';?>" method="POST" ">
            <!--muy importante con esto le decimos a nuestro formulario que le podemos mandar acrchivos-->

            <div class="row mg-b-25">

                <div class="col-lg-4">
                    <div class="form-group">
                        <label class="form-control-label">Tipo reporte: <span class="tx-danger">*</span></label>
                        <select 
                            id="privilegio"
                            class="form-control"
                            name="tipo_reporte"
                            data-placeholder="Puesto"                           
                        >                            
                            <option value="Ordenes de trabajo" selected>Ordenes de trabajo</option>
                            <option value="Pendientes de pago">Pendientes de pago</option>
                            <option value="Finalizados">Finalizados</option>
                        </select>
                    </div>
                </div><!-- col-4 -->

                <div class="col-lg-3">
                    <div class="form-group mg-b-10-force">
                        <label class="form-control-label font-weight-normal">Del: <span class="tx-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-calendar tx-16 lh-0 op-6"></i></span>
                            <input 
                                type="date"
                                class="form-control"
                                id="fecha_del"
                                name="fecha_del"
                                placeholder="MM/DD/YYYY"
                                required
                                <?php if (isset($mensaje['fecha_inicio'])){
                                    echo('value="'.$mensaje['fecha_inicio'].'"');
                                }?>
                            >

                        </div>
                    </div>
                </div><!-- col-3 -->
                <div class="col-lg-3">
                    <div class="form-group mg-b-10-force">
                        <label class="form-control-label font-weight-normal">Hasta: <span class="tx-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-calendar tx-16 lh-0 op-6"></i></span>
                            <input 
                                type="date"
                                class="form-control"
                                id="fecha_hasta"
                                name="fecha_hasta" 
                                placeholder="MM/DD/YYYY"
                                required
                                <?php if (isset($mensaje['fecha_fin'])){
                                    echo('value="'.$mensaje['fecha_fin'].'"');
                                }?>
                            >

                        </div>
                    </div>
                </div><!-- col-3 -->

                <div class="col-lg-2">
                    <div class="form-group">
                        <label class="form-control-label"> </label>
                        <br>
                        <button class="btn btn-info ">Buscar</button>
                    </div>
                </div><!-- col-4 -->

        </form><!-- form-layout -->

        <div class="col-lg-12">
            <hr>
            <?php if (isset($mensaje['tipo_reporte'])){
                    echo('<h1>'.$mensaje['tipo_reporte'].'</h1> ');
                }?>
        </div><!-- col-4 -->

        <?php if (isset($mensaje['data'][0])) : ?>
            
            <div class="col-lg-12">

                <div class="pd-r-10 ">
                    <div class="bd bd-gray-300 pd-sm-t-10 pd-sm-b-10 table-responsive pd-r-10 pd-l-10">
                        <table id="tabla1" class="table table-striped table-bordered " style="width:100%">
                            <thead class=" thead-colored thead-dark">
                                <tr>                                    
                                    <th>Código:</th>
                                    <th>Proyecto:</th>
                                    <th>Ejecutado:</th>
                                    <th>Fecha:</th>
                                    <th>Total:</th>
                                    <th>Abono:</th>
                                    <th>Saldo:</th>
                                    <th>Estado:</th>
                                    <th>Observaciones:</th>
                                    <th>Cliente:</th>
                                    <th>Telefono:</th>
                                    <th>Encargado:</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($mensaje['data'] as $value) : ?>
                                    <tr>                                        
                                        <td scope="row"><?= $value->codigo; ?></td>
                                        <td><?= $value->nombre_proyecto; ?></td>
                                        <td><?= $value->ejecutado_por; ?></td>
                                        <td><?= $value->fecha_recepcion; ?></td>
                                        <td><?= $value->costo_total; ?></td>
                                        <td><?= $value->abono; ?></td>
                                        <td><?= $value->saldo; ?></td>                                        
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
                                        ><strong><?=$value->estado;?></strong>
                                        </td> 
                                        <td><?= $value->observacion; ?></td>
                                        <td><?= $value->nombre; ?></td>
                                        <td><?= $value->telefono; ?></td>
                                        <td><?= $value->nombre_usuario;?> <?= $value->apellido; ?></td>

                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div><!-- bd -->
                </div><!-- row -->

            </div><!-- col-4 -->

        <?php endif; ?>




    </div><!-- row -->







</div><!-- br-section-wrapper -->
</div><!-- br-pagebody -->


<?= $this->endSection() ?>