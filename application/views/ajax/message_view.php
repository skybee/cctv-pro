<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<form method="post" action="/ajax/message/send_message/" id="ajax_order_form">
<div class="ajax_order message_form">
    <table>
        <tr>
            <td style="width: 120px;">Имя:</td>
            <td><input type="text" name="name" /></td>
        </tr>
        <tr>
            <td>Телефон:</td>
            <td><input type="text" name="phone" value="+380" onkeyup="input_check_phone(this)" /></td>
        </tr>
        <tr>
            <td>E-mail:</td>
            <td><input type="text" name="mail" /></td>
        </tr>
        <tr>
            <td style="height: 20px;"></td>
            <td></td>
        </tr>
        <tr>
            <td>Тема сообщения:</td>
            <td><input type="text" name="subject" style="width: 450px;" /></td>
        </tr>
        <tr>
            <td>Текст сообщения:</td>
            <td><textarea name="message" style="height: 120px;"></textarea></td>
        </tr>
    </table>
    
    </div>
</div>
</form>

<div class="ajax_btn_block">
    <div id="order_error_msg"></div>
    <a href="javascript:void(0)" class="mybtn" onclick="if( check_message_form() ) send_form('#ajax_order_form', {title:'Отправка сообщения',content:'loader'})">Отправить</a>
</div>