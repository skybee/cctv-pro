/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */



function send_form( formId, modalTxtObj, actionURL  ){
        
    if( actionURL == undefined ){
        actionURL = $( formId ).attr('action');
    }
    
    $( formId ).ajaxSubmit({
        type:           'post',
        dataType:       'json',
        url:            actionURL,
        beforeSubmit:   function(){
            show_modal( modalTxtObj.title, modalTxtObj.content );
        },
        success:        function( anserAr ){
            show_modal( anserAr['title'], anserAr['content'], anserAr['close_link'] );
            
            if( anserAr['script'] )
                eval(anserAr['script']);
        }
    });
}

function send_post(dataObj, url, modalTxtObj ){
    show_modal( modalTxtObj.title, modalTxtObj.content);
    
    $.post(
            url, 
            dataObj,
            function(anserAr){
                show_modal( anserAr['title'], anserAr['content'], anserAr['close_link']);
        
            if( anserAr['script'] )
                eval(anserAr['script']);
            },
            'json'
     )
    .error(function() {show_modal( 'Произошла ошибка', 'Попробуйте повторить действие еще раз, либо перегрузить страницу')})
}


function show_modal( title, content, close_link){
    
    
    if( content == 'loader' ) content = '<div id="modal_loader"></div>';
    if( close_link ){
        $('#modal_bg').attr('reload', close_link);
    }
    
    
    $('#modal_dialog_title')    .html(title);
    $('#modal_dialog_content')  .html(content);
    
    $('#modal_bg').css({'display':'block'})
    
    window_h        = $('#modal_bg').innerHeight();
    modal_block_h   = $('#modal_dialog_block').innerHeight();
    modal_margin_top = ( window_h - modal_block_h ) / 2; 
    
    $('#modal_dialog_block').css({'margin-top':modal_margin_top+'px'});
    $('#modal_bg').animate({opacity: 1}, 400, function(){
        $('#modal_dialog_block').animate({'opacity': '1'}, 500);
    });
    
}


function close_modal(){
    $('#modal_bg').animate({opacity: 0}, 100, function(){
        $('#modal_bg').css({'display':'none'});
        $('#modal_dialog_block').css({'opacity':'0', 'margin-top':'0px'});
        $('#modal_dialog_title, #modal_dialog_content').empty();
    });
    
    //== перенаправление на другой URL ==//
    r_link = $('#modal_bg').attr('reload');
    if( r_link ){window.location.href = r_link;}
}


function ajax_update( update_block_selector, url){
    $.get(url)
    .success(function(data){
        $(update_block_selector).html(data);
        set_jq_style();
        set_jq_action();
    })
    .error(function() {show_modal( 'Ошибка обновления страницы', 'Попробуйте перегрузить страницу')})
}



