<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


function get_cat_tree_li( array $cat_tree_ar ){
    $html       = "<ul>\n";
    foreach( $cat_tree_ar as $cat_ar ){
        $html  .= "<li>\n";
        $html  .= '<a href="/admin/category/'.$cat_ar['id'].'/" class="ajax_load">'.$cat_ar['name']."</a>\n";
        $html  .= '<a href="/admin/goods_list/'.$cat_ar['id'].'/" class="ajax_load goods_cat_link">[ '.$cat_ar['goods_count'].' шт. ]</a>'."\n";
        if( is_array( $cat_ar['podcat'] ) && count($cat_ar['podcat']) > 0 ){
            $html .= get_cat_tree_li( $cat_ar['podcat'] );
        } 
        $html  .= '<input type="text" name="cat_sort['.$cat_ar['id'].']" value="'.$cat_ar['sort'].'" maxlength="2" /></li>'."\n";
    }
    $html      .= "</ul>\n";
    
    return $html;
}

function get_cat_tree_select( array $cat_tree_ar, &$goods_cat_id = false ){
    $html = "";
    foreach( $cat_tree_ar as $cat_ar ){
        if( is_array( $cat_ar['podcat'] ) && count($cat_ar['podcat']) > 0 ){
            $html .= '<optgroup label="'.$cat_ar['name'].'">'."\n";
            $html .= get_cat_tree_select( $cat_ar['podcat'], $goods_cat_id );
            $html .= '</optgroup>'."\n";
        }
        else{
            $selected = '';
            if( is_array($goods_cat_id) && in_array($cat_ar['id'], $goods_cat_id) ){
                $selected = ' selected="selected" ';
            }
            $html  .= '<option value="'.$cat_ar['id'].'" '.$selected.'>'.$cat_ar['name'].'</option>';
        }
    }
    
    return $html;
}

function get_cat_tree_select_without_group( array $cat_tree_ar, &$pcat_id = false ){
    $html = '';
    
    foreach( $cat_tree_ar as $cat_ar ){
        
        $selected = '';
        if( $pcat_id != false && $cat_ar['id'] == $pcat_id )
            $selected = ' selected="selected" ';
        
        if( is_array( $cat_ar['podcat'] ) && count($cat_ar['podcat']) > 0 ){
            $html  .= '<option value="'.$cat_ar['id'].'" '.$selected.'>+'.$cat_ar['name'].'</option>'."\n";
            $html  .= get_cat_tree_select_without_group( $cat_ar['podcat'], $pcat_id );
        }
        else
            $html  .= '<option value="'.$cat_ar['id'].'" '.$selected.'>- '.$cat_ar['name'].'</option>'."\n";
    }
    
    return $html;
}
