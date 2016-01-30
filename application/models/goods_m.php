<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class goods_m extends CI_Model{

    function __construct(){
        parent::__construct();
    }
    
    function get_goods_from_cat($cat_id_ar, $page = 1, $cnt_on_page = 15, $sort = 'rank' ){
        $stop   = $page * $cnt_on_page;
        $start  = $stop - $cnt_on_page;
        
        $cnt_cat_id = count($cat_id_ar);
        $where_id = '';
        for($i=0; $i<$cnt_cat_id; $i++){
            if($i)
                $where_id .= ', ';
            $where_id .= $cat_id_ar[$i];
        }
        
        switch ($sort) {
            case 'price':
                $goods_sort = 'goods.price ASC';
                break;
            case 'name':
                $goods_sort = 'goods.name ASC';
                break;
            case 'rank':
                $goods_sort = 'goods.rank DESC, goods.price ASC';
                break;
            default:
                $goods_sort = 'goods.rank DESC';
                break;
        }
        
        
//        $query_str = "  SELECT 
//                            goods.id, goods.name, goods.short_description, goods.main_img, goods.url_name, goods.price, category.name AS 'cat_name'
//                        FROM 
//                            `goods`, `category`, `category_goods`
//                        WHERE
//                            goods.price > 0
//                            AND
//                            category_goods.goods_id     = goods.id
//                            AND
//                            category_goods.category_id  = category.id
//                            AND
//                            category.id IN ( {$where_id} )
//                        ORDER BY category.sort, category.parent_id, goods.price
//                        LIMIT {$start}, {$cnt_on_page}
//                    ";
        
        $query_str = "  SELECT 
                            goods.id, goods.name, goods.short_description, goods.main_img, goods.url_name, goods.price, category.name AS 'cat_name'
                        FROM 
                            `goods`, `category`, `category_goods`
                        WHERE
                            goods.price > 0
                            AND
                            category_goods.goods_id     = goods.id
                            AND
                            category_goods.category_id  = category.id
                            AND
                            category.id IN ( {$where_id} )
                        ORDER BY {$goods_sort}
                        LIMIT {$start}, {$cnt_on_page}
                    ";
        
        $query = $this->db->query( $query_str );
        
        if( $query->num_rows() < 1 ) return NULL;
        
        foreach( $query->result_array() as $row){
            $result_ar[] = $row;
        }
        
        return $result_ar;
    }
    
    function get_pager_ar( $cat_id_ar, $page = 1, $cnt_on_page = 15, $page_left_right = 3 ){
        $cnt_cat_id = count($cat_id_ar);
        $where_id = '';
        for($i=0; $i<$cnt_cat_id; $i++){
            if($i)
                $where_id .= ', ';
            $where_id .= $cat_id_ar[$i];
        }
        
        $query_str = "  SELECT 
                            COUNT(goods.id) AS 'count'
                        FROM 
                            `goods`, `category`, `category_goods`
                        WHERE
                            goods.price > 0
                            AND
                            category_goods.goods_id     = goods.id
                            AND
                            category_goods.category_id  = category.id
                            AND
                            category.id IN ( {$where_id} )
                    ";
         $query = $this->db->query($query_str);
         $row   = $query->row();
         $count_goods = $row->count;
         
         $start     = $page - $page_left_right; if( $start < 1 ) $start = 1;
         $cnt_page  = ceil( $count_goods / $cnt_on_page );
         $stop      = $page + $page_left_right; if( $stop > $cnt_page ) $stop = $cnt_page;
         
         $result_ar = array();
         
         if( $page > $page_left_right+1 ){ //дополнение массива первой страницей
             $result_ar[] = 1;
             if( $page != $page_left_right+2 )
                $result_ar[] = '...';
         }    
         
         
         for($i = $start; $i<=$stop; $i++ ){
             $result_ar[] = $i;
         }
         
         if($cnt_page > $stop+1 ){ //дополняет масив последней страницей
             $result_ar[] = '...';
             $result_ar[] = $cnt_page;
         }    
         
         return $result_ar;
    }
    
    function get_goods_info( $id, $url_name){
        $query = $this->db->query(" SELECT goods.*, category_goods.category_id AS 'cat_id' 
                                    FROM `goods`, `category_goods` 
                                    WHERE 
                                        goods.id='{$id}'  
                                        AND
                                        category_goods.goods_id = '{$id}'
                                    ");
        
        if( $query->num_rows() < 1 ) return FALSE;
        
        $row = $query->result_array();
        return $row[0];
    }
    
    function get_goods_by_id( $id_ar ){
        if( count($id_ar) < 1) return NULL;
        
        $sql_id_list = '';
        $i=0;
        foreach( $id_ar as $id){
            if($i) $sql_id_list .= ', ';
            $sql_id_list .=  $id;
            $i++;
        }
        
        $query = $this->db->query(" SELECT
                                        goods.id, goods.name, goods.short_description, goods.main_img, goods.url_name, goods.price, 
                                        category_goods.category_id AS 'cat_id'
                                    FROM 
                                        `goods`, `category_goods`
                                    WHERE
                                        goods.id IN ({$sql_id_list})
                                        AND 
                                        goods.id = category_goods.goods_id
                                    ORDER BY `cat_id`, goods.price   
                                  ");                                        
        $result_ar = NULL;
        foreach( $query->result_array() as $row )
            $result_ar[ $row['id'] ] = $row;
        
        return $result_ar;        
    }
    
    function get_like_goods( $id, $price, $cat_id  ){
        
        $result_ar = NULL;
        
        $query = $this->db->query(" SELECT goods.id, goods.name, goods.short_description, goods.main_img, goods.url_name, goods.price
                                    FROM `goods`, `category_goods` 
                                    WHERE goods.id != '{$id}' AND `price` <= '$price' AND `price` > '0' AND category_goods.goods_id = goods.id AND category_goods.category_id = '{$cat_id}'
                                    ORDER BY `price` DESC    
                                    LIMIT 2
                                  ");
        
        foreach( $query->result_array() as $row )
            $result_ar[] = $row;
        
        if( $result_ar != NULL )
            $result_ar = array_reverse($result_ar);
        
        
        $query2 = $this->db->query(" SELECT goods.id, goods.name, goods.short_description, goods.main_img, goods.url_name, goods.price
                                    FROM `goods`, `category_goods` 
                                    WHERE goods.id != '{$id}' AND `price` >= '$price' AND `price` > '0' AND category_goods.goods_id = goods.id AND category_goods.category_id = '{$cat_id}'
                                    ORDER BY `price` ASC    
                                    LIMIT 4
                                  ");
        
        foreach( $query2->result_array() as $row )
            $result_ar[] = $row;
        
        
        return $result_ar;
    }
    
    function get_last_order_id(){
        $query = $this->db->query("SELECT MAX(`id`) AS id FROM `order`");
        $row = $query->row();
        return $row->id;
    }
    
    function save_order( $html ){
        $html = mysql_real_escape_string($html);
        $this->db->query("INSERT INTO `order` SET `html`='{$html}' ");
    }
    
    function get_like_str_goods( $str, $cnt_return=10, $cnt_select=10 ){
        $str = strip_tags( $str );
        $str = preg_replace("#&[a-z]{2};#i", ' ', $str);
        $str = mysql_real_escape_string( $str );
        $str = mb_substr($str, 0, 120);
        
        $query = $this->db->query(" SELECT
                                        `id`, `name`, `url_name`, `main_img`, `price`
                                    FROM 
                                        `goods`
                                    WHERE 
                                        MATCH(`name`,`short_description`)   AGAINST('{$str}')
                                        AND
                                        `price` > 200
                                        AND
                                        `id` IN (   SELECT * FROM 
                                                    (   SELECT `goods_id` FROM `goods_top` 
                                                        GROUP BY  `goods_id` 
                                                        HAVING SUM(`rank`) >= COUNT(`id`)*1.1
                                                        ORDER BY SUM(`rank`) DESC
                                                        LIMIT 300
                                                    ) AS `tmp_tbl`
                                                )
                                    LIMIT {$cnt_select}        
                                  ");
        $cnt_resul = $query->num_rows();
        
//        if( $cnt_resul < 1 ) return FALSE;
        
        foreach( $query->result_array() as $row ){
            $result_ar[] = $row;
        }
        
        if( $cnt_resul > $cnt_return ){ //рендом новостей если количество выбранных новостей больше чем колличество для вывода
            srand( date("n")+abs(crc32($_SERVER['REQUEST_URI'])) );
            shuffle($result_ar);
            srand();
            
            $tmp_result_ar = $result_ar;
            unset($result_ar);
            
            for($i=0; $i<$cnt_return; $i++)
                $result_ar[] = $tmp_result_ar[$i];
        }
        elseif( $cnt_resul < $cnt_return){ //дополнение случайными статьями, если не хватает схожих статей
            $cnt_rand_article = $cnt_return - $cnt_resul; //необходимое количество случайных статей
            $rand_articles_ar = $this->get_rand_goods($cnt_rand_article);
            
            foreach( $rand_articles_ar as $article_ar ){
                $result_ar[] = $article_ar;
            }
        }
        return $result_ar;
    }
    
    function get_rand_goods( $cnt_articles ){
        $query = $this->db->query(" SELECT `id`, `name`, `url_name`, `main_img`, `price`
                                        FROM `goods`
                                        WHERE 
                                            `price` > 200
                                            AND
                                            `id` IN (   SELECT * FROM 
                                                        (   SELECT `goods_id` FROM `goods_top` 
                                                            GROUP BY  `goods_id` 
                                                            HAVING SUM(`rank`) >= COUNT(`id`)*1.1
                                                            ORDER BY SUM(`rank`) DESC
                                                            LIMIT 300
                                                        ) AS `tmp_tbl`
                                                    )
                                        ORDER BY RAND()
                                        LIMIT {$cnt_articles}        
                                      ");
        $cnt_resul = $query->num_rows();

        if( $cnt_resul < 1 ) return FALSE;

        foreach( $query->result_array() as $row ){
            $result_ar[] = $row;
        }

        return $result_ar;
    }
    
    function upd_goods_rank(){
        $query = $this->db->query("SELECT `id` FROM `goods` ORDER BY `rank_upd` ASC LIMIT 100");
        
        if( $query->num_rows() < 1 ) return FALSE;
        
        $id_list = '0';
        foreach( $query->result_array() as $row ){
            $id_list .= ', '.$row['id'];
        }
        
        $date_now = date("Y-m-d H:i:s");
        
        $this->db->query("  UPDATE `goods` 
                            SET 
                                `rank`      = (SELECT SUM(`rank`) FROM `goods_top` WHERE goods_top.goods_id = goods.id),
                                `rank_upd`  = '{$date_now}'
                            WHERE
                                `id` IN ({$id_list})
                         ");
                                
        return TRUE;                        
    }
    
    function set_goods_rank($id, $ip, $rank){
        //проверка наличие записи с таким IP и ID в базе
        $query = $this->db->query(" SELECT COUNT(*) AS 'cnt' FROM `goods_top` WHERE `goods_id` = '{$id}' AND `ip` = '{$ip}' "); 
        $row = $query->row_array();
        
        
        if( $row['cnt'] < 1 ){ //запись новой записи в базу
            $this->db->query("INSERT INTO `goods_top` SET `goods_id` = '{$id}', `ip` = '{$ip}', `rank` = {$rank} ");
            
            if( rand(1, 1000) <= 50 ){ //удаление старых записей
                $control_date   = date("Y-m-d H:i:s", strtotime("- 50 day", time() ) ); //дата удаления записи
                
                $this->db->query("DELETE FROM `goods_top` WHERE `date` < '{$control_date}' ");
            }
        }
    }
    
    function set_order_goods_rank( array $goods_id ){
        if( $goods_id == NULL ) return FALSE;
        
        $rank = 15;
        
        foreach( $goods_id as $id ){
            $this->db->query("INSERT INTO `goods_top` SET `goods_id` = '{$id}', `ip` = '127.0.0.1', `rank` = {$rank} ");
        }
    }
}

