<?php namespace App\Models;

  use CodeIgniter\Model;

class Reporte extends Model{ 

  

    public function buscarResultado($tipo_reporte, $fecha_del, $fecha_hasta) {
      $db = \Config\Database::connect();

      $builder = $db->table('orden_de_trabajo');
      $builder->select(
        'orden_de_trabajo.*,
         entrega_cliente.nombre,
         entrega_cliente.telefono,
         usuario.nombre_usuario,
         usuario.apellido'
      );
      $builder->join('entrega_cliente','orden_de_trabajo.entrega_cliente_identrega_cliente = entrega_cliente.identrega_cliente');
      $builder->join('usuario','orden_de_trabajo.Usuario_idUsuario_creacion = usuario.idUsuario');
      $builder->where('orden_de_trabajo.fecha_recepcion BETWEEN  "'.$fecha_del.'" AND "'.$fecha_hasta.'"' );
      if ($tipo_reporte=='Pendientes de pago') {
        $builder->where('orden_de_trabajo.estado', 'Pendiente pago' );
      }
      if ($tipo_reporte=='Finalizados') {
        $builder->where('orden_de_trabajo.estado', 'Finalizado' );
      }
      $query = $builder->get();
      
      return $query->getResult();
		}
   
  }
