<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class cron extends CI_Controller{
    
    function __construct() {
        parent::__construct();
        
        $this->load->database();
        $this->load->model('cron_m');
        $this->load->model('goods_m');
    }
    
    function  check_competitors(){
        $this->load->library('cron/competitors_lib');
        
        $competitors_ar = $this->cron_m->get_competitors_links( 3, 48 );
        
        if( $competitors_ar != NULL )
            $this->competitors_lib->update( $competitors_ar );
        else
            echo "Нет позиций для обновления <br />\n";
    }
    
    function upd_goods_rank(){
        if( !$this->goods_m->upd_goods_rank() )
            echo 'Нет записей для обновления';
        else
            echo 'Записи обновлены';
    }
}