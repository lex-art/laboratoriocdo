<?php namespace App\Controllers;

use App\Models\CrudUsuariosModel;
use App\Models\CrudOrdenesModel;
use App\Models\DetallePruebasEnsayos;
use App\Models\CrudBitacoraBuscqueda;
use App\Models\Reporte;
use App\Models\CrudEventoActividad;

class AppController extends BaseController
{
	public function index()
	{
		/**
		 * El index de los cobtroladores solo nos serviran para redireccionar a una pagina en espesifico
		 */
		$model = new CrudOrdenesModel();
				
				$total = $model->totalOrdenes();
				$abono = $model->totalAbono();
				$saldo = $model->totalPendientes();
				$count = $model->countOrdenes();

				$total_anual = $model->totalOrdenesAnual();
				$abono_anual = $model->totalAbonoAnual();
				$saldo_anual = $model->totalPendientesAnual();
				$count_anual = $model->countOrdenesAnual();

				if ($total) {

					$mensaje = session('mensaje');
					$data = [
						'page' => 'home',
						'total' => $total,
						'abono' => $abono,
						'saldo' => $saldo,
						'count' => $count,

						'total_anual' => $total_anual,
						'abono_anual' => $abono_anual,
						'saldo_anual' => $saldo_anual,
						'count_anual' => $count_anual,
					];
					view('app/layout', $data);
					return view('app/pages/home', $data);
								
	
				} else {
					$mensaje =[
						'tipo_alert' =>'error',
						'value' =>"hubo un error al cargar los datos!"
					];
					return redirect()->to(base_url('/app'))->with('mensaje', $mensaje);
				}		
	}
	//--------------------- Funcion para reeedirigir sin datos -----------------------------------------------
	public function resourse($page){		
		/* echo($page); */
		$mensaje = session('mensaje');
		$data = [
			'page' => $page,
			'mensaje' => $mensaje,
		];
		view('app/layout', $data);
		return view('app/pages/'.$page);
	}
	//--------------------- Funcion para reeedirigir con datos -----------------------------------------------
	public function resourseWithData($page, $datos){		
		/* echo($page); */
		
		$mensaje = session('mensaje');
		$data = [
			'page' => $page,
			'mensaje' => $mensaje,
		];
		view('app/layout', $data);
		return view('app/pages/'.$page, $datos);
	}

