<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');




class main extends CI_Controller{
    
    function __construct() {
        parent::__construct();
        
        $this->load->database();
        $this->load->model('category_m','category');
        $this->load->model('goods_m', 'goods');
        $this->load->model('info_m', 'info');
        $this->load->model('articles_m', 'articles');
        $this->load->helper('goods');
        $this->load->helper('cookie');
        $this->load->helper('url');
        $this->load->helper('articles');
        
// вызывается непосредственно в методе        $this->load->helper('links/sitemap_link');
// вызывается непосредственно в методе        $this->load->library('links_lib', array('main'=>'ignots') );
// вызывается непосредственно в методе        $this->links_lib->link_isset = TRUE;  //== !!! ===//
        
        $this->cache_do = true;
        
        $this->data['counter']['yandex']    = $this->load->view('component/counter/cnt_yandex_view','',TRUE);
        $this->data['counter']['google']    = $this->load->view('component/counter/cnt_google_view','',TRUE);
        $this->data['counter']['li']        = $this->load->view('component/counter/cnt_li_view','',TRUE);
    }
    
    function index(){
//        if( $this->cache_do ) $this->output->cache(30);
        
//        $this->load->helper('links/sitemap_link'); //Tmp for Indots
//        $this->load->library('links_lib', array('main'=>'ignots') ); //Tmp for Indots
//        $this->links_lib->link_isset = TRUE; //Tmp for Indots
        
        $data_ar['catname_list']        = $this->category->get_category_list();
        $data_ar['child_cat_list']      = $this->category->get_child_cat( 0 );
        $data_ar['main_menu_list']      = $this->info->get_page_list();
        $data_ar['main_cat_id']         = false;
        $data_ar['info_ar']             = $this->info->get_info( 'main' );
        $data_ar['cat_info']            = &$data_ar['info_ar'];
        $data_ar['left_articles_list']  = $this->articles->get_like_article( 'видеонаблюдение домофон видеорегистратор сигнализация' , 4, 20, 500 );
//        $data_ar['links']['isset']      = $this->links_lib->link_isset;
//        $data_ar['links']['html']       = $this->links_lib->link_html;
                
        $tpl_ar['head_data']      = &$data_ar['cat_info'];      
        
        $tpl_ar['top_contact']          = $this->load->view('component/top_contact_schema.org.php', '', TRUE);
        $tpl_ar['cat_menu']             = $this->load->view('component/cat_menu_view', $data_ar, TRUE);
        $tpl_ar['content']              = $this->load->view('component/top_slider_view', array(), TRUE);
        $tpl_ar['content']             .= $this->load->view('component/category_grid_view', $data_ar, TRUE);
        $tpl_ar['content']             .= $this->load->view('component/cat_txt_view', $data_ar, TRUE);
//        $tpl_ar['content']             .= '<div style="display:none;">'.get_sitemap_links().'</div>'; //== !!! ==//
        $tpl_ar['top_menu']             = $this->load->view('component/top_menu_view', array(), TRUE);
        $tpl_ar['left_articles_goods']  = $this->load->view('component/left_articles_view', $data_ar, TRUE);
        $tpl_ar['counter']              = $this->data['counter'];
        
        $this->load->view('main_view', $tpl_ar );
    }
    
