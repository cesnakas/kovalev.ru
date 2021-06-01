<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("История семьи");
$APPLICATION->IncludeComponent("bitrix:breadcrumb", "breadcrumbs", array(
    "START_FROM" => "0",    // Номер пункта, начиная с которого будет построена навигационная цепочка
    "PATH" => "",    // Путь, для которого будет построена навигационная цепочка (по умолчанию, текущий путь)
    "SITE_ID" => "s1",    // Cайт (устанавливается в случае многосайтовой версии, когда DOCUMENT_ROOT у сайтов разный)
),
    false
);
?>    <div class="page-content">
        <div class="page-content__container">
			<div class="heading-section heading-section--page">
				<div class="heading-section__nav nav-heading">
					<div class="nav-heading__item">
						<a href="/about/" class="nav-heading__card">
							<span class="nav-heading__img-wrap nav-heading__img-wrap--left">
								<span class="nav-heading__img-circle">
									<span class="icon-doctor"></span>
								</span>
							</span>
							<span class="nav-heading__name">Обо мне</span>
						</a>
					</div>
					<div class="nav-heading__item">
						<a href="/history/" class="nav-heading__card nav-heading__card--current">
							<span class="nav-heading__img-wrap nav-heading__img-wrap--right">
								<span class="nav-heading__img-circle">
									<span class="icon-family-insurance"></span>
								</span>
							</span>
							<span class="nav-heading__name">История семьи</span>
						</a>
					</div>
					<div class="nav-heading__item">
						<a href="/traditions/" class="nav-heading__card">
							<span class="nav-heading__img-wrap nav-heading__img-wrap--left">
								<span class="nav-heading__img-circle">
									<span class="icon-old"></span>
								</span>
							</span>
							<span class="nav-heading__name">ХХ век начинается</span>
						</a>
					</div>
				</div>
				<div class="heading-section__title">
					<h1 class="page-content__title">Семейные традиции травничества с 1890 г.</h1>
				</div>
			</div>
			<h2 class="title-page">История семьи</h2>
            <div class="row">
                <div class="col-xl-4 col-lg-4 col-md-5 col-sm-5 col-12">
                    <picture>
                        <source srcset="<?= SITE_TEMPLATE_PATH ?>/img/history/01.webp" type="image/webp">
                        <img class="photo-biography" src="<?= SITE_TEMPLATE_PATH ?>/img/history/01.jpg" alt=""/>
                    </picture>
                    <span class="img-caption">Г.М. Ковалев начало 1930-х  годов.</span>
                </div>

                <div class="col-xl-8 col-lg-8 col-md-7 col-sm-7 col-12">
<h2 class="page-content__subtitle page-content__subtitle--no-mb">На этой странице я хочу рассказать о династии Травников Ковалевых всем…</h2><br>
					<p>Про уникальные сборы из лекарственных растений, рецептуру которых, используя записи своих предков, создал мой прадед Георгий Матвеевич Ковалев.</p>
					<p>Про семью травников и врачей Ковалёвых, которая на протяжении многих десятилетий помогала и помогает людям противостоять болезням и оставаться здоровыми.</p>
					<p>Про семью Ковалевых, в судьбах представителей которой отражается история страны на протяжении нескольких веков. Про окружение семьи и про тот мир и уклад жизни, который частично остался в большом волжском городе, где работали мои предки и до сих работают мои родственники.</p>
