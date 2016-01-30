/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

function imgError(image){
    image.onerror = "";
    image.src = "/img/no_image.gif";
    return true;
}

$(document).ready(function(){

    $('#loopedSlider').loopedSlider({ //slider
                    autoStart: 3500,
                    restart: 7500
    });
    
    update_menu_basket(); //обновление корзины
    update_menu_favorite(); //обновление списка избранных

    $(".new_descr").tipTip({ //всплывающее окно описания
            maxWidth: "300px"
    });

    $('.show_full_text').toggle( //раскрытие/скрытие текста в категориях
        function(){
            txt_h = $('.category_text .std div').innerHeight() + 10;
            $('.category_text .std').animate({'height': txt_h+'px', 'max-height': txt_h+'px'},200);
            $('.category_text .show_full_text div').addClass('slide_up_btn');
        },
        function(){
            $('.category_text .std').animate({'height': '58px', 'max-height': '58px'},200);
            $('.category_text .show_full_text div').removeClass('slide_up_btn');
        }
    )
    
    //=== add line checkprint
    var check_number = $('#check_number').attr('val');
    var check_line = $('#check_tbl tr:nth-child(2)').clone();
    $('#add_line').click(function(){
        check_number ++;
        $('input', check_line).attr('value','');
        $('input.wrnt_input', check_line).attr('value','12 мес.');
        $('td:nth-child(3) input', check_line).attr('value','шт.');
        $('td:nth-child(4) input', check_line).attr('value','1');
        $('td:first', check_line).text( check_number+'.' );
        $('#check_tbl').append( '<tr>'+check_line.html()+'</tr>' );
        
        show_wrnt_input();
    });
    
    $('#printcheck_form input[name=print_wrnt]').change(function(){
        show_wrnt_input();
    });
    //=== /add line checkprint    
    
    //== <donor link convert> ==//
    donor_url = $('.jq_link').text();
    $('.jq_link').html('<a href="http://'+donor_url+'">'+donor_url+'</a>');
    //== </donor link convert> ==//
    
    goods_order_link(); //light order link
    
    //<липкий блок>
    $(function() {
        if( $('.breadcrumb_fixed').is(':visible') ){
            var box = $('.breadcrumb_fixed').first(); // float-fixed block
        
            var top = box.offset().top - parseFloat(box.css('marginTop').replace(/auto/, 0));
            box_height = box.outerHeight(true);
            $(window).scroll(function(){
                var windowpos = $(window).scrollTop();
                if(windowpos < top) {
                    box.removeClass('breadcrumb_fixed_active');
                    $('#breadcrumb_spacer').css({'height':'auto'});
                    if( $.browser.opera ){ box.css( {'min-width':'auto'} ) }
                } else {
                    box.addClass('breadcrumb_fixed_active');
                    $('#breadcrumb_spacer').css({'height':box_height+'px'});
                    if( $.browser.opera ){ box.css( {'min-width':'679px'} ) }
                }
            });
        }
    });
    //</липкий блок>
    
    //<breadcrumb_child_links>
    $('.bcl_a_block span').each(function(){
        $(this).append('<a href="/category/'+$(this).attr('urlname')+'/">'+$(this).attr('name')+'</a>')
    });    
    //</breadcrumb_child_links>
    
    //load check list
    $('#save_list').click(function(){
        defaultFormAction = $('#printcheck_form').attr('action'); 
        $('#printcheck_form')
                .attr('action','/savefile/goods_list/')
                .submit()
                .attr('action',defaultFormAction);
    });
    
    $('#load_filelist_btn').click(function(){
        if( $('#load_check_filelist').attr('value') == false ){
            return;
        }
        
        defaultFormAction = $('#printcheck_form').attr('action'); 
        $('#printcheck_form')
                .attr('action','')
                .attr('target','_self')
                .submit();
    });
       
});

//гарантийный талон (печать чека)
function show_wrnt_input(){
    //== гарантийный талон (печать чека) ==// 
    
        if( $('#printcheck_form input[name=print_wrnt]:checked').length > 0 )
            $('.wrnt_input_block').addClass('wrnt_input_block_show');
        else
            $('.wrnt_input_block').removeClass('wrnt_input_block_show');
    //== /гарантийный талон (печать чека) ==//
}



