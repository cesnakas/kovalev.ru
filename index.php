<?
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php');
$APPLICATION->SetTitle("Главная");

?>
<?

$APPLICATION->IncludeComponent(
    "bitrix:news.list",
    "main_slider",
    array(
        "ACTIVE_DATE_FORMAT" => "d.m.Y",
        "ADD_SECTIONS_CHAIN" => "N",
        "AJAX_MODE" => "N",
        "AJAX_OPTION_ADDITIONAL" => "",
        "AJAX_OPTION_HISTORY" => "N",
        "AJAX_OPTION_JUMP" => "N",
        "AJAX_OPTION_STYLE" => "Y",
        "CACHE_FILTER" => "N",
        "CACHE_GROUPS" => "Y",
        "CACHE_TIME" => "36000000",
        "CACHE_TYPE" => "A",
        "CHECK_DATES" => "Y",
        "DETAIL_URL" => "",
        "DISPLAY_BOTTOM_PAGER" => "N",
        "DISPLAY_DATE" => "Y",
        "DISPLAY_NAME" => "Y",
        "DISPLAY_PICTURE" => "Y",
        "DISPLAY_PREVIEW_TEXT" => "Y",
        "DISPLAY_TOP_PAGER" => "N",
        "FIELD_CODE" => array("ID", "CODE", "NAME", "SORT", "PREVIEW_TEXT", "PREVIEW_PICTURE", "DETAIL_TEXT", "DETAIL_PICTURE", ""),
        "FILTER_NAME" => "",
        "HIDE_LINK_WHEN_NO_DETAIL" => "N",
        "IBLOCK_ID" => "2",
        "IBLOCK_TYPE" => "content",
        "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
        "INCLUDE_SUBSECTIONS" => "Y",
        "MESSAGE_404" => "",
        "NEWS_COUNT" => "20",
        "PAGER_BASE_LINK_ENABLE" => "N",
        "PAGER_DESC_NUMBERING" => "N",
        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
        "PAGER_SHOW_ALL" => "N",
        "PAGER_SHOW_ALWAYS" => "N",
        "PAGER_TEMPLATE" => ".default",
        "PAGER_TITLE" => "Новости",
        "PARENT_SECTION" => "",
        "PARENT_SECTION_CODE" => "",
        "PREVIEW_TRUNCATE_LEN" => "",
        "PROPERTY_CODE" => array("HREF", "TYPE", ""),
        "SET_BROWSER_TITLE" => "N",
        "SET_LAST_MODIFIED" => "N",
        "SET_META_DESCRIPTION" => "N",
        "SET_META_KEYWORDS" => "N",
        "SET_STATUS_404" => "N",
        "SET_TITLE" => "N",
        "SHOW_404" => "N",
        "SORT_BY1" => "SORT",
        "SORT_BY2" => "NAME",
        "SORT_ORDER1" => "ASC",
        "SORT_ORDER2" => "ASC",
        "STRICT_SECTION_CHECK" => "N"
    )
);

