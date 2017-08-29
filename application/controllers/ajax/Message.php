<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Message extends CI_Controller{
    
    function __construct() {
        parent::__construct();
        $this->load->library('email');
        $this->load->helper('email');
    }
    
    
    function index(){  show_404(); }
    
    function show_form(){
        
        
        $json_ar['title']   = 'Отправка сообщения';
        $json_ar['content'] = $this->load->view('ajax/message_view', array(), TRUE);
        
        echo json_encode($json_ar);
    }
    
    function send_message(){
        
        $data_ar = $_POST;
        $order_html = $this->load->view('ajax/mail_message_view', $data_ar, true);
        
        //== отправка писем ==//
        $mail_conf['charset']       = 'utf-8';
        $mail_conf['mailtype']      = 'html';
        $mail_conf['protocol']      = 'smtp';
        $mail_conf['smtp_port']     = '465';
        $mail_conf['smtp_host']     = 'ssl://smtp.yandex.ru';
        $mail_conf['smtp_user']     = 'mail@cctv-pro.com.ua';
        $mail_conf['smtp_pass']     = 'cctv-pro-qwerty';
        $mail_conf['smtp_timeout']  = '10';
        $mail_conf['priority']      = '1';
                
        $to_ar[] = 'mail@cctv-pro.com.ua';
                
        $this->email->initialize($mail_conf);
        $this->email->from('mail@cctv-pro.com.ua', 'HC Вопрос');
        $this->email->to($to_ar);
        $this->email->subject( $data_ar['subject'] );
        $this->email->message( $order_html );
        if( valid_email($data_ar['mail']) )
            $this->email->reply_to( $data_ar['mail'] );
                
        if( $this->email->send() ){
            $json_ar['title']   = 'Сообщение отправленно';
            $json_ar['content'] = 'Наш менеджер ответит  Вам в ближайшее время.';
                    
            //==== SMS ====//
            $mail_conf['mailtype']      = 'text';
                    
            $this->email->clear();
            $this->email->initialize($mail_conf);
            $this->email->from('mail@cctv-pro.com.ua', 'CCTV');
            $this->email->to('380685669303@sms.kyivstar.net');
            $this->email->subject('Новый вопрос');
            $this->email->message( ' '.$data_ar['subject'] );
            
            $this->email->send();
            //==== /SMS ====//
        }
        else{
            $json_ar['title']   = '! Произошла ошибка при отправке сообщения';
            $json_ar['content'] = 'Свяжитесь с нами телефону:<br />- (057) 759-56-81 <br />- (098) 427-01-25 <br /><br /> Либо E-mail:<br />- mail@cctv-pro.com.ua';
    //      echo $this->email->print_debugger();
        }
                //== /отправка писем ==//
                
                echo json_encode($json_ar);
    }
    
    
}