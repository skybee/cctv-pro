<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class admin extends CI_Controller{
    
    function __construct() {
        parent::__construct();
        
        $this->load->database();
        
        
        $this->load->model('admin_m');
        $this->load->helper('admin');
        $this->load->helper('path');
        $this->load->helper('url');
        $this->load->helper('valid_data');
        $this->load->helper('url_name');
        $this->load->library('upload');
        $this->load->library('ion_auth');
        $this->load->library('session');
        $this->load->library('upload_img_lib');
        
        $_POST = post_valid( $_POST );
    }
    
    //==================== LOGIN =====================//
    function _check_login(){
        if ( !$this->ion_auth->logged_in() ) { header("Location: /admin/login/"); exit(); }
    }
    
    function _check_login_json(){
        if ( !$this->ion_auth->logged_in() ) {
            $anser_ar['title']      = 'Ошибка авторизации';
            $anser_ar['content']    = '';
            $anser_ar['script']     = ' location="/admin/login/" ';
            echo json_encode($anser_ar);
            exit();
        }
    }
    
    function login(){
        $this->load->view('admin/login_v');
    }
    
    function auth(){
        if( $this->ion_auth->login( $_POST['login'], $_POST['password'], TRUE) ){
            $anser_ar['title']      = 'Вход в систему';
            $anser_ar['content']    = 'loader';
            $anser_ar['script']     = ' location="/admin/" ';
        }
        else{
            $anser_ar['title']      = 'Ошибка входа';
            $anser_ar['content']    = 'Не верно введены логин и(или) пароль';
        }
        echo json_encode($anser_ar);
    }
    
    function logout(){
        $this->ion_auth->logout();
        header("Location: /admin/login/");
    }
    
    function _create_user(){
        $this->_check_login();
        
        $username   = 'house-control';
        $password   = '1865tsb';
	$email      = 'info@house-control.org.ua';
	$additional_data = array(
            'first_name' => 'Liza',
            'last_name' => 'Pam-param',
	);								
        $group = array('1'); // Sets user to admin. No need for array('1', '2') as user is always set to member by default

	$this->ion_auth->register($username, $password, $email, $additional_data, $group);
    }
    
    private function is_ajax(){
        if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            return TRUE;
        }
        else
            return exit();
    }
    //==================== /LOGIN =====================//
    
    function index(){
        $this->_check_login();
        
        $tpl_data['content']        = $this->all_goods( TRUE );
        $tpl_data['cnt_hi_price']   = count( $this->admin_m->get_goods_hi_price() );
        
        $this->load->view('admin/main_v', $tpl_data);
    }
    
    function all_goods( $return = false ){
        $this->_check_login();
        
        $data_ar['category_list']   = get_cat_tree_li( $this->admin_m->get_category_tree() );
        
        return $this->load->view('admin/index_v', $data_ar, $return);
    }
    
    function goods_list( $cat_id ){
        $this->_check_login();
        
        $data_ar['cat_id']      = $cat_id;
        $data_ar['goods_ar']    = $this->admin_m->get_goods_list( $cat_id );
        $data_ar['cat_select']  = get_cat_tree_select( $this->admin_m->get_category_tree(), $cat_id );
                
        $this->load->view('admin/goods_list_v', $data_ar);
    }
    
    function goods($id){
        $this->_check_login();
        
        $data_ar['goods_data']  = $this->admin_m->get_goods_data($id);
        $data_ar['competitors'] = $this->admin_m->get_competitors_link_from_goods($id);
        $data_ar['cat_select']  = get_cat_tree_select( $this->admin_m->get_category_tree(), $data_ar['goods_data']['cat_id'] );
        
//        print_r( $data_ar );
        
        $this->load->view('admin/goods_v', $data_ar);
    }
    
    function add_goods(){
        $this->_check_login();
        
        $data_ar['cat_select']  = get_cat_tree_select( $this->admin_m->get_category_tree() );
        
        $this->load->view('admin/add_goods_v', $data_ar);
    }
    
    function category($id){
        $this->_check_login();
        
        $id = (int) $id;
        
        $data_ar['cat_data']    = $this->admin_m->get_category_data($id);
        if( $data_ar['cat_data'] == NULL ) exit("Страница не может быть отображена");
        $data_ar['cat_select']  = get_cat_tree_select_without_group($this->admin_m->get_category_tree(), $data_ar['cat_data']['parent_id'] );
        
        $this->load->view('admin/category_v', $data_ar);
    }
    
    function add_category(){
        $data_ar['cat_select']  = get_cat_tree_select_without_group( $this->admin_m->get_category_tree() );
        
        $this->load->view('admin/add_category_v', $data_ar);
    }
    
    function hi_price(){
        $this->_check_login();
        
        $data_ar['goods_ar']    = $this->admin_m->get_goods_hi_price();
        
        $this->load->view('admin/hi_price_goods_list_v', $data_ar);
    }
    
    
    
    //==================== ACTION =====================//
    
        
    function upd_blocks(){
        $this->_check_login_json();
        
        foreach( $_POST['blocks'] as $id => $block_ar ){
            $this->db->query("  UPDATE `benefits`
                                SET
                                    `img_css_id`    = '{$block_ar['img_css_id']}',
                                    `name`          = '{$block_ar['name']}',
                                    `notice`        = '{$block_ar['notice']}'
                                WHERE
                                    `id` = '{$id}'
                            ");
        }
        
        if( $this->db->_error_number() == 0 ){
            $anser_ar['title']      = 'Сохранено';
            $anser_ar['content']    = '';
        }
        else{
            $anser_ar['title']      = 'Ошибка!';
            $anser_ar['content']    = 'Информация не сохранена <br />'.$this->db->_error_message();
        }
        
        echo json_encode($anser_ar);
    }
    
    function change_price(){
        $this->_check_login_json();
        
        if( !isset($_POST['price']) || !is_array($_POST['price']) ){
            $anser_ar['title']      = 'Ошибка!';
            $anser_ar['content']    = 'Отсутствуют товары для изменения цен';
        }
        else{
            $err = false;
            foreach( $_POST['price'] as $id => $val ){
                $id     = (int)     $id;
                $val    = (float)   $val;
                
                if( !$this->admin_m->upd_goods_price($id, $val) ){ 
                    $anser_ar['title']      = 'Ошибка!';
                    $anser_ar['content']    = 'Произошла ошибка во время изменения цен. <br />Обновите страницу и повторите попытку.';
                    $err = true;
                    break;
                }
            }
            
            if( $err == false ){
                $anser_ar['title']      = 'Изменения сохранены';
                $anser_ar['content']    = 'Внимание! Новые цены отобразятся на сайте в течении 10 мин.';
            }
        }
        
        echo json_encode($anser_ar);
    }
    
    function change_goods_cat(){
        $this->_check_login_json();
        
        if( $this->admin_m->del_goods_from_cat( $_POST['check_goods'] ) ){
            foreach( $_POST['goods_cat'] as $cat_id ){
                foreach( $_POST['check_goods'] as $goods_id ){
                    $this->admin_m->add_goods_to_cat($goods_id, $cat_id);
                }
            }
            
            $anser_ar['title']      = 'Категории для выбранных товаров изменены';
            $anser_ar['content']    = 'Изменения отобразятся на сайте в течении 10 мин.';
            $anser_ar['script']     = "$('#right_content_block').load('/admin/goods_list/{$_POST['this_cat_id']}/')";
        }
        else{
            $anser_ar['title']      = 'Ошибка обновления';
            $anser_ar['content']    = '';
        }
        
        echo json_encode($anser_ar);
    }
    
    function upd_goods(){
        $this->_check_login_json();
        
        $msg        = '';
        
//        print_r($_POST); exit();
        
        if( !empty($_POST['image_url']) OR isset($_FILES['image_local']) ){ //загрузка изображений
            
            if(!empty($_POST['image_url'])) //загрузка изображений по URl
                $load_result = $this->upload_img_lib->url_upload( $_POST['image_url'] );
            else //загрузка изображения с компьютера
                $load_result = $this->upload_img_lib->local_upload('image_local');
            
            if( $load_result ){
                $img_data = $this->upload_img_lib->get_file_data();

                $this->upload_img_lib->resize_img( $img_data['file_name'], '70x70');
                $this->upload_img_lib->resize_img( $img_data['file_name'], '160x160');
                $this->upload_img_lib->resize_img( $img_data['file_name'], '265x290');
                
                $_POST['main_img'] = $img_data['file_name'];
            }
            else
                $msg .= $this->upload_img_lib->error_msg();
        }
        
        //info update
        if( $this->admin_m->upd_goods_info( $_POST['goods_id'], $_POST ) ){ 
            
            //update category
            if( $this->admin_m->del_goods_from_cat( array($_POST['goods_id']) ) ){ 
                foreach( $_POST['categories'] as $cat_id ){
                    $this->admin_m->add_goods_to_cat($_POST['goods_id'], $cat_id);
                }
            }
            else
                $msg .= ' !Ошибка при обновлении категорий ';
            
            //add competitors link
            $msg .= $this->admin_m->add_competitors_link( $_POST['goods_id'], $_POST['competitors'] ); 
            
            $anser_ar['title']      = 'Информация обновлена';
            $anser_ar['content']    = $msg.' Изменения отобразятся на сайте в течении 10 мин.';
            $anser_ar['script']     = "$('#right_content_block').load('/admin/goods/{$_POST['goods_id']}/', {}, function(){ ajax_init(); } )";
        }
        else{
            $anser_ar['title']      = 'Произошла ошибка';
            $anser_ar['content']    = $msg.' Информация не изменена.';
        }
        
        echo json_encode($anser_ar);
    }
    
    function add_goods_action(){
        $this->_check_login_json();
//        print_r($_POST);
        
        $msg = '';
        
        $_POST['price'] = (int) $_POST['price'];
        
        if( mb_strlen( $_POST['name'] ) < 3 
            OR 
            mb_strlen( $_POST['short_description'] ) < 15 
            OR
            count( $_POST['categories'] ) < 1
            OR
            $_POST['price'] < 0    
          ){
            $anser_ar['title']      = 'Ошибка';
            $anser_ar['content']    = ' Одно из полей заполнено неверно ';
        }
        else{
            
            // <load image>
            if( !empty($_POST['image_url']) OR isset($_FILES['image_local']) ){ 
            
                if(!empty($_POST['image_url'])) //загрузка изображений по URl
                    $load_result = $this->upload_img_lib->url_upload( $_POST['image_url'] );
                else //загрузка изображения с компьютера
                    $load_result = $this->upload_img_lib->local_upload('image_local');

                if( $load_result ){
                    $img_data = $this->upload_img_lib->get_file_data();

                    $this->upload_img_lib->resize_img( $img_data['file_name'], '70x70');
                    $this->upload_img_lib->resize_img( $img_data['file_name'], '160x160');
                    $this->upload_img_lib->resize_img( $img_data['file_name'], '265x290');

                    $_POST['main_img'] = $img_data['file_name'];
                }
                else{
                    $_POST['main_img'] = '';
                    $msg .= $this->upload_img_lib->error_msg();
                }    
            }
            // </load image>
            
            // получение keywords, description
            $html_info = $this->admin_m->get_new_goods_html_info( $_POST['name'], $_POST['categories'][0] );
            
            $_POST['html_keywords']     = $html_info['html_keywords'];
            $_POST['html_description']  = $html_info['html_description'];
            $_POST['url_name']          = seoUrl( $_POST['name'] );
            
            $goods_id = $this->admin_m->add_goods( $_POST ); // занесение информации о товаре
            
            if( $goods_id ){
                foreach( $_POST['categories'] as $cat_id ){ // добавление категорий товаров
                    $this->admin_m->add_goods_to_cat( $goods_id, $cat_id );
                }
                
                //add competitors link
                $msg .= $this->admin_m->add_competitors_link( $goods_id, $_POST['competitors'] );
                
                $anser_ar['title']      = 'Товар добавлен';
                $anser_ar['content']    = $msg.' Изменения отобразятся на сайте в течении 10 мин.';
                $anser_ar['script']     = "$('#right_content_block').load('/admin/add_goods/', {}, function(){ ajax_init(); } )";
            }
            else{
                $anser_ar['title']      = 'Товар не добавлен';
                $anser_ar['content']    = 'Возникла ошибка при добавлении. '.$msg;
            }
        }
        
        echo json_encode($anser_ar);
    }
    
    function upd_cat_sort(){
        $this->_check_login_json();
        
        $err = false;
        foreach( $_POST['cat_sort'] as $cat_id => $sort_val ){
            $cat_id     = (int) $cat_id;
            $sort_val   = (int) $sort_val;
            
            if( !$this->admin_m->upd_cat_sort( $cat_id, $sort_val) ){
                $err = true;
                break;
            }
        }
        
        if( $err ){
            $anser_ar['title']      = 'Ошибка';
            $anser_ar['content']    = 'Сортировка категорий не сохронена';
        }
        else{
            $anser_ar['title']      = 'Сохранено';
            $anser_ar['content']    = 'Изменения отобразятся на сайте в течении 10 мин.';
            $anser_ar['script']     = "$('#right_content_block').load('/admin/all_goods/', {}, function(){ ajax_init(); } )";
        }
        
        echo json_encode($anser_ar);
    }
    
    function upd_category(){
        $this->_check_login_json();
        
        $msg        = '';
        
//        print_r($_POST); exit();
        
        if( !empty($_POST['image_url']) OR isset($_FILES['image_local']) ){ //загрузка изображений
            
            if( !empty($_POST['image_url']) ) //загрузка изображений по URl
                $load_result = $this->upload_img_lib->url_upload( $_POST['image_url'] );
            else //загрузка изображения с компьютера
                $load_result = $this->upload_img_lib->local_upload('image_local');
            
            if( $load_result ){
                $img_data = $this->upload_img_lib->get_file_data();
                
                $this->upload_img_lib->resize_img( $img_data['file_name'], '160x160');
                
                $_POST['img'] = $img_data['file_name'];
            }
            else
                $msg .= $this->upload_img_lib->error_msg();
        }
        
        if( $this->admin_m->upd_category( $_POST['cat_id'], $_POST ) ){ //info update
            $anser_ar['title']      = 'Информация обновлена';
            $anser_ar['content']    = $msg.' Изменения отобразятся на сайте в течении 10 мин.';
            $anser_ar['script']     = "$('#right_content_block').load('/admin/category/{$_POST['cat_id']}/', {}, function(){ ajax_init(); } )";
        }
        else{
            $anser_ar['title']      = 'Произошла ошибка';
            $anser_ar['content']    = $msg.' Информация не изменена.';
        }
        
        echo json_encode($anser_ar);
    }
    
    function add_category_action(){
        $this->_check_login_json();
        
//        print_r( $_POST ); exit();
        
        $msg = '';
        $_POST['sort'] = (int) $_POST['sort'];
        
        if( mb_strlen( $_POST['name'] ) < 5 
            OR 
            mb_strlen( $_POST['html_title'] ) < 5 
            OR
            preg_match("/^[a-z\d-_]{3,150}$/i", $_POST['url_name'] ) == false
            OR
            $_POST['sort'] < 0    
            OR
            $this->admin_m->cat_urlname_isset( $_POST['url_name'] )    
          ){
            
            if( $this->admin_m->cat_urlname_isset($_POST['url_name']) )
                $msg .= ' URL-адрес уже используется ';
            elseif( preg_match("/^[a-z\d-_]{3,150}$/i", $_POST['url_name'] ) == false )        
                $msg .= ' Формат URL-адреса не верен ';    
            
            $anser_ar['title']      = 'Ошибка';
            $anser_ar['content']    = ' Одно из обязательных полей заполнено неверно. '.$msg;
        }
        else{
            // <load image>
            if( !empty($_POST['image_url']) OR isset($_FILES['image_local']) ){ 
            
                if(!empty($_POST['image_url'])) //загрузка изображений по URl
                    $load_result = $this->upload_img_lib->url_upload( $_POST['image_url'] );
                else //загрузка изображения с компьютера
                    $load_result = $this->upload_img_lib->local_upload('image_local');

                if( $load_result ){
                    $img_data = $this->upload_img_lib->get_file_data();
                    $this->upload_img_lib->resize_img( $img_data['file_name'], '160x160');

                    $_POST['img'] = $img_data['file_name'];
                }
                else{
                    $_POST['img'] = '';
                    $msg .= $this->upload_img_lib->error_msg();
                }    
            }
            else
                $_POST['img'] = '';
            // </load image>
            
            if( $this->admin_m->add_category( $_POST ) ){ // занесение категории
                $anser_ar['title']      = 'Категория занесена';
                $anser_ar['content']    = $msg.' Изменения отобразятся на сайте в течении 10 мин.';
                $anser_ar['script']     = "$('#right_content_block').load('/admin/add_category/', {}, function(){ ajax_init(); } )";
            }
            else{
                $anser_ar['title']      = 'Категория не добавлена';
                $anser_ar['content']    = 'Возникла ошибка при добавлении. '.$msg;
            }
        }
        echo json_encode($anser_ar);        
    }
    
    function del_competitors(){
        $id = (int) $_POST['id'];
        
        if( $this->admin_m->del_competitors($id) ){
            $anser_ar['title']      = 'Ссылка удалена';
            $anser_ar['content']    = '';
            $anser_ar['script']     = "$('.competitors_link_block_{$id}').remove();";
        }
        else{
            $anser_ar['title']      = '! Ошибка';
            $anser_ar['content']    = 'Ссылка не удалена';
        }
        
        echo json_encode($anser_ar);
    }
    
    function multiply_price_all(){
        $multiply = $_POST['multiply_price'];
        $multiply = trim( $multiply );
        $multiply = str_replace(',', '.', $multiply);
        
        if( !preg_match("#^\d\.\d+$#i", $multiply) ){
            $anser_ar['title']      = '! Ошибка';
            $anser_ar['content']    = 'Неверный формат множителя: <br />"'.$multiply.'" <br /> Пример: 1.05 | 0.925 ';
        }
        elseif($multiply > 1.15 || $multiply < 0.85){
            $anser_ar['title']      = '! Ошибка';
            $anser_ar['content']    = 'Изменение цен более чем на 15% за один раз невозможно';
        }
        else{
            $multiply = (float) $multiply;
            
            $result_1 = $this->db->query("UPDATE `goods` SET `price` = `price` * {$multiply} ");
            $result_2 = $this->db->query("UPDATE `goods` SET `price` = ROUND(`price`,0) WHERE  `price` > 10");
            
            if($result_1 && $result_2){
                $anser_ar['title']      = 'Все цены изменены';
                $anser_ar['content']    = 'Изменения отобразятся на сайте в течении 10 мин.';
            }
            else{
                $anser_ar['title']      = '! Ошибка';
                $anser_ar['content']    = 'При изменение цен произошла ошибка. <br />Проверьте были ли изменены цены и в случае необходимости повторите попытку';
            }
        }
        
        echo json_encode($anser_ar);
    }
    
    
}