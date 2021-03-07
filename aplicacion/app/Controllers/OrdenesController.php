<?php namespace App\Controllers;

	use App\Models\CrudOrdenesModel;
	use App\Models\DetallePruebasEnsayos;
	use \Mpdf\Mpdf;	
	use App\Controllers\AppController;
class OrdenesController extends BaseController
{
	public function index()
	{
		
		$mensaje = session('mensaje');
		$data = [
			'page' => 'ordenes_ver',
			'mensaje' => $mensaje,
		];
		view('app/layout', $data);
		return view('app/pages/ordenes_ver', $data);
	}

//############################### FUNCION PARA CREAR UNA ORDEN DE TRABAJO ##################################
	public function crearOrden(){
		
		$nombre_proyecto = $this->request->getpost("nombre_proyecto");
		$ejecutado_por = $this->request->getpost("ejecutado_por");
		$fecha = $this->request->getpost("fecha_recepcion");
		$nombre_cliente = $this->request->getpost("nombre_cliente");
		$nit_cliente = $this->request->getpost("nit_cliente");
		$telefono_cliente = $this->request->getpost("telefono_cliente");
		$correo_cliente = $this->request->getpost("correo_cliente");
		$empresa_cliente = $this->request->getpost("empresa_cliente");
		$observaciones = $this->request->getpost("observaciones");
		$costo_total = $this->request->getpost("costo_total");
		$abono = $this->request->getpost("abono");
		$saldo = $this->request->getpost("saldo");
		$pruebas = $this->request->getpost("cb");
		$idCliente = $this->request->getPost('clienteid');//campo oculto en el formulario

		
		if( $pruebas == null){
			$mensaje =[
				'tipo_alert' =>'warning',
				'value' => "Seleccione por lo menos una pueba o ensayo."
			];	
			return redirect()->to(base_url('/ordenes'))->with('mensaje', $mensaje);
		}
		$prueba = array();	
		$todo_prueba = array();

		$data_inicial_orden = [
			'creado'=> date("Y-m-d H:i:s"),
			'modificado'=> date("Y-m-d H:i:s"),
			'Usuario_idUsuario_creacion'=> session('id'),
			'activo'=> 0
		];
		
		//sacamos las cantidades y los id del formualrio que seactivaron con el checkbox 
		for ($i=0; $i < count($pruebas); $i++) { 

			$cantidad = $this->request->getpost("cantidad2_".$pruebas[$i]);			
			$prueba['cantidad'] = $cantidad;
			$prueba['costo_prueba'] = $costo = $this->request->getpost("costo_".$pruebas[$i]);
			$prueba['sub_total'] = floatval($cantidad) * floatval($costo);
			$prueba['lista_prueba_ensayo_idprueba_ensayo'] = $pruebas[$i]; 
			//mettemos todos los registros que se van a usar, en un array para que se puedan
			//insertar después, y poder relacionarlos coon la orden de trabajo
			array_push($todo_prueba, $prueba);
		} 		
		//Generamos el aray de datos necesarios para la orden de trabaho

		 $dataCliente=[
			'nombre'=>$nombre_cliente,
			'nit'=>$nit_cliente,
			'telefono' =>$telefono_cliente ,
			'correo'=>$correo_cliente ,
			'empresa'=>$empresa_cliente ,
			'activo'=>1,			
		];

		$dataOrden=[				
			'nombre_proyecto'=> $nombre_proyecto ,
			'ejecutado_por'=> $ejecutado_por,
			'fecha_recepcion'=> $fecha,
			'costo_total'=>$costo_total ,
			'abono'=> $abono,
			'saldo'=> $saldo ,
			'estado'=> 'Pendiente de confirmar',
			'observacion'=> $observaciones ,
			'activo'=> 1,
		];
		//instanciamos el modelo que vamos a para crear la orden de trabajo
		$model = new CrudOrdenesModel();
		//Guradamos en una variable la respuesta que nos retorna la funcion crearOrden del modelo
		$result = $model->crearOrden($data_inicial_orden, $todo_prueba, $dataCliente, $dataOrden, $idCliente);
		if($result != null || $result !=0){

			$mensaje =[
				'tipo_alert' =>'success',
				'value' => "Orden de trabajo creado exitosamente.",
				'codigo' => $result
			];
			return redirect()->to(base_url('/ver_ordenes'))->with('mensaje', $mensaje); 			
		}else{
			$mensaje =[
				'tipo_alert' =>'error',
				'value' => "No se logro generar la orden de trabajo"
			];	
			return redirect()->to(base_url('/ordenes'))->with('mensaje', $mensaje); 
		} 		
	}
//############################### FUNCION PARA SUBIR LOS RESULTADOS DE UNA ORDEN DE TRABAJO ##################################
	public function confirmarOrden(){

		$idOrden = $this->request->getpost("midOrden");

		$dataOrden = [
			'estado' => 'En proceso'
		];

		$model = new CrudOrdenesModel();
		$result = $model->actualizar($dataOrden, $idOrden);

		if ($result != null) {
			$mensaje =[
				'tipo_alert' =>'success',
				'value' => "Orden de trabajo confirmada"
			];	
			return redirect()->to(base_url('/ver_ordenes'))->with('mensaje', $mensaje);
		}else{
			$mensaje =[
				'tipo_alert' =>'error',
				'value' => "No se pudo liberar la orden de trabajo"
			];	
			return redirect()->to(base_url('/ver_ordenes'))->with('mensaje', $mensaje);
		}
	}
	public function resultados(){
		$observaciones = $this->request->getpost("observaciones");
		$codigo = $this->request->getpost("codigo");
		$fecha = $this->request->getpost("fecha");
	
		//############## Proceso para subir una el  archivo ##############
		
		$informe = $_FILES['informe']['name']; //nombre del archivo

		if($informe != null){

			$filename = $_FILES['informe']['name']; //nombre del archivo		
			$ruta = $_FILES['informe']['tmp_name'];//el archivo en si
			//Creamos su carpeta correspondiete
			//verificamos si la carpera no exista
			if (!file_exists("../informes/informe ".$codigo)) {
				//verifica que la creacion de la carpeta no tenga ningun problema al crearse
				if(!mkdir("../informes/informe ".$codigo."/", 0700, true)){
					$mensaje =[
						'tipo_alert' =>'error',
						'value' => "Fallo al intentar crear la carpeta del resultado!"
					];
					return redirect()->to(base_url('/resultados'))->with('mensaje', $mensaje);
				}else{
					//mkdir("../codeigniter/informes/informe".$codigo."/", 0700);
					$destino = "assets/informes/".$codigo."_".$filename;
				}
			}else{
		    	$destino = "assets/informes/".$codigo."_".$filename;
			}			
			//si el archivo ya exite lo borra y lo vuelve a copiar
			if (file_exists(base_url().$destino)) {
				unlink($ruta);
				copy($ruta,$destino);               
			}
			copy($ruta,$destino); 

			$data =[
				'observacion' =>$observaciones,
				'url_informe' =>  $codigo."_".$filename,
				'fecha'=> $fecha,
				'activo' => 1,
				'creado'=> date("Y-m-d H:i:s"),
				'modificado' => date("Y-m-d H:i:s")
			];

			$model = new CrudOrdenesModel();
			$result = $model->subir_resultados($data, $codigo);

			if ($result) {
				$mensaje =[
					'tipo_alert' =>'success',
					'value' => "Informe subido exitosamente!"
				];
				return redirect()->to(base_url('/resultados'))->with('mensaje', $mensaje);
				
			}else{
				$mensaje =[
					'tipo_alert' =>'error',
					'value' => "No se pudo subir el archivo, hubo un problema!"
				];
				return redirect()->to(base_url('/resultados'))->with('mensaje', $mensaje);
			}

		}else{
			$mensaje =[
				'tipo_alert' =>'error',
				'value' => "No se pudo guradar el informe, elija un archivo valido!"
			];
			return redirect()->to(base_url('/resultados'))->with('mensaje', $mensaje);
		}

	}
	public function pagarOrden(){
		$idOrden = $this->request->getpost("codOrden");
		$abono = $this->request->getpost("abono");
		
	
		$CrudOrdenes = new CrudOrdenesModel();
		$resultado = $CrudOrdenes->where('idorden_de_trabajo', $idOrden)->find();

		//print_r($resultado);
		$saldo =  floatval($resultado[0]['saldo']);
		$abono_db =  floatval($resultado[0]['abono']);
		$abono2  = floatval($abono);
		$nuevo_abono = $abono_db + $abono2;
		$saldo_nuevo = $saldo - $abono2;
		
		if ($saldo_nuevo < 0) {
			$mensaje =[
				'tipo_alert' =>'error',
				'value' => "El saldo no puede ser menor a cero!"
			];
			return redirect()->to(base_url('/resultados'))->with('mensaje', $mensaje);
		} else {
			$data = [
				'abono' => floatval($nuevo_abono),
				'saldo' => floatval($saldo_nuevo),
				'estado' => $saldo_nuevo > 0 ? 'Pendiente de pago' : 'Finalizado',
				'modificado' => date("Y-m-d H:i:s")
			];

			$update = $CrudOrdenes->actualizar($data, $idOrden);

			if ($update) {
				$mensaje =[
					'tipo_alert' =>'success',
					'value' => "Orden de trabajo actualizado correctamente!"
				];
				return redirect()->to(base_url('/resultados'))->with('mensaje', $mensaje);
			}else{
				$mensaje =[
					'tipo_alert' =>'error',
					'value' => "No se pudo actualizar el registro!"
				];
				return redirect()->to(base_url('/resultados'))->with('mensaje', $mensaje);
			}

		}

	}
	public function editarResultados(){

		$idResultado = $this->request->getpost("idResultado");
		$codigo = $this->request->getpost("codigo");
		$observaciones = $this->request->getpost("observaciones");		
		$fecha = $this->request->getpost("fecha");
	
		//############## Proceso para subir archivo ##############		
		$informe = $_FILES['informe']['name']; //nombre del archivo

		if($informe != null){

			$filename = $_FILES['informe']['name']; //nombre del archivo		
			$ruta = $_FILES['informe']['tmp_name'];//el archivo en si
			//Creamos su carpeta correspondiete
			//verificamos si la carpera no exista
			if (!file_exists("../informes/informe ".$codigo)) {
				//verifica que la creacion de la carpeta no tenga ningun problema al crearse
				if(!mkdir("../informes/informe ".$codigo."/", 0700, true)){
					$mensaje =[
						'tipo_alert' =>'error',
						'value' => "Fallo al intentar crear la carpeta del resultado!"
					];
					return redirect()->to(base_url('/resultados'))->with('mensaje', $mensaje);
				}else{
					//mkdir("../codeigniter/informes/informe".$codigo."/", 0700);
					$destino = "../informes/informe ".$codigo."/".$filename;
				}
			}else{
				$destino = "../informes/informe ".$codigo."/".$filename;
			}			
			//si el archivo ya exite lo borra y lo vuelve a copiar
			if (file_exists(base_url().$destino)) {
				unlink($ruta);
				copy($ruta,$destino);               
			}
			copy($ruta,$destino); 

			$data =[
				'observacion' =>$observaciones,
				'url_informe' =>  $filename,
				'fecha'=> $fecha,
				'modificado' => date("Y-m-d H:i:s")
			];

			$model = new CrudOrdenesModel();
			$result = $model->actualizarResultado($data, $idResultado);

			if ($result) {
				$mensaje =[
					'tipo_alert' =>'success',
					'value' => "Informe actualizado exitosamente!"
				];
				return redirect()->to(base_url('/resultados'))->with('mensaje', $mensaje);
				
			}else{
				$mensaje =[
					'tipo_alert' =>'error',
					'value' => "No se pudo actualizar el archivo, hubo un problema!"
				];
				return redirect()->to(base_url('/resultados'))->with('mensaje', $mensaje);
			}

		}else{
			$mensaje =[
				'tipo_alert' =>'error',
				'value' => "No se pudo guradar el informe, elija un archivo valido!"
			];
			return redirect()->to(base_url('/resultados'))->with('mensaje', $mensaje);
		}

	}

############################## Eliminar una orden de trabajo ###########################################
	public function eliminar()	{
		$idOrden = $this->request->getpost("midOrdeneliminar");	

		$data =['activo' =>0];

		$CrudOrdenes = new CrudOrdenesModel();
		$resultado = $CrudOrdenes->actualizar($data,$idOrden);
		
		if ($resultado) {
			$mensaje =[
				'tipo_alert' =>'success',
				'value' => "Orden de trabajo elimiando exitosamente!"
			];
			return redirect()->to(base_url('/ver_ordenes'))->with('mensaje', $mensaje);
		}else{
			$mensaje =[
				'tipo_alert' =>'error',
				'value' => "No se pudo elimianr el registro!"
			];
			return redirect()->to(base_url('/ver_ordenes'))->with('mensaje', $mensaje);
		} 
	}

########################### Actualizar una orden de trabajo ########################################
	public function actualizarOrden(){
		$id_orden = $this->request->getpost("id_orden");
		$nombre_proyecto = $this->request->getpost("nombre_proyecto");
		$ejecutado_por = $this->request->getpost("ejecutado_por");
		$fecha = $this->request->getpost("fecha_recepcion");
		$id_cliente = $this->request->getpost("id_cliente");
		$nombre_cliente = $this->request->getpost("nombre_cliente");
		$nit_cliente = $this->request->getpost("nit_cliente");
		$telefono_cliente = $this->request->getpost("telefono_cliente");
		$correo_cliente = $this->request->getpost("correo_cliente");
		$empresa_cliente = $this->request->getpost("empresa_cliente");
		$observaciones = $this->request->getpost("observaciones");

		$dataOrden=[				
			'nombre_proyecto'=> $nombre_proyecto ,
			'ejecutado_por'=> $ejecutado_por,
			'fecha_recepcion'=> $fecha,	
			'observacion'=> $observaciones ,
			'modificado'=>date("Y-m-d H:i:s")	
		];
		
		$dataCliente=[
			'nombre'=>$nombre_cliente,
			'nit'=>$nit_cliente,
			'telefono' =>$telefono_cliente ,
			'correo'=>$correo_cliente ,
			'empresa'=>$empresa_cliente ,
			'modificado'=>date("Y-m-d H:i:s")		
		];
		//dd($dataOrden,$id_orden);
		
		//instanciamos el modelo que vamos a para crear la orden de trabajo
		$model = new CrudOrdenesModel();
		//Guradamos en una variable la respuesta que nos retorna la funcion crearOrden del modelo
		$result = $model->updateOrden($id_orden, $dataOrden, $id_cliente, $dataCliente);
		if($result != null ){

			$mensaje =[
				'tipo_alert' =>'success',
				'value' => "Orden de trabajo actualizado exitosamente.",				
			];
			return redirect()->to(base_url('/ver_ordenes'))->with('mensaje', $mensaje); 			
		}else{
			$mensaje =[
				'tipo_alert' =>'error',
				'value' => "No se logro actualizar la orden de trabajo"
			];	
			return redirect()->to(base_url('/ver_ordenes'))->with('mensaje', $mensaje); 
		}
		//dd($dataOrden,$dataCliente,$id_cliente,$codigo_orden);
		
	}
########################################## Imprimir una orden de trabjo ################################
	public function imprimirOrden()	{

		$codigo = $_GET['codigo'];

		$CrudOrdenes = new CrudOrdenesModel();
		
		$resultado = $CrudOrdenes->getOden($codigo);

		$CrudPruebasEnsayos = new DetallePruebasEnsayos();
		$pruebaEnsayos = $CrudPruebasEnsayos->getDetalleOrden($resultado[0]->idorden_de_trabajo);
			
		$datos = [
			'orden'  => $resultado,		
			'pruebaEnsayos' => $pruebaEnsayos,
			//'ensayos'=>$ensayos,
			
		];
		
		$mostrar = view('app/pages/orden_imprimir',$datos);
		$css = file_get_contents(base_url().'/assets/css/imprimir.css');
		$mpdf = new Mpdf();

		// Write some HTML code:
		$mpdf->SetHeader(' | |Fecha: '.date("Y-m-d"));
			$mpdf->SetFooter('Tel: 7761-8422 ');
			//$mpdf->WriteHTML($css,\Mpdf\HTMLParserMode::HEADER_CSS);
			$mpdf->WriteHTML($css,\Mpdf\HTMLParserMode::HEADER_CSS);
			$mpdf->WriteHTML($mostrar,\Mpdf\HTMLParserMode::HTML_BODY);
			//$mpdf->SetWatermarkText('Document Code');
			//$mpdf->watermark_font = 'DejaVuSansCondensed';
				
		// Output a PDF file directly to the browser
		return redirect()->to($mpdf->Output($resultado[0]->codigo.'.pdf','I'));
	}
	
}