	//################## Funcion para crear un usuario ####################
	public function crearUsuario(){
		//recibimos el correo y datos necesarios desde el frontend
		$correo = $this->request->getpost("email");
		$puesto = $this->request->getpost("puesto");
		//importamos la libreria que necesitamos
		$email = \Config\Services::email();
		
		//instanciamos el modelo que vamos a usar
		$UsuarioModel = $this->usuarioModel = model('CrudUsuariosModel');
		//Verificamos que el usuario que se va a registrar no este registrado previamente
		$user = $UsuarioModel->where('email', $correo)->findAll();
		 if($user){
			//print_r($user);
			$mensaje =[
				'tipo_alert' =>'error',
				'value' =>"El usuario ya esta registrado!"
			];
			return redirect()->to(base_url('/usuarios_crear'))->with('mensaje', $mensaje);  
			/* echo('ya existe el usuario'); */
		}else{ 
			//generamos una contraseña aleatoria de 10 digitos
			$permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
			$password =  substr(str_shuffle($permitted_chars), 0, 10);

			try {	
				$data = [
					"email" => $correo,
					"password" => sha1($password),
					"activo" => 1,
					"creado" => date("Y-m-d H:i:s"),
					"modificado"=> date("Y-m-d H:i:s"),
					"rol" => $puesto,
					"first_time" => 1,
				];
				//Se inserta el registro en la base de datos
				

				if ($UsuarioModel->insert($data)) {
					/* $to = $correo;
					$subect = "Cuenta creada - Laboratorio CDO";
					$message = "Hola. \n \n Bienvenido al equipo de Laboratorio CDO."
							."\n\n Su usuario es: ".$correo. " y su contraseña es: ".$password 
							."\n\n Porfavor haz click en el enlace siguiente, "
							."para activar la cuenta: \n ".base_url().'/login';
					
					$email->setTo($to);
					$email->setFrom('info@laboratoriocdo.com', 'Info');
					$email->setSubject($subect);
					$email->setMessage($message); */

					$mensaje =[
						'tipo_alert' =>'success',
						'value' => "Usuario creado. No pierda la contraseña, proporcionela al usuario (Puede cambiar su contraseña, en edición de usuario).",
						'pass' => $password
					];
					return redirect()->to(base_url('/usuarios_listar'))->with('mensaje',$mensaje ); 
					/* if($email->send()){
						
						//notificaion de que el usuarios se creo exitosamente al iugual de que el correo que envio exitosamente
						$mensaje =[
							'tipo_alert' =>'success',
							'value' =>"Usuario creado exitosmente!"
						];
						return redirect()->to(base_url('/usuarios_listar'))->with('mensaje',$mensaje ); 
					}else{
						//notificacion de que si se pudo crear el usuario, pero no se pudo mandar el correo electronico, mostrar correo y contraseña
						$mensaje =[
							'tipo_alert' =>'warning',
							'value' =>"Usuario registrado, pero no se pudo enviar el correo electrónico!"
						];
						return redirect()->to(base_url('/usuarios_listar'))->with('mensaje', $mensaje);
						 $data = $email->printDebugger(['headers']);
						print_r($data);
					}  */
				}else {
					//notificacion de que se no se pudo crear el usuario en la base de datos
					$mensaje =[
						'tipo_alert' =>'error',
						'value' =>"No se pudo crear el usuarios!"
					];					
					return redirect()->to(base_url('/usuarios_listar'))->with('mensaje', $mensaje);
				}
			} catch (\Throwable $th) {
				//throw $th;
				$mensaje =[
					'tipo_alert' =>'error',
					'value' =>"Se produjo algun error!"
				];
				return redirect()->to(base_url('/usuarios_listar'))->with('mensaje', $mensaje);
				/* print_r($th); */
			}
			
			
		 } 
	}

	//########################### Funcion la listar todos los usuarios ######################