?>
<?
global $mainElementFilter;
$mainElementFilter = array("IBLOCK_SECTION_ID" => "1");
$APPLICATION->IncludeComponent("bitrix:catalog.section", "main", array(
    "TITLE" => "Сборы лекарственных трав",
    "ACTION_VARIABLE" => "action",    // Название переменной, в которой передается действие
    "ADD_PICT_PROP" => "-",    // Дополнительная картинка основного товара
    "ADD_PROPERTIES_TO_BASKET" => "Y",    // Добавлять в корзину свойства товаров и предложений
    "ADD_SECTIONS_CHAIN" => "N",    // Включать раздел в цепочку навигации
    "ADD_TO_BASKET_ACTION" => "ADD",    // Показывать кнопку добавления в корзину или покупки
    "AJAX_MODE" => "N",    // Включить режим AJAX
    "AJAX_OPTION_ADDITIONAL" => "",    // Дополнительный идентификатор
    "AJAX_OPTION_HISTORY" => "N",    // Включить эмуляцию навигации браузера
    "AJAX_OPTION_JUMP" => "N",    // Включить прокрутку к началу компонента
    "AJAX_OPTION_STYLE" => "Y",    // Включить подгрузку стилей
    "BACKGROUND_IMAGE" => "-",    // Установить фоновую картинку для шаблона из свойства
    "BASKET_URL" => "/personal/basket.php",    // URL, ведущий на страницу с корзиной покупателя
    "BROWSER_TITLE" => "-",    // Установить заголовок окна браузера из свойства
    "CACHE_FILTER" => "N",    // Кешировать при установленном фильтре
    "CACHE_GROUPS" => "Y",    // Учитывать права доступа
    "CACHE_TIME" => "36000000",    // Время кеширования (сек.)
    "CACHE_TYPE" => "A",    // Тип кеширования
    "COMPATIBLE_MODE" => "Y",    // Включить режим совместимости
    "CONVERT_CURRENCY" => "N",    // Показывать цены в одной валюте
    "CUSTOM_FILTER" => "{\"CLASS_ID\":\"CondGroup\",\"DATA\":{\"All\":\"AND\",\"True\":\"True\"},\"CHILDREN\":[]}",
    "DETAIL_URL" => "",    // URL, ведущий на страницу с содержимым элемента раздела
    "DISABLE_INIT_JS_IN_COMPONENT" => "N",    // Не подключать js-библиотеки в компоненте
    "DISPLAY_BOTTOM_PAGER" => "N",    // Выводить под списком
    "DISPLAY_COMPARE" => "N",    // Разрешить сравнение товаров
    "DISPLAY_TOP_PAGER" => "N",    // Выводить над списком
    "ELEMENT_SORT_FIELD" => "shows",    // По какому полю сортируем элементы
    "ELEMENT_SORT_FIELD2" => "shows",    // Поле для второй сортировки элементов
    "ELEMENT_SORT_ORDER" => "asc",    // Порядок сортировки элементов
    "ELEMENT_SORT_ORDER2" => "asc",    // Порядок второй сортировки элементов
    "ENLARGE_PRODUCT" => "STRICT",    // Выделять товары в списке
    "FILTER_NAME" => "mainElementFilter",    // Имя массива со значениями фильтра для фильтрации элементов
    "HIDE_NOT_AVAILABLE" => "Y",    // Недоступные товары
    "HIDE_NOT_AVAILABLE_OFFERS" => "Y",    // Недоступные торговые предложения
    "IBLOCK_ID" => "1",    // Инфоблок
    "IBLOCK_TYPE" => "catalog",    // Тип инфоблока
    "INCLUDE_SUBSECTIONS" => "Y",    // Показывать элементы подразделов раздела
    "LABEL_PROP" => "",    // Свойства меток товара
    "LAZY_LOAD" => "N",    // Показать кнопку ленивой загрузки Lazy Load
    "LINE_ELEMENT_COUNT" => "3",    // Количество элементов выводимых в одной строке таблицы
    "LOAD_ON_SCROLL" => "N",    // Подгружать товары при прокрутке до конца
    "MESSAGE_404" => "",    // Сообщение для показа (по умолчанию из компонента)
    "MESS_BTN_ADD_TO_BASKET" => "Купить",    // Текст кнопки "Добавить в корзину"
    "MESS_BTN_BUY" => "Купить",    // Текст кнопки "Купить"
    "MESS_BTN_DETAIL" => "Подробнее",    // Текст кнопки "Подробнее"
    "MESS_BTN_SUBSCRIBE" => "Подписаться",    // Текст кнопки "Уведомить о поступлении"
    "MESS_NOT_AVAILABLE" => "Нет в наличии",    // Сообщение об отсутствии товара
    "META_DESCRIPTION" => "-",    // Установить описание страницы из свойства
    "META_KEYWORDS" => "-",    // Установить ключевые слова страницы из свойства
    "OFFERS_FIELD_CODE" => array(    // Поля предложений
        0 => "",
        1 => "",
    ),
    "OFFERS_LIMIT" => "5",    // Максимальное количество предложений для показа (0 - все)
    "OFFERS_SORT_FIELD" => "sort",    // По какому полю сортируем предложения товара
    "OFFERS_SORT_FIELD2" => "id",    // Поле для второй сортировки предложений товара
    "OFFERS_SORT_ORDER" => "asc",    // Порядок сортировки предложений товара
    "OFFERS_SORT_ORDER2" => "desc",    // Порядок второй сортировки предложений товара
    "PAGER_BASE_LINK_ENABLE" => "N",    // Включить обработку ссылок
    "PAGER_DESC_NUMBERING" => "N",    // Использовать обратную навигацию
    "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",    // Время кеширования страниц для обратной навигации
    "PAGER_SHOW_ALL" => "N",    // Показывать ссылку "Все"
    "PAGER_SHOW_ALWAYS" => "N",    // Выводить всегда
    "PAGER_TEMPLATE" => ".default",    // Шаблон постраничной навигации
    "PAGER_TITLE" => "Товары",    // Название категорий
    "PAGE_ELEMENT_COUNT" => "3",    // Количество элементов на странице
    "PARTIAL_PRODUCT_PROPERTIES" => "N",    // Разрешить добавлять в корзину товары, у которых заполнены не все характеристики
    "PRICE_CODE" => array(    // Тип цены
        0 => "BASE",
    ),
    "PRICE_VAT_INCLUDE" => "Y",    // Включать НДС в цену
    "PRODUCT_BLOCKS_ORDER" => "price,props,sku,quantityLimit,quantity,buttons",    // Порядок отображения блоков товара
    "PRODUCT_DISPLAY_MODE" => "N",    // Схема отображения
    "PRODUCT_ID_VARIABLE" => "id",    // Название переменной, в которой передается код товара для покупки
    "PRODUCT_PROPS_VARIABLE" => "prop",    // Название переменной, в которой передаются характеристики товара
    "PRODUCT_QUANTITY_VARIABLE" => "quantity",    // Название переменной, в которой передается количество товара
    "PRODUCT_ROW_VARIANTS" => "[{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false}]",    // Вариант отображения товаров
    "PRODUCT_SUBSCRIPTION" => "Y",    // Разрешить оповещения для отсутствующих товаров
    "RCM_PROD_ID" => $_REQUEST["PRODUCT_ID"],    // Параметр ID продукта (для товарных рекомендаций)
    "RCM_TYPE" => "personal",    // Тип рекомендации
    "SECTION_CODE" => "",    // Код раздела
    "SECTION_ID" => $_REQUEST["SECTION_ID"],    // ID раздела
    "SECTION_ID_VARIABLE" => "SECTION_ID",    // Название переменной, в которой передается код группы
    "SECTION_URL" => "",    // URL, ведущий на страницу с содержимым раздела
    "SECTION_USER_FIELDS" => array(    // Свойства раздела
        0 => "",
        1 => "",
    ),
    "SEF_MODE" => "N",    // Включить поддержку ЧПУ
    "SET_BROWSER_TITLE" => "N",    // Устанавливать заголовок окна браузера
    "SET_LAST_MODIFIED" => "N",    // Устанавливать в заголовках ответа время модификации страницы
    "SET_META_DESCRIPTION" => "N",    // Устанавливать описание страницы
    "SET_META_KEYWORDS" => "N",    // Устанавливать ключевые слова страницы
    "SET_STATUS_404" => "N",    // Устанавливать статус 404
    "SET_TITLE" => "N",    // Устанавливать заголовок страницы
    "SHOW_404" => "N",    // Показ специальной страницы
    "SHOW_ALL_WO_SECTION" => "N",    // Показывать все элементы, если не указан раздел
    "SHOW_CLOSE_POPUP" => "N",    // Показывать кнопку продолжения покупок во всплывающих окнах
    "SHOW_DISCOUNT_PERCENT" => "N",    // Показывать процент скидки
    "SHOW_FROM_SECTION" => "N",    // Показывать товары из раздела
    "SHOW_MAX_QUANTITY" => "N",    // Показывать остаток товара
    "SHOW_OLD_PRICE" => "N",    // Показывать старую цену
    "SHOW_PRICE_COUNT" => "1",    // Выводить цены для количества
    "SHOW_SLIDER" => "N",    // Показывать слайдер для товаров
    "SLIDER_INTERVAL" => "3000",
    "SLIDER_PROGRESS" => "N",
    "TEMPLATE_THEME" => "site",    // Цветовая тема
    "USE_ENHANCED_ECOMMERCE" => "N",    // Отправлять данные электронной торговли в Google и Яндекс
    "USE_MAIN_ELEMENT_SECTION" => "N",    // Использовать основной раздел для показа элемента
    "USE_PRICE_COUNT" => "N",    // Использовать вывод цен с диапазонами
    "USE_PRODUCT_QUANTITY" => "N",    // Разрешить указание количества товара
),
    false
); ?>

    <div class="our-values">
        <div class="container">
            <h2 class="title-section">Наши ценности</h2>
            <div class="our-values__list">
                <div class="our-values__item">
                    <div class="our-values__card">
                        <div class="our-values__img">
                            <picture>
                                <source srcset="<?= SITE_TEMPLATE_PATH ?>/img/our-values-img1.svg" type="image/webp">
                                <img src="<?= SITE_TEMPLATE_PATH ?>/img/our-values-img1.svg" alt=""/></picture>
                        </div>
                        <div class="our-values__text">
                            <? $APPLICATION->IncludeComponent(
                                "bitrix:main.include",
                                "",
                                array(
                                    "AREA_FILE_SHOW" => "file",
                                    "AREA_FILE_SUFFIX" => "inc",
                                    "EDIT_TEMPLATE" => "",
                                    "PATH" => SITE_TEMPLATE_PATH . "/include_areas/main_recept.php"
                                )
                            ); ?>
                        </div>
                    </div>
                </div>
                <div class="our-values__item">
                    <div class="our-values__card">
                        <div class="our-values__img">
                            <picture>
                                <source srcset="<?= SITE_TEMPLATE_PATH ?>/img/our-values-img2.svg" type="image/webp">
                                <img src="<?= SITE_TEMPLATE_PATH ?>/img/our-values-img2.svg" alt=""/></picture>
                        </div>
                        <div class="our-values__text">
                            <? $APPLICATION->IncludeComponent(
                                "bitrix:main.include",
                                "",
                                array(
                                    "AREA_FILE_SHOW" => "file",
                                    "AREA_FILE_SUFFIX" => "inc",
                                    "EDIT_TEMPLATE" => "",
                                    "PATH" => SITE_TEMPLATE_PATH . "/include_areas/main_recept2.php"
                                )
                            ); ?>
                        </div>
                    </div>
                </div>
                <div class="our-values__item">
                    <div class="our-values__card">
                        <div class="our-values__img">
                            <picture>
                                <source srcset="<?= SITE_TEMPLATE_PATH ?>/img/our-values-img3.svg" type="image/webp">
                                <img src="<?= SITE_TEMPLATE_PATH ?>/img/our-values-img3.svg" alt=""/></picture>
                        </div>
                        <div class="our-values__text">
                            <? $APPLICATION->IncludeComponent(
                                "bitrix:main.include",
                                "",
                                array(
                                    "AREA_FILE_SHOW" => "file",
                                    "AREA_FILE_SUFFIX" => "inc",
                                    "EDIT_TEMPLATE" => "",
                                    "PATH" => SITE_TEMPLATE_PATH . "/include_areas/main_recept3.php"
                                )
                            ); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="about-main">
        <div class="container">
            <div class="about-main__wrap">
                <div class="about-main__item about-main__item--first">
                    <div class="about-main__heading">
                        <div class="about-main__title">Георгий Матвеевич Ковалёв</div>
                    </div>
                    <div class="about-main__text">
                        <? $APPLICATION->IncludeComponent(
                            "bitrix:main.include",
                            "",
                            array(
                                "AREA_FILE_SHOW" => "file",
                                "AREA_FILE_SUFFIX" => "inc",
                                "EDIT_TEMPLATE" => "",
                                "PATH" => SITE_TEMPLATE_PATH . "/include_areas/main_family1.php"
                            )
                        ); ?>

                    </div>
                    <div class="about-main__img">
                        <picture>
                            <source srcset="<?= SITE_TEMPLATE_PATH ?>/img/about-main-img1.webp" type="image/webp">
                            <img src="<?= SITE_TEMPLATE_PATH ?>/img/about-main-img1.png" alt=""/></picture>
                    </div>
                </div>
                <div class="about-main__item about-main__item--two">
                    <ul class="list-circle-wh">
                        <? $APPLICATION->IncludeComponent(
                            "bitrix:main.include",
                            "",
                            array(
                                "AREA_FILE_SHOW" => "file",
                                "AREA_FILE_SUFFIX" => "inc",
                                "EDIT_TEMPLATE" => "",
                                "PATH" => SITE_TEMPLATE_PATH . "/include_areas/main_family2.php"
                            )
                        ); ?>

                    </ul>
                    <div class="about-main__img">
                        <picture>
                            <source srcset="<?= SITE_TEMPLATE_PATH ?>/img/about-main-img2.webp" type="image/webp">
                            <img src="<?= SITE_TEMPLATE_PATH ?>/img/about-main-img2.png" alt=""/></picture>
                    </div>
                </div>
                <div class="about-main__item about-main__item--three">
                    <div class="about-main__heading">
                        <div class="about-main__title">Нина Георгиевна Ковалёва</div>
                    </div>
                    <div class="about-main__text">
                        <? $APPLICATION->IncludeComponent(
                            "bitrix:main.include",
                            "",
                            array(
                                "AREA_FILE_SHOW" => "file",
                                "AREA_FILE_SUFFIX" => "inc",
                                "EDIT_TEMPLATE" => "",
                                "PATH" => SITE_TEMPLATE_PATH . "/include_areas/main_family3.php"
                            )
                        ); ?>
                    </div>
                    <div class="about-main__img">
                        <picture>
                            <source srcset="<?= SITE_TEMPLATE_PATH ?>/img/about-main-img3.webp" type="image/webp">
                            <img src="<?= SITE_TEMPLATE_PATH ?>/img/about-main-img3.png" alt=""/></picture>
                    </div>
                </div>
            </div>
            <div class="about-main__btn">
                <a href="/history/" class="black-btn">Узнать подробнее о семье </a>
            </div>
        </div>
    </div>
    <div class="company-info">
        <div class="container">
            <div class="company-info__wrap">
                <h2 class="title-section">Миссия магазина Травника Ковалева</h2>

                <? $APPLICATION->IncludeComponent(
                    "bitrix:main.include",
                    "",
                    array(
                        "AREA_FILE_SHOW" => "file",
                        "AREA_FILE_SUFFIX" => "inc",
                        "EDIT_TEMPLATE" => "",
                        "PATH" => SITE_TEMPLATE_PATH . "/include_areas/main_mission.php"
                    )
                ); ?>


                <div class="more-text">
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        "",
                        array(
                            "AREA_FILE_SHOW" => "file",
                            "AREA_FILE_SUFFIX" => "inc",
                            "EDIT_TEMPLATE" => "",
                            "PATH" => SITE_TEMPLATE_PATH . "/include_areas/main_mission_more.php"
                        )
                    ); ?>

                </div>
                <div class="more-btn-wrap">
                    <a href="javascript:void(0);" class="more-link more-link-js">Показать весь текст</a>
                </div>
            </div>
        </div>
    </div>

