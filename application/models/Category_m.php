<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');





class Category_m extends CI_Model{
     
    private $id_tree_ar = array();
    
    function __construct() {
        parent::__construct();
        $this->id_tree_construct();
        $this->load->driver('cache');
    }
    
    function get_info( $cat_name ){
        $cat_name = $this->db->escape_str($cat_name);
        $query = $this->db->query("SELECT * FROM `category` WHERE `url_name`='$cat_name' ");
        if( $query->num_rows() < 1 ) 
            return FALSE;
        
//        $row = $query->row_array();
        return $query->row_array();
    }
     
    function get_category_list( $parent_id = 0 ){
        $query = $this->db->query(" SELECT 
                                        `id`, `name`, `url_name` 
                                    FROM 
                                        `category` 
                                    WHERE 
                                        `parent_id`='{$parent_id}'");
        
        $result_ar = array();
        foreach($query->result_array() as $row){
            $result_ar[] = $row;
        }
        
        return $result_ar;
    }
    
    function get_child_id_first_level( $pid ){
        if( isset($this->id_tree_ar[ $pid ]) )
            return $this->id_tree_ar[ $pid ];
        else
            return FALSE;
    }
    
    function get_child_id_all_level( $pid ){
        if( !isset( $this->id_tree_ar[$pid] ) )
            return FALSE;
        foreach ( $this->id_tree_ar[$pid] as $id => $parent_id ){
            $result_ar[]    = $parent_id;
            $tmp            = $this->get_child_id_all_level($parent_id);  
            if( is_array($tmp) ){
                foreach ( $tmp as $tmp_pid )
                    $result_ar[] = $tmp_pid;
            }
        }
        return $result_ar;
        
    }
    
    function get_child_cat( $parent_id ){
        $query = $this->db->query("SELECT `id`, `name`, `url_name`, `img` FROM `category` WHERE `parent_id` = '{$parent_id}' ORDER BY `sort` ");
        
        if( $query->num_rows() < 1 )
            return NULL;
        
        $result_ar = array();
        foreach( $query->result_array() as $row ){
            $result_ar[] = $row;
        }
        
        return $result_ar;
    }
    
    function get_breadcrumb( $cat_id, $cache_time = 60 ){
        $result_ar  = array();
        $cache_id   = 'breadcrumb_cat_id_'.$cat_id;
        $cache_time = $cache_time * 60;
        
        if( $result_ar = $this->cache->file->get($cache_id) )
            return  $result_ar;
        
        do{
            $query = $this->db->query("SELECT `id`, `name`, `url_name`, `parent_id`, `rnd_goods_descript_tpl_id` FROM `category` WHERE `id`='{$cat_id}' ");
            $row = $query->row_array();
            $result_ar[ $row['id'] ]    = $row;
            $cat_id         = $row['parent_id'];
            
            //select child  cat
            $query  = $this->db->query("SELECT `name`, `url_name` FROM `category` WHERE `parent_id`='{$row['id']}' ORDER BY `sort` ");
            foreach($query->result_array() as $row_ch)
                $result_ar[ $row['id'] ]['child'][] = $row_ch;
        }
        while( $row['parent_id'] != 0 );
        
        $result_ar = array_reverse($result_ar);
        
        $this->cache->file->save( $cache_id, $result_ar , $cache_time );
        
        return $result_ar;
    }
    
    function city_rewrite_txt( $data_ar, $cat_id, $city_name){
        $query = $this->db->query("SELECT * FROM `category_city`  WHERE `category_id` = '{$cat_id}' AND `url_city_name` = '{$city_name}' ");
        
        if( !$query->num_rows() ) return false;
        
        $row = $query->row_array();
        
//        print_r($data_ar);
//        print_r($row);
        
        $data_ar['h1']                  = $row['h1'];
        $data_ar['text']                = $row['text'];
        $data_ar['html_title']          = $row['html_title'];
        $data_ar['html_keywords']       = $row['html_keywords'];
        $data_ar['html_description']    = $row['html_description'];
        
        return $data_ar;
                
    }
    
    function get_brand_list($cat_id){
        $sql    = "SELECT * FROM `category_filter` WHERE `cat_id` = '{$cat_id}' ORDER BY `name` ASC ";
        $query  = $this->db->query($sql);
        $result = false;
        
        if ($query->num_rows() > 0){
            foreach ($query->result_array() as $row){
                $result[] = $row;
            }
        }
        
        return $result;
    }
    
    function get_two_level_menu($pid=0){
        $result_ar  = array();
        $cache_id   = 'two_level_menu';
        $cache_time = 600; //10 minutes
        
        if( $result_ar = $this->cache->file->get($cache_id) ){
            return  $result_ar;
        }
        
        $firstLvlAr = $this->get_category_list($pid);
        
        if(is_array($firstLvlAr)){
            foreach($firstLvlAr as $key => $valAr){
                $subMenuAr = $this->get_category_list($valAr['id']);
                if(is_array($subMenuAr) && count($subMenuAr)>=2){
                    $firstLvlAr[$key]['submenu'] = $subMenuAr;
                }
                else{
                    $firstLvlAr[$key]['submenu'] = false;
                }
            }
        
            $result_ar = $firstLvlAr;
        }
        
        $this->cache->file->save( $cache_id, $result_ar , $cache_time );
        
        return $result_ar;
    }
    
    private function id_tree_construct(){
        $query = $this->db->query("SELECT `id`, `parent_id` FROM `category`");
        
        foreach ($query->result_array() as $tmp_ar ) {
            $result_ar[$tmp_ar['parent_id']][] = $tmp_ar['id'];
        }
        $this->id_tree_ar =& $result_ar;
    }
    
    
}