

<!-- ########## START: LEFT PANEL ########## -->
<div class="br-logo ">
    <div class="mx-auto">
    <a href="<?php site_url().'/app';?>"> <img src="<?php base_url()?>assets/img/logo-sidebar.png"" class="wd-100" alt="logo"> </a>
    </div>   
</div>
  <!-- ########## INICIO: HEAD PANEL ########## -->
  <div class="br-header">
    <div class="br-header-left">
      <div class="navicon-left hidden-md-down"><a id="btnLeftMenu" href=""><i class="icon ion-navicon-round"></i></a></div>
      <div class="navicon-left hidden-lg-up"><a id="btnLeftMenuMobile" href=""><i class="icon ion-navicon-round"></i></a></div>
  </div><!-- br-header-left -->
    <div class="br-header-right">
      <nav class="nav">
       
     
        <div class="dropdown ">
          <a href="" class="nav-link nav-link-profile" data-toggle="dropdown">
            <span class="logged-name hidden-md-down text-white"> <?php echo session('nombre')?> <?php echo session('apellido')?> </span>
            <img src="<?php 
              if (session('foto') != null) {
                echo base_url().'../../codeigniter/media/avatar/'.session('foto');
              } else {
                echo  base_url().'/assets/img/usuario.png';
              }
            ?> " class="wd-32 rounded-circle" alt="">
            <span class="square-10 bg-success"></span>
          </a>
          <div class="dropdown-menu dropdown-menu-header wd-200">
            <ul class="list-unstyled user-profile-nav">
              <li><a href="editar_perfil"><i class="icon ion-ios-person"></i>Editar perfil</a></li>
              <!--Aqui enlazamos a controlador principal y llamamos a la funcion cerrar sesion-->
              <li><a href="salir"><i class="icon ion-power"></i> Salir</a></li>
            </ul>
          </div><!-- dropdown-menu -->
        </div><!-- dropdown -->
      </nav>       
    </div><!-- br-header-right -->
</div><!-- br-header -->
    
