<?php namespace App\Controllers;

	use App\Models\CrudPruebasEnsayos;

class PruebasEnsayosController extends BaseController
{
	public function index()
	{
		$mensaje = session('mensaje');
		$data = [
			'page' => 'ordenes_ver',
			'mensaje' => $mensaje,
		];
		view('app/layout', $data);
		return view('app/pages/pruebas_ensayos_ver', $data);
	}

//############################### FUNCION PARA CREAR UNA ORDEN DE TRABAJO ##################################
	public function crearPruebasEnsayos(){
		
		$codigo = $this->request->getpost("codigo");
		$descripcion = $this->request->getpost("descripcion");
		$costo = $this->request->getpost("costo");
		
		$data = [
			'codigo'=> $codigo,
			'descripcion'=> $descripcion,
			'costo'=> $costo,
			'activo' => 1,
			'creado' =>  date("Y-m-d H:i:s"),
			'modificado' =>  date("Y-m-d H:i:s"),
			
		];
		
		//instanciamos el modelo que vamos a para crear la orden de trabajo
		
		$PruebaEnsayoModel = $this->pruebaEnsayoModel = model('CrudPruebasEnsayos');
		if ($PruebaEnsayoModel->insert($data)) {
				
			$mensaje =[
				'tipo_alert' =>'success',
				'value' => "Prueba o ensayo creado exitosamente."
			];
			return redirect()->to(base_url('/ver_pruebas_ensayos'))->with('mensaje', $mensaje); 			
		}else{
			$mensaje =[
				'tipo_alert' =>'error',
				'value' => "No se logro registrar le prueba o ensayo"
			];	
			return redirect()->to(base_url('/ver_pruebas_ensayos'))->with('mensaje', $mensaje); 
		} 			
	}

	public function actualizarPruebasEnsayos(){
		
		$id = $this->request->getpost("idPruebaEnsayo");
		$codigo = $this->request->getpost("codigo");
		$descripcion = $this->request->getpost("descripcion");
		$costo = $this->request->getpost("costo");
		
		$data = [
			'codigo'=> $codigo,
			'descripcion'=> $descripcion,
			'costo'=> $costo,
			'activo' => 1,			
			'modificado' =>  date("Y-m-d H:i:s"),
			
		];
		$PruebaEnsayoModel = new CrudPruebasEnsayos();
		$resul = $PruebaEnsayoModel->actualizar($data,$id);
		if ($resul) {
			$mensaje =[
				'tipo_alert' =>'success',
				'value' => "Prueba o ensayo actualizado exitosamente."
			];
			return redirect()->to(base_url('/ver_pruebas_ensayos'))->with('mensaje', $mensaje); 
		}else{
			$mensaje =[
				'tipo_alert' =>'error',
				'value' => "La prueba o ensayo NO se pudo actualizar."
			];
			return redirect()->to(base_url('/ver_pruebas_ensayos'))->with('mensaje', $mensaje); 
		}
	}

}

