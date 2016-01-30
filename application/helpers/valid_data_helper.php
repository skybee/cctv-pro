<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



function post_valid( $post_ar ){
    if( count($post_ar) ){
        foreach ( $post_ar as $key => $val){
            if( is_string($val) ){
                $new_ar[ $key ] = mysql_real_escape_string( $val );
            }
            else
                $new_ar[ $key ] = $val;
        }
        $post_ar = $new_ar;
    }
    
    return $post_ar;
}