//<basket>
function del_goods_from_basket(element){
    $(element).closest('.ab_goods_block').animate(
        {height:'0', opacity: '0'},
        100, 
        function(){
            $(this).remove();
            re_summ_basket();
        });
}
function re_summ_basket(){
    inputObj = $('.ajax_basket input');
    resultSumm = 0;
    for(i=0; i<inputObj.length; i++){
        thisInput   = $(inputObj[i]);
        thisBlock   = $(thisInput).closest('.ab_right_block');
        cntGoods    = $(thisInput).attr('value');
        priceGoods  = $(thisInput).attr('price');
        summ        = cntGoods * priceGoods;
        if( isNaN(summ) || cntGoods < 1) summ = 0;
        resultSumm  = resultSumm + summ;
        
        $('.ab_goods_summ span', thisBlock).text( summ.toFixed(2) );
    }
    $('.result_price b').text( resultSumm.toFixed(2) );
    
    re_write_basket_cookie();
    update_menu_basket(); //обновление корзины
}


function re_write_basket_cookie(){
    inputObj = $('.ajax_basket input');
    result_ar = new Object();
    for(i=0; i<inputObj.length; i++){
        thisInput   = $(inputObj[i]);
        cntGoods    = $(thisInput).attr('value');
        idGoods     = $(thisInput).attr('name');
        
        result_ar[idGoods] = cntGoods;
    }
//    console.log(result_ar);
    cookieStr = $.toJSON(result_ar);
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
  var results = document.cookie.match ( '(^|;) ?' + cookie_name + '=([^;]*)(;|$)' );
 
  if ( results )
    return ( unescape ( results[2] ) );
  else
    return null;
}

function update_menu_basket(){
    $.post(
        '/ajax/basket/update_menu/',
        {},
        function(data){
            $('#menu_basket_goods').text( data['cnt_goods'] );
            $('#menu_basket_price').text( data['summ_price'] );
        },
        'json'
    );
}
//</basket>

function update_menu_favorite(){
    id = $('#jq_goods_id').attr('val');
    
    $.post(
        '/ajax/goods/get_favorite/',
        {id: id},
        function(data){
            $('#ajax_favorite').html( data['html'] );
        },
        'json'
    );
}

//<order>
function show_hide_shipping(){
    if( $('.ajax_order input[type=radio][value=2]').attr('checked') == 'checked' )
        $('#shipping_block').slideDown(0);
    else
        $('#shipping_block').slideUp(0);
    
    set_center_window();
}

function check_order_form(){
    name    = $('.ajax_order input[name=name]').attr('value');
    phone   = $('.ajax_order input[name=phone]').attr('value');
    sname   = $('.ajax_order input[name=sname]').attr('value');
    thname  = $('.ajax_order input[name=thname]').attr('value');
    sklad   = $('.ajax_order textarea[name=sklad]').attr('value');
    
    if( name.length < 3 ){
        $('#order_error_msg').text('Укажите пожалуйста свое Имя');
        return false;
    }
    if( phone.length < 13 ){
        $('#order_error_msg').text('Укажите пожалуйста свой Телефон');
        return false;
    }
    
    if( $('.ajax_order input[type=radio][value=2]').attr('checked') == 'checked' ){
        if( sname.length < 4 ){
            $('#order_error_msg').text('Укажите пожалуйста свою Фамилию');
            return false;
        }
        if( thname.length < 4 ){
            $('#order_error_msg').text('Укажите пожалуйста свое Отчество');
            return false;
        }
        if( sklad.length < 5 ){
            $('#order_error_msg').text('Укажите пожалуйста адрес доставки');
            return false;
        }
    }
    return true;
}
//<order>


//<message>
function check_message_form(){
    name    = $('.ajax_order input[name=name]').attr('value');
    phone   = $('.ajax_order input[name=phone]').attr('value');
    mail    = $('.ajax_order input[name=mail]').attr('value');
    message = $('.ajax_order textarea[name=message]').attr('value');
    
    if( name.length < 3 ){
        $('#order_error_msg').text('Укажите пожалуйста свое Имя');
        return false;
    }
    if( phone.length < 13 && mail.length < 5 ){
        $('#order_error_msg').text('Укажите Ваш E-mail и/или Телефон');
        return false;
    }
    if( message.length < 30 ){
        $('#order_error_msg').text('Напишите чуть более длинное сообщение ');
        return false;
    }
    
    
    return true;
}
//</message>

function input_check_phone( input ){
    nbrStr = $( input ).attr('value');
    newNbrStr =  nbrStr.replace(/[^0-9\+]/g, '');
    $( input ).attr('value', newNbrStr);
//    alert( nbrStr +' - '+newNbrStr );
}

function goods_order_link(){
    order_val = $('#order_goods_block').attr('rel');
    $('a#'+order_val).addClass('active');
}

function set_center_window(){
    window_h        = $('#modal_bg').innerHeight();
    modal_block_h   = $('#modal_dialog_block').innerHeight();
    modal_margin_top = ( window_h - modal_block_h ) / 2; 
    $('#modal_dialog_block').animate({'margin-top':modal_margin_top+'px'}, 400);
}