    function category( $category = false, $page = false, $city = false, $order = false ){
//        if( $this->cache_do ) $this->output->cache(10);
        
        $page = abs( (int) $page );
        if( $page == false ){
            $page = 1;
            $url_page_isset = false; //используется для исключения дублей ( /category/ & /category/1/ )
        }
        else
            $url_page_isset = true;
        if( $category == false )    show_404();
        
        $data_ar['page_nmbr']                   = $page;
        $data_ar['cat_info']                    = $this->category->get_info( $category );
        $data_ar['cat_info']['h1']             .= ' - "House-Control Харьков, Украина" ';
        $data_ar['cat_name']                    = $category;
        if( $data_ar['cat_info']['id'] == false )   show_404();
        $data_ar['catname_list']                = $this->category->get_category_list();
        $data_ar['breadcrumb_list']             = $this->category->get_breadcrumb( $data_ar['cat_info']['id'] );
        $data_ar['child_cat']['first_level']    = $this->category->get_child_id_first_level( $data_ar['cat_info']['id'] );
        $data_ar['child_cat_list']              = $this->category->get_child_cat( $data_ar['cat_info']['id'] );
        
        if( $city == 'order' ){  
            $city                   = false;
            $data_ar['link_order']  = 'order/'.$order.'/';
            $use_order              = true; //используется для исключения дублей
            switch ($order) {
                case 'price':
                    $html_title_order = ' - отсортировано по цене';
                    break;
                case 'name':
                    $html_title_order = ' - отсортировано по названию';
                    break;
                case 'rank':
                    $html_title_order = ' - отсортировано по популярности';
                    break;
                default:
                    $html_title_order = ' - сортировка';
                    break;
            }
        }
        else{
            $use_order              = false;
            $html_title_order       = '';
            $data_ar['link_order']  = '';
            if( $data_ar['child_cat_list'] != NULL )
                $order = 'rank';
            else
                $order = 'price';
        }
        $data_ar['order_val'] = $order;
        
        $data_ar['child_cat']['all_level']      = $this->category->get_child_id_all_level( $data_ar['cat_info']['id'] );
        $data_ar['child_cat']['all_level'][]    = $data_ar['cat_info']['id'];
        $data_ar['goods_list']                  = $this->goods->get_goods_from_cat( $data_ar['child_cat']['all_level'], $page, 15, $order );
        $data_ar['pager_ar']                    = $this->goods->get_pager_ar(       $data_ar['child_cat']['all_level'], $page, 15 );
        $data_ar['main_menu_list']              = $this->info->get_page_list();
        $data_ar['main_cat_id']                 = $data_ar['breadcrumb_list'][0]['id'];
        if( isset($data_ar['breadcrumb_list'][1]['id']) )
            $data_ar['child_cat_id']            = $data_ar['breadcrumb_list'][1]['id'];
        else
            $data_ar['child_cat_id']            = false;
        $data_ar['child_main_cat']              = $this->category->get_child_cat( $data_ar['main_cat_id'] );
        $data_ar['left_articles_list']          = $this->articles->get_like_article( $this->articles->get_str_from_breadcrumb( $data_ar['breadcrumb_list'] ) , 4, 20, 500 );
        
        if( $city ){ //категория для города
            if( !$data_ar['cat_info'] = $this->category->city_rewrite_txt($data_ar['cat_info'], $data_ar['cat_info']['id'], $city) ){
                show_404();  exit();
            }
        }
        
        $tpl_ar['head_data']                = &$data_ar['cat_info'];
        if( !$city )
            $tpl_ar['head_data']['html_title']      .= ' Харьков - House Control, Украина';
        if( $page > 1 ){
            $tpl_ar['head_data']['html_title']          .= ' - страница '.$page;
            $tpl_ar['head_data']['html_description']    .= ' - страница '.$page;
        }    
        if( $use_order ){
            $tpl_ar['head_data']['html_title']          .= $html_title_order;
            $tpl_ar['head_data']['html_description']    .= $html_title_order;
        }     
        
        if( $data_ar['main_cat_id'] == 1 ) //видеонаблюдение
            $tpl_ar['left_banner']      = $this->load->view('component/banner/ip_online_v', '', TRUE);
        
        $tpl_ar['content']              = '';
        $tpl_ar['content']             .= $this->load->view('component/breadcrumb_view', $data_ar, TRUE);
        $tpl_ar['content']             .= $this->load->view('component/category_grid_view', $data_ar, TRUE);
        
        if( $page == 1 && $use_order == false && ($url_page_isset == false || $city != false) ) // условие для исключения дублей главных страниц категорий
            $tpl_ar['content']         .= $this->load->view('component/cat_txt_view', $data_ar, TRUE);
        
        $tpl_ar['top_contact']          = $this->load->view('component/top_contact', '', TRUE);
        $tpl_ar['content']             .= $this->load->view('component/goods_grid_view', $data_ar, TRUE);
        $tpl_ar['cat_menu']             = $this->load->view('component/cat_menu_view', $data_ar, TRUE);
        $tpl_ar['top_menu']             = $this->load->view('component/top_menu_view', array(), TRUE);
        $tpl_ar['left_articles_goods']  = $this->load->view('component/left_articles_view', $data_ar, TRUE);
        $tpl_ar['counter']              = $this->data['counter'];
        
        $this->load->view('main_view', $tpl_ar );
    }
    
