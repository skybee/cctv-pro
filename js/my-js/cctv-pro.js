/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

function imgError(image){
    image.onerror = "";
    image.src = "/img/no_image.gif";
    return true;
}

jQuery(document).ready(function(){
    
    jQuery('.products-grid .desc_grid').tooltip({
        tooltipClass: "gooods-grid-tooltip",
        show: { effect: "fade", duration: 800, delay: 1000 }
    });
    
    update_menu_basket(); //обновление корзины
    update_menu_favorite(); //обновление списка избранных

    jQuery('.show_full_text').toggle( //раскрытие/скрытие текста в категориях
        function(){
            txt_h = jQuery('#height-category-text-block').innerHeight() + 40;
            jQuery('.category-text-block').animate({'height': txt_h+'px', 'max-height': txt_h+'px'},400);
            jQuery('.category-text-block .show_full_text div').addClass('fa-sort-asc');
            jQuery('.category-text-block .show_full_text div').removeClass('fa-sort-desc');
        },
        function(){
            jQuery('.category-text-block').animate({'height': '190px', 'max-height': '190px'},400);
            jQuery('.category-text-block .show_full_text div').addClass('fa-sort-desc');
            jQuery('.category-text-block .show_full_text div').removeClass('fa-sort-asc');
        }
    );
    
    //=== add line checkprint
    var check_number = jQuery('#check_number').attr('val');
    var check_line = jQuery('#check_tbl tr:nth-child(2)').clone();
    jQuery('#add_line').click(function(){
        check_number ++;
        jQuery('input', check_line).attr('value','');
        jQuery('input.wrnt_input', check_line).attr('value','12 мес.');
        jQuery('td:nth-child(3) input', check_line).attr('value','шт.');
        jQuery('td:nth-child(4) input', check_line).attr('value','1');
        jQuery('td:first', check_line).text( check_number+'.' );
        jQuery('#check_tbl').append( '<tr>'+check_line.html()+'</tr>' );
        
        show_wrnt_input();
    });
    
    jQuery('#printcheck_form input[name=print_wrnt]').change(function(){
        show_wrnt_input();
    });
    //=== /add line checkprint    
    
    //== <donor link convert> ==//
    donor_url = jQuery('.jq_link').text();
    jQuery('.jq_link').html('<a href="http://'+donor_url+'">'+donor_url+'</a>');
    //== </donor link convert> ==//
    
    goods_order_link(); //light order link
    
    //<липкий блок>
    jQuery(function() {
        if( jQuery('.breadcrumb_fixed').is(':visible') ){
            var box = jQuery('.breadcrumb_fixed').first(); // float-fixed block
        
            var top = box.offset().top - parseFloat(box.css('marginTop').replace(/auto/, 0));
            box_height = box.outerHeight(true);
            jQuery(window).scroll(function(){
                var windowpos = jQuery(window).scrollTop();
                if(windowpos < top) {
                    box.removeClass('breadcrumb_fixed_active');
                    jQuery('#breadcrumb_spacer').css({'height':'auto'});
                    if( jQuery.browser.opera ){ box.css( {'min-width':'auto'} ) }
                } else {
                    box.addClass('breadcrumb_fixed_active');
                    jQuery('#breadcrumb_spacer').css({'height':box_height+'px'});
                    if( jQuery.browser.opera ){ box.css( {'min-width':'679px'} ) }
                }
            });
        }
    });
    //</липкий блок>
    
    //<breadcrumb_child_links>
    jQuery('.bcl_a_block span').each(function(){
        jQuery(this).append('<a href="/category/'+jQuery(this).attr('urlname')+'/">'+jQuery(this).attr('name')+'</a>')
    });    
    //</breadcrumb_child_links>
    
    //load check list
    jQuery('#save_list').click(function(){
        defaultFormAction = jQuery('#printcheck_form').attr('action'); 
        jQuery('#printcheck_form')
                .attr('action','/savefile/goods_list/')
                .submit()
                .attr('action',defaultFormAction);
    });
    
    jQuery('#load_filelist_btn').click(function(){
        if( jQuery('#load_check_filelist').attr('value') == false ){
            return;
        }
        
        defaultFormAction = jQuery('#printcheck_form').attr('action'); 
        jQuery('#printcheck_form')
                .attr('action','')
                .attr('target','_self')
                .submit();
    });
       
    //<show goods description>   
    jQuery('.show-goods-descript-btn').toggle(
            function(){
                descriptH = jQuery('#goods_descript_height').height();
                descriptH = descriptH + 40;
                jQuery('.hide-goods-descript').animate({'max-height':descriptH+'px'},800,function(){
                    jQuery('.show-goods-descript-btn #btn_txt').text('скрыть');
                    jQuery('.show-goods-descript-btn #btn_ico').removeClass('fa-angle-down');
                    jQuery('.show-goods-descript-btn #btn_ico').addClass('fa-angle-up');
                });
            },
            function(){
                jQuery('.hide-goods-descript').animate({'max-height':'300px'},800,function(){
                    jQuery('.show-goods-descript-btn #btn_txt').text('показать');
                    jQuery('.show-goods-descript-btn #btn_ico').removeClass('fa-angle-up');
                    jQuery('.show-goods-descript-btn #btn_ico').addClass('fa-angle-down');
                });
            }
        );
    //</show goods description>
       
});

