<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die();
CModule::IncludeModule('sale');
?>
<!DOCTYPE html>
<html>
<head>
    <script src="https://code.jquery.com/jquery-2.2.4.js" crossorigin="anonymous"></script>
    <? $APPLICATION->ShowHead(); ?>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><? $APPLICATION->ShowTitle(); ?></title>
    <link rel="shortcut icon" type="image/x-icon" href="/favicon.ico"/>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;1,300;1,400&display=swap"
          rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
          crossorigin="anonymous">
	<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <link rel="stylesheet" href="<?= SITE_TEMPLATE_PATH ?>/css/style.min.css"/>
</head>

<body class="home">
<div id="panel">
    <? $APPLICATION->ShowPanel(); ?>
</div>

<div class="wrapper">
    <header class="header">
		<div class="header__fix">
        <div class="container">
            <div class="logo">
                <a href="/" class="logo__link">
                    <picture>
                        <source srcset="<?= SITE_TEMPLATE_PATH ?>/img/logo.svg" type="image/webp">
                        <img src="<?= SITE_TEMPLATE_PATH ?>/img/logo.svg" alt=""/></picture>
                </a>
            </div>
            <div class="nav-shadow"></div>

            <? $APPLICATION->IncludeComponent(
                "bitrix:menu",
                "main_menu",
                Array(
                    "ALLOW_MULTI_SELECT" => "N",
                    "CHILD_MENU_TYPE" => "left",
                    "DELAY" => "N",
                    "MAX_LEVEL" => "2",
                    "MENU_CACHE_GET_VARS" => array(0 => "",),
                    "MENU_CACHE_TIME" => "3600",
                    "MENU_CACHE_TYPE" => "N",
                    "MENU_CACHE_USE_GROUPS" => "Y",
                    "ROOT_MENU_TYPE" => "top",
                    "USE_EXT" => "Y"
                )
            ); ?>
            
            <div class="h-box-info">
                <div class="social">
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        "",
                        Array(
                            "AREA_FILE_SHOW" => "file",
                            "AREA_FILE_SUFFIX" => "inc",
                            "EDIT_TEMPLATE" => "",
                            "PATH" => SITE_TEMPLATE_PATH . "/include_areas/main_sotial.php"
                        )
                    ); ?>
                </div>
                <div class="phone_and_feddback">
                    <div class="phone-wrap">
                        <? $APPLICATION->IncludeComponent(
                            "bitrix:main.include",
                            "",
                            Array(
                                "AREA_FILE_SHOW" => "file",
                                "AREA_FILE_SUFFIX" => "inc",
                                "EDIT_TEMPLATE" => "",
                                "PATH" => SITE_TEMPLATE_PATH . "/include_areas/main_phone.php"
                            )
                        ); ?>
                    </div>
                    <a href="/contacts/" class="feedback-btn">Обратная связь</a>
                </div>
                <a href="/basket/" class="basket-link icon-basket"><span id="BASKET_COUNTER" class="basket-link__count"><?=
                      $cntBasketItems = CSaleBasket::GetList(
                            array(),
                            array(
                                "FUSER_ID" => CSaleBasket::GetBasketUserID(),
                                "LID" => SITE_ID,
                                "ORDER_ID" => "NULL"
                            ),
                            array()
                        );
                        ?></span></a>
                <a class="menu-trigger menu-open-js" href="javascript:void(0)">
                    <span class="menu-trigger-icon"></span>
                </a>
            </div>
        </div>
	</div>
    </header>
    <main class="main">
						