    function goods( $id = false, $url_name = false, $lock = false ){
//        if( $this->cache_do ) $this->output->cache(10);
        
        $id = (int) $id;
        if( !$id || !$url_name || $lock ){ show_404 (); exit(); }
        
        $data_ar['goods_info']          = $this->goods->get_goods_info( $id, $url_name );
        
        if( $data_ar['goods_info'] == false ) show_404 ();
        if( $data_ar['goods_info']['url_name'] != $url_name ){
            header ('HTTP/1.1 301 Moved Permanently');
            header ('Location: /goods/'.$id.'/'.$data_ar['goods_info']['url_name'].'/');
            exit();
        }
        
        $data_ar['goods_list']          = $this->goods->get_like_goods( $data_ar['goods_info']['id'], $data_ar['goods_info']['price'], $data_ar['goods_info']['cat_id'] );
        $data_ar['catname_list']        = $this->category->get_category_list();
        $data_ar['breadcrumb_list']     = $this->category->get_breadcrumb( $data_ar['goods_info']['cat_id'] );
        $data_ar['main_cat_id']         = $data_ar['breadcrumb_list'][0]['id'];
        if( isset($data_ar['breadcrumb_list'][1]['id']) )
            $data_ar['child_cat_id']            = $data_ar['breadcrumb_list'][1]['id'];
        else
            $data_ar['child_cat_id']            = false;
        $data_ar['child_main_cat']      = $this->category->get_child_cat( $data_ar['main_cat_id'] );
        $data_ar['this_cat']            = $data_ar['breadcrumb_list'][ count($data_ar['breadcrumb_list'])-1 ];
        $data_ar['main_menu_list']      = $this->info->get_page_list();
        $data_ar['left_articles_list']  = $this->articles->get_like_article( $this->articles->get_str_from_breadcrumb($data_ar['breadcrumb_list'] ).' '.$data_ar['goods_info']['name'] , 4, 50, 500 );
        $data_ar['left_articles_list']  = add_gname_to_larticles($data_ar['left_articles_list'], $data_ar['goods_info']['name']);
//        $data_ar['links']['isset']      = $this->links_lib->link_isset;
//        $data_ar['links']['html']       = $this->links_lib->link_html;
       
        $tpl_ar['head_data']['html_title']          = $data_ar['goods_info']['name'].'  Купить в Украине';
        $tpl_ar['head_data']['html_description']    = $data_ar['goods_info']['html_description'];
        $tpl_ar['head_data']['html_keywords']       = $data_ar['goods_info']['html_keywords'];
        
        if( $data_ar['main_cat_id'] == 1 ) //видеонаблюдение
            $tpl_ar['left_banner']      = $this->load->view('component/banner/ip_online_v', '', TRUE);
       
        $tpl_ar['top_contact']          = $this->load->view('component/top_contact', '', TRUE);
        $tpl_ar['cat_menu']             = $this->load->view('component/cat_menu_view', $data_ar, TRUE);
        $tpl_ar['top_menu']             = $this->load->view('component/top_menu_view', array(), TRUE);
        $tpl_ar['left_articles_goods']  = $this->load->view('component/left_articles_view', $data_ar, TRUE);
        $tpl_ar['content']              = $this->load->view('component/breadcrumb_view', $data_ar, TRUE);
        $tpl_ar['content']             .= $this->load->view('page/goods_view', $data_ar, TRUE);
        $tpl_ar['content']             .= $this->load->view('component/goods_grid_view', $data_ar, TRUE);
        $tpl_ar['counter']              = $this->data['counter'];
        
//        print_r($data_ar);
        
        $this->load->view('main_view', $tpl_ar );
    }
     
