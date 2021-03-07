<?php namespace App\Models;

  use CodeIgniter\Model;

class CrudEventoActividad extends Model{ 

    protected $table        ='evento';
    protected $primarykey   ='id_evento';
    protected $returnType   ='array'; // formato de array nsts dts
    protected $allowedFields=[
        'id_evento',
        'evento_actividad',
        'titulo',
        'description',        
      
    ];

    public function actualizar($data, $id) {
     
			$Cliente = $this->db->table('evento');
			$Cliente->set($data);
			$Cliente->where('id_evento', $id);
			return $Cliente->update();
		}
   
  }
