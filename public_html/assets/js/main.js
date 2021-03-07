//-------------------------termina el codigo para auto complete---------------------------------
//Para inicializar datatables de la manera más simple
//funcion para traducir al español la date table
$( document ).ready(function(){
  'use strict';

  $('#tabla1').DataTable({
      //cambiar el lenguaje a español de las data tables 
    language: {
      searchPlaceholder: 'Buscar...',
      sSearch: '',
      lengthMenu: "Mostrar _MENU_ registros",
      zeroRecords: "No se encontraron resultados",
      lengthMenu: '_MENU_ Registro/Página ',
      info: "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
      infoEmpty: "Mostrando registros del 0 al 0 de un total de 0 registros",
      infoFiltered: "(filtrado de un total de _MAX_ registros)",
      sProcessing:"Procesando...",
      order: [[ 1, "desc" ]],
      oPaginate: {
              "sFirst": "Primero",
              "sLast":"Último",
              "sNext":"Siguiente",
              "sPrevious": "Anterior"
     },
    },
    responsive: true, 
    //dom la forma en que estan ordenadas lo botones, busqueda, tabla,  informacion, cambial el orden para probar
    dom: 'lfBrtip',       
        buttons:[ 
			/* {
        //los parametros y estilo de los botones de excel y pdf para las data tables
				extend:    'excelHtml5',
				text:      '<i class=" fas fa-file-excel tx-16"></i> ',
				titleAttr: 'Exportar a Excel',
				className: 'btn btn-success mg-l-10 pd-sm-x-30 '
			}, */
			{
				extend:    'pdfHtml5',
				text:      '<i class="fas fa-file-pdf tx-16"></i> ',
				titleAttr: 'Exportar a PDF',
				className: 'btn btn-danger mg-l-10 pd-sm-x-30'
			},
		]	 
  });    
  $('#tabla2').DataTable({
    //cambiar el lenguaje a español de las data tables 
  language: {
    searchPlaceholder: 'Buscar...',
    sSearch: '',
    lengthMenu: "Mostrar _MENU_ registros",
    zeroRecords: "No se encontraron resultados",
    lengthMenu: '_MENU_ Registro/Página ',
    info: "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
    infoEmpty: "Mostrando registros del 0 al 0 de un total de 0 registros",
    infoFiltered: "(filtrado de un total de _MAX_ registros)",
    sProcessing:"Procesando...",
    oPaginate: {
            "sFirst": "Primero",
            "sLast":"Último",
            "sNext":"Siguiente",
            "sPrevious": "Anterior"
   },
  },
  responsive: true, 
  //dom la forma en que estan ordenadas lo botones, busqueda, tabla,  informacion, cambial el orden para probar
  dom: 'lfBrtip',       
      buttons:[ 
   /*  {
      //los parametros y estilo de los botones de excel y pdf para las data tables
      extend:    'excelHtml5',
      text:      '<i class=" fas fa-file-excel"></i> ',
      titleAttr: 'Exportar a Excel',
      className: 'btn btn-success mg-l-10 pd-sm-x-30 '
    }, */
    {
      extend:    'pdfHtml5',
      text:      '<i class="fas fa-file-pdf"></i> ',
      titleAttr: 'Exportar a PDF',
      className: 'btn btn-danger mg-l-10 pd-sm-x-30'
    },
  ]	 
});  
    // Select2
    $('.dataTables_length select').select2({ minimumResultsForSearch: Infinity });

    $('#tabla1' ).DataTable().fnDestroy();
    $('#tabla1').DataTable({
      bLengthChange: false,
      searching: false,
      responsive: true
    });

    $('#tabla2' ).DataTable().fnDestroy();
    $('#tabla2').DataTable({
      bLengthChange: false,
      searching: false,
      responsive: true
    });

   
  });