    function info( $url_name, $lock = false ){
        if( $lock ){ show_404(); exit(); }
        if( $this->cache_do ) $this->output->cache(60*24*10);
        
        if( $url_name == 'main' ) redirect('/', 'location', 301);
        
        $data_ar['info_ar']         = $this->info->get_info( $url_name );
        if( $data_ar['info_ar'] == NULL ) show_404 ();
        $data_ar['catname_list']    = $this->category->get_category_list();
        $data_ar['main_menu_list']  = $this->info->get_page_list();
        $data_ar['main_cat_id']     = false;
        $data_ar['left_articles_list']  = $this->articles->get_like_article( 'видеонаблюдение домофон видеорегистратор кондиционер' , 4, 20, 500 );
        
//        $data_ar['info_ar']['text'] = $this->load->view('page/tmp/about_as_view', $data_ar, TRUE);
        
        $tpl_ar['head_data']    = &$data_ar['info_ar'];
        
        $tpl_ar['top_contact']          = $this->load->view('component/top_contact_schema.org.php', '', TRUE);
        $tpl_ar['cat_menu']             = $this->load->view('component/cat_menu_view', $data_ar, TRUE);
        $tpl_ar['content']              = $this->load->view('component/top_slider_view', array(), TRUE);
        $tpl_ar['content']             .= $this->load->view('page/info_view', $data_ar, TRUE);
        $tpl_ar['top_menu']             = $this->load->view('component/top_menu_view', array(), TRUE);
        $tpl_ar['left_articles_goods']  = $this->load->view('component/left_articles_view', $data_ar, TRUE);
        $tpl_ar['counter']              = $this->data['counter'];
        
        $this->load->view('main_view', $tpl_ar );
    }
    
    function search(){
//        if( $this->cache_do ) $this->output->cache(0);
        
        $tpl_ar['top_contact']          = $this->load->view('component/top_contact', '', TRUE);
        $data_ar['catname_list']        = $this->category->get_category_list();
        $data_ar['main_menu_list']      = $this->info->get_page_list();
        $data_ar['main_cat_id']         = false;
        $data_ar['left_articles_list']  = $this->articles->get_like_article( 'видеонаблюдение домофон видеорегистратор кондиционер' , 4, 20, 500 );
        
        $tpl_ar['head_data']['html_title']          = 'Поиск';      
        $tpl_ar['head_data']['html_keywords']       = '';
        $tpl_ar['head_data']['html_description']    = '';
        
        $tpl_ar['cat_menu']             = $this->load->view('component/cat_menu_view', $data_ar, TRUE);
        $tpl_ar['content']              = $this->load->view('component/top_slider_view', '', TRUE);
        $tpl_ar['content']             .= $this->load->view('page/search_view', '', TRUE);
        $tpl_ar['top_menu']             = $this->load->view('component/top_menu_view', array(), TRUE);
        $tpl_ar['left_articles_goods']  = $this->load->view('component/left_articles_view', $data_ar, TRUE);
        $tpl_ar['counter']              = $this->data['counter'];
        
        $this->load->view('main_view', $tpl_ar );
    }
    
