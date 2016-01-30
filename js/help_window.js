/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


function set_help_window_cookie(){
    help_window = getCookie('help_window');
    
//    alert(help_window);
    
    if( help_window == null ) help_window = 0;
    
    help_window = parseInt(help_window);
    
    help_window = help_window + 1;
    
    if( help_window >= 4 ){ //показ окошка и сброс счетчика просмотренных товаров
        setTimeout(show_help_window,2000);
        setCookie('help_window', 0, 1, '/' );
    }
    else{ //увеличение счетчика просмотреных товаров
        setCookie('help_window', help_window, 1, '/' );
    }
}

function show_help_window(){
//    $('#help_window').css({display:'block'});
//    audio = $('#hw_audio')[0];
//    audio.play();
    $('#help_window').animate({bottom:'10px'},400);   
}

function close_help_window(){
    $('#help_window').animate({bottom:'-220px'},400/*,function(){
        $('#help_window').css({display:'none'});
    }*/);
}

$(document).ready(function(){
    set_help_window_cookie();
});
