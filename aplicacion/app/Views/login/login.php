
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link  rel="icon"   href="<?php base_url()?>assets/img/icon.png" type="png" />

    <title>Inicio de sesión</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/sign-in/">

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="<?php base_url()?>assets/css/bootstrap/bootstrap.min.css" >

    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="<?php base_url()?>assets/css/web/login.css">

    <!-- ########################## vendor css ########################## -->
    <link href="<?php base_url();?>assets/lib/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="<?php base_url();?>assets/lib/Ionicons/css/ionicons.css" rel="stylesheet"> 
  </head>

  <body >
      <div class="text-center card card-tam p-3 padding " >
        <form class="form-signin" action="<?php echo base_url().'/SessionController/iniciarSesion';?>" method="POST">
            <a href="/">
              <img class="mb-4" src= "<?php base_url();?>assets/img/logo-inicio.png" alt="" width="190" height="70">
            </a>          
          <h1 class="h3 mb-3 font-weight-normal text-dark">Porfavor ingrese sus datos.</h1>
          <label for="inputEmail" class="text-dark">Correo electrónico:</label>
          <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Ingrese correo electrónico" required autofocus>
            <br>
          <label for="myInput" class="text-dark">Contraseña:</label>
          <input type="password" name="password" id="myInput" class="form-control" placeholder="Ingrese su contraseña" required>
          
          <input type="checkbox"  onclick="myFunction()" id="verContra">
          <label for="verContra"> Ver contraseña </label>

          <br>
          <div class= "mx-auto" >
            <button  class="btn btn-primary form-control boton-tam" type="submit">Iniciar sesión</button>            
          </div>
          <a class="mt-1 mb-1 text-dark" href="/">Regresar</a>        
          <p class="mt-3 mb-1 text-muted">&copy; LaboratorioCDO</p>
        </form>
      </div>
      <!--############################# libreria para las alertas ########################### -->
      <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

      <script type="text/javascript">
      let tipo_alert = '<?php echo $mensaje['tipo_alert']?>'; //el tipo de alerta si es ecitoso
      let value = '<?php echo $mensaje['value']?>'; //guarda el mensaje que tiene el array

     
       if(tipo_alert == 'error'){
        swal({
          title: ":(",
          text: value,
          icon: "error",
          button: "Aceptar",
        });
      }else if(tipo_alert == 'success'){
        swal({
          title: ":D",
          text: value,
          icon: "success",
          button: "Aceptar",
        });      
      } 

    </script>
    <script type="text/javascript">
      function myFunction() {
        var x = document.getElementById("myInput");
        if (x.type === "password") {
          x.type = "text";
        } else {
          x.type = "password";
        }
      }
    </script>

  </body>
</html>






    
    