	public function listarUsuarios()
	{
		//instanciamos el modelo que vamos a usar
		$UsuarioModel = $this->usuarioModel = model('CrudUsuariosModel');
		//Verificamos que el usuario que se va a registrar no este registrado previamente
		$users = $UsuarioModel->where('activo', 1)->findAll();

		$datos ['usuarios'] = $users;
		$Controlador = new AppController();
		$page = 'usuarios_listar';
		$mostrar = $Controlador->resourseWithData($page, $datos);
		echo $mostrar;
	}

//########################### Funcion para activar la cuenta y actualizar los datos del usuario #######################
	public function updateProfile()
	{
		//obtenemos el id del usuario quien esta modificando
		$id = session('id');
		//Establecer la información local en castellano de Guatemala
		setlocale(LC_TIME,"es_GT");
		//############## Proceso para subir una imagen de archivo ##############
		
		$fotoname = $_FILES['foto_usuario']['name'];

		if($fotoname != null){

			$fotoname = $_FILES['foto_usuario']['name']; //nombre de la foto			
			$ruta = $_FILES['foto_usuario']['tmp_name'];//el archivo de la imagen en si
			$destino = "../codeigniter/media/avatar/".$fotoname;
			//si el archivo ya exite lo borra y lo vuelve a copiar
			if (file_exists(base_url().$destino)) {
				unlink($ruta);
				copy($ruta,$destino);               
			}
			copy($ruta,$destino); 

		}else{
			$fotoname = null;
		}
		
		//###### Preparando los datos para actualizar el registro
		$data = array (
			'nombre_usuario'=> $this->request->getpost("nombre"),
			'apellido'=>$_POST['apellido'],
			'password'=> sha1($_POST['password']),
			'telefono'=> $_POST['telefono'],
			'dpi'=> $_POST['dpi'],
			'genero'=> $_POST['genero'],
			'modificado'=> date("Y-m-d H:i:s"),//formato sql,
			'url_img'=> $fotoname,
			'first_time' => 0
		);

		//instanciamos el modelo que vamos a usar
		$Usuario = new CrudUsuariosModel();

		//Se inserta el registro en la base de datos
		$resul =  $Usuario->actualizar($data, $id);

		if ($resul) {
			return redirect()->to(base_url('/salir'));
		}else {
			return redirect()->to(base_url('/salir'));
		}		
	}

//########################### Funcion para actualizar los datos del usuario desde el usuario administrador#######################
	public function updateProfileAdmin()
	{
		//obtenemos el id del usuario que se quiere modificar
		$id = $this->request->getpost("idUsuario");
		//Establecer la información local en castellano de Guatemala
		setlocale(LC_TIME,"es_GT");

		//############## Proceso para subir una imagen de archivo ##############		
		$fotoname = $_FILES['foto_usuario']['name'];

		if($fotoname != null){

			$fotoname = $_FILES['foto_usuario']['name']; //nombre de la foto			
			$ruta = $_FILES['foto_usuario']['tmp_name'];//el archivo de la imagen en si
			$destino = "../codeigniter/media/avatar/".$fotoname;
			//si el archivo ya exite lo borra y lo vuelve a copiar
			if (file_exists(base_url().$destino)) {
				unlink($ruta);
				copy($ruta,$destino);               
			}
			copy($ruta,$destino); 

		}else{
			$fotoname = null;
		}
		
		//###### Preparando los datos para actualizar el registro
		$data =[];

		if ($_POST['password'] != null){

			$data = [	
				'nombre_usuario'=> $this->request->getpost("nombre"),
				'apellido'=>$_POST['apellido'],
				'password'=> sha1($_POST['password']),
				'telefono'=> $_POST['telefono'],
				'dpi'=> $_POST['dpi'],
				'genero'=> $_POST['genero'],
				'modificado'=> date("Y-m-d H:i:s"),//formato sql,
				'url_img'=> $fotoname,
				'rol' =>  $_POST['puesto']
			];
		}else{
			$data = [	
				'nombre_usuario'=> $this->request->getpost("nombre"),
				'apellido'=>$_POST['apellido'],	
				'telefono'=> $_POST['telefono'],
				'dpi'=> $_POST['dpi'],
				'genero'=> $_POST['genero'],
				'modificado'=> date("Y-m-d H:i:s"),//formato sql,
				'url_img'=> $fotoname,
				'rol' =>  $_POST['puesto']
			];
		}
		

		//instanciamos el modelo que vamos a usar
		$Usuario = new CrudUsuariosModel();

		//Se inserta el registro en la base de datos
		//$resul =  $Usuario->actualizar($data, $id);

		if ($Usuario->actualizar($data, $id)) {
			$mensaje =[
				'tipo_alert' =>'success',
				'value' =>"Usuario Actualizado!"
			];
			return redirect()->to(base_url('/usuarios_listar'))->with('mensaje', $mensaje);
		}else {
			$mensaje =[
				'tipo_alert' =>'error',
				'value' =>"No se pudo actualizar el usuarios!"
			];
			return redirect()->to(base_url('/usuarios_listar'))->with('mensaje', $mensaje);
			//echo("El resigto no se pudo actualizar");
		}
		
	}
//########################### Funcion para desactivar un suaurio #######################
	public function deleteUser()
	{
		//obtenemos el id del usuario que se quiere modificar
		$id = $this->request->getpost("idUsuario");
		//instanciamos el modelo que vamos a usar
		$Usuario = new CrudUsuariosModel();
		$data = [	
			'activo'=> 0,
		];
		//Se inserta el registro en la base de datos
		$resul =  $Usuario->actualizar($data, $id);

		if ($resul) {
			$mensaje =[
				'tipo_alert' =>'success',
				'value' =>"Usuario eliminado!"
			];
			return redirect()->to(base_url('/usuarios_listar'))->with('mensaje', $mensaje);
		}else {
			$mensaje =[
				'tipo_alert' =>'error',
				'value' =>"No se pudo eliminar el usuario!"
			];
			return redirect()->to(base_url('/usuarios_listar'))->with('mensaje', $mensaje);
			//echo("El resigto no se pudo actualizar");
		}
	}
	//########################### Funcion Leer las pruebas y ensayos y redireccionarlas #######################
	public function crearOrden()
	{
		//instanciamos el modelo que vamos a usar
		$Pruebas = $this->pruebasEnsayos = model('PruebasEnsayosListado');

		$ensayos = $Pruebas->where('activo', 1)->findAll();

		$datos ['pruebasEnsayos'] = $ensayos;
		$Controlador = new AppController();
		$page = 'ordenes_crear';
		$mostrar = $Controlador->resourseWithData($page, $datos);
		echo $mostrar;
	}

