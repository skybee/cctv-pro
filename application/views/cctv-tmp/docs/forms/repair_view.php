<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class="col-main col-xs-12 col-sm-9">
    <div class="padding-s">
        
        <div class="std docs_form">
            <h1>Создание и печать талона о приеме на ремонт</h1>

            <form action="/print_docs/prnt_doc/repair/" target="_blank" method="post" id="printcheck_form" >
                
                <input type="hidden" name="headTpl" value="logo" />
                
                <div class="select_flp">
                    <span>Выбор ФЛП:</span>
                    
                    <label>
                        <input type="radio" name="flp" value="tor" />
                        Торяник П.Е.
                    </label>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <label>
                        <input type="radio" name="flp" value="pan" checked="checked" />
                        Панасенко И.С.
                    </label>
                </div>
                
                <div class="checkname_select_block">
                    <select name="checkname">
                        <option value="гарантийный ремонт">Гарантийный ремонт</option>
                        <option value="платный ремонт">Платный ремонт</option>
                    </select>
                </div>
                <table id="check_tbl">
                    <tr>
                        <td>№</td>
                        <td>Наименование</td>
                        <td>Сер.№</td>
                        <td>Кол-во</td>
                    </tr>
                    <tr>
                        <td>1.</td>
                        <td><input type="text" name="name[]" style="width: 250px;" /></td>
                        <td><input type="text" name="wrnt_number[]" style="width: 170px;" /></td>
                        <td><input type="text" name="count[]" value="1" /></td>
                    </tr>
                </table>
                <div id="check_btn_block">
                    <input type="button" id="add_line" value=" Добавить строку " />
                    <input type="submit" value=" Сформировать талон " />
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    Дата: <input type="text" name="date" value="<?=$doc_data['date']?>" width="120px" />
                </div>
            </form>

        </div>
    </div>
</div>