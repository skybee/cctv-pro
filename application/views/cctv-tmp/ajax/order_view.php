<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<form method="post" action="/ajax/basket/send_order/" id="ajax_order_form">
<div class="ajax_order">
    <table>
        <tr>
            <td style="width: 150px;"></td>
            <td style="color:#12354E;"><b>Сумма заказа - <?= number_format($summ, 2, '.', ' ')?> грн.</b></td>
        </tr>
        <tr>
            <td style="width: 150px;">Имя:</td>
            <td><input type="text" name="name" /> <font color="#f00" size="3">*</font> </td>
        </tr>
        <tr>
            <td style="width: 150px;">Фамилия:</td>
            <td><input type="text" name="sname" /> <font color="#f00" size="3">*</font> </td>
        </tr>
        <tr>
            <td>Отчество:</td>
            <td><input type="text" name="thname" /> <font color="#f00" size="3">*</font> </td>
        </tr>
        <tr>
            <td>Телефон:</td>
            <td><input type="text" name="phone" placeholder="+380XXXXXXX"  onkeyup="input_check_phone(this)" /> <font color="#f00" size="3">*</font> </td>
        </tr>
        <tr>
            <td>E-mail:</td>
            <td><input type="text" name="mail" /></td>
        </tr>
        <tr>
            <td id="order_new_post_notice">
                Склад "Новой Почты":<br />
                <a href="http://novaposhta.com.ua/frontend/warenhouses/ru" target="_blank" style="font-size: 12px; line-height: 5px;">Списов отделений</a>
            </td>
            <td><input type="text" name="sklad" placeholder="Город и № отделения" /> <font color="#f00" size="3">*</font></td>
        </tr>
        <tr>
            <td>Комментарий к заказу:</td>
            <td><textarea name="comment"></textarea></td>
        </tr>
        <tr>
            <td colspan="2" class="shipping">
                <span>Доставка</span><br />
                <div>
                    Доставка товаров осуществляется курьерской службой <a href="http://novaposhta.com.ua/site/index/ru" target="_blank">"Новая Почта"</a><br />
                    Доставка в регионы Украины возможна при сумме заказа <b>от 300 грн</b>.<br />
                    Доставка производится за счет покупателя, согласно тарифам  курьерской службы.
                </div>
            </td>
        </tr>
        <!--
        <tr>
            <td>Самовывоз (Харьков)</td>
            <td><input type="radio" name="order" value="1" checked="checked" style="width: 20px;" onchange="show_hide_shipping()" /></td>
        </tr>
        <tr <?php if($summ < 300 ) echo ' style="opacity:0.75;" ' ?> >
            <td>Доставка в другой город</td>
            <td>
                <input type="radio" name="order" value="2" style="width: 20px;" onchange="show_hide_shipping()" <?php if($summ < 300 ) echo ' disabled="disabled" ' ?>  />
                <?php if($summ < 300 ) echo ' <i>* возможна при сумме заказа от 300 грн.</i> ' ?>
            </td>
        </tr>
        -->
        
        <input type="hidden" value="2" name="order" />
        
    </table>
    <!--
    <div id="shipping_block">
        <table>
            <tr>
                <td style="width: 150px;">Фамилия:</td>
                <td><input type="text" name="sname" /> <font color="#f00" size="3">*</font> </td>
            </tr>
            <tr>
                <td>Отчество:</td>
                <td><input type="text" name="thname" /> <font color="#f00" size="3">*</font> </td>
            </tr>
            <tr>
                <td id="order_new_post_notice">
                    Склад "Новой Почты":<br />
                    <font color="#f00" ><span id="new_post_notice">Укажите город и № склада</span></font><br />
                    <a href="http://novaposhta.com.ua/frontend/warenhouses/ru" target="_blank" style="font-size: 12px; line-height: 5px;">Списов складов</a>
                </td>
                <td><textarea name="sklad" style="height: 40px;"></textarea> <font color="#f00" size="3">*</font></td>
            </tr>
        </table>
    </div>
    -->
</div>
</form>

<div class="ajax_btn_block">
    <div id="order_error_msg"></div>
    <a href="javascript:void(0)" style="line-height: 33px;" onclick="send_post('', '/ajax/basket/show_basket/', {title:'Обработка данных',content:'loader'})">&larr; Вернуться к корзине</a>
    <a href="javascript:void(0)" class="mybtn" onclick="if( check_order_form() ) send_form('#ajax_order_form', {title:'Обработка данных',content:'loader'})">Заказ подтверждаю</a>
</div>