    function doc_form( $doc_name ){
        $this->load->model('docs_m','docs');
        $this->load->helper('docs');
        
        if(isset($_FILES['goods_file_list'])){
            $goodsList = getLoadFileJsonData($_FILES['goods_file_list']['tmp_name']);
        }
        else{
            $goodsList = false;
        }
//        print_r($goodsList);
        
        $data_ar['goods_list']          = $goodsList;
        $data_ar['catname_list']        = $this->category->get_category_list();
        $data_ar['main_menu_list']      = $this->info->get_page_list();
        $data_ar['main_cat_id']         = false;
        $data_ar['doc_data']['date']    = $this->docs->getCheckDate();
        $data_ar['doc_data']['doc_nbr'] = $this->docs->get_doc_number($doc_name);
        $data_ar['left_articles_list']  = $this->articles->get_like_article( 'видеонаблюдение домофон видеорегистратор кондиционер' , 4, 20, 500 );
        
        $title_ar = array( 
            'check'=>'Товарный чек', 
            'invoice'=>'Счет', 
            'act'=>'Акт выполненных работ', 
            'bill'=>'Товарная накладная',
            'repair'=>'Гарантийный талон',
            'proposal'=>'Коммерческое Предложение');
        
        $tpl_ar['head_data']['html_title']          = $title_ar[$doc_name];
        $tpl_ar['head_data']['html_description']    = '';
        $tpl_ar['head_data']['html_keywords']       = '';
        
        $tpl_ar['top_contact']          = $this->load->view('component/top_contact', '', TRUE);
        $tpl_ar['cat_menu']             = $this->load->view('component/cat_menu_view', $data_ar, TRUE);
        $tpl_ar['content']              = $this->load->view('docs/forms/'.$doc_name.'_view', $data_ar, TRUE);
        $tpl_ar['top_menu']             = $this->load->view('component/top_menu_view', array(), TRUE);
        $tpl_ar['left_articles_goods']  = $this->load->view('component/left_articles_view', $data_ar, TRUE);
        $tpl_ar['counter']              = $this->data['counter'];
        
        $this->load->view('main_view', $tpl_ar );
    }
    
    function articles($page=1, $tags_name=false, $lock=false){
        if( $lock ){ show_404(); exit(); }
        if( $this->cache_do ) $this->output->cache(60*24*10);
        
        $page = (int) $page;
        if( $page == false )        $page = 1;
        
        $data_ar['tags_list']       = $this->articles->get_tags();
        
        if( isset($data_ar['tags_list'][$tags_name]) ){
            $tag_search_txt     = $data_ar['tags_list'][$tags_name]['search'];
            $tag_page_title     = '| '.$data_ar['tags_list'][$tags_name]['name'];
            $data_ar['tag_url'] = $data_ar['tags_list'][$tags_name]['url_name'].'/';
        }
        else
            $tag_search_txt = $tag_page_title = $data_ar['tag_url'] = false;
        
        $data_ar['catname_list']    = $this->category->get_category_list();
        $data_ar['main_menu_list']  = $this->info->get_page_list();
        $data_ar['main_cat_id']     = false;
        $data_ar['articles_list']   = $this->articles->get_articles_to_page($page, $tag_search_txt);
        if( $data_ar['articles_list'] == false) show_404 ();
        $data_ar['pager_ar']        = $this->articles->get_pager_ar($page, $tag_search_txt);
        $data_ar['page_nmbr']       = $page;
        
        //== составление строки для поиска товаров
        $i=0; $like_goods_str = '';
        foreach( $data_ar['articles_list'] as $article_ar ){
            $like_goods_str .=' '.$article_ar['title'];
            if( $i == 5 ) break;
            $i++;
        }
        
        $data_ar['left_goods_list'] = $this->goods->get_like_str_goods( $like_goods_str, 15, 50 );
                
        $tpl_ar['head_data']['html_title']          = 'Статьи Новости '.$tag_page_title.' - страница '.$page;      
        $tpl_ar['head_data']['html_keywords']       = '';
        $tpl_ar['head_data']['html_description']    = '';
        
        $tpl_ar['top_contact']          = $this->load->view('component/top_contact', '', TRUE);
        $tpl_ar['cat_menu']             = $this->load->view('component/cat_menu_view', $data_ar, TRUE);
        $tpl_ar['content']              = $this->load->view('component/top_slider_view', array(), TRUE);
        $tpl_ar['content']             .= $this->load->view('page/articles_view', $data_ar, TRUE);
        $tpl_ar['top_menu']             = $this->load->view('component/top_menu_view', array(), TRUE);
        $tpl_ar['left_articles_goods']  = $this->load->view('component/left_goods_view', $data_ar, TRUE);
        $tpl_ar['counter']              = $this->data['counter'];
        $tpl_ar['counter']['li']        = '';
        
        $this->load->view('main_view', $tpl_ar );
    }
    