//para los los efectos de los botones de la pagina
$(function(){
    'use strict'
    // menu collapsed by default during first page load or refresh with screen
    // having a size between 992px and 1299px. This is intended on this page only
    // for better viewing of widgets demo.
    $(window).resize(function(){
      minimizeMenu();
    });

    minimizeMenu();

    function minimizeMenu() {
      if(window.matchMedia('(min-width: 992px)').matches && window.matchMedia('(max-width: 1299px)').matches) {
        // show only the icons and hide left menu label by default
        $('.menu-item-label,.menu-item-arrow').addClass('op-lg-0-force d-lg-none');
        $('body').addClass('collapsed-menu');
        $('.show-sub + .br-menu-sub').slideUp();
      } else if(window.matchMedia('(min-width: 1300px)').matches && !$('body').hasClass('collapsed-menu')) {
        $('.menu-item-label,.menu-item-arrow').removeClass('op-lg-0-force d-lg-none');
        $('body').removeClass('collapsed-menu');
        $('.show-sub + .br-menu-sub').slideDown();
      }
    }

});

  //############################################ Funciones personalidaas ##########################
  //obtenemos los datos del registro del cliente que se selecciono en el boton editar con el evento onclick
  function obtenerUsuario(idUsuario,nombre,apellido,telefono, dpi, rol, genero) {
    //de esta forma imprimimos los valores en los imputs del modal
    $('#midUsuario').val(idUsuario); 
    $('#nombre').val(nombre);  
    $('#apellido').val(apellido); 
    $('#telefono').val(telefono);
    $('#dpi').val(dpi);  
    $('#puesto').val(rol); 
    $('#genero').val(genero);
  };

  function liberarOrden(idOrden) {
    //de esta forma imprimimos los valores en los imputs del modal
    $('#midOrden').val(idOrden); 
   
  };
 
  function obteneridPrueba(idPrueba) {
    //de esta forma imprimimos los valores en los imputs del modal
    $('#midPrueba').val(idPrueba); 

  };

  //obtenemos los datos del registro del cliente que se selecciono en el boton Eliminar con el evento onclick
 function eliminarUsuario(idUsuario) {
    //de esta forma imprimimos los valores en los imputs del modal
    $('#idUsuario').val(idUsuario);  
  };
  function obtenerPruebaEnsayo(id, codigo, descripcion, costo) {
    
    $('#midPruebaEnsayo').val(id); 
    $('#mcodigo').val(codigo); 
    $('#mdescripcion').val(descripcion); 
    $('#mcosto').val(costo); 
  };

  function cancelarOrden(codigo, total, saldo) {
    
    $('#mcodOrden').val(codigo);
    $('#costoTotal').val(total);
    $('#pendiente').val(saldo);
    
  }
 function eliminarOrden(idOrden){
    $('#midOrdeneliminar').val(idOrden);
 }

 function eventoActividad(idEvento, titulo, description) {    
  $('#midEvento').val(idEvento);
  $('#mtitulo').val(titulo);
  $('#mdescription').val(description);
  
}
function eliminarEventoActividad(idEvento){
  $('#midEventoElimianar').val(idEvento);
}
/* ################################### Sumar dos números. ##########################################*/
function sumarModal (valor) {
  var total = 0;	
  valor = parseInt(valor); // Convertir el valor a un entero (número).

  total = $('#pendiente').val();

  // Aquí valido si hay un valor previo, si no hay datos, le pongo un cero "0".
  total = (total == null || total == undefined || total == "") ? 0 : total;

  /* Esta es la suma. */
  total = (parseInt(total) - parseInt(valor));

  // Colocar el resultado de la suma en el control "span".
  
  if (total < 0) {
    swal({
      title: ":/",
      text: "El saldo no puede ser menor al total!",
      icon: "warning",
      button: "Aceptar",
    });
    $('#abono').val("");
    $('#saldo').val($('#costoTotal').val());
  }else{
    $('#saldo').val(total.toFixed(2));
    
  }
  
}
function sumar () {
  var total = parseFloat($('#costoTotal').val())||0; // Convertir el valor a un entero (número).
  
  var abono = parseFloat($("#abono").val())||0;  

  /* Esta es la suma. */
  resul = (parseFloat(total) - parseFloat(abono));

  // Colocar el resultado de la suma en el control "span".
  
  if (resul < 0) {
    swal({
      title: ":/",
      text: "El saldo no puede ser menor al total!",
      icon: "warning",
      button: "Aceptar",
    });
    $('#abono').val("");
    $('#saldo').val($('#costoTotal').val());
  }else{
    $('#saldo').val(resul.toFixed(2));
    
  }
  
}

   
function sumarCosto(costo, idPrueba) {

  var actual = parseFloat($("#costoTotal").val())||0;
  
 
  var costo = parseFloat(costo)||0;
  /*  if(isNaN(actual)){
    actual = 0.0;
    parseFloat(actual); 
  }  */
  var total = actual + costo;
  //$('#costoTotal').val(total);
  var isVerficade = false;
  var inputC = $('#cantidad_'+idPrueba+'_prueba');

  $('input[type="checkbox"]').on('change', function(e){
    if (this.checked) {
        /* console.log('Checkbox ' + $(e.currentTarget).val() + ' checked'); */

       // document.getElementById("cantidad_"+idPrueba+"_prueba").disabled = true;
      
        var cantidad = parseInt($('#cantidad_'+idPrueba+'_prueba').val())||0;
        
        
        //console.log('El valor del input cantitas es:\n\n\n ', "cantidad_"+idPrueba+"_prueba", cantidad);
        total = actual + (costo * cantidad);
        //console.log('El valor del activo  es:\n\n\n ', actual, costo, cantidad);
        isVerficade = true;
      
       
    } else {
        /* console.log('Checkbox ' + $(e.currentTarget).val() + ' unchecked'); */
        //var cantidad = document.getElementById("cantidad"+id).value;
       // $('#abono').val(_abono.toFixed(2));
        $("#abono").val('');
        var cantidad = parseInt($('#cantidad_'+idPrueba+'_prueba').val())||0;
        total = actual - (costo * cantidad);
       //console.log('El valor del desctiovado es:\n\n\n ', actual, costo, cantidad);
        isVerficade = false;
       
        //document.getElementById("cantidad_"+idPrueba+"_prueba").value = 1 || 0;
        //$('#cantidad_'+idPrueba+'_prueba').prop( "disabled", false );
        //document.getElementById("cantidad_"+idPrueba+"_prueba").disabled = false;
       
    }
    console.log('El valor del input cantitas es:\n\n\n ', isVerficade);
    if (isVerficade) {
        inputC.prop( "disabled", true );
    }else{
        inputC.prop( "disabled", false );
        //$('#abono').val(_abono.toFixed(2));
    }
   
    $('#costoTotal').val(total.toFixed(2));
    $('#saldo').val(total.toFixed(2));
  });
  
  
 
};

 function pasarValor(idPrueba){
    
    $('#cantidad2_'+idPrueba+'_prueba').val($('#cantidad_'+idPrueba+'_prueba').val());
 }

 function nuevoSaldo() {
    try {
      var saldo = parseFloat(document.getElementById("msaldo").value) || 0,
        abono = parsparseFloat(document.getElementById("mabono").value) || 0;
       
      
      var reultado = saldo - abono;
      if (reultado < 0) {
        alert('El saldo nuevo no puede ser menor a 0');
        document.getElementById("mabono").value = '';
        document.getElementById("msaldo_nuevo").value = '';
      }else{
        if (document.getElementById("mabono").value == '') {
          document.getElementById("msaldo_nuevo").value = '';
        }else{
          document.getElementById("msaldo_nuevo").value = reultado ;
        } 
        
      }
      
    } catch (e) {}
  }
  //################################## Funciones psaldoara el auto completado del cliente ##########################
   //para el autocompletado del buscador de cliente (con easy autocomplete)
     //con esta vatiable obtenemos los registro
     var option = {
      url: 'http://localhost/laboratorio_app/public_html/get_cliente',
      //campo que va evaluar al buscar  en la bd
      getValue: function(element) {
        //aqui podemos concatenar mas paramtreos de la bd
          return element.nit;
      },
      theme: "blue-light",
     //al encontrar el registro y seleccionar el campo nombre sera seleccionarlo en el input
      //concatemos el apellido   
      template: {
        type: "custom",
        //lo que muestra en el resutado de la busqueda
        method: function(value, item) {
            data = item.nombre
             return data;
        }
      },
      list:{
        //listas un maximo de 10 registros nada mas
        maxNumberOfElements: 10,
        //esto hace la comparacion del input con los registros
        match:{
          enabled: true
        },
        //con esta funcion capturamos el id del cliente que se selcciono
        onClickEvent: function (){
          var value = $('#clienteNit').getSelectedItemData().identrega_cliente;
          $('#clienteid').val(value).trigger('change');
          var value2 = $('#clienteNit').getSelectedItemData().nombre;
          $('#nombreCliente').val(value2).trigger('change');
          var value3 = $('#clienteNit').getSelectedItemData().telefono;
          $('#telefonoCliente').val(value3).trigger('change');
          var value4 = $('#clienteNit').getSelectedItemData().correo;
          $('#correoCliente').val(value4).trigger('change');
          var value5 = $('#clienteNit').getSelectedItemData().empresa;
          $('#empresaCliente').val(value5).trigger('change');
        }
      }
  
    };
    //seleccionamos el id del imput para pasarle los datos encontrados
    $("#clienteNit").easyAutocomplete(option); 