<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Print_docs extends CI_Controller{
    
    function __construct() {
        parent::__construct();
        
        $this->load->database();
        $this->load->model('docs_m','docs');
    }
    
    
    function prnt_doc ( $doc_name ){
        if( isset($_POST['doc_number']) ){
            $this->docs->set_doc_number( $doc_name, $_POST['doc_number'] );
        }
        
        $headTplName = $_POST['headTpl']; 
        
//        $headTplName = 'invoice_info'; 
        
        $headAr['head_info'] = $this->load->view('cctv-tmp/docs/headers/'.$headTplName.'_v', array(), true); 
        
        $this->load->view('cctv-tmp/docs/print/'.$doc_name.'_view',$headAr);
    }
    
}