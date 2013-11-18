<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Upload_model extends CI_Model {

    public function construct() {
        parent::__construct();
    }
    
    //FUNCIÓN PARA INSERTAR LOS DATOS DE LA IMAGEN SUBIDA
    function subir($titulo,$imagen,$autor,$descripcion,$resumen,$fecha,$hora)
    {
        $data = array(
            
            'titulo' => $titulo,
            'autor' => $autor,
            'descripcion' => $descripcion,
            'resumen' => $resumen,
            'fecha' => $fecha,
            'hora' => $hora,
            'ruta' => $imagen
        );
        return $this->db->insert('proyectotitulo', $data);
    }
}
