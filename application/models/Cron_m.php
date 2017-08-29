<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Cron_m extends CI_Model{
    
    
    function __construct() {
        parent::__construct();
    }
    
    
    function get_competitors_links( $count = 3, $hour = 48 /*2 суток*/  ){
        
        $sec    = $hour * 3600;
        $date   = date( "Y-m-d H:i:s", time() - $sec );
        
        $query = $this->db->query(" SELECT * FROM `competitors_price` 
                                    WHERE `update` < '{$date}'
                                    ORDER BY `update` 
                                    LIMIT {$count} 
                                  ");
                                    
        if( $query->num_rows() < 1 ) return FALSE;
        
        $result_ar = array();
        foreach( $query->result_array() as $row ){
            $result_ar[] = $row;
        }
        
        return $result_ar;
    }
    
    function upd_competitors_link( $data ){
        return $this->db->query("   UPDATE `competitors_price`
                                    SET
                                        `price`     = '{$data['price']}',
                                        `update`    = '{$data['date']}'
                                    WHERE
                                        `id` = '{$data['id']}'
                                    LIMIT 1        
                                ");
    }
}