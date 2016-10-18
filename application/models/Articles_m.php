<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Articles_m extends CI_Model{
    
    function __construct() {
        parent::__construct();
        $this->load->driver('cache');
    }
    
    
    function get_articles_to_page( $page, $search_txt=false, $cnt_on_page = 20 ){
        $page   = (int) $page;
        $stop   = $page * $cnt_on_page;
        $start  = $stop - $cnt_on_page; 
        
        if( $search_txt )
            $where_match = " WHERE MATCH(`title`,`text`)   AGAINST('{$search_txt}') >= '0.5' ";
        else
            $where_match = '';  
        
        $query = $this->db->query(" SELECT 
                                        `id`, `url_name`, `date`, `img`, `date`, `title`, `text`
                                    FROM 
                                        `articles`
                                    {$where_match}    
                                    ORDER BY
                                        `date` DESC, `id` ASC
                                    LIMIT {$start}, {$cnt_on_page}
                                  ");
                                    
        if( $query->num_rows() < 1 ) return FALSE;
        
        foreach( $query->result_array() as $row ){
            $row['text']    = $this->get_short_txt($row['text'], 500);
            $result_ar[] = $row;
        }
        
        return $result_ar;
    }
    
    function get_pager_ar( $page = 1, $search_txt=false, $cnt_on_page = 20, $page_left_right = 5 ){
        
        if( $search_txt )
            $where_match = " WHERE MATCH(`title`,`text`)   AGAINST('{$search_txt}') >= '0.5' ";
        else
            $where_match = '';
                
        $query_str = "  SELECT 
                            COUNT(`id`) AS 'count'
                        FROM 
                            `articles`
                        {$where_match}    
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
    
    function get_info( $id ){
        $query = $this->db->query(" SELECT
                                        `id`, `url_name`, `date`, `img`, `date`, `title`, `text`, `donor_host`
                                    FROM 
                                        `articles` 
                                    WHERE 
                                        `id`='{$id}' ");
        
        if( $query->num_rows() > 0 ){
            $row = $query->result_array();
            return $row[0];
        }
        else
            return NULL;
    }
    
    function get_short_txt( $text, $length = 100 ){
        $text = strip_tags($text);
        return mb_substr($text, 0, $length).'...';
    }
    
    function get_like_article( $str, $cnt_return=10, $cnt_select=10, $str_length = 200, $this_id=0, $order = FALSE ){
        $str = strip_tags( $str );
        $str = preg_replace("#&[a-z]{2};#i", ' ', $str);
        
        $cache_name = 'like_articles_'.sha1( $str.$cnt_return.$cnt_select.$str_length.$this_id.$order );
        $cache_time = 3600*24*30;
//        if( $result_ar = $this->cache->file->get($cache_name) )
//            return  $result_ar;
        
        if( $order )
            $order = ' ORDER BY `date` ASC ';
        
        $query = $this->db->query(" SELECT
                                        `id`, `url_name`, `date`, `img`, `date`, `title`, `text`
                                    FROM 
                                        `articles`
                                    WHERE 
                                        MATCH(`title`,`text`)   AGAINST('{$str}')
                                        AND
                                        `id` != {$this_id}
                                    {$order}        
                                    LIMIT {$cnt_select}        
                                  ");
        $cnt_resul = $query->num_rows();
        
        if( $cnt_resul < 1 ) return FALSE;
        
        foreach( $query->result_array() as $row ){
            $row['text']    = $this->get_short_txt($row['text'], $str_length);
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
            $rand_articles_ar = $this->get_rand_articles($cnt_rand_article, $str_length);
            
            foreach( $rand_articles_ar as $article_ar ){
                $result_ar[] = $article_ar;
            }
        }
        
//        $this->cache->file->save( $cache_name, $result_ar , $cache_time );
        
        return $result_ar;
    }
    
    function get_rand_articles( $cnt_articles, $str_length = 200 ){
        $query = $this->db->query(" SELECT `id`, `url_name`, `date`, `img`, `date`, `title`, `text`
                                    FROM `articles`
                                    ORDER BY RAND()
                                    LIMIT {$cnt_articles}        
                                  ");
        $cnt_resul = $query->num_rows();
        
        if( $cnt_resul < 1 ) return FALSE;
        
        foreach( $query->result_array() as $row ){
            $row['text']    = $this->get_short_txt($row['text'], $str_length);
            $result_ar[] = $row;
        }
        
        return $result_ar;
    }
    
    function get_str_from_breadcrumb( $breadcrumb_list ){
        $str = '';
        foreach( $breadcrumb_list as $bcrumb_ar ){
            $str .= ' '.$bcrumb_ar['name'];
        }
        return $str;
    }
    
    function get_tags(){
        $query = $this->db->query("SELECT * FROM `tags` WHERE `page`='articles' ORDER BY `sort`");
        
        $result_ar = array();
        foreach( $query->result_array() as $row ){
            $result_ar[ $row['url_name'] ] = $row;
        }
        
        return $result_ar;
    }
}