    function article( $id, $url_title = FALSE, $lock = false ){
        if( $lock ){ show_404(); exit(); }
//        if( $this->cache_do ) $this->output->cache(60*24*10);
        
//        $this->load->helper('links/sitemap_link'); //Tmp for Indots
//        $this->load->library('links_lib', array('main'=>'ignots') ); //Tmp for Indots
//        $this->links_lib->link_isset = TRUE; //Tmp for Indots
        
        if( !$url_title || $lock ){ show_404 (); exit(); }
        
        $id = (int) $id;
        
        $data_ar['tags_list']           = $this->articles->get_tags();
        $data_ar['info_ar']             = $this->articles->get_info( $id );
        
        if( $data_ar['info_ar'] == NULL ) show_404 ();
        if( $data_ar['info_ar']['url_name'] != $url_title ){
            header ('HTTP/1.1 301 Moved Permanently');
            header ('Location: /article/'.$id.'/'.$data_ar['info_ar']['url_name'].'/');
            exit();
        }
        
        $data_ar['articles_list']       = $this->articles->get_like_article( $data_ar['info_ar']['title'], 6, 20, 500, $data_ar['info_ar']['id'] );
        $data_ar['catname_list']        = $this->category->get_category_list();
        $data_ar['main_menu_list']      = $this->info->get_page_list();
        $data_ar['main_cat_id']         = false;
        $data_ar['left_goods_list']     = $this->goods->get_like_str_goods( $data_ar['info_ar']['title'].' '.$this->articles->get_short_txt( $data_ar['info_ar']['text'] ,300), 8, 12 );
//        $data_ar['links']['isset']      = $this->links_lib->link_isset;
//        $data_ar['links']['html']       = $this->links_lib->link_html;
        $data_ar['info_ar']['text']     = article_linkator( $data_ar['info_ar']['text'] );
        $data_ar['city_link']           = get_city_link( $_SERVER['REQUEST_URI'] );
        
        $tpl_ar['head_data']['html_title']          = $data_ar['info_ar']['title']." - House Control Харьков";
        $tpl_ar['head_data']['html_keywords']       = '';
        $tpl_ar['head_data']['html_description']    = '';
        
        $tpl_ar['top_contact']          = $this->load->view('component/top_contact', '', TRUE);
        $tpl_ar['cat_menu']             = $this->load->view('component/cat_menu_view', $data_ar, TRUE);
        $tpl_ar['content']              = $this->load->view('component/top_slider_view', array(), TRUE);
        $tpl_ar['content']             .= $this->load->view('page/article_view', $data_ar, TRUE);
        $tpl_ar['top_menu']             = $this->load->view('component/top_menu_view', array(), TRUE);
        $tpl_ar['left_articles_goods']  = $this->load->view('component/left_goods_view', $data_ar, TRUE);
        $tpl_ar['counter']              = $this->data['counter'];
        $tpl_ar['counter']['li']        = '';
        
        $this->load->view('main_view', $tpl_ar );
    }
}