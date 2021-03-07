<body>
  <main class="container">
    <img src="<?php base_url() ?>assets/img/logo-inicio.png" alt="" width="150">
    <h1 class="text-center">Orden de trabajo: <?= $orden[0]->codigo ?></h1>

  <hr>

    <div class="row text-center">
      <div class="col-6 wrapper">
        <h4> <strong>Datos de la orden de trabajo:</strong> </h4>
        
        <label> <strong> Nombre del proyecto: </strong></label>
        <label><?=$orden[0]->nombre_proyecto ?>   _____</label>
        <Strong><label>Ejecutado por:</label></Strong>        
        <label><?=$orden[0]->ejecutado_por  ?></label> 
        <br>
        <label> <strong> Fecha recepción: </strong></label>
        <label><?=$orden[0]->fecha_recepcion ?>   _____</label>
        <Strong><label>Observaciones:</label></Strong>
        <label><?=$orden[0]->observacion ?></label> 
        
      </div>
      <div class="col-6">
        <br>
      <h4> <strong>Datos del cliente:</strong> </h4>
        
        <label> <strong> Nombre: </strong></label>
        <label><?=$orden[0]->nombre ?>   _____</label>
        <Strong><label>Nit:</label></Strong>        
        <label><?=$orden[0]->nit  ?></label> 
        <br>
        <label> <strong> Teléfono: </strong></label>
        <label><?=$orden[0]->telefono ?>   _____</label>
        <Strong><label>Correo:</label></Strong>
        <label><?=$orden[0]->correo ?></label> 
        <br>
        <Strong><label>Empresa:</label></Strong>
        <label><?=$orden[0]->empresa ?></label> 

      </div>
    </div>
    <br />
    <hr>
    <h2 class="text-center ">Pruebas u ensayos aplicados a esta orden de trabajo.</h2>
    <table class="table">
      <thead>
        <tr>
          <th>Código:</th>
          <th>Descripción:</th>
          <th>Cantidad:</th>
          <th>Costo:</th>
          <th>Sub Total:</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($pruebaEnsayos as $value) : ?>
          <tr>         
            <td class="text-center "><?= $value->codigo; ?></td>
            <td class="text-center"><?= $value->descripcion; ?></td>
            <td class="text-center"><?= $value->cantidad; ?></td>
            <td class="text-center">Q.<?= $value->costo_prueba; ?></td>
            <td class="text-center">Q.<?= $value->sub_total; ?></td>
          </tr>
        <?php endforeach; ?>

      </tbody>
    </table>
    <div class="row text-center">
     <hr>
      <div class="col-6">
        <br> 
        <label> <strong> Costo total: </strong></label>
        <label>Q.<?=$orden[0]->costo_total ?>   _____</label>
        <Strong><label>Abono:</label></Strong>        
        <label>Q.<?=$orden[0]->abono  ?> _____ </label>         
        <label> <strong>Saldo: </strong></label>
        <label>Q.<?=$orden[0]->saldo ?> </label>
        

      </div>
    </div>
  </main>
</body>