<?php 
namespace App\Controllers;

use App\Models\Reporte;

class ReportesController extends BaseController
{
	public function index($page, $datos)
	{
		/**
		 * El index de los cobtroladores solo nos serviran para redireccionar a una pagina en espesifico
		 */
		$mensaje = session('mensaje');
		$data = [
			'page' => $page,
			'mensaje' => $mensaje,
		];
		view('app/layout', $data);
		return view('app/pages/reportes', $datos);
	}

	//--------------------------------------------------------------------
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
	
	public function tipoReporte()
	{
		$tipo_reporte = $this->request->getpost("tipo_reporte");
		$fecha_inicio = $this->request->getpost("fecha_del");
		$fecha_fin = $this->request->getpost("fecha_hasta");

		$model = new Reporte();
		//Resultado de la busqueda de la orden de trabajo
		$resul = $model->buscarResultado($tipo_reporte, $fecha_inicio, $fecha_fin);
		//dd($resul);
		if ($resul) {
			//dd($resul);
			$datos['data'] = $resul;
			$mensaje = [				
				'data' =>$resul,
				'tipo_reporte' => $tipo_reporte,
				'fecha_inicio' => $fecha_inicio,
				'fecha_fin' => $fecha_fin,
			];
			return redirect()->to(base_url('/reportes'))->with('mensaje', $mensaje);


			

		} else {
			$mensaje = [
				'tipo_alert' => 'error',
				'value' => "No se pudo realizar el reporte por algun motivo!"
			];
			return redirect()->to(base_url('/reportes'))->with('mensaje', $mensaje);
		}
	}
}
