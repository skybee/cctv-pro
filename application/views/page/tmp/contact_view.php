
<div class="contact_block">
    <p>
        Если Вы хотите заказать у нас услугу или товар, либо получить консультацию, свяжитесь с нами <br />
        по телефону или e-mail, либо напишите нам используя форму обратной связи, расположенную ниже.
    </p>
    <table class="contact_tbl">
        <tr>
            <td class="ct_first_td">
                Адрес:
            </td>
            <td>
                г. Харьков, пр-т. Ленина 40/3, офис 345
            </td>
        </tr>
        <tr>
            <td class="ct_first_td">
                Время работы:
            </td>
            <td>
                Понедельник - Суббота 09:00 - 18:00
            </td>
        </tr>
        <tr>
            <td class="ct_first_td">
                E-mail:
            </td>
            <td>
                mail@cctv-pro.com.ua
            </td>
        </tr>
        <tr>
            <td class="ct_first_td">
                Телефон:
            </td>
            <td>
                (057) 759-56-81
            </td>
        </tr>
        <tr>
            <td class="ct_first_td">
            </td>
            <td>
                (098) 427-01-25
            </td>
        </tr>
        <tr>
            <td>
            </td>
            <td>
                <a href="javascript:void(0)"onclick="alert('В данный момент форма недоступна')">
                    Написать через форму обратной связи
                </a>
            </td>
        </tr>
    </table>

    <div class="contact_map_block">
        <center>

        <!-- Этот блок кода нужно вставить в ту часть страницы, где вы хотите разместить карту (начало) -->
        <div id="ymaps-map-id_134920912352626934352" style="width: 632px; height: 386px;"></div>
<!--        <div style="width: 600px; text-align: right;"><a href="http://api.yandex.ru/maps/tools/constructor/?lang=ru-RU" target="_blank" style="color: #1A3DC1; font: 13px Arial,Helvetica,sans-serif;">Создано с помощью инструментов Яндекс.Карт</a></div>-->
        <script type="text/javascript">
            function fid_134920912352626934352(ymaps) {
                var map = new ymaps.Map("ymaps-map-id_134920912352626934352", {
                    center: [36.224318973921704, 50.02491091855051],
                    zoom: 15,
                    type: "yandex#map"
                });
                map.controls
                .add("zoomControl")
                .add("mapTools")
                .add(new ymaps.control.TypeSelector(["yandex#map", "yandex#satellite", "yandex#hybrid", "yandex#publicMap"]));
                map.geoObjects
                .add(new ymaps.Placemark([36.22466229667545, 50.023677347688796], {
                    balloonContent: "House Control"
                }, {
                    preset: "twirl#blueDotIcon"
                }));
            };
        </script>
        <script type="text/javascript" src="http://api-maps.yandex.ru/2.0/?coordorder=longlat&load=package.full&wizard=constructor&lang=ru-RU&onload=fid_134920912352626934352"></script>
        <!-- Этот блок кода нужно вставить в ту часть страницы, где вы хотите разместить карту (конец) -->
        </center>
    </div>
</div>