//гарантийный талон (печать чека)
function show_wrnt_input(){
    //== гарантийный талон (печать чека) ==// 
    
        if( jQuery('#printcheck_form input[name=print_wrnt]:checked').length > 0 )
            jQuery('.wrnt_input_block').addClass('wrnt_input_block_show');
        else
            jQuery('.wrnt_input_block').removeClass('wrnt_input_block_show');
    //== /гарантийный талон (печать чека) ==//
}



//<basket>
function del_goods_from_basket(element){
    jQuery(element).closest('.ab_goods_block').animate(
        {height:'0', opacity: '0'},
        100, 
        function(){
            jQuery(this).remove();
            re_summ_basket();
        });
}
function re_summ_basket(){
    inputObj = jQuery('.ajax_basket input');
    resultSumm = 0;
    for(i=0; i<inputObj.length; i++){
        thisInput   = jQuery(inputObj[i]);
        thisBlock   = jQuery(thisInput).closest('.ab_right_block');
        cntGoods    = jQuery(thisInput).attr('value');
        priceGoods  = jQuery(thisInput).attr('price');
        summ        = cntGoods * priceGoods;
        if( isNaN(summ) || cntGoods < 1) summ = 0;
        resultSumm  = resultSumm + summ;
        
        jQuery('.ab_goods_summ span', thisBlock).text( summ.toFixed(2) );
    }
    jQuery('.result_price b').text( resultSumm.toFixed(2) );
    
    re_write_basket_cookie();
    update_menu_basket(); //обновление корзины
}


function re_write_basket_cookie(){
    inputObj = jQuery('.ajax_basket input');
    result_ar = new Object();
    for(i=0; i<inputObj.length; i++){
        thisInput   = jQuery(inputObj[i]);
        cntGoods    = jQuery(thisInput).attr('value');
        idGoods     = jQuery(thisInput).attr('name');
        
        result_ar[idGoods] = cntGoods;
    }
//    console.log(result_ar);
    cookieStr = jQuery.toJSON(result_ar);
//    alert(cookieStr);
    setCookie('basket', cookieStr, 'Mon, 01-Jan-2029 00:00:00 GMT', '/');
}


function setCookie (name, value, expires, path, domain, secure) {
      document.cookie = name + "=" + escape(value) +
        ((expires) ? "; expires=" + expires : "") +
        ((path) ? "; path=" + path : "") +
        ((domain) ? "; domain=" + domain : "") +
        ((secure) ? "; secure" : "");
}

function getCookie ( cookie_name ){
  var results = document.cookie.match ( '(^|;) ?' + cookie_name + '=([^;]*)(;|jQuery)' );
 
  if ( results )
    return ( unescape ( results[2] ) );
  else
    return null;
}

