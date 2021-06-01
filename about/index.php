<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Обо мне");
$APPLICATION->IncludeComponent("bitrix:breadcrumb", "breadcrumbs", array(
    "START_FROM" => "0",    // Номер пункта, начиная с которого будет построена навигационная цепочка
    "PATH" => "",    // Путь, для которого будет построена навигационная цепочка (по умолчанию, текущий путь)
    "SITE_ID" => "s1",    // Cайт (устанавливается в случае многосайтовой версии, когда DOCUMENT_ROOT у сайтов разный)
),
    false
);
?><div class="page-content">
	<div class="page-content__container">
		<div class="heading-section heading-section--page">
			<div class="heading-section__nav nav-heading">
				<div class="nav-heading__item">
 <a href="/about/" class="nav-heading__card nav-heading__card--current"> <span class="nav-heading__img-wrap nav-heading__img-wrap--left"> <span class="nav-heading__img-circle"> <span class="icon-doctor"></span> </span> </span> <span class="nav-heading__name">Обо мне</span> </a>
				</div>
				<div class="nav-heading__item">
 <a href="/history/" class="nav-heading__card"> <span class="nav-heading__img-wrap nav-heading__img-wrap--right"> <span class="nav-heading__img-circle"> <span class="icon-family-insurance"></span> </span> </span> <span class="nav-heading__name">История семьи</span> </a>
				</div>
				<div class="nav-heading__item">
 <a href="/traditions/" class="nav-heading__card"> <span class="nav-heading__img-wrap nav-heading__img-wrap--left"> <span class="nav-heading__img-circle"> <span class="icon-old"></span> </span> </span> <span class="nav-heading__name">ХХ век начинается</span> </a>
				</div>
			</div>
			<div class="heading-section__title">
				<h1 class="page-content__title">Семейные традиции травничества с 1890 г.</h1>
			</div>
		</div>
		<h2 class="title-page">Обо мне</h2>
		<div class="doctor-info-box">
			<div class="row">
				<div class="col-xl-5 col-lg-5 col-md-5 col-sm-5 col-12">
 <img src="/local/templates/tea/img/about/stepensky-v2.jpg" class="doctor-info-box__img" alt="">
					<div class="quote-box w-50">
						 «Дедушка твоего прадедушки вылечил панночку<br> травами, и за это пан подарил ему золотые часы» <br>
						 из рассказа моей бабушки<br>
						 Александры Георгиевны Ковалевой.
					</div>
				</div>
				<div class="col-xl-7 col-lg-7 col-md-7 col-sm-7 col-12">
					<div class="page-content__text">
						<h3>Я - Ковалев Андрей Борисович </h3>
						 <?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	Array(
		"AREA_FILE_SHOW" => "file",
		"AREA_FILE_SUFFIX" => "inc",
		"EDIT_TEMPLATE" => "",
		"PATH" => SITE_TEMPLATE_PATH."/include_areas/about/3.php"
	)
);?>
					</div>
				</div>
			</div>
		</div>
		<div class="img-box img-box--two img-box--right">
 <img src="/local/templates/tea/img/about/01.jpg" alt=""> <img src="/local/templates/tea/img/about/02.jpg" alt="">
		</div>
		<div class="page-content__text w-70">
			 <?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	Array(
		"AREA_FILE_SHOW" => "file",
		"AREA_FILE_SUFFIX" => "inc",
		"EDIT_TEMPLATE" => "",
		"PATH" => SITE_TEMPLATE_PATH."/include_areas/about/1.php"
	)
);?>
		</div>
	</div>
	<div class="img-box img-box--three">
 <img src="/local/templates/tea/img/about/03.jpg" alt=""> <img src="/local/templates/tea/img/about/04.jpg" alt=""> <img src="/local/templates/tea/img/about/05.jpg" alt="">
	</div>
	<div class="page-content__container">
		<div class="page-content__text w-70">
			 <?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	Array(
		"AREA_FILE_SHOW" => "file",
		"AREA_FILE_SUFFIX" => "inc",
		"EDIT_TEMPLATE" => "",
		"PATH" => SITE_TEMPLATE_PATH."/include_areas/about/2.php"
	)
);?>
		</div>
	</div>
	 <?$APPLICATION->IncludeComponent(
	"bitrix:catalog.section",
	"recommended_bascket",
	Array(
		"ACTION_VARIABLE" => "action",
		"ADD_PICT_PROP" => "-",
		"ADD_PROPERTIES_TO_BASKET" => "Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"ADD_TO_BASKET_ACTION" => "ADD",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"BACKGROUND_IMAGE" => "-",
		"BASKET_URL" => "/personal/basket.php",
		"BROWSER_TITLE" => "-",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"COMPATIBLE_MODE" => "Y",
		"CONVERT_CURRENCY" => "N",
		"CUSTOM_FILTER" => "{\"CLASS_ID\":\"CondGroup\",\"DATA\":{\"All\":\"AND\",\"True\":\"True\"},\"CHILDREN\":[]}",
		"DETAIL_URL" => "",
		"DISABLE_INIT_JS_IN_COMPONENT" => "N",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"DISPLAY_COMPARE" => "N",
		"DISPLAY_TOP_PAGER" => "N",
		"ELEMENT_SORT_FIELD" => "shows",
		"ELEMENT_SORT_FIELD2" => "shows",
		"ELEMENT_SORT_ORDER" => "asc",
		"ELEMENT_SORT_ORDER2" => "asc",
		"ENLARGE_PRODUCT" => "STRICT",
		"FILTER_NAME" => "mainElementFilter",
		"HIDE_NOT_AVAILABLE" => "Y",
		"HIDE_NOT_AVAILABLE_OFFERS" => "Y",
		"IBLOCK_ID" => "1",
		"IBLOCK_TYPE" => "catalog",
		"INCLUDE_SUBSECTIONS" => "Y",
		"LABEL_PROP" => "",
		"LAZY_LOAD" => "N",
		"LINE_ELEMENT_COUNT" => "3",
		"LOAD_ON_SCROLL" => "N",
		"MESSAGE_404" => "",
		"MESS_BTN_ADD_TO_BASKET" => "Купить",
		"MESS_BTN_BUY" => "Купить",
		"MESS_BTN_DETAIL" => "Подробнее",
		"MESS_BTN_SUBSCRIBE" => "Подписаться",
		"MESS_NOT_AVAILABLE" => "Нет в наличии",
		"META_DESCRIPTION" => "-",
		"META_KEYWORDS" => "-",
		"OFFERS_FIELD_CODE" => array(0=>"",1=>"",),
		"OFFERS_LIMIT" => "5",
		"OFFERS_SORT_FIELD" => "sort",
		"OFFERS_SORT_FIELD2" => "id",
		"OFFERS_SORT_ORDER" => "asc",
		"OFFERS_SORT_ORDER2" => "desc",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Товары",
		"PAGE_ELEMENT_COUNT" => "4",
		"PARTIAL_PRODUCT_PROPERTIES" => "N",
		"PRICE_CODE" => array(0=>"BASE",),
		"PRICE_VAT_INCLUDE" => "Y",
		"PRODUCT_BLOCKS_ORDER" => "price,props,sku,quantityLimit,quantity,buttons",
		"PRODUCT_DISPLAY_MODE" => "N",
		"PRODUCT_ID_VARIABLE" => "id",
		"PRODUCT_PROPS_VARIABLE" => "prop",
		"PRODUCT_QUANTITY_VARIABLE" => "quantity",
		"PRODUCT_ROW_VARIANTS" => "[{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false}]",
		"PRODUCT_SUBSCRIPTION" => "Y",
		"RCM_PROD_ID" => $_REQUEST["PRODUCT_ID"],
		"RCM_TYPE" => "personal",
		"SECTION_CODE" => "",
		"SECTION_ID" => $_REQUEST["SECTION_ID"],
		"SECTION_ID_VARIABLE" => "SECTION_ID",
		"SECTION_URL" => "",
		"SECTION_USER_FIELDS" => array(0=>"",1=>"",),
		"SEF_MODE" => "N",
		"SET_BROWSER_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SHOW_ALL_WO_SECTION" => "N",
		"SHOW_CLOSE_POPUP" => "N",
		"SHOW_DISCOUNT_PERCENT" => "N",
		"SHOW_FROM_SECTION" => "N",
		"SHOW_MAX_QUANTITY" => "N",
		"SHOW_OLD_PRICE" => "N",
		"SHOW_PRICE_COUNT" => "1",
		"SHOW_SLIDER" => "N",
		"SLIDER_INTERVAL" => "3000",
		"SLIDER_PROGRESS" => "N",
		"TEMPLATE_THEME" => "site",
		"USE_ENHANCED_ECOMMERCE" => "N",
		"USE_MAIN_ELEMENT_SECTION" => "N",
		"USE_PRICE_COUNT" => "N",
		"USE_PRODUCT_QUANTITY" => "N"
	)
);?>
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
					 <?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	Array(
		"AREA_FILE_SHOW" => "file",
		"AREA_FILE_SUFFIX" => "inc",
		"EDIT_TEMPLATE" => "",
		"PATH" => SITE_TEMPLATE_PATH."/include_areas/main_phone.php"
	)
);?>
				</div>
			</div>
			<div class="contacts-f__item">
				<div class="contacts-f__label contacts-f__label--social">
					 <?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	Array(
		"AREA_FILE_SHOW" => "file",
		"AREA_FILE_SUFFIX" => "inc",
		"EDIT_TEMPLATE" => "",
		"PATH" => SITE_TEMPLATE_PATH."/include_areas/main_mi_sotial.php"
	)
);?>
				</div>
			</div>
		</div>
	</div>
</div>
    <script type="text/javascript">
        document.getElementsByTagName('main')[0].className += " main--brown"
    </script><? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>