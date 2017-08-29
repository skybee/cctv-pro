<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Page_m extends CI_Controller{
    
    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->helper('donor/page');
        $this->load->helper('donor/articles');
    }
    
    
    function get_articles_for_domain( $cnt=3, $host ){
        $host   = urldecode($host); 
        $query  = $this->db->query(" SELECT * FROM `articles` WHERE `them`='security' ORDER BY RAND(".abs(crc32($host)).") LIMIT {$cnt}  ");
        
        $result_ar = array();
        foreach($query->result_array() as $row ){
            $result_ar[ $row['id'] ] = $row;
        }
        
        echo json_encode( $result_ar );
    }
    
    function get_page_data( $url_name ){
        $url_name   = urldecode( $url_name );
        
        preg_match("#_(\d+)$#i", $url_name, $article_id);
        $article_id = (int) $article_id[1];
        
        $query = $this->db->query("SELECT * FROM `articles` WHERE `id`={$article_id}");
        if( $query->num_rows() < 1 ) return FALSE;
        
        $row    = $query->row_array();
        
        $result_ar['title']     = $row['title'];
        $result_ar['text']      = $this->get_short_txt( $row['text'], 3000);
        $result_ar['url_name']  = $row['url_name'];
        
        $rearch_str = strip_tags($row['title']);
        $rearch_str = preg_replace("#&\w{2,8};#i", ' ', $rearch_str);
        
        $query = $this->db->query("SELECT `title`, `text` FROM `articles` WHERE `id`!={$article_id} AND MATCH(`title`, `text`) AGAINST('".$this->db->escape_str($rearch_str)."') LIMIT 10 ");
        
        if( $query->num_rows() > 0 ){
            foreach( $query->result_array() as $row ){
                $tmp_articles_ar[] = $row;
            }
            
            shuffle($tmp_articles_ar);
            $cnt_tmp_ar = count( $tmp_articles_ar );
            
//            print_r($tmp_articles_ar);
            
            for($i=0; $i<5 && $i<$cnt_tmp_ar; $i++ ){
                $result_ar['text'] .= "<br /><br /><h3>{$tmp_articles_ar[$i]['title']}</h3>\n";
                $result_ar['text'] .= $this->get_short_txt($tmp_articles_ar[$i]['text'], 2000);
                
                // HC Link
                if( $i==1 )
                    $result_ar['text'] .= '<br />'.$this->set_nofollow( get_city_link($article_id), $article_id, 10);
            }
        }
        
        if( $article_id%3 == 0 )
        {
            //Article Link
            $article_url = 'http://house-control.org.ua/article/'.$article_id.'/'.$result_ar['url_name'].'/';
            $result_ar['text'] .= '<br /><a href="'.$article_url.'">'.$result_ar['title'].'</a>';
        }    
        else
        {
            //Goods Text & Link
            $result_ar['text'] .= $this->get_top_goods($url_name, $article_id);
        }
        
        // Sape Link
        $result_ar['text'] .= '<br />'.get_city_link( $article_id, 'sape_a_link_donor.txt' );
        
        // CCTV_PL Link
        if( $article_id%10 == 0)
        {
            $result_ar['text'] .= '<br />'.get_cctv_pl_link( $article_id );
        }
        
        // CY Donor Link
//        $donor_ar   = $this->get_donor_domain( $article_id );
//        $donor_url  = get_donor_url($donor_ar, $article_id);
//        #$donor_url  = 'http://cy.'.$donor_ar['prefix_1'].$donor_ar['name'].'/';
//        $result_ar['text'] .= '<br /><a href="'.$donor_url.'">'.$donor_url.'</a>';
        
        echo json_encode( $result_ar );
    }
    
    function get_short_txt( $text, $length = 100 ){
//        $text = strip_tags($text);
        return $this->close_tags( mb_substr($text, 0, $length) );
    }
    
    function close_tags($content){
        $position = 0;
        $open_tags = array();
        //теги для игнорирования
        $ignored_tags = array('br', 'hr', 'img');

        while (($position = strpos($content, '<', $position)) !== FALSE)
        {
            //забираем все теги из контента
            if (preg_match("|^<(/?)([a-z\d]+)\b[^>]*>|i", substr($content, $position), $match))
            {
                $tag = strtolower($match[2]);
                //игнорируем все одиночные теги
                if (in_array($tag, $ignored_tags) == FALSE)
                {
                    //тег открыт
                    if (isset($match[1]) AND $match[1] == '')
                    {
                        if (isset($open_tags[$tag]))
                            $open_tags[$tag]++;
                        else
                            $open_tags[$tag] = 1;
                    }
                    //тег закрыт
                    if (isset($match[1]) AND $match[1] == '/')
                    {
                        if (isset($open_tags[$tag]))
                            $open_tags[$tag]--;
                    }
                }
                $position += strlen($match[0]);
            }
            else
                $position++;
        }
        //закрываем все теги
        foreach ($open_tags as $tag => $count_not_closed)
        {
            if( $count_not_closed < 0 ) $count_not_closed = 0;
            $content .= str_repeat("</{$tag}>", $count_not_closed);
        }

        return $content;
    }  
    
    function get_donor_domain( $article_id ){
        $query = $this->db->query(" SELECT `name`, `prefix_1` 
                                    FROM `donor_domain` 
                                    WHERE 
                                        `hosting`!='' AND `delete` != 'delete'
                                    ORDER BY RAND({$article_id}) 
                                    LIMIT 1 ");
        
        $row = $query->row_array();
        return $row;
    }
    
    function get_top_goods( $url_name, $article_id = 2 ){

        $query = $this->db->query(" SELECT * FROM
                                    (
                                        SELECT 
                                            `name`, `short_description`, `url_name`, `id` 
                                        FROM 
                                            `goods`
                                        WHERE 
                                            `price` > 500
                                        ORDER BY `rank` DESC
                                        LIMIT 200    
                                    ) AS `t1`
                                    ORDER BY RAND(".abs(crc32($url_name)).")
                                    LIMIT 1    
                                  ");        
        $row = $query->row_array();
        
        $html = '<h3>'.$row['name'].'</h3><p> '.$row['short_description'].'<br />';
        
        $goods_url = 'http://cctv-pro.com.ua/goods/'.$row['id'].'/'.$row['url_name'].'/';
        
        if( $article_id%2 == 0 )
            $html .= ' <a href="'.$goods_url.'">'.$row['name'].'</a>.';
        else
            $html .= ' <a href="'.$goods_url.'">'.$goods_url.'</a>.';
        
        $html .= '</p>';
        
        echo $html;
    }
      
    function set_nofollow( $link_txt, $seed_int, $percentage=10){
        mt_srand($seed_int);
        
        $rnd_int = mt_rand(1, 100);
        
        if( $rnd_int <= $percentage ){
            
            $link_txt = str_ireplace('<a ', '<a rel="nofollow" ', $link_txt);
        }
        mt_srand();
        
        return $link_txt;
    }
}