<?
global $mainElementFilter;
$mainElementFilter = array("IBLOCK_SECTION_ID" => "2");
$APPLICATION->IncludeComponent("bitrix:catalog.section", "main", array(
    "TITLE" => "Оздоровительные фитосборы",
    "ACTION_VARIABLE" => "action",    // Название переменной, в которой передается действие
    "ADD_PICT_PROP" => "-",    // Дополнительная картинка основного товара
    "ADD_PROPERTIES_TO_BASKET" => "Y",    // Добавлять в корзину свойства товаров и предложений
    "ADD_SECTIONS_CHAIN" => "N",    // Включать раздел в цепочку навигации
    "ADD_TO_BASKET_ACTION" => "ADD",    // Показывать кнопку добавления в корзину или покупки
    "AJAX_MODE" => "N",    // Включить режим AJAX
    "AJAX_OPTION_ADDITIONAL" => "",    // Дополнительный идентификатор
    "AJAX_OPTION_HISTORY" => "N",    // Включить эмуляцию навигации браузера
    "AJAX_OPTION_JUMP" => "N",    // Включить прокрутку к началу компонента
    "AJAX_OPTION_STYLE" => "Y",    // Включить подгрузку стилей
    "BACKGROUND_IMAGE" => "-",    // Установить фоновую картинку для шаблона из свойства
    "BASKET_URL" => "/personal/basket.php",    // URL, ведущий на страницу с корзиной покупателя
    "BROWSER_TITLE" => "-",    // Установить заголовок окна браузера из свойства
    "CACHE_FILTER" => "N",    // Кешировать при установленном фильтре
    "CACHE_GROUPS" => "Y",    // Учитывать права доступа
    "CACHE_TIME" => "36000000",    // Время кеширования (сек.)
    "CACHE_TYPE" => "A",    // Тип кеширования
    "COMPATIBLE_MODE" => "Y",    // Включить режим совместимости
    "CONVERT_CURRENCY" => "N",    // Показывать цены в одной валюте
    "CUSTOM_FILTER" => "{\"CLASS_ID\":\"CondGroup\",\"DATA\":{\"All\":\"AND\",\"True\":\"True\"},\"CHILDREN\":[]}",
    "DETAIL_URL" => "",    // URL, ведущий на страницу с содержимым элемента раздела
    "DISABLE_INIT_JS_IN_COMPONENT" => "N",    // Не подключать js-библиотеки в компоненте
    "DISPLAY_BOTTOM_PAGER" => "N",    // Выводить под списком
    "DISPLAY_COMPARE" => "N",    // Разрешить сравнение товаров
    "DISPLAY_TOP_PAGER" => "N",    // Выводить над списком
    "ELEMENT_SORT_FIELD" => "shows",    // По какому полю сортируем элементы
    "ELEMENT_SORT_FIELD2" => "shows",    // Поле для второй сортировки элементов
    "ELEMENT_SORT_ORDER" => "asc",    // Порядок сортировки элементов
    "ELEMENT_SORT_ORDER2" => "asc",    // Порядок второй сортировки элементов
    "ENLARGE_PRODUCT" => "STRICT",    // Выделять товары в списке
    "FILTER_NAME" => "mainElementFilter",    // Имя массива со значениями фильтра для фильтрации элементов
    "HIDE_NOT_AVAILABLE" => "Y",    // Недоступные товары
    "HIDE_NOT_AVAILABLE_OFFERS" => "Y",    // Недоступные торговые предложения
    "IBLOCK_ID" => "1",    // Инфоблок
    "IBLOCK_TYPE" => "catalog",    // Тип инфоблока
    "INCLUDE_SUBSECTIONS" => "Y",    // Показывать элементы подразделов раздела
    "LABEL_PROP" => "",    // Свойства меток товара
    "LAZY_LOAD" => "N",    // Показать кнопку ленивой загрузки Lazy Load
    "LINE_ELEMENT_COUNT" => "3",    // Количество элементов выводимых в одной строке таблицы
    "LOAD_ON_SCROLL" => "N",    // Подгружать товары при прокрутке до конца
    "MESSAGE_404" => "",    // Сообщение для показа (по умолчанию из компонента)
    "MESS_BTN_ADD_TO_BASKET" => "Купить",    // Текст кнопки "Добавить в корзину"
    "MESS_BTN_BUY" => "Купить",    // Текст кнопки "Купить"
    "MESS_BTN_DETAIL" => "Подробнее",    // Текст кнопки "Подробнее"
    "MESS_BTN_SUBSCRIBE" => "Подписаться",    // Текст кнопки "Уведомить о поступлении"
    "MESS_NOT_AVAILABLE" => "Нет в наличии",    // Сообщение об отсутствии товара
    "META_DESCRIPTION" => "-",    // Установить описание страницы из свойства
    "META_KEYWORDS" => "-",    // Установить ключевые слова страницы из свойства
    "OFFERS_FIELD_CODE" => array(    // Поля предложений
        0 => "",
        1 => "",
    ),
    "OFFERS_LIMIT" => "5",    // Максимальное количество предложений для показа (0 - все)
    "OFFERS_SORT_FIELD" => "sort",    // По какому полю сортируем предложения товара
    "OFFERS_SORT_FIELD2" => "id",    // Поле для второй сортировки предложений товара
    "OFFERS_SORT_ORDER" => "asc",    // Порядок сортировки предложений товара
    "OFFERS_SORT_ORDER2" => "desc",    // Порядок второй сортировки предложений товара
    "PAGER_BASE_LINK_ENABLE" => "N",    // Включить обработку ссылок
    "PAGER_DESC_NUMBERING" => "N",    // Использовать обратную навигацию
    "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",    // Время кеширования страниц для обратной навигации
    "PAGER_SHOW_ALL" => "N",    // Показывать ссылку "Все"
    "PAGER_SHOW_ALWAYS" => "N",    // Выводить всегда
    "PAGER_TEMPLATE" => ".default",    // Шаблон постраничной навигации
    "PAGER_TITLE" => "Товары",    // Название категорий
    "PAGE_ELEMENT_COUNT" => "3",    // Количество элементов на странице
    "PARTIAL_PRODUCT_PROPERTIES" => "N",    // Разрешить добавлять в корзину товары, у которых заполнены не все характеристики
    "PRICE_CODE" => array(    // Тип цены
        0 => "BASE",
    ),
    "PRICE_VAT_INCLUDE" => "Y",    // Включать НДС в цену
    "PRODUCT_BLOCKS_ORDER" => "price,props,sku,quantityLimit,quantity,buttons",    // Порядок отображения блоков товара
    "PRODUCT_DISPLAY_MODE" => "N",    // Схема отображения
    "PRODUCT_ID_VARIABLE" => "id",    // Название переменной, в которой передается код товара для покупки
    "PRODUCT_PROPS_VARIABLE" => "prop",    // Название переменной, в которой передаются характеристики товара
    "PRODUCT_QUANTITY_VARIABLE" => "quantity",    // Название переменной, в которой передается количество товара
    "PRODUCT_ROW_VARIANTS" => "[{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false}]",    // Вариант отображения товаров
    "PRODUCT_SUBSCRIPTION" => "Y",    // Разрешить оповещения для отсутствующих товаров
    "RCM_PROD_ID" => $_REQUEST["PRODUCT_ID"],    // Параметр ID продукта (для товарных рекомендаций)
    "RCM_TYPE" => "personal",    // Тип рекомендации
    "SECTION_CODE" => "",    // Код раздела
    "SECTION_ID" => $_REQUEST["SECTION_ID"],    // ID раздела
    "SECTION_ID_VARIABLE" => "SECTION_ID",    // Название переменной, в которой передается код группы
    "SECTION_URL" => "",    // URL, ведущий на страницу с содержимым раздела
    "SECTION_USER_FIELDS" => array(    // Свойства раздела
        0 => "",
        1 => "",
    ),
    "SEF_MODE" => "N",    // Включить поддержку ЧПУ
    "SET_BROWSER_TITLE" => "N",    // Устанавливать заголовок окна браузера
    "SET_LAST_MODIFIED" => "N",    // Устанавливать в заголовках ответа время модификации страницы
    "SET_META_DESCRIPTION" => "N",    // Устанавливать описание страницы
    "SET_META_KEYWORDS" => "N",    // Устанавливать ключевые слова страницы
    "SET_STATUS_404" => "N",    // Устанавливать статус 404
    "SET_TITLE" => "N",    // Устанавливать заголовок страницы
    "SHOW_404" => "N",    // Показ специальной страницы
    "SHOW_ALL_WO_SECTION" => "N",    // Показывать все элементы, если не указан раздел
    "SHOW_CLOSE_POPUP" => "N",    // Показывать кнопку продолжения покупок во всплывающих окнах
    "SHOW_DISCOUNT_PERCENT" => "N",    // Показывать процент скидки
    "SHOW_FROM_SECTION" => "N",    // Показывать товары из раздела
    "SHOW_MAX_QUANTITY" => "N",    // Показывать остаток товара
    "SHOW_OLD_PRICE" => "N",    // Показывать старую цену
    "SHOW_PRICE_COUNT" => "1",    // Выводить цены для количества
    "SHOW_SLIDER" => "N",    // Показывать слайдер для товаров
    "SLIDER_INTERVAL" => "3000",
    "SLIDER_PROGRESS" => "N",
    "TEMPLATE_THEME" => "site",    // Цветовая тема
    "USE_ENHANCED_ECOMMERCE" => "N",    // Отправлять данные электронной торговли в Google и Яндекс
    "USE_MAIN_ELEMENT_SECTION" => "N",    // Использовать основной раздел для показа элемента
    "USE_PRICE_COUNT" => "N",    // Использовать вывод цен с диапазонами
    "USE_PRODUCT_QUANTITY" => "N",    // Разрешить указание количества товара
),
    false
); ?>


    <div class="contacts-f">
        <div class="container">
            <h2 class="contacts-f__title">Контакты</h2>
            <div class="contacts-f__list">
                <!--div class="contacts-f__item">
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
                </div-->
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


<?
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php');
?>