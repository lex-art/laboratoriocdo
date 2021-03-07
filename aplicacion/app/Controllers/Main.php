<?php namespace App\Controllers;
use App\Models\CrudEventoActividad;

class Main extends BaseController
{
	public function index()
	{
		$model = new CrudEventoActividad();
		$resul = $model->find();
		$datos['evento']= $resul;
		

		$mensaje = session('mensaje');
		$data = [
			'page' => 'inicio',
			'mensaje' => $mensaje,
		];
		
		view('webPage/layout',$data);
		return view('webPage/page/inicio', $datos);
	}

//------------------------  redirección de  la pagina web --------------------------------------------
	public function pagina($page)
	{		
		/* echo($page); */
		$mensaje = session('mensaje');
		$data = [
			'page' => $page,
			'mensaje' => $mensaje,
		];
			
		view('webPage/layout',$data);
		return view('webPage/page/'.$page);
	}

	public function login()
	{		
		/* echo($page); */
	 
		return view('login/login');
	}

	
	
}