<br>
                    <h3 class="page-content__subtitle page-content__subtitle--no-mb">ГЕОРГИЙ МАТВЕЕВИЧ КОВАЛЕВ
                        (1873-1944)</h3>
                    <div class="quote-box quote-box--pad_b">Продолжатель дела предков-травников.<br>
                        Фельдшер. Практиковал с 1890 г. до конца жизни.
                    </div>
                    <div class="page-content__text">

                        <? $APPLICATION->IncludeComponent(
                            "bitrix:main.include",
                            "",
                            array(
                                "AREA_FILE_SHOW" => "file",
                                "AREA_FILE_SUFFIX" => "inc",
                                "EDIT_TEMPLATE" => "",
                                "PATH" => SITE_TEMPLATE_PATH . "/include_areas/history/1.php"
                            )
                        ); ?>
                    </div>
                </div>
            </div>
            <div class="box-img-content box-img-content--first">
                <picture>
                    <source srcset="<?= SITE_TEMPLATE_PATH ?>/img/history/02.webp" type="image/webp">
                    <img src="<?= SITE_TEMPLATE_PATH ?>/img/history/02.png" alt=""/></picture>
                <div class="page-content__text">
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        "",
                        array(
                            "AREA_FILE_SHOW" => "file",
                            "AREA_FILE_SUFFIX" => "inc",
                            "EDIT_TEMPLATE" => "",
                            "PATH" => SITE_TEMPLATE_PATH . "/include_areas/history/2.php"
                        )
                    ); ?>

                </div>
            </div>
            <div class="box-img-content box-img-content--two">
                <picture>
                    <source srcset="<?= SITE_TEMPLATE_PATH ?>/img/history/03.webp" type="image/webp">
                    <img src="<?= SITE_TEMPLATE_PATH ?>/img/history/03.png" alt=""/></picture>
                <div class="page-content__text">
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        "",
                        array(
                            "AREA_FILE_SHOW" => "file",
                            "AREA_FILE_SUFFIX" => "inc",
                            "EDIT_TEMPLATE" => "",
                            "PATH" => SITE_TEMPLATE_PATH . "/include_areas/history/3.php"
                        )
                    ); ?>

                </div>
            </div>
            <div class="box-img-content box-img-content--three">
                <picture>
                    <source srcset="<?= SITE_TEMPLATE_PATH ?>/img/history/04.webp" type="image/webp">
                    <img src="<?= SITE_TEMPLATE_PATH ?>/img/history/04.png" alt=""/></picture>
                <div class="page-content__text">

                    <? $APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        "",
                        array(
                            "AREA_FILE_SHOW" => "file",
                            "AREA_FILE_SUFFIX" => "inc",
                            "EDIT_TEMPLATE" => "",
                            "PATH" => SITE_TEMPLATE_PATH . "/include_areas/history/4.php"
                        )
                    ); ?>
                </div>
            </div>
            <div class="box-img-content box-img-content--thour">
                <picture>
                    <source srcset="<?= SITE_TEMPLATE_PATH ?>/img/history/05.webp" type="image/webp">
                    <img src="<?= SITE_TEMPLATE_PATH ?>/img/history/05.png" alt=""/></picture>
                <div class="page-content__text">

                    <? $APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        "",
                        array(
                            "AREA_FILE_SHOW" => "file",
                            "AREA_FILE_SUFFIX" => "inc",
                            "EDIT_TEMPLATE" => "",
                            "PATH" => SITE_TEMPLATE_PATH . "/include_areas/history/5.php"
                        )
                    ); ?>

                </div>
            </div>
            <div class="box-img-content box-img-content--five">
                <picture>
                    <source srcset="<?= SITE_TEMPLATE_PATH ?>/img/history/06.webp" type="image/webp">
                    <img src="<?= SITE_TEMPLATE_PATH ?>/img/history/06.png" alt=""/></picture>
                <div class="page-content__text">
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        "",
                        array(
                            "AREA_FILE_SHOW" => "file",
                            "AREA_FILE_SUFFIX" => "inc",
                            "EDIT_TEMPLATE" => "",
                            "PATH" => SITE_TEMPLATE_PATH . "/include_areas/history/6.php"
                        )
                    ); ?>

                </div>
            </div>
            <div class="box-img-content box-img-content--six">
                <picture>
                    <source srcset="<?= SITE_TEMPLATE_PATH ?>/img/history/07.webp" type="image/webp">
                    <img src="<?= SITE_TEMPLATE_PATH ?>/img/history/07.png" alt=""/></picture>
                <div class="page-content__text">

                    <? $APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        "",
                        array(
                            "AREA_FILE_SHOW" => "file",
                            "AREA_FILE_SUFFIX" => "inc",
                            "EDIT_TEMPLATE" => "",
                            "PATH" => SITE_TEMPLATE_PATH . "/include_areas/history/7.php"
                        )
                    ); ?>


                </div>
            </div>
        </div>


        <?

        $APPLICATION->IncludeComponent("bitrix:catalog.section", "recommended_bascket", array(
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
            "PAGE_ELEMENT_COUNT" => "4",    // Количество элементов на странице
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


    </div>

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


    <script type="text/javascript">
        document.getElementsByTagName('main')[0].className += " main--brown"
    </script>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>