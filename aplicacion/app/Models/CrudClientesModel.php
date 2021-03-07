<?php namespace App\Models;

  use CodeIgniter\Model;

class CrudClientesModel extends Model{ 

    protected $table        ='entrega_cliente';
    protected $primarykey   ='identrega_cliente';
    protected $returnType   ='array'; // formato de array nsts dts
    protected $allowedFields=[
        'identrega_cliente',
        'nombre',
        'nit',
        'telefono',
        'correo',
        'empresa',
        'activo',
        'creado',
        'modificado'
    ];

    public function actualizar($data, $id) {
			$Cliente = $this->db->table('entrega_cliente');
			$Cliente->set($data);
			$Cliente->where('identrega_cliente', $id);
			return $Cliente->update();
		}
   
  }
