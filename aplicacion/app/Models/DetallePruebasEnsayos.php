<?php namespace App\Models;

  use CodeIgniter\Model;

class DetallePruebasEnsayos extends Model{ 

    protected $table        ='prueba_ensayos';
    protected $primarykey   ='idprueba_ensayos';
    protected $returnType   ='array'; // formato de array nsts dts
    protected $allowedFields=[
        'idprueba_ensayos',
        'cantidad',
        'costo_prueba',
        'sub_total',
        'lista_prueba_ensayo_idprueba_ensay',
        'activo',
        'creado',
        'modificado',
        'orden_de_trabajo_idorden_de_trabajo',
    ];

    public function actualizar($data, $idPrueba) {
			$PruebasEnsayos = $this->db->table('prueba_esnayos');
			$PruebasEnsayos->set($data);
			$PruebasEnsayos->where('idprueba_ensayos', $idPrueba);
			return $PruebasEnsayos->update();
    }

    public function getDetalleOrden($idOrden){
        $db = \Config\Database::connect();
  
        $builder = $db->table('orden_de_trabajo');
        $builder->select(
          'prueba_ensayos.idprueba_ensayos,
          prueba_ensayos.cantidad,
          prueba_ensayos.costo_prueba, 
          prueba_ensayos.sub_total,
          prueba_ensayos.lista_prueba_ensayo_idprueba_ensayo,
          lista_prueba_ensayo.idprueba_ensayo,
          lista_prueba_ensayo.codigo,
          lista_prueba_ensayo.descripcion,
          lista_prueba_ensayo.costo'
        );
        $builder->join('prueba_ensayos','orden_de_trabajo.idorden_de_trabajo = prueba_ensayos.lista_prueba_ensayo_idprueba_ensayo');
        $builder->join('lista_prueba_ensayo','prueba_ensayos.lista_prueba_ensayo_idprueba_ensayo = lista_prueba_ensayo.idprueba_ensayo');
        $builder->where('prueba_ensayos.orden_de_trabajo_idorden_de_trabajo ', $idOrden);
        $query = $builder->get();
        
        return $query->getResult();
        
      }
        
   
  }
