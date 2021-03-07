<?= $this->extend('app/layout') ?>

<?= $this->section('title') ?>
Editar Perfil
<?= $this->endSection() ?>

<?= $this->section('editar_perfil') ?>

<div class="br-pagebody">
  <div class="br-section-wrapper  pd-sm-t-30 pd-sm-x-30">
    <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10">Editar tus datos</h6>


    <form class="form-layout form-layout-1"  action="<?php echo base_url().'/AppController/updateProfile';?>" method="POST" enctype="multipart/form-data"><!--muy importante con esto le decimos a nuestro formulario que le podemos mandar acrchivos-->
        <div class="row mg-b-25">
            <div class="col-lg-4">
                <div class="form-group">
                    <label class="form-control-label">Nombre: <span class="tx-danger">*</span></label>
                    <input 
                    class="form-control" 
                    type="text" 
                    id="nombre"
                    name="nombre" 
                    required 
                    placeholder="Ingrese Nombre"
                    value="<?php echo(session('nombre'));?>"
                    >
                </div>
            </div><!-- col-4 -->
            <div class="col-lg-4">
                <div class="form-group">
                    <label class="form-control-label">Apellido: <span class="tx-danger">*</span></label>
                    <input 
                    class="form-control"
                    type="text"
                    id="apellido"
                    name="apellido"
                    required
                    placeholder="Ingrese Apellido"
                    value="<?php echo(session('apellido'));?>"
                    
                    >
                </div>
            </div><!-- col-4 -->
            <div class="col-lg-4">
                <div class="form-group">
                    <label class="form-control-label">Género: <span class="tx-danger">*</span></label>
                    <select class="form-control" id="genero" name="genero"    required>
                        <option value="<?php echo(session('genero'));?>" hidden selected><?php echo(session('genero'));?></option>                        
                        <option value="Masculino">Masculino</option>
                        <option value="Femenino">Femenino</option>
                    </select>
                </div>
            </div><!-- col-4 -->  
            <div class="col-lg-4">
                    <div class="form-group mg-b-10-force">
                    <label class="form-control-label font-weight-bold">Nueva contraseña: <span class="tx-danger">*</span></label>
                    <input 
                    class="form-control"
                    type="password"
                    id="password" 
                    name="password" 
                    required
                    placeholder="Ingrese contraseña"
                  >
                </div>
            </div><!-- col-6 -->
            <div class="col-lg-4">
                <div class="form-group">
                    <label class="form-control-label">Teléfono: <span class="tx-danger">*</span></label>
                    <input 
                    class="form-control" 
                    type="text"
                    id="telefono"
                    name="telefono"
                    required placeholder="Ingrese su número de teléfono"
                    value="<?php echo(session('telefono'));?>"
                    >
                </div>
            </div><!-- col-4 -->
            <div class="col-lg-4">
                <div class="form-group">
                    <label class="form-control-label">DPI:</label>
                    <input 
                    class="form-control"
                    type="text" 
                    id="dpi"
                    name="dpi"
                    placeholder="Ingrese número de DPI"
                    value="<?php echo(session('dpi'));?>"
                    >
                </div>
            </div><!-- col-4 -->
            
            <div class="col-lg-6">
                
                <div class="form-group mg-b-0-force">
                    <label class="form-control-label">Foto de perfil:</label>
                    <input class="form-control-file" type="file" accept="image/jpeg, .png" name="foto_usuario" placeholder="Selecciones una Imagen.">
                </div>
            </div><!-- col-6 -->

        </div><!-- row -->

            <div class="form-layout-footer pd-x-0">
                <br>
            <button class="btn btn-info ">Guardar</button>
            <a href="<?=base_url()?>/app" class="btn btn-secondary ">Cancelar</a>          
            </div><!-- form-layout-footer -->
    </form><!-- form-layout -->


  </div>
</div>


<?= $this->endSection() ?>