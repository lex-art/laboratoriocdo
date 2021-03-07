<?= $this->extend('app/layout') ?>

<?= $this->section('title') ?>
Bienvenido
<?= $this->endSection() ?>

<?= $this->section('home') ?>



<?php if (session('privilegio') == 'su' || session('privilegio') == 'Evaluador') : ?>
  <!--estadisticas del programa-->
  <div class="br-pagebody mg-t-0 pd-x-20">
    <div class="container ">
      <div class="row justify-content-between">
        <h1>Resumen mensual </h1>
        <div class="row align-items-end pr-4">
          <h5><?php echo ('1-' . date("M-Y") . "--" . date("d-M-Y")); ?></h5>
        </div>
      </div>
    </div>

    <div class="row row-sm mx-auto">
      <div class="col-sm-6 col-xl-3 ">

        <div class="bg-teal rounded overflow-hidden ">

          <div class="pd-25 d-flex align-items-center" style="height: 140px;">
            <i class="ion ion-cash    tx-60 lh-0 tx-white op-7"></i>
            <div class="mg-l-20">
              <p class="tx-10 tx-spacing-1 tx-mont tx-medium tx-uppercase  tx-white-8 mg-b-10">Total sobre ordenes</p>
              <p class="tx-24 tx-white tx-lato tx-bold mg-b-2 lh-1">Q.<?php
                                                                      echo $total[0]->costo_total;
                                                                      ?>
              </p>
              <span class="tx-11 tx-roboto tx-white-6">Total neto</span>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-xl-3 mg-t-20 mg-sm-t-0">
        <div class="bg-danger rounded overflow-hidden">
          <div class="pd-25 d-flex align-items-center" style="height: 140px;">
            <i class="ion ion-podium tx-60 lh-0 tx-white op-7"></i>
            <div class="mg-l-20">
              <p class="tx-10 tx-spacing-1 tx-mont tx-medium tx-uppercase tx-white-8 mg-b-10">Pendientes de pago</p>
              <p class="tx-24 tx-white tx-lato tx-bold mg-b-2 lh-1">Q.<?php
                                                                      echo $saldo[0]->saldo;
                                                                      ?>
              </p>
              <span class="tx-11 tx-roboto tx-white-6">Total sobre saldos</span>
            </div>
          </div>
        </div>
      </div><!-- col-3 -->

      <div class="col-sm-6 col-xl-3 mg-t-20 mg-xl-t-0">
        <div class="bg-primary rounded overflow-hidden">
          <div class="pd-25 d-flex align-items-center" style="height: 140px;">
            <i class="ion ion-cash  tx-60 lh-0 tx-white op-7"></i>
            <div class="mg-l-20">
              <p class="tx-10 tx-spacing-1 tx-mont tx-medium tx-uppercase tx-white-8 mg-b-10">Total recibido</p>
              <p class="tx-24 tx-white tx-lato tx-bold mg-b-2 lh-1">Q.<?php
                                                                      echo $abono[0]->abono;
                                                                      ?>
              </p>
              <span class="tx-11 tx-roboto tx-white-6">Total sobre abonos</span>
            </div>
          </div>
        </div>
      </div><!-- col-3 -->

      <div class="col-sm-6 col-xl-3 mg-t-20 mg-xl-t-0">
        <div class="bg-br-primary rounded overflow-hidden">
          <div class="pd-25 d-flex align-items-center">
            <i class="ion ion-podium tx-60 lh-0 tx-white op-7"></i>
            <div class="mg-l-20">
              <p class="tx-10 tx-spacing-1 tx-mont tx-medium tx-uppercase tx-white-8 mg-b-10"> Total de ordenes realizadas </p>
              <p class="tx-24 tx-white tx-lato tx-bold mg-b-2 lh-1">
                <?php echo $count[0]->idorden_de_trabajo;   ?>

              </p>
              <span class="tx-11 tx-roboto tx-white-6">Total</span>
            </div>
          </div>
        </div>
      </div><!-- col-3 -->
    </div>



    <br>
    <div class="container ">
      <div class="row justify-content-between">
        <h1>Resumen Anual </h1>
        <div class="row align-items-end pr-4">
          <h5><?php echo ('1-Ene' . date("Y") . "--" . date("d-M-Y")); ?></h5>
        </div>
      </div>
    </div>
    <div class="row row-sm mx-auto">
      <div class="col-sm-6 col-xl-3 ">

        <div class="bg-teal rounded overflow-hidden ">

          <div class="pd-25 d-flex align-items-center" style="height: 140px; background-color: #31A5E8;">
            <i class="ion ion-cash    tx-60 lh-0 tx-white op-7"></i>
            <div class="mg-l-20">
              <p class="tx-10 tx-spacing-1 tx-mont tx-medium tx-uppercase  tx-white-8 mg-b-10">Total sobre ordenes</p>
              <p class="tx-24 tx-white tx-lato tx-bold mg-b-2 lh-1">Q.<?php
                                                                      echo $total_anual[0]->costo_total;
                                                                      ?>
              </p>
              <span class="tx-11 tx-roboto tx-white-6">Total neto</span>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-xl-3 mg-t-20 mg-sm-t-0">
        <div class="bg-danger rounded overflow-hidden">
          <div class="pd-25 d-flex align-items-center" style="height: 140px; background-color: #BA4937;">
            <i class="ion ion-podium tx-60 lh-0 tx-white op-7"></i>
            <div class="mg-l-20">
              <p class="tx-10 tx-spacing-1 tx-mont tx-medium tx-uppercase tx-white-8 mg-b-10">Pendientes de pago</p>
              <p class="tx-24 tx-white tx-lato tx-bold mg-b-2 lh-1">Q.<?php
                                                                      echo $saldo_anual[0]->saldo;
                                                                      ?>
              </p>
              <span class="tx-11 tx-roboto tx-white-6">Total sobre saldos</span>
            </div>
          </div>
        </div>
      </div><!-- col-3 -->

      <div class="col-sm-6 col-xl-3 mg-t-20 mg-xl-t-0">
        <div class="bg-primary rounded overflow-hidden">
          <div class="pd-25 d-flex align-items-center" style="height: 140px; background-color: #DA9D42;">
            <i class="ion ion-cash  tx-60 lh-0 tx-white op-7"></i>
            <div class="mg-l-20">
              <p class="tx-10 tx-spacing-1 tx-mont tx-medium tx-uppercase tx-white-8 mg-b-10">Total recibido</p>
              <p class="tx-24 tx-white tx-lato tx-bold mg-b-2 lh-1">Q.<?php
                                                                      echo $abono_anual[0]->abono;
                                                                      ?>
              </p>
              <span class="tx-11 tx-roboto tx-white-6">Total sobre abonos</span>
            </div>
          </div>
        </div>
      </div><!-- col-3 -->

      <div class="col-sm-6 col-xl-3 mg-t-20 mg-xl-t-0">
        <div class="bg-br-primary rounded overflow-hidden">
          <div class="pd-25 d-flex align-items-center " style="height: 140px; background-color: #165D63;">
            <i class="ion ion-podium tx-60 lh-0 tx-white op-7"></i>
            <div class="mg-l-20">
              <p class="tx-10 tx-spacing-1 tx-mont tx-medium tx-uppercase tx-white-8 mg-b-10"> Total de ordenes realizadas </p>
              <p class="tx-24 tx-white tx-lato tx-bold mg-b-2 lh-1">
                <?php echo $count_anual[0]->idorden_de_trabajo;   ?>

              </p>
              <span class="tx-11 tx-roboto tx-white-6">Total</span>
            </div>
          </div>
        </div>
      </div><!-- col-3 -->
    </div>
  </div>
<?php else: ?>

<!--estadisticas del programa-->
<div class="br-pagebody mg-t-0 pd-x-20">
  <div class="container ">
    <div class="row justify-content-between">
      <h1>Bienvenido al sistema </h1>
      <div class="row align-items-end pr-4">
        <h5><?php echo (date("d-M-Y")); ?></h5>
      </div>
    </div>
  </div>
 
</div>


<?php endif; ?>



<?= $this->endSection() ?>