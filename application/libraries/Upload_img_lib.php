<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Upload_img_lib{
    private $ci, 
            $err_msg    = '', 
            $file_data  = array(),
            $img_folder = 'upload/images/';
    
    function __construct() {
        $this->ci = &get_instance();
        
        $this->ci->load->helper('download_helper');
        $this->ci->load->library('upload');
        $this->ci->load->library('image_lib');
    }
    
    function error_msg(){
        return $this->err_msg;
    }
    
    function get_file_data(){
        return $this->file_data;
    }
    
    function set_img_folder( $folder ){
        $this->img_folder = $folder;
    }
    
    function local_upload( $fname ){
        $config['upload_path']      = $this->img_folder;
        $config['allowed_types']    = 'gif|jpg|jpeg|png';
        $config['max_size']         = '2000';
        $config['max_width']        = '1920';
        $config['max_height']       = '1080';
        $config['encrypt_name']     = TRUE;
        
        $this->ci->upload->initialize($config);
        
        if( !$this->ci->upload->do_upload( $fname ) ){
            $this->err_msg .= $this->ci->upload->display_errors();
            return FALSE;
        }
        
        $this->file_data = $this->ci->upload->data();
        
        return TRUE;
    }
    
    function url_upload( $url ){
        
        if( $img_type = $this->check_img_url($url) )
            $content = $this->down_with_curl($url);
        else{
            $this->err_msg .= ' !URL изображения не верен ';
            return FALSE;
        }
        
        if( $content == false && length($content) < 100 ){
            $this->err_msg .= ' !Изображение не загруженно ';
            return FALSE;
        }
        
        $img_fname = md5($content).'.'.$img_type;
        
        file_put_contents($this->img_folder.$img_fname, $content);
        
        $this->file_data = array('file_name' => $img_fname, 'file_path' => $this->img_folder );
        
        return TRUE;
    }
    
    function resize_img( $img_name, $size ){
        switch ( $size ) {
            case 'small':
                $width  = 70;
                $height = 70;
                $folder = 'small/';
                break;
            case 'upper-small':
                $width  = 180;
                $height = 180;
                $folder = 'upper-small/';
                break;
            case 'medium':
                $width  = 300; //265
                $height = 300; //290
                $folder = 'medium/';
                break;
            case 'category-small':
                $width  = 129; 
                $height = 91; 
                $folder = 'category-small/';
                break;
            default:
                $width  = false;
                $height = false;
                $folder = false;
                break;
        }
        
        $config['source_image'] = $this->img_folder.$img_name;
        $config['new_image']    = $this->img_folder.$folder.$img_name;
        $config['width']        = $width;
        $config['height']       = $height;
        $config['master_dim']   = 'auto';       
        $config['quality']      = 100;
        
        if( $width == false ){
            $this->err_msg .= ' Не заданы параметры для изменения размера ';
            return FALSE;
        }
        
        $this->ci->image_lib->initialize($config);
        $this->ci->image_lib->resize();
    }
    
    private function down_with_curl($url){
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; ru; rv:1.9.2.2) Gecko/20100316 Firefox/3.6.2' );
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_TIMEOUT, 15);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);

        $content = curl_exec($ch);
        
        $error = curl_errno($ch);
	curl_close($ch);
        
        if( $error > 0 )
            return FALSE;
        else
            return $content;
    }
    
    private function check_img_url( $url ){
        $pattern = "#http://[\S]*?\.(gif|jpg|jpeg|png)#i";
        
        if( preg_match($pattern, $url, $arr) ){
            return $arr[1];
        }
        else
            return FALSE;
    }
    
}