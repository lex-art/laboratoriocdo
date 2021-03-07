<?php namespace App\Models;

  use CodeIgniter\Model;

class PruebasEnsayosListado extends Model{ 

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

    public function actualizar($data, $idPrueba) {
			$PruebasEnsayos = $this->db->table('lista_prueba_ensayo');
			$PruebasEnsayos->set($data);
			$PruebasEnsayos->where('idprueba_ensayo', $idPrueba);
			return $PruebasEnsayos->update();
		}
   
  }
