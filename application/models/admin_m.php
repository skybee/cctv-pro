<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class admin_m extends CI_Model{
    
    
    function __construct() {
        parent::__construct();
    }
    
    function get_category_tree(){
        $query = $this->db->query(" SELECT 
                                        `id`, `parent_id`, `name`, `sort`, `id` AS 'cat_id',
                                        ( SELECT COUNT(goods.id) FROM `goods`, `category_goods`
                                          WHERE  
                                            goods.id = category_goods.goods_id
                                            AND
                                            category_goods.category_id = `cat_id`
                                            AND
                                            goods.price > 0
                                        ) AS 'goods_count'
                                    FROM 
                                        `category` 
                                    ORDER BY `sort` ");
        
        foreach($query->result_array() as $row){
            $cats[ $row['id'] ] = $row;
        }

        $new_cats = $this->build_tree( $cats, 0 );
        
        return $new_cats;
    }
    
    private function build_tree( &$cats, $id ){
        $new_cats = array();
        
        foreach( $cats as $cat){
            if( $id == $cat['parent_id'] ){
                $new_cats[ $cat['id'] ] = $cat; 
                $new_cats[ $cat['id'] ]['podcat']  = $this->build_tree($cats, $cat['id']);
//                unset( $cats[ $cat['id'] ] );
            }
        }
        
        return $new_cats;
    }
    
    function get_goods_list( $cat_id ){
        $query = $this->db->query(" SELECT 
                                        goods.id, goods.name, goods.price,
                                        goods.id AS 'g_id',
                                        ( SELECT COUNT(`id`) FROM `competitors_price` WHERE `goods_id` = `g_id` ) AS 'competitors_cnt'
                                    FROM 
                                        `goods`,`category_goods`
                                    WHERE
                                        goods.id = category_goods.goods_id
                                        AND
                                        category_goods.category_id = {$cat_id}
                                        
                                    ORDER BY 
                                        goods.price, goods.name 
                                  "); 
        $result = array();
        
        foreach( $query->result_array() as $row){
            $result[] = $row;
        }
        
        return $result;        
    }
    
    function get_goods_data($id){
        $query = $this->db->query("SELECT goods.* FROM `goods` WHERE `id` = {$id} ");
        
        
        if( $query->num_rows ){
            $result = $query->row_array();
            
            $query = $this->db->query(" SELECT category.id, category.name 
                                        FROM 
                                            `category`, `category_goods`
                                        WHERE
                                            category.id = category_goods.category_id
                                            AND
                                            category_goods.goods_id = {$result['id']}
                                      ");
                                            
            if( $query->num_rows ){
                foreach( $query->result_array() as $row ){
                    $result['category'][]   = $row; 
                    $result['cat_id'][]     = $row['id'];
                }
            }
            return $result;
        }    
        else
            return NULL;
    }
    
    function get_goods_hi_price(){
        $query = $this->db->query(" SELECT 
                                        goods.id, goods.name, goods.price,
                                        competitors_price.price AS 'competitors_price', 
                                        competitors_price.id AS 'competitors_id',
                                        competitors_price.url, competitors_price.update
                                    FROM 
                                        `goods`, `competitors_price`,`category_goods`
                                    WHERE
                                        goods.id = competitors_price.goods_id
                                        AND
                                        goods.price > competitors_price.price
                                        AND
                                        category_goods.goods_id = goods.id
                                    ORDER BY
                                        category_goods.category_id, goods.price
                                  ");
        
        if( !$query->num_rows() ) return NULL;
        
        $result_ar = array();
        foreach( $query->result_array() as $row ){
            $result_ar[ $row['id'] ]['price']   = $row['price'];
            $result_ar[ $row['id'] ]['id']      = $row['id'];
            $result_ar[ $row['id'] ]['name']    = $row['name'];
            
            $result_ar[ $row['id'] ]['competitors'][ $row['competitors_id'] ]['id']     = $row['competitors_id'];
            $result_ar[ $row['id'] ]['competitors'][ $row['competitors_id'] ]['price']  = $row['competitors_price'];
            $result_ar[ $row['id'] ]['competitors'][ $row['competitors_id'] ]['url']    = $row['url'];
            $result_ar[ $row['id'] ]['competitors'][ $row['competitors_id'] ]['update'] = $row['update'];
        }
        
        return $result_ar;
    }
    
    function get_category_data($id){
        $query = $this->db->query("SELECT * FROM `category` WHERE `id` = '{$id}' ");
        
        if( $query->num_rows() ){
            return $query->row_array();
        }
        else
            return NULL;
    }
    
    function upd_goods_price( $id, $price){
        if( !is_int($id) || !is_float($price) ) return FALSE;
        
        return $this->db->query("UPDATE `goods` SET `price` = {$price} WHERE `id` = {$id} LIMIT 1 ");
    }
    
    function del_goods_from_cat( array $goods_id_ar ){
        if( count($goods_id_ar) < 1 )  return FALSE;
        
        $sql_goods_id = '';
        foreach( $goods_id_ar as $goods_id ){
            $sql_goods_id .= $goods_id.', ';
        }
        $sql_goods_id .= '99999999';
        
        return $this->db->query("DELETE FROM `category_goods` WHERE `goods_id` IN ({$sql_goods_id}) ");
            
    }
    
    function add_goods_to_cat( $goods_id, $cat_id){
        $goods_id   = (int) $goods_id;
        $cat_id     = (int) $cat_id;
        return $this->db->query("INSERT INTO `category_goods` SET `goods_id` = {$goods_id}, `category_id` = {$cat_id} ");
    }
    
    function upd_goods_info( $id, $data_ar ){
        $id = (int) $id;
        
        return $this->db->query("   UPDATE `goods`
                                    SET
                                        `name`              = '{$data_ar['name']}',
                                        `price`             = '{$data_ar['price']}',
                                        `short_description` = '{$data_ar['short_description']}',
                                        `description`       = '{$data_ar['description']}',
                                        `html_keywords`     = '{$data_ar['html_keywords']}',
                                        `html_description`  = '{$data_ar['html_description']}',    
                                        `main_img`          = '{$data_ar['main_img']}'
                                    WHERE
                                        `id` = {$id}
                                    LIMIT 1        
                                ");
    }
    
    function add_goods( $data_ar ){
        if( $this->db->query("  INSERT INTO `goods`
                                SET
                                    `name`              = '{$data_ar['name']}',
                                    `url_name`          = '{$data_ar['url_name']}',    
                                    `price`             = '{$data_ar['price']}',
                                    `short_description` = '{$data_ar['short_description']}',
                                    `description`       = '{$data_ar['description']}',
                                    `html_keywords`     = '{$data_ar['html_keywords']}',
                                    `html_description`  = '{$data_ar['html_description']}',    
                                    `main_img`          = '{$data_ar['main_img']}'
                            ") ){
            return $this->db->insert_id();                                
        }
        else
            return FALSE;
    }
    
    function get_new_goods_html_info( $goods_name, $cat_id){
        $cat_id = (int) $cat_id;
        $query = $this->db->query(" SELECT `goods_keywords_tpl`, `goods_description_tpl` 
                                    FROM `category` 
                                    WHERE `id`={$cat_id} ");
                                    
        $row = $query->row_array();                            
        
        $search = '#name#';
        
        $result_ar['html_keywords']     = str_replace($search, $goods_name, $row['goods_keywords_tpl']);
        $result_ar['html_description']  = str_replace($search, $goods_name, $row['goods_description_tpl']);
        
        return $result_ar;
    }
    
    function upd_cat_sort( $id, $val){
        return $this->db->query("UPDATE `category` SET `sort`='{$val}' WHERE `id`='{$id}' LIMIT 1");
    }
    
    function upd_category( $id, $data ){
        return $this->db->query("   UPDATE `category` 
                                    SET
                                        `parent_id`             = '{$data['parent_cat']}',
                                        `sort`                  = '{$data['sort']}',
                                        `url_name`              = '{$data['url_name']}',
                                        `name`                  = '{$data['name']}',
                                        `h1`                    = '{$data['h1']}',
                                        `text`                  = '{$data['text']}',
                                        `img`                   = '{$data['img']}',
                                        `html_title`            = '{$data['html_title']}',
                                        `html_keywords`         = '{$data['html_keywords']}',    
                                        `html_description`      = '{$data['html_description']}',
                                        `goods_keywords_tpl`    = '{$data['goods_keywords_tpl']}',
                                        `goods_description_tpl` = '{$data['goods_description_tpl']}'
                                     WHERE
                                        `id` = '{$id}'
                                     LIMIT 1       
                                ");
    }
    
    function add_category( $data ){
        return $this->db->query("   INSERT INTO `category` 
                                    SET
                                        `parent_id`             = '{$data['parent_cat']}',
                                        `sort`                  = '{$data['sort']}',
                                        `url_name`              = '{$data['url_name']}',
                                        `name`                  = '{$data['name']}',
                                        `h1`                    = '{$data['h1']}',
                                        `text`                  = '{$data['text']}',
                                        `img`                   = '{$data['img']}',
                                        `html_title`            = '{$data['html_title']}',
                                        `html_keywords`         = '{$data['html_keywords']}',    
                                        `html_description`      = '{$data['html_description']}',
                                        `goods_keywords_tpl`    = '{$data['goods_keywords_tpl']}',
                                        `goods_description_tpl` = '{$data['goods_description_tpl']}'       
                                ");
    }
    
    function cat_urlname_isset( $url_name ){
        $query = $this->db->query("SELECT COUNT(*) AS 'count' FROM `category` WHERE `url_name` = '{$url_name}'  ");
        
        $row = $query->row_array();
        
        if( $row['count'] > 0 )
            return TRUE;
        else
            return FALSE;
    }
    
    function add_competitors_link( $goods_id, $url_ar ){
        $msg = '';
        if( count($url_ar) < 1 ) return FALSE;
        
        foreach( $url_ar as $url ){
            $url = trim($url);
            
            if( empty($url) ) continue;
            
            if( !$this->valid_url($url) ){
                $msg .= '!Ошибка в URL конкурента: <br /> '.$url.'<br />'; 
                continue;
            }
            
            $this->db->query("  INSERT INTO `competitors_price` 
                                SET 
                                    `goods_id` = '{$goods_id}', `url` = '{$url}'
                             ");
        }
        
        return $msg;
    }
    
    function get_competitors_link_from_goods( $goods_id ){
        $query = $this->db->query("SELECT * FROM `competitors_price` WHERE `goods_id` = {$goods_id} ");
        
        if( !$query->num_rows() ) return NULL;
        
        $result_ar = array();
        foreach( $query->result_array() as $row ){
            $result_ar[] = $row;
        }
        
        return $result_ar;
    }
    
    function del_competitors( $id ){
        return $this->db->query("DELETE FROM `competitors_price` WHERE `id` = '{$id}' LIMIT 1");
    }
    
    private function valid_url( $url ){
        $pattern = "#^http://[a-z\d-\.]{2,30}\.(com|ua|ru|su|net|org|biz|info)/\S+$#i";
        
        if( preg_match($pattern, $url) )
            return TRUE;
        else
            return FALSE;
    }
    
}    