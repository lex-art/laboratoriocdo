<!DOCTYPE html>
<html lang="en">
  <head><meta charset="gb18030">
    <!-- ########################## Required meta tags ########################## -->
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <link  rel="icon"   href="<?php base_url()?>assets/img/icon.png" type="png" />
    <!-- ########################## bootstrap ########################## -->    
    <link rel="stylesheet" href="<?php base_url()?>assets/css/bootstrap/bootstrap.min.css" >
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" >
    
    <!-- ########################## vendor css ########################## -->
    <link href="<?php base_url();?>assets/lib/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="<?php base_url();?>assets/lib/Ionicons/css/ionicons.css" rel="stylesheet"> 
    <!-- ########################## Tablas Responsivas ########################## -->

    <link href="<?php base_url();?>assets/lib/datatables-responsive/responsive.dataTables.scss" rel="stylesheet">
    <link href="<?php base_url();?>assets/lib/datatables/jquery.dataTables.css" rel="stylesheet">
    <link href="<?php base_url();?>assets/lib/select2/css/select2.min.css" rel="stylesheet">
    <!-- ########################## Bracket CSS ########################## -->
    <link rel="stylesheet" href="<?php base_url();?>assets/css/bracket.css"> 

      <!-- ######################### CSS file para el autocompletado ########################### -->
    <link rel="stylesheet" href="<?php base_url();?>assets/auto/easy-autocomplete.min.css"> 

     <!--############################## font awesome con CDN para icono de excel y pdf ######################-->  
     <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">  

    <title><?= $this->renderSection('title')?> </title>

    <!--  <link rel="stylesheet" href="https://code.jquery.com/qunit/qunit-2.10.0.css">-->
</head>
<body> 
  
  <!-- para no repetir codigo en codeogniter se puede secciopnar las parter como puna plantilla -->
  <?= $this->include('app/header') ?>
  <!-- Para definir que opciones va a tener cada usuario -->
  <?=  
    session('privilegio')=='Administrador' || session('privilegio')=='su' 
    ?
      $this->include('app/aside_admin')
    : 
      (session('privilegio')=='Evaluador' 
        ?
          $this->include('app/aside_evaluador')
        :
          $this->include('app/aside_recepcionista')
      ) 
   ?>
  <!-- ########## INICIA: PANEL PRICIPAL AQUI va todo EL CONTENIDO ########## -->
  <div id="contenido" class="br-mainpanel">
    <div class="container p-3 padding">
      <?= $this->renderSection($page) ?> 
    </div>    
  </div>
  <!-- ########## TERMIMA: EL CONTENIDO ########## -->
  <?= $this->include('webPage/footer') ?>

    
  <!-- Scripts necesarios para usar bootstrap -->

   <!-- ########## Scripts de la aplicación para que funciones bootstrap  ########## -->
    <script src="<?php base_url();?>assets/lib/jquery/jquery.js"></script>
    <script src="<?php base_url();?>assets/lib/popper.js/popper.js"></script>
    <script src="<?php base_url();?>assets/lib/bootstrap/bootstrap.js"></script> 

    <!-- #################### Scripts para que funcione esta app  ##################### -->
    <script src="<?php base_url();?>assets/lib/perfect-scrollbar/js/perfect-scrollbar.jquery.js"></script>   
    <script src="<?php base_url();?>assets/lib/jquery-ui/jquery-ui.js"></script>
    <script src="<?php base_url();?>assets/lib/jquery-switchbutton/jquery.switchButton.js"></script>
    <script src="<?php base_url();?>assets/lib/peity/jquery.peity.js"></script>

     <!--######################   Scrtip para las tablas ########################-->   
    <script src="<?php base_url();?>assets/lib/datatables/jquery.dataTables.js"></script>
    <script src="<?php base_url();?>assets/lib/datatables-responsive/dataTables.responsive.js"></script>
    <script src="<?php base_url();?>assets/lib/select2/js/select2.min.js"></script>

    <!-- ########## Scripts  para que funcione los estilos y sea responsiva esta app  ########## -->
    <script src="<?php base_url();?>assets/js/bracket.js"></script>

   
    <!-- ###################### Scripts  para poder ejecutar las alertas  ################### -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <!-- ####################### Para usar los botones en data tablle para descargar pdf y excel ################-->
    <script type="text/javascript" src="<?php base_url();?>assets/lib/datatables/Buttons-1.6.2/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="<?php base_url();?>assets/lib/datatables/JSZip-2.5.0/jszip.min.js"></script>
    <script type="text/javascript" src="<?php base_url();?>assets/lib/datatables/pdfmake-0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="<?php base_url();?>assets/lib/datatables/pdfmake-0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="<?php base_url();?>assets/lib/datatables/Buttons-1.6.2/js/buttons.html5.min.js"></script>

    <!-- ######################## Scrtip para el autocompletado del cliente #####################-->
  	<script src="<?php base_url();?>assets/auto/jquery.easy-autocomplete.min.js"></script> 
    <script src="<?php base_url();?>assets/js/main.js"> type="module"</script>
    


   
    <script type="text/javascript">
      let tipo_alert = '<?php 
          if (isset($mensaje['tipo_alert'])) {
            echo $mensaje['tipo_alert'];
        }else {
          echo ('');
        }
      
      ?>'; //el tipo de alerta si es ecitoso
      let value = '<?php 
          if (isset($mensaje['value'])) {
            echo $mensaje['value'];
        }else {
          echo ('');
        }
      ?>'; //guarda el mensaje que tiene el array
      let codigo = '<?php 
        if (isset($mensaje['codigo'])) {
           echo ('3');
        }else  if (isset($mensaje['pass'])) {
          echo ('2');
        }else{
          echo ('1');
        }
      ?>'
      

       if(tipo_alert == 'success'){
         if(codigo == '1'){           
            swal({
              title: ":D" ,
              text: value,
              icon: "success",
              button: "Aceptar",
            });
         }else if(codigo == '3'){
          swal({
            title: 'Codigo: <?php echo $mensaje['codigo']?>',
            text: value,
            icon: "success",
            button: "Aceptar",
          });          
        }else if(codigo == '2'){
          swal({
            title: 'Password: <?php echo  $mensaje['pass']?>',
            text: value,
            icon: "success",
            button: "Aceptar",
          }); 
        }
      }else if(tipo_alert == 'error'){
        swal({
          title: ":(",
          text: value,
          icon: "error",
          button: "Aceptar",
        });
      }else if(tipo_alert == 'warning'){
        swal({
          title: ":/",
          text: value,
          icon: "warning",
          button: "Aceptar",
        });
      }

    </script>
</body>
</html>