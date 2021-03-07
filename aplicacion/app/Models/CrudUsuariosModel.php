<?php namespace App\Models;

  use CodeIgniter\Model;

class CrudUsuariosModel extends Model{ 

    protected $table        ='usuario';
    protected $primarykey   ='idusuairo';
    protected $returnType   ='array'; // formato de array nsts dts
    protected $allowedFields=[
        'idUsuario',
        'nombre_usuario',
        'apellido',
        'password',
        'email',
        'password',
        'telefono',
        'dpi',
        'genero',
        'activo',
        'creado',
        'modificado',
        'url_img',
        'rol',
        'first_time'
    ];

    public function actualizar($data, $idUsuario) {
      
      
        $Usuarios = $this->db->table('usuario');
        $Usuarios->set($data);
        $Usuarios->where('idUsuario', $idUsuario);
        return $Usuarios->update();
  }
   
  }
