<aside class="br-sideleft overflow-y-auto ">
  <label class="sidebar-label pd-x-15 mg-t-20 ">Navegación</label>
  <div class="br-sideleft-menu ">
    <!--aqui redireccionaremos a las paginas del sistema -->
  <a href="<?=base_url()?>/app" class="br-menu-link">
      <div class="br-menu-item">      
        <i class="menu-item-icon icon ion-ios-home-outline tx-22"></i>
        <span class="menu-item-label">Inicio</span>
      </div><!-- menu-item -->
  </a><!-- br-menu-link -->
    <a href="ver_ordenes" class="br-menu-link">
      <div class="br-menu-item">
        <i class="menu-item-icon icon ion-ios-list-outline tx-24"></i>
        <span class="menu-item-label">Ordenes de trabajo</span>
      </div><!-- menu-item -->
    </a><!-- br-menu-link -->
    <a href="<?=base_url()?>/resultados" class="br-menu-link">
      <div class="br-menu-item">
        <i class="menu-item-icon icon ion-ios-paper-outline tx-20"></i>
        <span class="menu-item-label">Resultados</span>
      </div><!-- menu-item -->
    </a><!-- br-menu-link -->
    <a href="<?=base_url()?>/usuarios_listar"  class="br-menu-link">
      <div class="br-menu-item">
        <i class="menu-item-icon icon ion-ios-person-outline tx-20"></i>
        <span class="menu-item-label">Usuarios</span>
      </div><!-- menu-item -->
    </a><!-- br-menu-link -->
    <a href="<?=base_url()?>/reportes" class="br-menu-link">
      <div class="br-menu-item">
        <i class="menu-item-icon icon ion-arrow-graph-up-left tx-20"></i>
        <span class="menu-item-label">Reportes</span>
      </div><!-- menu-item -->
    </a><!-- br-menu-link -->

    <label class="sidebar-label pd-x-15 mg-t-25 mg-b-20 tx-info op-9"> Fin Navegación </label>
    <!-- ########## Nenu desplegable ########## -->
    <a href="#" class="br-menu-link">
          <div class="br-menu-item">
            <i class="menu-item-icon icon ion-ios-information-outline tx-24"></i>
            <span class="menu-item-label">Opciones</span>
            <i class="menu-item-arrow fa fa-angle-down"></i>
          </div><!-- menu-item -->
        </a><!-- br-menu-link -->
        <ul class="br-menu-sub nav flex-column">
          <li class="nav-item"><a  href="ver_pruebas_ensayos" class="nav-link">Pruebas y ensayos</a></li>       
          <li class="nav-item"><a  href="bitacora" class="nav-link">Bitacora búsqueda</a></li>
          <li class="nav-item"><a  href="evento" class="nav-link">Publicar evento o actividad</a></li>       
        </ul>
        
 
</div><!-- br-sideleft-menu -->
</aside><!-- br-sideleft -->
<!-- ########## END: LEFT PANEL ########## -->

