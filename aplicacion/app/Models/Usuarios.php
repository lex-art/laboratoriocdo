<?php namespace App\Models;

  use CodeIgniter\Model;

class Usuarios extends Model{ //la clase emplea_model va a //
    /*   protected $table        ='usuario';
      protected $primarykey   ='idusuairo';
      protected $returnType   ='array'; // formato de array nsts dts
      protected $allowedFields=['nombre','apellido','password','email']; //especf las clms a trabjr            //heredar de la clase model y la //
                                                                  //clase modelo tiene todos los metodos que necesitemos//
                                                              // para hacer consultas en la bd de datos//} */
      public function obtnerUsuario($email, $pass){
          $Usuario = $this->db->table('usuario');
          $Usuario->where('activo =', TRUE);
          $Usuario->where('email =',$email);
          $Usuario->where('password =',$pass);
          return $Usuario->get()->getResultArray();   
      }
  }