	//########################### Funcion Leer las pruebas y ensayos #######################
	public function verOrden()
	{
		//instanciamos el modelo que vamos a usar
		$CrudOrdenes = $this->crudOrdenes = model('CrudOrdenesModel');
		
		$ensayosConfirmar = $CrudOrdenes->where('activo', 1)->where('estado', 'Pendiente de confirmar')->orderBy('idorden_de_trabajo','ASC')->findAll();
		$ensayos = $CrudOrdenes->where('activo', 1)->orderBy('idorden_de_trabajo','ASC')->findAll();
		$datos = [
			'pendiente_de_confirmar'=> $ensayosConfirmar,
			'ordenes'=> $ensayos
		];

		$Controlador = new AppController();
		$page = 'ordenes_ver';
		$mostrar = $Controlador->resourseWithData($page, $datos);
		echo $mostrar;
	}

//################# Funcion mostrar las ordenes de trabajo pendientes de subir resultados ####################
	public function resultados(){
		//instanciamos el modelo que vamos a usar
		$CrudOrdenes = $this->crudOrdenes = model('CrudOrdenesModel');
		
		$ordenes = $CrudOrdenes->where('activo', 1)->where('estado', 'En Proceso')->findAll();

		$ordenes_terminadas = new CrudOrdenesModel();
		

		$resul = $ordenes_terminadas->obtner_resultados();

		

		// $CrudOrdenes->where('activo', 1)->where('informe_resultado_idinforme_resultado  IS NOT', null)->findAll();
		//echo json_encode($resul);
		
		//print_r($resul);
		
		  $datos = [
			'ordenes'  => $ordenes,
			'ordenes_terminadas' =>  $resul
		
		];

	 	$Controlador = new AppController();
		$page = 'resultados';
		$mostrar = $Controlador->resourseWithData($page, $datos);
		echo $mostrar;  
	}

	public function subirResultado()
	{			
		$codigo = $_GET['codigo'];

		
		$datos ['codigo'] = $codigo;

		$Controlador = new AppController();
		$page = 'subir_resultado';
		$mostrar = $Controlador->resourseWithData($page, $datos);
		echo $mostrar;
		
	}

	public function editarResultado()
	{			
		$codigo = $_GET['codigo'];

		
		$datos ['codigo'] = $codigo;

		$CrudOrdenes = new CrudOrdenesModel();
		
		$resultado = $CrudOrdenes->getInforme($codigo);

		//dd($resultado);

		$datos ['resultado'] = $resultado;

		$Controlador = new AppController();
		$page = 'editar_resultado';
		$mostrar = $Controlador->resourseWithData($page, $datos);
		echo $mostrar;
		
	}

