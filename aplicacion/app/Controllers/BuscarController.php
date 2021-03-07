<?php namespace App\Controllers;

use App\Models\CrudBitacoraBuscqueda;


class BuscarController extends BaseController
{
	public function index()
	{
		/**
		 * El index de los cobtroladores solo nos serviran para redireccionar a una pagina en espesifico
		 */
        $mensaje = session('mensaje');
		$data = [
			'page' => 'inicio',
			'mensaje' => $mensaje,
		];
		
		view('webPage/layout',$data);
		return view('webPage/page/inicio');
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
        $resul = $model->buscarOrden($codigo);
       // dd($resul);

        if ($resul) {
            if($resul[0]->estado == "Pendiente de pago"){

                $data=[
                    'codigo_orden'=>$codigo,
                    'nombre'=>$nombres,
                    'telefono' =>$telefono,
                    'correo'=>$email, 
                    'resultado' =>'Orden pendiente de pago',  
                    'creado'=>date("Y-m-d H:i:s"),                    
                ];

                $model->insertarBitacora($data);
                
                return redirect()->to(base_url('/resultado_pendiente'));
               
                /*$ data['page'] = 'consulta_resultado';
                view('webPage/layout',$data);
                return view('webPage/page/consulta_resultado'); */
               
            }else{ 
                
                $data=[
                    'codigo_orden'=>$codigo,
                    'nombre'=>$nombres,
                    'telefono' =>$telefono,
                    'correo'=>$email, 
                    'resultado' =>'Búsqueda exitosa',  
                    'creado'=>date("Y-m-d H:i:s"),                    
                ];
                $model->insertarBitacora($data);

                $mensaje =[
                    'resultado'=> $resul,
                    'datos'=>$data
                ];
                return redirect()->to(base_url('/consultas'))->with('mensaje', $mensaje);
                  
            }            
        }else{
            $data=[
                'codigo_orden'=>$codigo,
                'nombre'=>$nombres,
                'telefono' =>$telefono,
                'correo'=>$email, 
                'resultado' =>'No se encontró la orden',  
                'creado'=>date("Y-m-d H:i:s"),                    
            ];

            $model->insertarBitacora($data);

            $mensaje =[
				'tipo_alert' =>'error',
				'value' =>"No se pudo encontrar laorden de trabajo!"
			];
			return redirect()->to(base_url('/consultas'))->with('mensaje', $mensaje);
        } 



    }

    public function buscarOrdenInicio(){
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
        $resul = $model->buscarOrden($codigo);
       // dd($resul);

        if ($resul) {
            if($resul[0]->estado == "Pendiente de pago"){

                $data=[
                    'codigo_orden'=>$codigo,
                    'nombre'=>$nombres,
                    'telefono' =>$telefono,
                    'correo'=>$email, 
                    'resultado' =>'Orden pendiente de pago',  
                    'creado'=>date("Y-m-d H:i:s"),                    
                ];

                $model->insertarBitacora($data);
                
                return redirect()->to(base_url('/resultado_pendiente'));
               
                /*$ data['page'] = 'consulta_resultado';
                view('webPage/layout',$data);
                return view('webPage/page/consulta_resultado'); */
               
            }else{ 
                
                $data=[
                    'codigo_orden'=>$codigo,
                    'nombre'=>$nombres,
                    'telefono' =>$telefono,
                    'correo'=>$email, 
                    'resultado' =>'Búsqueda exitosa',  
                    'creado'=>date("Y-m-d H:i:s"),                    
                ];
                $model->insertarBitacora($data);

                $mensaje =[
                    'resultado'=> $resul,
                    'datos'=>$data
                ];
                return redirect()->to(base_url('/'))->with('mensaje', $mensaje);
                  
            }            
        }else{
            $data=[
                'codigo_orden'=>$codigo,
                'nombre'=>$nombres,
                'telefono' =>$telefono,
                'correo'=>$email, 
                'resultado' =>'No se encontró la orden',  
                'creado'=>date("Y-m-d H:i:s"),                    
            ];

            $model->insertarBitacora($data);

            $mensaje =[
				'tipo_alert' =>'error',
				'value' =>"No se pudo encontrar laorden de trabajo!"
			];
			return redirect()->to(base_url('/'))->with('mensaje', $mensaje);
        } 



    }


}