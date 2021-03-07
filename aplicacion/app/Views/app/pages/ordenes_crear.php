<?=$this->extend('app/layout')?>

<?= $this->section('title') ?>
    Crear orden
    
<?= $this->endSection()?>

<?= $this->section('ordenes_crear') ?>

<?php if (session('privilegio') == 'su' || session('privilegio') == 'Recepcionista' ): ?> 

<div class="pd-x-0 pd-sm-x-30 pd-t-10 pd-sm-t-10">
  <a href="ver_ordenes" class="btn btn-info btn-with-icon">
      <div class="ht-40 justify-content-between">
        <span class="pd-x-10">Regresar</span>
        <span class="icon wd-40"><i class="fa fa-reply"></i></span>
      </div>      
  </a>
</div>

<div class="br-pagebody" id="contenido">
  <div class="br-section-wrapper  pd-sm-t-30 pd-sm-x-30">
    <h6 class="tx-gray-800 tx-uppercase tx-bold tx-18 mg-b-0 "><span class="icon wd-40"><i class="ion-ios-list-outline tx-24"></i> </span> Crear orden de trabajo </h6>  
    <p class="mg-b-5">Este sistema generá ordenes de trabajo, para pruebas y ensayos.</p>
    <div class="row justify-content-between text-center px-3">
      <span class="col-6 tx-gray-800  tx-14 mg-b-10">Fecha: <strong><?php echo $myTime = date('d-m-y');?></strong></span>
      <span class="col-6 tx-gray-800  tx-14 mg-b-10">Encargado de realizar la orden:<strong class="tx-uppercase"> <?php echo session('nombre')?> <?php echo session('apellido')?></span>
    </div>
     
     
      <form id="formularioOrden" class="form-layout form-layout-1"  action="<?php echo base_url().'/OrdenesController/crearOrden';?>" method="POST">
        <div class="row mg-b-25">
            <div class="col-lg-6">            
              <div class="form-group ">                      
                <label class="form-control-label font-weight-normal ">Nombre del proyecto : <span class="tx-danger">*</span></label>
                <input 
                  type="text"
                  class="form-control tx-bold" 
                  name="nombre_proyecto"
                  placeholder="Ingrese nombre del proyecto"
                  required
                > 
              </div>
            </div><!-- col--->        
            <div class="col-lg-3">
              <div class="form-group">
                <label class="form-control-label font-weight-normal">Ejecutado por:</label>
                <input
                  type="text"
                  name="ejecutado_por"
                  class="form-control tx-bold"
                  placeholder="Ingrese nombre"
                  required
                >
              </div>
            </div><!-- col-3 --> 
            <div class="col-lg-3">
              <div class="form-group mg-b-10-force">
                <label class="form-control-label font-weight-normal">Fecha: <span class="tx-danger">*</span></label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-calendar tx-16 lh-0 op-6"></i></span>                    
                    <input 
                      type="date"
                      class="form-control"
                      id="fecha"
                      name="fecha_recepcion"
                      value='<?php echo  $myTime = date('Y-m-d');?>'
                      placeholder="MM/DD/YYYY"
                      required
                    >
                    
                  </div>
              </div>          
            </div><!-- col-3 -->

            <div class="col-lg-2">
              <p class="">Atencion a:</p>
            </div><!-- col-2 -->
            <div class="col-lg-10"><hr></div><!-- col-10 -->

            <div class="col-lg-6">
              <div class="form-group mg-b-10-force"> 
                <label class="form-control-label font-weight-normal">Nombre: <span class="tx-danger">*</span></label>
                <input 
                  class="form-control tx-bold"
                  type="text"
                  id="nombreCliente"
                  name="nombre_cliente" 
                  placeholder="Ingrese nombre"
                  required
                >
              </div>
            </div><!-- col-6 -->            
            <div class="col-lg-3">
              <div class="form-group mg-b-10-force"> 
                <label class="form-control-label font-weight-normal">Nit:</label>
                <input
                  class="form-control tx-bold"
                  type="text" 
                  id="clienteNit"
                  name="nit_cliente" 
                  placeholder="Ingrese nit" 
                >
                <input type="hidden"  id="clienteid" name ="clienteid" > 
             </div>
            </div><!-- col-3 -->
            <div class="col-lg-3">
              <div class="form-group mg-b-10-force"> 
                <label class="form-control-label font-weight-normal">Teléfono:</label>
                <input
                  class="form-control tx-bold"
                  type="text"
                  id="telefonoCliente"
                  name="telefono_cliente" 
                  placeholder="Ingrese número de teléfono"
                >
              </div>
            </div><!-- col-3 -->
            <div class="col-lg-3">
              <div class="form-group mg-b-10-force"> 
                <label class="form-control-label font-weight-normal">Correo:</label>
                <input
                  class="form-control tx-bold"
                  type="email"
                  id="correoCliente"
                  name="correo_cliente"
                  placeholder="Ingrese correo"
                >
              </div>
            </div><!-- col-3 -->
            <div class="col-lg-3">
              <div class="form-group mg-b-10-force"> 
                <label class="form-control-label font-weight-normal">Empresa:</label>
                <input
                  class="form-control tx-bold"
                  type="text"
                  id="empresaCliente"
                  name="empresa_cliente"
                  placeholder="Nombre de la empresa"
                >
              </div>
            </div><!-- col-3 -->

            
            <div class="col-lg-12">
              <div class="form-group">
                <label class="form-control-label font-weight-normal">Observaciones:</label>
                <textarea 
                  rows="2" 
                  class="form-control"
                  type="text"
                  id="observaciones"
                  name="observaciones"
                  placeholder="Ingrese  observacion aquí"></textarea>
                <hr>
              </div>
            </div><!-- col-12 -->

            <div class="col-lg-12">
              <h6 class="tx-gray-800 tx-bold tx-14 mg-b-10">Listado de oprdenes y ensayos que la empresa realiza </h6>
                <div class="pd-r-10  mg-b-10">
                  <div class="bd bd-gray-300 pd-sm-t-10 pd-sm-b-10 table-responsive pd-r-10 pd-l-10">
                    <table id= "tabla1" class="table table-striped table-bordered " style="width:100%">
                          <thead class=" thead-colored thead-dark">
                          <tr>
                          <th>ID</th>
                              <th>Código</th>
                              <th>Descripción</th>
                              <th>Costo</th>
                              <th>Cantidad</th>
                              <th>Opciones</th>          
                            </tr>
                          </thead>
                          <tbody>
                          <?php foreach($pruebasEnsayos as $value): ?>
                                <tr>
                                  <th scope="row"><?=$value['idprueba_ensayo'];?></th>
                                  <th scope="row"><?=$value['codigo'];?></th>
                                  <td><?=$value['descripcion'];?></td>
                                  <td>Q.<?=$value['costo'];?> </td>
                                  <td>
                                    <div class="input-group input-group-sm mb-3">
                                      <input 
                                      type="number"
                                      min="1"
                                      value="1"
                                      id="cantidad_<?=$value['idprueba_ensayo'];?>_prueba"
                                      name="cantidad[]"
                                      placeholder="Cantidad"
                                      class="form-control"
                                      aria-label="Small"
                                      aria-describedby="inputGroup-sizing-sm"
                                      oninput="pasarValor('<?=$value['idprueba_ensayo'];?>')"
                                    >
                                    <input 
                                      type="hidden"  
                                      value="1"                                    
                                      id="cantidad2_<?=$value['idprueba_ensayo'];?>_prueba"
                                      name="cantidad2_<?=$value['idprueba_ensayo'];?>"                                     
                                    >
                                    <input 
                                      value="<?=$value['costo'];?>"
                                      type="hidden"
                                      name="costo_<?=$value['idprueba_ensayo'];?>"
                                    >
                                    </div>
                                  </td>                      
                                  <td>
                                    <label class="ckbox ckbox-info ">
                                      <input
                                        id="cb[]"
                                        name="cb[]"
                                        value="<?=$value['idprueba_ensayo'];?>"
                                        type="checkbox"   
                                        onClick = "sumarCosto('<?php echo $value['costo'];?>' , '<?php echo $value['idprueba_ensayo'];?>')"
                                        ><span>Agregar</span>
                                    </label>
                                  </td> 
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
                <input 
                  id="costoTotal" 
                  class="form-control  tx-bold" 
                  step="any"  
                  type=[number]::-webkit-outer-spin-button { 
                    -webkit-appearance: none; 
                    margin: 0; 
                  }
                  min="0"
                  name="costo_total"  
                  placeholder="Q.00.00"                  
                >
              </div>
            </div><!-- col-3 -->
            <div class="col-lg-3">
              <div class="form-group mg-b-10-force">
                <label class="form-control-label font-weight-normal">Abono:</label>
                <input
                  id="abono"  
                  class="form-control tx-bold"
                  step="any"  
                  type=[number]::-webkit-outer-spin-button { 
                    -webkit-appearance: none; 
                    margin: 0; 
                  }
                  min="0"
                  name="abono" 
                  placeholder="Q.00.00" 
                  onKeyUp="sumar()"
                >
              </div>
            </div><!-- col-3 -->
            <div class="col-lg-3">
              <div class="form-group mg-b-10-force"> 
                <label class="form-control-label font-weight-normal">Saldo:</label>
                <input 
                id="saldo" 
                class="form-control tx-bold"
                step="any"  
                type=[number]::-webkit-outer-spin-button { 
                    -webkit-appearance: none; 
                    margin: 0; 
                  }
                min="0" 
                name="saldo"
                placeholder="Q.00.00" >
              </div>
            </div><!-- col-3 -->
        </div><!-- row 25-->

         <div class="form-layout-footer">
           <button class="btn btn-info tx-18" id="enviar"  >Crear Orden</button>
           <a href="ver_ordenes" class="btn btn-secondary tx-18">Cancelar</a>
         </div><!-- form-layout-footer -->
      </form><!-- form-layout -->
  </div><!-- br-section-wrapper -->
</div><!-- br-pagebody -->

<?php else: ?>
    <?php redirect()->to(base_url('/app'))?>

<?php endif; ?>

<?= $this->endSection()?>

