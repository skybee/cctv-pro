<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class basket extends CI_Controller{
    
    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('goods_m','goods');
        $this->load->library('email');
        $this->load->helper('email');
        $this->load->helper('cookie');
    }
    
    
    function index(){  show_404(); }
    
    function show_basket(){
        $goods_ar = NULL;
        
        if( isset($_COOKIE['basket']) )
            $goods_ar = json_decode( $_COOKIE['basket'], true );
//            print_r($goods_ar);
        if( isset($_POST['id']) ){
            $new_id     = abs( (int) $_POST['id'] );
            $new_cnt    = abs( (int) $_POST['cnt'] );
            if( $new_id>0 && $new_cnt>0)
                $goods_ar[$new_id] = $new_cnt;
        }
        
        $data_ar['goods_list']  = NULL;
        $data_ar['count_ar']    = $goods_ar;
        if( count($goods_ar) > 0 ){
            set_cookie('basket', json_encode($goods_ar), time()+(3600*24*100) );
            foreach( $goods_ar as $id => $cnt )
                $id_ar[] = $id;
            $data_ar['goods_list'] = $this->goods->get_goods_by_id( $id_ar );
        }
        
        
        $json_ar['title']   = 'Ваша корзина';
        $json_ar['script']  = 'update_menu_basket();';
        if( count($data_ar['goods_list']) >= 1 )
            $json_ar['content'] = $this->load->view('ajax/basket_view', $data_ar, TRUE);
        else
            $json_ar['content'] = 'Ваша корзина пуста';
        
        echo json_encode($json_ar);
    }
    
    function order(){
        
        $json_ar['title']   = 'Ошибка!';
        $json_ar['content'] = 'В Вашей корзине нет товаров';
        
        if( isset($_COOKIE['basket']) ){ //подсчет суммы
            $goods_ar = json_decode( $_COOKIE['basket'], true );
            if( count($goods_ar) > 0 ){
                foreach( $goods_ar as $id => $cnt )
                     $id_ar[] = $id;
                $goods_list = $this->goods->get_goods_by_id( $id_ar );
                $summ = 0;
                foreach( $goods_list as $goods ){
                    $summ = $summ + $goods['price'] * $goods_ar[ $goods['id'] ];
                }
               
                $json_ar['title']   = 'Оформление заказа';
                $json_ar['content'] = $this->load->view('ajax/order_view', array('summ'=>$summ), TRUE);
            }
        }
        
        echo json_encode($json_ar);
    }
    
    function send_order(){
        if( isset($_COOKIE['basket']) ){
            $goods_ar = json_decode( $_COOKIE['basket'], true );
            if( count($goods_ar) > 0 ){
                
                foreach( $goods_ar as $id => $cnt )
                     $id_ar[] = $id;
                
                $this->goods->set_order_goods_rank($id_ar); //увеличение популярности товаров
                
                $goods_list = $this->goods->get_goods_by_id( $id_ar );
                
                $summ = 0;
                foreach( $goods_list as $goods )
                    $summ = $summ + $goods['price'] * $goods_ar[ $goods['id'] ];
                
                $data_ar                = $_POST;
                $data_ar['summ']        = round($summ, 2);
                $data_ar['goods_list']  = $goods_list;
                $data_ar['count_ar']    = $goods_ar;
                $data_ar['order_id']    = $this->goods->get_last_order_id() +1;
                $order_html = $this->load->view('ajax/mail_order_view', $data_ar, true);
                
                
                //== отправка писем ==//
                $mail_conf['charset']       = 'utf-8';
                $mail_conf['mailtype']      = 'html';
                $mail_conf['protocol']      = 'smtp';
                $mail_conf['smtp_port']     = '465';
                $mail_conf['smtp_host']     = 'ssl://smtp.yandex.ru';
                $mail_conf['smtp_user']     = 'info@house-control.org.ua';
                $mail_conf['smtp_pass']     = 'house-control44';
                $mail_conf['smtp_timeout']  = '10';
                $mail_conf['priority']      = '1';
                
                $to_ar[] = 'info@house-control.org.ua';
                $replay_mail = false;
                if( valid_email($_POST['mail']) ){
                    $to_ar[]     = $_POST['mail'];
                    $replay_mail = $_POST['mail'];
                }    
                
                $this->email->initialize($mail_conf);
                $this->email->from('info@house-control.org.ua', 'House Control');
                $this->email->to($to_ar);
                $this->email->subject('Заказ #'.$data_ar['order_id'].'. Сумма: '.$data_ar['summ'].' грн. от '.date("d.m.Y"));
                $this->email->message( $order_html );
                if( $replay_mail )
                    $this->email->reply_to( $replay_mail );
                
                if( $this->email->send() ){
                    $this->goods->save_order( $order_html );
                    $json_ar['title']   = 'Заказ оформлен';
                    $json_ar['content'] = 'Наш менеджер свяжется с Вами в ближайшее время.';
                    $json_ar['script']  = "setCookie('basket', '', 'Mon, 01-Jan-2000 00:00:00 GMT', '/'); update_menu_basket();"; //удаление куки
                    
                    //==== SMS ====//
                    $sms_txt = $this->load->view('ajax/sms_order_view', $data_ar, true);
                    
                    $mail_conf['mailtype']      = 'text';
//                    $mail_conf['charset']       = 'UCS-2';
                    
                    $this->email->clear();
                    $this->email->initialize($mail_conf);
                    $this->email->from('info@house-control.org.ua', 'HC');
                    $this->email->to('380984270125@sms.kyivstar.net');
                    $this->email->subject( 'Заказ #'.$data_ar['order_id'] );
                    $this->email->message( $sms_txt );
                    
                    $this->email->send();
                    //==== /SMS ====//
                }
                else{
                    $json_ar['title']   = '! Ошиба при созднии заказа';
                    $json_ar['content'] = 'Попробуйте пройти процедуру оформления повторно, либо свяжитесь с нами по телефону или e-mail.';
//                    echo $this->email->print_debugger();
                }
                //== /отправка писем ==//
                
                
                
            }
        }
        
        echo json_encode($json_ar);   
    }
    
    function update_menu(){
        
        $json_data['cnt_goods']     = '0';
        $json_data['summ_price']    = '0.00';
        
        if( isset($_COOKIE['basket']) ){
            $goods_ar = json_decode( $_COOKIE['basket'], true );
            if( count($goods_ar) > 0 ){
                
                $count_goods = 0;
                foreach( $goods_ar as $id => $cnt ){
                     $id_ar[]       = $id;
                     $count_goods   = $count_goods + abs($cnt);
                }     
                
                $goods_list = $this->goods->get_goods_by_id( $id_ar );
                
                $summ = 0;
                foreach( $goods_list as $goods )
                    $summ = $summ + ( abs($goods['price']) * abs($goods_ar[ $goods['id'] ]) );
                
                $json_data['cnt_goods']     = $count_goods;
                $json_data['summ_price']    = number_format($summ, 2, '.', ' ');
            }
        }
        echo json_encode($json_data);
    }
    
}