function update_menu_basket(){
    jQuery.post(
        '/ajax/basket/update_menu/',
        {},
        function(data){
            jQuery('#menu_basket_goods').text( data['cnt_goods'] );
            jQuery('#menu_basket_price').text( data['summ_price'] );
        },
        'json'
    );
}
//</basket>

function update_menu_favorite(){
    id = jQuery('#jq_goods_id').attr('val');
    
    jQuery.post(
        '/ajax/goods/get_favorite/',
        {id: id},
        function(data){
            jQuery('#ajax_favorite').html( data['html'] );
        },
        'json'
    );
}

//<order>
function show_hide_shipping(){
    if( jQuery('.ajax_order input[type=radio][value=2]').attr('checked') == 'checked' )
        jQuery('#shipping_block').slideDown(0);
    else
        jQuery('#shipping_block').slideUp(0);
    
    set_center_window();
}

function check_order_form(){
    name    = jQuery('.ajax_order input[name=name]').attr('value');
    phone   = jQuery('.ajax_order input[name=phone]').attr('value');
    sname   = jQuery('.ajax_order input[name=sname]').attr('value');
    thname  = jQuery('.ajax_order input[name=thname]').attr('value');
    sklad   = jQuery('.ajax_order textarea[name=sklad]').attr('value');
    
    if( name.length < 3 ){
        jQuery('#order_error_msg').text('Укажите пожалуйста свое Имя');
        return false;
    }
    if( phone.length < 13 ){
        jQuery('#order_error_msg').text('Укажите пожалуйста свой Телефон');
        return false;
    }
    
    if( jQuery('.ajax_order input[type=radio][value=2]').attr('checked') == 'checked' ){
        if( sname.length < 4 ){
            jQuery('#order_error_msg').text('Укажите пожалуйста свою Фамилию');
            return false;
        }
        if( thname.length < 4 ){
            jQuery('#order_error_msg').text('Укажите пожалуйста свое Отчество');
            return false;
        }
        if( sklad.length < 5 ){
            jQuery('#order_error_msg').text('Укажите пожалуйста адрес доставки');
            return false;
        }
    }
    return true;
}
//<order>


//<message>
function check_message_form(){
    name    = jQuery('.ajax_order input[name=name]').attr('value');
    phone   = jQuery('.ajax_order input[name=phone]').attr('value');
    mail    = jQuery('.ajax_order input[name=mail]').attr('value');
    message = jQuery('.ajax_order textarea[name=message]').attr('value');
    
    if( name.length < 3 ){
        jQuery('#order_error_msg').text('Укажите пожалуйста свое Имя');
        return false;
    }
    if( phone.length < 13 && mail.length < 5 ){
        jQuery('#order_error_msg').text('Укажите Ваш E-mail и/или Телефон');
        return false;
    }
    if( message.length < 30 ){
        jQuery('#order_error_msg').text('Напишите чуть более длинное сообщение ');
        return false;
    }
    
    
    return true;
}
//</message>

function input_check_phone( input ){
    nbrStr = jQuery( input ).attr('value');
    newNbrStr =  nbrStr.replace(/[^0-9\+]/g, '');
    jQuery( input ).attr('value', newNbrStr);
//    alert( nbrStr +' - '+newNbrStr );
}

function goods_order_link(){
    order_val = jQuery('#goods_sorter').attr('rel');
    jQuery('a#'+order_val).addClass('active');
    brand_val = jQuery('#brand_sorter').attr('rel');
    jQuery('a#'+brand_val).addClass('active');
}

function set_center_window(){
    window_h        = jQuery('#modal_bg').innerHeight();
    modal_block_h   = jQuery('#modal_dialog_block').innerHeight();
    modal_margin_top = ( window_h - modal_block_h ) / 2; 
    jQuery('#modal_dialog_block').animate({'margin-top':modal_margin_top+'px'}, 400);
}



