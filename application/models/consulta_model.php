<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Consulta_model extends CI_Model {

    public function construct() {
        parent::__construct();
    }
    

    public function get_datos(){
        $consulta = $this->db->query('Select * from proyectotitulo');
        return $consulta->result();
    }
    
}
