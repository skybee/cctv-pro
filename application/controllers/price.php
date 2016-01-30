<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class price extends CI_Controller{
    
    function __construct() {
        parent::__construct();
        
        $this->load->database();
        $this->load->model('price_m');
    }
    
    
    function yml(){
        header("Content-type: text/xml;Charset=utf-8");
        
        $data['cats_ar']    = $this->price_m->get_categories();
        $data['goods_ar']   = $this->price_m->get_goods();
        
//        print_r($data);
        
        $this->load->view('price/yml_v', $data);
    }
    
}