	public function getOrden()
	{			
		$codigo = $_GET['codigo'];

		$CrudOrdenes = new CrudOrdenesModel();
		
		$resultado = $CrudOrdenes->getOden($codigo);

		$CrudPruebasEnsayos = new DetallePruebasEnsayos();
		$pruebaEnsayos = $CrudPruebasEnsayos->getDetalleOrden($resultado[0]->idorden_de_trabajo);
		//dd($pruebaEnsayos);
		
		$datos = [
			'orden'  => $resultado,		
			'pruebaEnsayos' => $pruebaEnsayos
		];

	  	$Controlador = new AppController();
		$page = 'orden_ver';
		$mostrar = $Controlador->resourseWithData($page, $datos);
		echo $mostrar;   
	}
	public function getOrdenUpdate()
	{			
		$codigo = $_GET['codigo'];

		$CrudOrdenes = new CrudOrdenesModel();
		
		$resultado = $CrudOrdenes->getOden($codigo);

		$CrudPruebasEnsayos = new DetallePruebasEnsayos();
		$pruebaEnsayos = $CrudPruebasEnsayos->getDetalleOrden($resultado[0]->idorden_de_trabajo);
		//dd($pruebaEnsayos);
		//$Pruebas = $this->pruebasEnsayos = model('PruebasEnsayosListado');

		//$ensayos = $Pruebas->where('activo', 1)->findAll();
		
		$datos = [
			'orden'  => $resultado,		
			'pruebaEnsayos' => $pruebaEnsayos,
			//'ensayos'=>$ensayos,
			
		];

	  	$Controlador = new AppController();
		$page = 'orden_actualizar';
		$mostrar = $Controlador->resourseWithData($page, $datos);
		echo $mostrar;   
	}

// ############ obtenemos los datos del cliente para editarlo y lo retornamos en formato json ##################
    public function getCliente(){
		//instanciamos el modelo que vamos a usar
		$CrudCliente = $this->crudOrdenes = model('CrudClientesModel');
	
		$resultado = $CrudCliente->where('activo', 1)->findAll();
        echo json_encode($resultado);
	}
	
	// ############ Obtener todos los registros de las pruebas y ensayo que se realizar en la empresa ##################
    public function verPruebasEnsayos(){
	//instanciamos el modelo que vamos a usar
		$CrudOrdenes = $this->crudOrdenes = model('CrudPruebasEnsayos');
			
		$ensayos = $CrudOrdenes->where('activo', 1)->findAll();

		$datos ['pruebas_ensayos_ver'] = $ensayos;

		$Controlador = new AppController();
		$page = 'pruebas_ensayos_ver';
		$mostrar = $Controlador->resourseWithData($page, $datos);
		echo $mostrar;
	}

	public function tipoReporte(){
        $tipoReporte = $this->request->getpost("tipo_reporte");
        $fecha_inicio = $this->request->getpost("fecha_del");
        $fecha_fin = $this->request->getpost("fecha_hasta");

		$model = new Reporte();
        //Resultado de la busqueda de la orden de trabajo
		$resul = $model->buscarResultado( $tipoReporte, $fecha_inicio, $fecha_fin);
		//dd($resul);
		if ($resul) {
			//dd($resul);
			$datos ['data'] = $resul;
			$Controlador = new AppController();
			$page='reportes2';
			$mostrar = $Controlador->resourseWithData($page, $datos);
			echo $mostrar; 
		
			
		} else {
			$mensaje =[
				'tipo_alert' =>'error',
				'value' =>"No se pudo realizar el reporte por algun motivo!"
			];
			return redirect()->to(base_url('/reportes'))->with('mensaje', $mensaje);
		}
		
    }
	

	public function verBitacora(){
		
		$model = new CrudBitacoraBuscqueda();
		$resul = $model->findAll();
		$datos['bitacora']= $resul;
		//dd($datos);
		$Controlador = new AppController();
		$page = 'ver_bitacora';
		$mostrar = $Controlador->resourseWithData($page, $datos);
		echo $mostrar;
	}

	public function  evento_publicar(){		
		$model = new CrudEventoActividad();
		$resul = $model->findAll();
		$datos['eventos']= $resul;
		//dd($datos);
		$Controlador = new AppController();
		$page = 'publicar_evento';
		$mostrar = $Controlador->resourseWithData($page, $datos);
		echo $mostrar;
	}


