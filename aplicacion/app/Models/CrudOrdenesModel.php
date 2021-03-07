<?php namespace App\Models;

  use CodeIgniter\Model;

class CrudOrdenesModel extends Model{ 

    protected $table        ='orden_de_trabajo';
    protected $primarykey   ='idorden_de_trabajo';
    protected $returnType   ='array'; // formato de array nsts dts
    protected $allowedFields=[
        'idorden_de_trabajo',
        'codigo',
        'nombre_proyecto',
        'ejecutado_por',
        'fecha_recepcion',
        'costo_total',
        'abono',
        'saldo',
        'estado',
        'observacion',
        'activo',
        'creado',
        'modificado',
        'Usuario_idUsuario_creacion',
        'entrega_cliente_identrega_cliente',
        'Usuario_idUsuario_informe',
        'informe_resultado_idinforme_resultado',
        'prueba_ensayos_idprueba_ensayos'
    ];
    
//############################### FUNCION PARA ACTUALIZAR UNA ORDEN DE TRABAJO ##################################
    /**
     * Funcion que reazliza la actualizacion del regiustro de
     * una orden de trabajo,
     * 
     * @param array     $datos  a actualizar de la orden de trabajo 
     * @param string    $idOrden es el id de la orden de trabajo de que dese actualizar
     */
    public function actualizar($data, $idOrden) {
			$Orden = $this->db->table('orden_de_trabajo');
			$Orden->set($data);
			$Orden->where('idorden_de_trabajo', $idOrden);
      return $Orden->update();
      
    }
  
//############################### FUNCION PARA CREAR UNA ORDEN DE TRABAJO (INSERTAR EN LA BD) ##################################
    public function crearOrden( $data_inicial_orden, $todo_prueba, $dataCliente,$dataOrden, $idCliente) {

      /**
       * usamos transacciones para asegurarnos de que todo el proceso de insercionse
       * u actualizaciones salga bien y no se queden insersiones a medias,
       * haciendo que no concuerden los registros y datos  
       */
      $db = \Config\Database::connect();
      
      $db->transStart();

        $Pruebas = $this->db->table('prueba_ensayos');
        $Cliente = $this->db->table('entrega_cliente');
        $Orden = $this->db->table('orden_de_trabajo');

        $Orden->insert($data_inicial_orden);
        $idOrden = $this->db->insertID();        
        
        for ($i=0; $i < count($todo_prueba); $i++) { 
          //leemos los EL array de la cantidad de pruebas u ensallos que 
          //hay que realizar para la orden de trabajo, le agregamos los datos pendientes
          $registro = $todo_prueba[$i];
          $registro['activo'] = 1;
          $registro['creado'] = date("Y-m-d H:i:s"); 
          $registro['modificado'] = date("Y-m-d H:i:s"); 
          $registro['orden_de_trabajo_idorden_de_trabajo'] = $idOrden;
          $Pruebas->insert($registro);
        }
        //verificamos si el cliente existe o no
        if($idCliente != null){       
          //Agregmos los campos pendientes al cliente para poder actualizarlo
          $dataCliente['modificado'] = date("Y-m-d H:i:s");
          $Cliente->set($dataCliente);
          $Cliente->where("identrega_cliente", $idCliente);
          $Cliente->update($dataCliente);
        }else{
          //Agregmos los campos pendientes al cliente cuando se crea un nuevo cliente
          $dataCliente['creado'] = date("Y-m-d H:i:s");
          $dataCliente['modificado'] = date("Y-m-d H:i:s");
          $Cliente->insert($dataCliente);
          //cambiomos el valor de null al nuevo id generado
          $idCliente = $this->db->insertID();
        }

        //------------------------------ generamos codigo de la orden --------------
        $numero_chars = '0123456789';
        $letra_chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $numero =  substr(str_shuffle($numero_chars), 0, 4);
        $letra =  substr(str_shuffle($letra_chars ), 0, 1);

        $codigo  = 'OT-'.$idOrden.'-'.$numero.$letra;
        $dataOrden['codigo'] = $codigo;
        $dataOrden['entrega_cliente_identrega_cliente'] = $idCliente;

        $Orden->set($dataOrden);
        $Orden->where('idorden_de_trabajo', $idOrden);
        $Orden->update();

        $query = $Orden->where('idorden_de_trabajo', $idOrden)->get()->getRow('codigo');
      $db->transComplete();

      return $query;
    }
//############################### FUNCION PARA SUBIR RESULTADOS DE UNA ORDEN DE TRABAJO ##################################
    public function subir_resultados($data,$codigo){
      $db = \Config\Database::connect();
      $db->transStart();
        $Resultado = $this->db->table('informe_resultado');
        $Orden = $this->db->table('orden_de_trabajo');

        $Resultado->insert($data);
        $idResultado = $this->db->insertID();

        $dataOrden = [];

        $saldo = $Orden->where('codigo', $codigo)->get()->getRow('saldo');

        if ( floatval($saldo) > 0.0) {
          $dataOrden = [
            'estado' => 'Pendiente de pago',
            'modificado' => date("Y-m-d H:i:s"),
            'Usuario_idUsuario_informe' =>session('id'),
            'informe_resultado_idinforme_resultado' => $idResultado
            
          ];
        } else {
          $dataOrden = [
            'estado' => 'Finalizado',
            'modificado' => date("Y-m-d H:i:s"),
            'Usuario_idUsuario_informe' =>session('id'),
            'informe_resultado_idinforme_resultado' => $idResultado
          ];
        }

        $Orden->set($dataOrden);
        $Orden->where('codigo', $codigo);
        $Resul = $Orden->update();

      $db->transComplete();

      return $Resul;
    }

