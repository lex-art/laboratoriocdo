<?php namespace App\Controllers;

	use App\Models\Usuarios;
	use App\Models\CrudOrdenesModel;
	

class SessionController extends BaseController
{
	
	public function index()
	{
		
		$mensaje = session('mensaje'); 
		return view('login/login' , ['mensaje' => $mensaje,] );
	}

	//--------------------------------------------------------------------
	public function iniciarSesion(){
		//Capturamos los datos del formulario de login_view por medio del metodo post
		 /* $usuario = $this->request->getPost("usuario"); */ 
		
		$email = $this->request->getpost("email");
		$pass = $this->request->getpost("password"); 

		$Usuario = new Usuarios();
		$datoUsuario = $Usuario->obtnerUsuario($email, sha1($pass));
		

		 if (count($datoUsuario) > 0 ) {
			$session = session();
			if (!$datoUsuario[0]['first_time']) {
				//Datos del usuario
				$data = array(
					'id' =>  $datoUsuario[0]['idUsuario'],
					'nombre' =>  $datoUsuario[0]['nombre_usuario'],
					'apellido' =>  $datoUsuario[0]['apellido'],
					'telefono' =>  $datoUsuario[0]['telefono'],
					'dpi' =>  $datoUsuario[0]['dpi'],
					'genero' =>  $datoUsuario[0]['genero'],				
					'email' =>  $datoUsuario[0]['email'],				
					'privilegio' =>  $datoUsuario[0]['rol'],
					'foto' => $datoUsuario[0]['url_img'],
					'mensaje' => '',
					'login' => TRUE
				);	

				//Se crea una session de usuario
				$session->set($data);
				/* print_r($session->privilegio);  */
				//################### Aqui vemos lo de los permisos de los usuarios ######################
				

				return redirect()->to(base_url('/app'));
				
				 
			}else {
				$data = array(
					'id' =>  $datoUsuario[0]['idUsuario'],									
					'email' =>  $datoUsuario[0]['email'],				
					'privilegio' =>  $datoUsuario[0]['rol'],
					'login' => TRUE
				);		
				$session->set($data);
			
				return redirect()->to(base_url('/actualizar_usuario')); 
			}
			
			 
		}else{			
			/* return redirect()->to(base_url().'/')->with('Usuairo no encontrado', '0'); */
			$mensaje =[
				'tipo_alert' =>'error',
				'value' =>"El usuario o contraseña no son validos!"
			];
			return redirect()->to(base_url('/login'))->with('mensaje', $mensaje);
		}
	}
//######################### Funcion para redireccionar  para activar la cuenta ###########################
	public function updateUser()
	{
		
		return view('app/pages/activarCuenta');
	}


	public function lologout()
	{
		$session = session();
		$session->destroy();
		return redirect()->to(base_url('/login'));
	}

}