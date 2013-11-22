<?php

class Files extends CI_Controller {

public function __construct() {
        parent::__construct();
        $this->load->helper(array('download', 'file', 'url', 'html', 'form'));
        $this->folder = 'uploads/';
        $this->load->model('consulta_model');

        }
   
public function index()
    {
        $this->load->view('upload_form', array('error' => ' ' )); 

       
    }

//************ CARGA DE ARCHIVOS  ****************   
public function do_upload() 
    {     
        $config['upload_path'] = $this->folder;
        $config['allowed_types'] = 'zip|rar|pdf|docx|txt';
        $config['remove_spaces']=TRUE;
        $config['max_size']    = '2048';

        $this->load->library('upload', $config);

    if ( ! $this->upload->do_upload())
        {
            $error = array('error' => $this->upload->display_errors());
            $this->load->view('upload_form', $error);
        }
        else
        {
            $data = array('upload_data' => $this->upload->data());
           $this->load->view('upload_success', $data);

        }

   } 

public function info(){


   
   
    $files = get_filenames($this->folder, FALSE);
   
    if($files){
         $data = array(
                    'titulo'=>'Mis Consultas',

                    'datos'=> $this->consulta_model->get_datos(),

                    'files'=>$files

            );

            
        }else{
            $data = array(
                    'titulo'=>'Mis Consultas',

                    'datos'=> $this->consulta_model->get_datos(),

                    'files'=>$NULL

            );
            
        }
   $this->load->view('consulta_view',$data);   

}
//************ DESCARGA DE ARCHIVOS ***********************

public function downloads($name){
         
       $data = file_get_contents($this->folder.$name); 
       force_download($name,$data); 
     
}
}