<?php/*
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Consulta extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('consulta_model');
        
    }

    function index() {
        //CARGAMOS LA VISTA DEL FORMULARIO
        $data = array(
                    'titulo'=>'Mis Consultas',

                    'datos'=> $this->consulta_model->get_datos()

            );

        $this->load->view('consulta_view',$data);
    }

    
}*/