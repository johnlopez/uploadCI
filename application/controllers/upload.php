<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Upload extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('upload_model');
    }

    function index() {
        //CARGAMOS LA VISTA DEL FORMULARIO
        $this->load->view('upload_view');
    }

    //FUNCIÓN PARA SUBIR LA IMAGEN Y VALIDAR EL TÍTULO
    function do_upload() {
        /*
        validacion titulo

        $this->form_validation->set_rules('titulo', 'titulo', 'required|min_length[5]|max_length[10]|trim|xss_clean');
        */
        $this->form_validation->set_rules('titulo','titulo','trim|required|xss_clean|max_lenght[50]|min_length[2]');
        
        $this->form_validation->set_rules('autor','autor','trim|required|xss_clean|max_lenght[50]|min_length[2]');
        /*
        validacion para un Email
        
        $this->form_validation->set_rules('titulo','titulo','trim|valid_email|required|xss_clean');*/

        $this->form_validation->set_rules('descripcion','descripcion','trim|required|xss_clean|max_lenght[250]|min_length[2]');
        $this->form_validation->set_rules('resumen','resumen','trim|required|xss_clean');

        //validamos que se introduzcan los campos requeridos con la función de ci required
        $this->form_validation->set_message('required', 'Campo %s es obligatorio');
        //validamos el email con la función de ci valid_email
        $this->form_validation->set_message('valid_email', 'El %s no es v&aacute;lido');
        //comprobamos que se cumpla el mínimo de caracteres introducidos
        $this->form_validation->set_message('min_length', 'Campo %s debe tener al menos %s car&aacute;cteres');
        //comprobamos que se cumpla el máximo de caracteres introducidos
        $this->form_validation->set_message('max_length', 'Campo %s debe tener menos %s car&aacute;cteres');


        /*

        $this->form_validation->set_message('required', 'El %s no puede ir vacío!');
        $this->form_validation->set_message('min_length', 'El %s debe tener al menos %s carácteres');
        $this->form_validation->set_message('max_length', 'El %s no puede tener más de %s carácteres');
        */

        //SI EL FORMULARIO PASA LA VALIDACIÓN HACEMOS TODO LO QUE SIGUE
        if ($this->form_validation->run() == TRUE) 
        {
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '2000';
        $config['max_width'] = '2024';
        $config['max_height'] = '2008';

        $this->load->library('upload', $config);
        //SI LA IMAGEN FALLA AL SUBIR MOSTRAMOS EL ERROR EN LA VISTA UPLOAD_VIEW
        if (!$this->upload->do_upload()) {
            $error = array('error' => $this->upload->display_errors());
            $this->load->view('upload_view', $error);
        } else {
        //EN OTRO CASO SUBIMOS LA IMAGEN, CREAMOS LA MINIATURA Y HACEMOS 
        //ENVÍAMOS LOS DATOS AL MODELO PARA HACER LA INSERCIÓN
            $file_info = $this->upload->data();
            //USAMOS LA FUNCIÓN create_thumbnail Y LE PASAMOS EL NOMBRE DE LA IMAGEN,
            //ASÍ YA TENEMOS LA IMAGEN REDIMENSIONADA
            $this->_create_thumbnail($file_info['file_name']);
            $data = array('upload_data' => $this->upload->data());
            

            $titulo = $this->input->post('titulo');
            $autor = $this->input->post('autor');    
            $descripcion = $this->input->post('descripcion');                            
            $resumen = $this->input->post('resumen');
            $archivo = $this->input->post('archivo');
            //conseguimos la hora de nuestro país, en mi caso españa
            date_default_timezone_set("Chile/Continental");
            $fecha = date('Y-m-d');
            $hora= date("H:i:s");

            $imagen = $file_info['file_name'];
            

            $subir = $this->upload_model->subir($titulo,$imagen,$autor,$descripcion,$resumen,$fecha,$hora);      
            


            $data['titulo'] = $titulo;
            $data['imagen'] = $imagen;
            $this->load->view('imagen_subida_view', $data);
        }
        }else{
        //SI EL FORMULARIO NO SE VÁLIDA LO MOSTRAMOS DE NUEVO CON LOS ERRORES
            $this->index();
        }
    }
    //FUNCIÓN PARA CREAR LA MINIATURA A LA MEDIDA QUE LE DIGAMOS
    function _create_thumbnail($filename){
        $config['image_library'] = 'gd2';
        //CARPETA EN LA QUE ESTÁ LA IMAGEN A REDIMENSIONAR
        $config['source_image'] = 'uploads/'.$filename;
        $config['create_thumb'] = TRUE;
        $config['maintain_ratio'] = TRUE;
        //CARPETA EN LA QUE GUARDAMOS LA MINIATURA
        $config['new_image']='uploads/thumbs/';
        $config['width'] = 150;
        $config['height'] = 150;
        $this->load->library('image_lib', $config); 
        $this->image_lib->resize();
    }
}