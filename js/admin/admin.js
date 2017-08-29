/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


$(document).ready(function() {
    
    
    $('.show_lang').toggle(
            function() {
//                $('.couers_list').slideUp(200);
//                $('.show_lang').css({'background-image': "none"});
                
                $(this).next('.couers_list').slideDown(200);
                $(this).css({'background-image': "url('/img/admin_couers_arrow.png')"});
            },
            function() {
                $(this).next('.couers_list').slideUp(200);
                $(this).css({'background-image': "none"});
            });

//    $(".datepicker").datepicker({
//        dateFormat: "dd.mm.yy"
//    });

    // <load page>
    $('body').on('click', '.ajax_load',function() {
        link = $(this).attr('href');

        $('#right_content_block').load(link, {}, function() {
            ajax_init();
            $('#right_content_block').animate({opacity:'1'}, 600);
        }).animate({opacity:'0.2'}, 400);
        $('.ajax_load').removeClass('active_page');
        $(this).addClass('active_page');

        return false;
    });
    // </load page>
    
    //<multiply_price>
    $('body').on('click', '#multiply_price_do', function(){
        
        multiplier = $('#multiply_price_input').val();
        
        chbox_obj = $('.goods_list_checkbox:checked');
        
        for( i=0; i<chbox_obj.length; i++ ){
            price_input_obj = $('input[type=text]', $(chbox_obj[i]).closest('tr') );
            old_price = $(price_input_obj).val();
            new_price = old_price * multiplier;
            new_price = new_price.toFixed(2);
            $(price_input_obj).val( new_price);
        }
    });
    //<multiply_price>
    
    $('body').on('click', '#show_del_goods', function(){
        $('.goods_list_tr').css({display:'table-row'});
    });
    
    $('body').on('click','#show_goods_list_cat', function(){
        if( $('.goods_list_category').is(':visible') ){
            $('.goods_list_category').slideUp();
        }
        else{
            $('.goods_list_category').slideDown();
        }
    });
    
    //<select all goods>
    $('body').on('change','#goods_listchange_all',function(){
        if( $('#goods_listchange_all').is(':checked') )
            $('.goods_list_checkbox').prop('checked', true );
        else
            $('.goods_list_checkbox').prop('checked', false );
    });
    //<select all goods>
    

    $('body').on('click','.add_competitors_line', function(){
        html = $('.competitors_tpl').html();
        $('.competitors_list').append( html );
    });
    
    

    ajax_init();
});

function ajax_init() {
//    tinyMCE.init({
//        mode: "exact",
//        elements: "seo_text, t_mce_1, t_mce_2, t_mce_3",
//        theme_advanced_buttons1: "bold,italic,underline,forecolor,|,formatselect,|,link,unlink,|,bullist,numlist,|,code",
//        theme_advanced_toolbar_location: "top",
//        theme_advanced_toolbar_align: "left",
//        theme_advanced_statusbar_location: "bottom",
//        theme_advanced_resizing: true,
//        force_br_newlines: true,
//        force_p_newlines: false,
//        forced_root_block: '',
//        theme_advanced_blockformats: 'p,h2',
//        content_css: "/css/style.css"
//    });

//    $(".datepicker").datepicker({
//        dateFormat: "dd.mm.yy"
//    });


    //<test tabs>
//    $('.test_tabs').tabs();
//    $('.test_tabs2').tabs();
    //</test tabs>
    
    tinymce.init({
        selector: ".tinymce",
        language : 'ru',
        plugins: [
        "advlist autolink lists link image charmap print preview anchor",
        "searchreplace visualblocks code fullscreen table"
        ],
        toolbar1: "insertfile undo redo | table_clone_elements | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
        valid_elements : "strong/b,br,tr,td,table,li,ul,ol,p,span,h2,h3,iframe[name|src|framespacing|border|frameborder|scrolling|title|height|width]"
    });


    //<удаление изображения>
    $('.upload_img_li .del_img').click(function() {
        imgId = $(this).attr('val');
        $.get('/admin/del_image/' + imgId);
        $(this).closest('.upload_img_li').remove();
    });
    //</удаление изображения>


    //<выбор файла изображения>
    $('.load_img_block input[name=file]').click(function() {
        $('.load_img_block input[type=file]').click();
    });
    $('.load_img_block input[type=file]').change(function() {
        $('.load_img_block input[name=file]').attr('value', $(this).attr('value'));
    })
    //</выбор файла изображения>


    //<изображение в промо>
//    $('select[name=promo_image]').change(function() { //добавление изображения к странице
//        var imgId = $('option:selected', this).attr('value');
//        var imgName = $('option:selected', this).text();
//        var pageId = $('input[name=id]').attr('value');
//
//        if (imgId == 0)
//            return false;
//
//
//        $.post('/admin/add_img_to_page/', {page_id: pageId, img_id: imgId}, function() {
//            $('.promo_img_list').prepend('<li><a href="javascript:void(0)" class="del_img" val="' + imgId + '"></a> <a href="/upload/promo_img/' + imgName + '" target="_blank">' + imgName + '</a></li>');
//            ajax_init();
//        });
//
//    });

    $('.promo_img_list .del_img').click(function() {// открепление изображения от страницы
        var thisA = $(this);
        var imgId = $(this).attr('val');
        var pageId = $('input[name=id]').attr('value');

        $.post('/admin/del_img_from_page/', {page_id: pageId, img_id: imgId}, function() {
            $(thisA).closest('li').remove();
        });
    });
    //<изображение в промо>

    //<переключение табов(баннер)>
    $('#tabs .volonter_nabor_right a').click(function() {
        block_id = $(this).attr('href');
        link_nbr = $(this).attr('nbr');

        $('.tabs').css({display: 'none'});
        $(block_id).css({display: 'block'});
        $('#tabs_nbr').text(link_nbr);

        return false;
    });
    //</переключение табов(баннер)>
    
    $("body").animate({"scrollTop":0},"slow");
}

function add_img_to_promo( select ) {
    var imgId   = $('option:selected', select).attr('value');
    var imgName = $('option:selected', select).text();
    var pageId  = $('input[name=id]').attr('value');

    if (imgId == 0)
        return false;


    $.post('/admin/add_img_to_page/', {page_id: pageId, img_id: imgId}, function() {
        $('.promo_img_list').prepend('<li><a href="javascript:void(0)" class="del_img" val="' + imgId + '"></a> <a href="/upload/promo_img/' + imgName + '" target="_blank">' + imgName + '</a></li>');
        ajax_init();
    });
}