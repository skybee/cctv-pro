<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 

    $cnt_cat  = count($child_cat_list);
    if( $cnt_cat < 1 ) return '';
?>


<div class="new_products">
    
    <? if( isset($cat_info['name']) ): ?>
    <div class="page-title">
        <h2><?=$cat_info['name']?> / Категории:</h2>
    </div>
    <? endif; ?>
    
                                    
<?
    $i = 0;
    while( $i < $cnt_cat ):
?>
<ul class="products-grid category-grid">
    <? for($ii=0; $ii<3 && $i<$cnt_cat; $ii++, $i++): ?>
    <li class="cat_grid_dot item <? if($ii == 0) echo 'first'; ?>" >
            <h3 class="product-name">
                <!--<a href="#" ><?=$child_cat_list[$i]['name']?></a>-->
                <a href="/category/<?=$child_cat_list[$i]['url_name']?>/" ><?=$child_cat_list[$i]['name']?></a>
            </h3>
            <!--<a href="#" class="product-image">--> 
            <a href="/category/<?=$child_cat_list[$i]['url_name']?>/" class="product-image"> 
                <table>
                    <tr>
                        <td><img src="/upload/images/160x160/<?=$child_cat_list[$i]['img']?>"  alt="<?=$child_cat_list[$i]['name']?>" onerror="imgError(this);" /></td>
                    </tr>
                </table>
            </a>               
        </li>
    <? endfor; ?>
</ul>
<? endwhile; ?>    
</div>


