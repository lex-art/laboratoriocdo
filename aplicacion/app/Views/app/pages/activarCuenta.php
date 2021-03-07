<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <link  rel="icon"   href="<?php base_url()?>assets/img/icon.png" type="png" />
    <!-- bootstrap -->    
    <link rel="stylesheet" href="<?php base_url()?>assets/css/bootstrap/bootstrap.min.css" >
    <!-- vendor css -->
    <link href="<?php base_url();?>assets/lib/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="<?php base_url();?>assets/lib/Ionicons/css/ionicons.css" rel="stylesheet"> 
    <!-- Bracket CSS -->
    <link rel="stylesheet" href="<?php base_url();?>assets/css/bracket.css"> 

    <title>Activar cuenta</title>

    <!--  <link rel="stylesheet" href="https://code.jquery.com/qunit/qunit-2.10.0.css">-->
</head>
<body style="background-image: linear-gradient(-90deg,  #00384d, #00384d );"> 
  

  <!-- ########## INICIA: PANEL PRICIPAL AQUI va todo EL CONTENIDO ########## -->
  <div class="container">
    
  <div class="br-pagebody">
  <div class="row justify-content-center">
        <img class="mb-4 " src= "<?php base_url();?>assets/img/logo-sidebar.png" alt="" width="190" height="70">

    </div>
  <div class="br-section-wrapper  pd-sm-t-30 pd-sm-x-30">
    <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10">Para activar su cuenta es necesario que actualice sus datos y cambie su contraseña</h6>
  
    <form class="form-layout form-layout-1"  action="<?php echo base_url().'/AppController/updateProfile';?>" method="POST" enctype="multipart/form-data"><!--muy importante con esto le decimos a nuestro formulario que le podemos mandar acrchivos-->
        <div class="row mg-b-25">
            <div class="col-lg-4">
                <div class="form-group">
                    <label class="form-control-label">Nombre: <span class="tx-danger">*</span></label>
                    <input class="form-control" type="text" id="nombre" name="nombre" required placeholder="Ingrese Nombre">
                </div>
            </div><!-- col-4 -->
            <div class="col-lg-4">
                <div class="form-group">
                    <label class="form-control-label">Apellido: <span class="tx-danger">*</span></label>
                    <input class="form-control" type="text" id="apellido" name="apellido" required placeholder="Ingrese Apellido">
                </div>
            </div><!-- col-4 -->
            <div class="col-lg-4">
                <div class="form-group">
                    <label class="form-control-label">Género: <span class="tx-danger">*</span></label>
                    <select class="form-control" id="genero" name="genero"    required>
                        <option value="" hidden selected>Seleccione una opción</option>                        
                        <option value="Masculino">Masculino</option>
                        <option value="Femenino">Femenino</option>
                    </select>
                </div>
            </div><!-- col-4 -->  
            <div class="col-lg-4">
                    <div class="form-group mg-b-10-force">
                    <label class="form-control-label font-weight-bold">Nueva contraseña: <span class="tx-danger">*</span></label>
                    <input class="form-control" type="password" id="password" name="password" required placeholder="Ingrese contraseña">
                </div>
            </div><!-- col-6 -->
            <div class="col-lg-4">
                <div class="form-group">
                    <label class="form-control-label">Teléfono: <span class="tx-danger">*</span></label>
                    <input class="form-control" type="text" id="telefono" name="telefono" required placeholder="Ingrese su número de teléfono">
                </div>
            </div><!-- col-4 -->
            <div class="col-lg-4">
                <div class="form-group">
                    <label class="form-control-label">DPI:</label>
                    <input class="form-control" type="text" id="dpi" name="dpi" placeholder="Ingrese número de DPI">
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
            <button class="btn btn-info rounded-pill">Guardar</button>
            <a href="login" class="btn btn-secondary rounded-pill">Cambiar despúes</a>          
            </div><!-- form-layout-footer -->
    </form><!-- form-layout -->

</div><!-- br-section-wrapper -->
</div><!-- br-pagebody -->   

  <!-- ########## TERMIMA: EL CONTENIDO ########## -->
  <?= $this->include('webPage/footer') ?>
  </div>
  

    
  <!-- Scripts necesarios para usar bootstrap -->

   <!-- ########## Script de la aplicación ########## -->
 
   <script src="<?php base_url();?>assets/lib/jquery/jquery.js"></script>
    <script src="<?php base_url();?>assets/lib/popper.js/popper.js"></script>
    <script src="<?php base_url();?>assets/lib/bootstrap/bootstrap.js"></script> 
    <script src="<?php base_url();?>assets/lib/perfect-scrollbar/js/perfect-scrollbar.jquery.js"></script>
   
    <script src="<?php base_url();?>assets/lib/jquery-ui/jquery-ui.js"></script>
    <script src="<?php base_url();?>assets/lib/jquery-switchbutton/jquery.switchButton.js"></script>
    <script src="<?php base_url();?>assets/lib/peity/jquery.peity.js"></script>

    <script src="<?php base_url();?>assets/js/bracket.js"></script>
    
</body>
</html>