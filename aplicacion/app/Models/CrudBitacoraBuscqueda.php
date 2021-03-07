<?php namespace App\Models;

  use CodeIgniter\Model;

class CrudBitacoraBuscqueda extends Model{ 

    protected $table        ='bitacora_busqueda';
    protected $primarykey   ='idbitacora_busqueda';
    protected $returnType   ='array'; // formato de array nsts dts
    protected $allowedFields=[
        'idbitacora_busqueda',
        'codigo_orden',
        'nombre',
        'telefono',
        'correo',
        'resultado',
        'creado',
       
    ];

    public function actualizar($data, $id) {
			$bitacora = $this->db->table('bitacora_busqueda');
			$bitacora->set($data);
			$bitacora->where('idbitacora_busqueda', $id);
			return $bitacora->update();
        }
        
    public function buscarOrden($codigo) {
        $db = \Config\Database::connect();  
            
            $builder = $db->table('orden_de_trabajo');

            $builder->select('
                orden_de_trabajo.codigo,
                orden_de_trabajo.nombre_proyecto,
                orden_de_trabajo.estado,
                orden_de_trabajo.ejecutado_por,
                informe_resultado.*            
            ');
            $builder->join(
              'informe_resultado',
              'orden_de_trabajo.informe_resultado_idinforme_resultado = informe_resultado.idinforme_resultado'
            );
            $builder->where('orden_de_trabajo.activo', 1);
            $builder->where('orden_de_trabajo.codigo',$codigo);
            $query = $builder->get();

            
            
            return $query->getResult();

        
    }

    public function insertarBitacora($data) {
      $bitacora = $this->db->table('bitacora_busqueda');
      $bitacora->insert($data);

    }
   
  }