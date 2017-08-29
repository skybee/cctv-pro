<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 




class Info_m extends CI_Model{
    
    
    function __construct() {
        parent::__construct();
    }
    
    
    function get_page_list(){
        $query = $this->db->query(" SELECT `name`, `url_name` FROM `info_page` WHERE `position` != 'hide' ORDER BY `sort`");
        
        $result_ar = NULL;
        foreach( $query->result_array() as $row ){
            $result_ar[] = $row;
        }
        
        return $result_ar;
    }
    
    function get_info( $url_name ){
        $query = $this->db->query("SELECT * FROM `info_page` WHERE `url_name`='{$url_name}' ");
        
        if( $query->num_rows() > 0 ){
            $row = $query->result_array();
            return $row[0];
        }
        else
            return NULL;
    }
}