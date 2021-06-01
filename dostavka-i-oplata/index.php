<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Доставка и оплата");


$APPLICATION->IncludeComponent("bitrix:breadcrumb", "breadcrumbs", array(
    "START_FROM" => "0",    // Номер пункта, начиная с которого будет построена навигационная цепочка
    "PATH" => "",    // Путь, для которого будет построена навигационная цепочка (по умолчанию, текущий путь)
    "SITE_ID" => "s1",    // Cайт (устанавливается в случае многосайтовой версии, когда DOCUMENT_ROOT у сайтов разный)
),
    false
);
?>
    <div class="page-content">
        <div class="page-content__container page-content__container--lg">
            <h1 class="page-content__title">Доставка и оплата</h1>
            <div class="page-content__text">

                <h2>Доставка</h2>
                <p>Мы осуществляем доставку товаров по всей России. В большинстве городов возможны следующие варианты
                    доставки:</p>
                <ol>
                    <li>Пункты выдачи (оплата при получении или при оформлении заказа на сайте).</li>
                    <li>Доставка курьером (оплата при получении или при оформлении заказа на сайте).</li>
                    <li>Доставка Почтой России (оплата при оформлении заказа на сайте).</li>
                </ol>
                <p>Сроки и стоимость доставки зависят от населенного пункта и отображаются при оформлении заказа.<br>
                    Все сроки указаны в рабочих днях.</p>
                <p><strong>Адреса пунктов выдачи</strong></p>
                <p>Москва: <a href="https://boxberry.ru/find_an_office/" target="_blank">по ссылке</a><br>
                    Остальные города России: <a href="https://boxberry.ru/find_an_office/ + https://cdek.ru/offices/map"
                                                target="_blank">по ссылке</a></p>

                <p><strong>Бесплатная доставка</strong></p>
                <p>В пункты выдачи - при заказе от 5000 рублей (действует не во всех городах).<br>
                    Курьером - при заказе от 5500 рублей (действует не во всех городах).<br>
                    Почтой России - при заказе от 5000 рублей и предоплате (за исключением удаленных населенных
                    пунктов).</p>

                <h2>Оплата заказа</h2>
                <p>Вы можете оплатить заказ банковской картой прямо на нашем сайте либо при получении – наличными или
                    картой. Возможность оплаты картой в конкретном пункте выдачи уточняйте на сайте транспортной
                    компании.</p>
                <p>При доставке Почтой России возможна только предоплата.</p>
                <p>Юридические лица и индивидуальные предприниматели могут оплатить заказ по безналичному расчету. Мы
                    работаем без НДС.</p>
                <br>

            </div>
        </div>
    </div>

    <div class="contacts-f">
        <div class="container">
            <h2 class="contacts-f__title">Контакты</h2>
            <div class="contacts-f__list">
                <div class="contacts-f__item">
                    <div class="contacts-f__label contacts-f__label--adress">
                        <? $APPLICATION->IncludeComponent(
                            "bitrix:main.include",
                            "",
                            array(
                                "AREA_FILE_SHOW" => "file",
                                "AREA_FILE_SUFFIX" => "inc",
                                "EDIT_TEMPLATE" => "",
                                "PATH" => SITE_TEMPLATE_PATH . "/include_areas/main_adress.php"
                            )
                        ); ?>
                    </div>
                </div>
                <div class="contacts-f__item">
                    <div class="contacts-f__label contacts-f__label--phone contacts-f__label--black">
                        <? $APPLICATION->IncludeComponent(
                            "bitrix:main.include",
                            "",
                            array(
                                "AREA_FILE_SHOW" => "file",
                                "AREA_FILE_SUFFIX" => "inc",
                                "EDIT_TEMPLATE" => "",
                                "PATH" => SITE_TEMPLATE_PATH . "/include_areas/main_phone.php"
                            )
                        ); ?>
                    </div>
                </div>
                <div class="contacts-f__item">
                    <div class="contacts-f__label contacts-f__label--social">

                        <? $APPLICATION->IncludeComponent(
                            "bitrix:main.include",
                            "",
                            array(
                                "AREA_FILE_SHOW" => "file",
                                "AREA_FILE_SUFFIX" => "inc",
                                "EDIT_TEMPLATE" => "",
                                "PATH" => SITE_TEMPLATE_PATH . "/include_areas/main_mi_sotial.php"
                            )
                        ); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script type="text/javascript">
        document.getElementsByTagName('main')[0].className += " main--brown"
    </script>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>