    public function actualizarResultado($data, $idOrden) {
			$Orden = $this->db->table('informe_resultado');
			$Orden->set($data);
			$Orden->where('idinforme_resultado', $idOrden);
      return $Orden->update();
      
    }
    public function obtner_resultados(){
     
      $db = \Config\Database::connect();

      $builder = $db->table('orden_de_trabajo');

      $builder->select('*');
      $builder->join(
        'informe_resultado',
        'orden_de_trabajo.informe_resultado_idinforme_resultado = informe_resultado.idinforme_resultado '
      );
      $builder->where('orden_de_trabajo.activo = 1');
      $query = $builder->get();
      
      return $query->getResult();

    }

    public function getOden($codigo){
      $db = \Config\Database::connect();

      $builder = $db->table('orden_de_trabajo');
      $builder->select('*');
      $builder->join('entrega_cliente','orden_de_trabajo.entrega_cliente_identrega_cliente = entrega_cliente.identrega_cliente ');
      $builder->where('orden_de_trabajo.codigo', $codigo);
      $query = $builder->get();
      
      return $query->getResult();
      
    }
    public function getInforme($codigo){
      $db = \Config\Database::connect();

      $builder = $db->table('orden_de_trabajo');
      $builder->select('informe_resultado.*');
      $builder->join('informe_resultado','orden_de_trabajo.informe_resultado_idinforme_resultado = informe_resultado.idinforme_resultado');
      $builder->where('orden_de_trabajo.codigo', $codigo);
      $query = $builder->get();
      
      return $query->getResult();
    }
  //##################################### ACTUALIZAR UNA ORDEN DE TRABAJO  ##########################################
  public function updateOrden($id_orden, $dataOrden, $idCliente, $dataCliente)
  {
    $db = \Config\Database::connect();
      
    $db->transStart();
      $Orden = $this->db->table('orden_de_trabajo');
      $Cliente = $this->db->table('entrega_cliente');

      $Cliente->set($dataCliente);
      $Cliente->where("identrega_cliente", $idCliente);
      $Cliente->update($dataCliente);

			$Orden->set($dataOrden);
			$Orden->where('idorden_de_trabajo', $id_orden);
    $db->transComplete();
      

      return $Orden->update();
  }

  //##################################### para el dashboard  ##########################################
  public function totalOrdenes() {
    $db = \Config\Database::connect();

    $builder = $db->table('orden_de_trabajo');
    $builder->selectSum('costo_total');
    $builder->where('activo', 1);
    $builder->where('fecha_recepcion BETWEEN  "'.date("Y-m").'-1'.'" AND "'. date("Y-m-d").'"' );

   
    $query = $builder->get();
      
    return $query->getResult();
  }

  public function totalPendientes() {
    $db = \Config\Database::connect();

    $builder = $db->table('orden_de_trabajo');
    $builder->selectSum('saldo');
    $builder->where('activo', 1);
    $builder->where('fecha_recepcion BETWEEN  "'.date("Y-m").'-1'.'" AND "'. date("Y-m-d").'"' );
    $query = $builder->get();
      
    return $query->getResult();
  }
  public function totalAbono() {
    $db = \Config\Database::connect();

    $builder = $db->table('orden_de_trabajo');
    $builder->selectSum('abono');
    $builder->where('activo', 1);
    $builder->where('fecha_recepcion BETWEEN  "'.date("Y-m").'-1'.'" AND "'. date("Y-m-d").'"' );
    $query = $builder->get();
      
    return $query->getResult();
  }
  public function countOrdenes() {
    $db = \Config\Database::connect();

    $builder = $db->table('orden_de_trabajo');
    $builder->selectCount('idorden_de_trabajo');
    $builder->where('activo', 1);
    $builder->where('fecha_recepcion BETWEEN  "'.date("Y-m").'-1'.'" AND "'. date("Y-m-d").'"' );
    $query = $builder->get();
      
    return $query->getResult();
  }


//##################################### para el dasshboard anual ##########################################


  public function totalOrdenesAnual() {
    $db = \Config\Database::connect();

    $builder = $db->table('orden_de_trabajo');
    $builder->selectSum('costo_total');
    $builder->where('activo', 1);
    $builder->where('fecha_recepcion BETWEEN  "'.date("Y").'-01-1'.'" AND "'. date("Y-m-d").'"' );

   
    $query = $builder->get();
      
    return $query->getResult();
  }

  public function totalPendientesAnual() {
    $db = \Config\Database::connect();

    $builder = $db->table('orden_de_trabajo');
    $builder->selectSum('saldo');
    $builder->where('activo', 1);
    $builder->where('fecha_recepcion BETWEEN  "'.date("Y").'-01-1'.'" AND "'. date("Y-m-d").'"' );

  
    $query = $builder->get();
      
    return $query->getResult();
  }
  public function totalAbonoAnual() {
    $db = \Config\Database::connect();

    $builder = $db->table('orden_de_trabajo');
    $builder->selectSum('abono');
    $builder->where('activo', 1);
    $builder->where('fecha_recepcion BETWEEN  "'.date("Y").'-01-1'.'" AND "'. date("Y-m-d").'"' );
    $query = $builder->get();
      
    return $query->getResult();
  }
  public function countOrdenesAnual() {
    $db = \Config\Database::connect();

    $builder = $db->table('orden_de_trabajo');
    $builder->selectCount('idorden_de_trabajo');
    $builder->where('activo', 1);
    $builder->where('fecha_recepcion BETWEEN  "'.date("Y").'-01-1'.'" AND "'. date("Y-m-d").'"' );
    $query = $builder->get();
      
    return $query->getResult();
  }
    
}