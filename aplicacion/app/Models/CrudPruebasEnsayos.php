<?php namespace App\Models;

  use CodeIgniter\Model;

class CrudPruebasEnsayos extends Model{ 

    protected $table        ='lista_prueba_ensayo';
    protected $primarykey   ='idprueba_ensayo';
    protected $returnType   ='array'; // formato de array nsts dts
    protected $allowedFields=[
        'idprueba_ensayo',
        'descripcion',
        'codigo',
        'costo',
        'activo',
        'creado',
        'modificado'
      
    ];

    public function actualizar($data, $id) {
			$Cliente = $this->db->table('lista_prueba_ensayo');
			$Cliente->set($data);
			$Cliente->where('idprueba_ensayo', $id);
			return $Cliente->update();
		}
   
  }