	public function  updateEvento(){		
		$id_evento = $this->request->getpost("idEvento");
        $titulo = $this->request->getpost("titulo");
        $description = $this->request->getpost("description");

		$data = [			
			'evento_actividad'=>'Evento o acttividad',
			'titulo'=> $titulo,
			'description'=> $description,			
			
		];
		
		
		$Evento = new CrudEventoActividad();
		$resul = $Evento->actualizar($data,$id_evento);
		
		if ($resul) {
			$mensaje =[
				'tipo_alert' =>'success',
				'value' => "Evento o actividad publicado exitosamente."
			];
			return redirect()->to(base_url('/evento'))->with('mensaje', $mensaje); 
		}else{
			$mensaje =[
				'tipo_alert' =>'error',
				'value' => "No se pudo publicar el evento."
			];
			return redirect()->to(base_url('/evento'))->with('mensaje', $mensaje); 
		}
	
	}

	public function  deleteEvento(){
		$id_evemtp = $this->request->getpost("idEvento");
      

		$data = [			
			'titulo'=> null,
			'description'=> null,			
			
		];
		$Evento = new CrudEventoActividad();
		$resul = $Evento->actualizar($data,$id_evemtp);
		if ($resul) {
			$mensaje =[
				'tipo_alert' =>'success',
				'value' => "Evento o actividad eliminado exitosamente."
			];
			return redirect()->to(base_url('/evento'))->with('mensaje', $mensaje); 
		}else{
			$mensaje =[
				'tipo_alert' =>'error',
				'value' => "No se pudo elimianar publicar el evento, intente de nuevo."
			];
			return redirect()->to(base_url('/evento'))->with('mensaje', $mensaje); 
		}
	}

	public function getOrdenEvaluador(){
		$codigo = $_GET['codigo'];

		$CrudOrdenes = new CrudOrdenesModel();
		
		$resultado = $CrudOrdenes->getOden($codigo);

		$CrudPruebasEnsayos = new DetallePruebasEnsayos();
		$pruebaEnsayos = $CrudPruebasEnsayos->getDetalleOrden($resultado[0]->idorden_de_trabajo);
		//dd($pruebaEnsayos);		
		$datos = [
			'orden'  => $resultado,		
			'pruebaEnsayos' => $pruebaEnsayos
		];
	  	$Controlador = new AppController();
		$page = 'orden_ver_evaluador';
		$mostrar = $Controlador->resourseWithData($page, $datos);
		echo $mostrar;	
	}

	public function buscarOrden(){
        $codigo = $this->request->getpost("codigo");
		$nombres = $this->request->getpost("nombres");
		$email = $this->request->getpost("email");
        $telefono = $this->request->getpost("telefono");
        
        $data=[
            'codigo_orden'=>$codigo,
            'nombre'=>$nombres,
            'telefono' =>$telefono,
            'correo'=>$email,    
            'creado'=>date("Y-m-d H:i:s"),
        ];

        $model = new CrudBitacoraBuscqueda();
        //Resultado de la busqueda de la orden de trabajo
        $resul = $model->buscarOrden($codigo, $data);
       // dd($resul);

        if ($resul) {
            if($resul[0]->estado == "Pendiente de pago"){
                
                return redirect()->to(base_url('/resultado_pendiente'));
               
                /*$ data['page'] = 'consulta_resultado';
                view('webPage/layout',$data);
                return view('webPage/page/consulta_resultado'); */
               
            }else{    

				$data['page']='consulta_resultado';

				view('webPage/layout',$data);
		        return view('webPage/page/consulta_resultado');
                  
            }            
        }else{
            $mensaje =[
				'tipo_alert' =>'error',
				'value' =>"No se pudo encontrar laorden de trabajo!"
			];
			return redirect()->to(base_url('/consultas'))->with('mensaje', $mensaje);
        } 


    }
}
