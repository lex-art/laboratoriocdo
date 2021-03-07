<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <link  rel="icon"   href="<?php base_url()?>assets/img/icon.png" type="png" />

    <link rel="stylesheet" href="<?php base_url()?>assets/css/web/main.css">

    <!-- bootstrat -->    
    <link rel="stylesheet" href="<?php base_url()?>assets/css/bootstrap/bootstrap.min.css" >
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" >
    
    <!-- Para la galeria -->    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.8.1/baguetteBox.min.css">
    
    <link rel="stylesheet" href="<?php base_url()?>assets/css/web/galeria.css">  

    <link rel="stylesheet" href="<?php base_url()?>assets/css/web/consulta.css">  

    <link rel="stylesheet" href="<?php base_url()?>assets/css/web/contacto.css">  

    <title><?= $this->renderSection('title')?> </title>
    
</head>
<body>
    <!-- para no repetir codigo en codeogniter se puede secciopnar las parter como puna plantilla -->
    <?= $this->include('webPage/navbar') ?>
    <?= $this->renderSection($page) ?>
    <?= $this->include('webPage/footer') ?>

 
   
    <!-- Scripts necesarios para usar bootstrap -->
    <script src="<?php base_url()?>assets/js/jquery-3.5.1.min.js"></script>
    <script src="<?php base_url()?>assets/js/popper.min.js"></script>
    <script src="<?php base_url()?>assets/js/jsBt/bootstrap.min.js"></script>

    <!-- ###################### Scripts  para poder ejecutar las alertas  ################### -->
    <script src="<?php base_url()?>assets/js/sweetalert.min.js"></script>

    <!-- ###################### Scripts  para poder ejecutar las alertas  ################### -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    
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
           echo $mensaje['codigo'];
        }else {
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
          
         }else{
          swal({
            title: 'Código: '+ codigo,
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