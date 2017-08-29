<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Price_m extends CI_Model{
    
    private $lock_cat, $select_cat_id;
    
    function __construct() {
        parent::__construct();
        
        $this->lock_cat = '372, 6, 5, 227';
        $this->select_cat_id = '0';
    }
    
    function get_categories(){
        $query = $this->db->query(" SELECT `id`, `name`, `parent_id` 
                                    FROM `category` 
                                    WHERE 
                                        `id` NOT IN ({$this->lock_cat})
                                         AND 
                                        `parent_id` NOT IN ({$this->lock_cat})
                                  ");
       $result_ar = array();
       
       foreach( $query->result_array() as $row ){
           $row['name'] = htmlspecialchars( $row['name'] );
           $result_ar[] = $row;
           $this->select_cat_id .= ', '.$row['id'];
       }                       
       
       return $result_ar;
    }
    
    function get_goods(){
        $query = $this->db->query(" SELECT 
                                        goods.*, category_goods.category_id 
                                    FROM `goods`, `category_goods`
                                    WHERE
                                    goods.price > 50
                                    AND
                                    goods.id = category_goods.goods_id
                                    AND
                                    category_goods.category_id IN ({$this->select_cat_id})
                                  ");
       $result_ar = array();
       
       foreach( $query->result_array() as $row ){
           $row['short_description']    = $this->get_short_text($row['short_description'], 300);
           $row['short_description']    = htmlspecialchars( $row['short_description'] );
           $row['url_name']             = urlencode( $row['url_name'] );
           $row['main_img']             = urlencode( $row['main_img'] );
           $row['name']                 = str_ireplace('&nbsp;', ' ', $row['name']);
           $row['name']                 = htmlspecialchars( $row['name'] );
           
           
           
           $result_ar[] = $row;
       }                       
       
       return $result_ar;                                    
    }
    
    private function get_short_text( $text, $length = 150 ){
        return mb_substr( $text, 0, $length ).'...';
    }
}