<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 


class Savefile extends CI_Controller{
    
    function __construct() {
        parent::__construct();
        
        $this->load->helper('download');
    }
    
    function goods_list(){
//        print_r($_POST); exit();

        $cnt_position = count( $_POST['name'] );
        if($cnt_position<1){ exit('Форма не заполнена'); }
        
        $resultAr = array();
        $summ_all = 0;
        for($i=0; $i<$cnt_position; $i++)
        {   
            
            $resultAr[$i]['name']   = $_POST['name'][$i];
            $resultAr[$i]['units']  = $_POST['units'][$i];
            $resultAr[$i]['count']  = $_POST['count'][$i];
            $resultAr[$i]['price']  = $_POST['price'][$i];
            
            if( empty($_POST['price'][$i]) || empty($_POST['name'][$i]) || empty($_POST['count'][$i]) )
                continue;

            $cnt_unit   = trim( $_POST['count'][$i] );
            $price      = trim( str_replace(',', '.', str_replace(' ', '', $_POST['price'][$i] ) ) );
            $summ       = $price*$cnt_unit;
            $summ_all   = $summ_all + $summ;
        }
        
        $summ_all_str = number_format($summ_all, 2, '.','');
        
        
        $data = json_encode($resultAr);
        $name = 'Форма__'.date("Y.m.d__").$summ_all_str.'_грн.json';
        
        
        force_download($name, $data);
    }
}

