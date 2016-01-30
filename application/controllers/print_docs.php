<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class print_docs extends CI_Controller{
    
    function __construct() {
        parent::__construct();
        
        $this->load->database();
        $this->load->model('docs_m','docs');
    }
    
    
    function prnt_doc ( $doc_name ){
        if( isset($_POST['doc_number']) )
            $this->docs->set_doc_number( $doc_name, $_POST['doc_number'] );
        $this->load->view('docs/print/'.$doc_name.'_view');
    }
    
}