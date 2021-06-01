<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();


/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CatalogSectionComponent $component
 * @var CBitrixComponentTemplate $this
 * @var string $templateName
 * @var string $componentPath
 * @var string $templateFolder
 */

$this->setFrameMode(true);
$mainId = $this->GetEditAreaId($arResult['ID']);
?>


<div class="card-page__heading">
    <div class="container">
        <h1 class="card-page__caption">medicus curat, natura sanat</h1>
        <div class="card-page__img">
            <picture>
                <source srcset="<?= $arResult["DETAIL_PICTURE"]["SRC"] ?>" type="image/webp">
                <img src="<?= $arResult["DETAIL_PICTURE"]["SRC"] ?>" alt=""/></picture>
        </div>
        <div class="card-page__content">
            <h1 class="title-page"><?= $arResult["NAME"] ?></h1>
            <div class="card-page__text">
                <?= $arResult["DETAIL_TEXT"] ?>
            </div>
            <div class="card-page__consist consist-card">
                <? if (!empty($arResult["PROPERTIES"]["SOSTAV"]["VALUE"])) { ?>
                    <div class="consist-card__caption">Состав</div>
                    <div class="consist-card__content">
                        <? foreach ($arResult["PROPERTIES"]["SOSTAV"]["VALUE"] as $sostav) { ?>
                            <div class="consist-card__item"><?= $sostav["UF_NAME"] ?></div>
                        <? } ?>

                    </div>
                <? } ?>
            </div>

            <? if (!empty($arResult["OFFERS"])) { ?>
            <div class="card-page__count">
                <div class="select-b select-b--brown">
                    <div class="select-b__heading">
                        <div class="select-b__name"><?= $arResult["OFFERS"][0]['CATALOG_WEIGHT'] ?> гр</div>
                    </div>
                    <div class="select-b__body">
                        <ul class="select-b__list">
                            <?
                            foreach ($arResult["OFFERS"] as $OFFER) { ?>
                                <li data-offer-id="<?= $OFFER['ID'] ?>"
                                    onclick="setOffer(`<?= $OFFER['ID'] ?>`,`<?= $arResult["ID"] ?>`,`<?= $OFFER['MIN_PRICE']["DISCOUNT_VALUE"] ?>`);"
                                    class="select-b__item"><?= $OFFER["CATALOG_WEIGHT"] ?> гр
                                </li>
                                <?
                            } ?>
                    </div>
                </div>
                <span class="price"
                      id="<?= $arResult["ID"] ?>_PRICE_BLOCK"><?= $arResult["OFFERS"][0]['MIN_PRICE']["DISCOUNT_VALUE"] ?></span>
            </div>


            <div class="card-page__btn">
                <div class="counter">
                    <span class="counter__minus"></span>
                    <input type="text"
                           onchange="setQuantity(`<?= $arResult["ID"] ?>`,`<?= $arResult["OFFERS"][0]['ID'] ?>`,$(this));return false;"
                           id="<?= $arResult["ID"] ?>_QUANTITY" name="counter" value="1" class="counter__input">
                    <span class="counter__plus"></span>
                </div>
                <a href="#" id="<?= $arResult["ID"] ?>_BY_BUTTON"
                   onclick='add2basket(`<?= $arResult["ID"] ?>`,`<?= $arResult["OFFERS"][0]['ID'] ?>`,`1`);return false;'
                   class="pay-btn pay-btn--light">Купить</a>
            </div>



            <?}else{?>

                <div class="card-page__count">
                    <div class="select-b select-b--brown">
                        <div class="">
                            <div class="select-b__name"><?= $arResult["PRODUCT"]["WEIGHT"] ?> гр</div>
                        </div>

                    </div>
                    <span class="price"
                          id="<?= $arResult["ID"] ?>_PRICE_BLOCK"><?= $arResult['MIN_PRICE']["DISCOUNT_VALUE"]  ?></span>
                </div>


                <div class="card-page__btn">
                    <div class="counter">
                        <span class="counter__minus"></span>
                        <input type="text"
                               onchange="setQuantity(`<?= $arResult["ID"] ?>`,`<?= $arResult["ID"] ?>`,$(this));return false;"
                               id="<?= $arResult["ID"] ?>_QUANTITY" name="counter" value="1" class="counter__input">
                        <span class="counter__plus"></span>
                    </div>
                    <a href="#" id="<?= $arResult["ID"] ?>_BY_BUTTON"
                       onclick='add2basket(`<?= $arResult["ID"] ?>`,`<?= $arResult["ID"] ?>`,`1`);return false;'
                       class="pay-btn pay-btn--light">Купить</a>
                </div>



            <?}?>



        </div>
    </div>
</div>
<div class="card-page__tabs">
    <div class="container">
        <ul class="tabs-card">
            <? if (!empty($arResult["PROPERTIES"]["SOSTAV_FULL"]["VALUE"])) { ?>
                <li class="tabs-card__li">Полный состав</li>
            <? } ?>
            <? if (!empty($arResult["PROPERTIES"]["VLIYANIYE_TEXT"]["VALUE"]['TEXT'])) { ?>
                <li class="tabs-card__li current">Влияние на здоровье</li>
            <? } ?>
            <? if (!empty($arResult["PROPERTIES"]["SPOSOB_TEXT"]["VALUE"]['TEXT'])) { ?>
                <li class="tabs-card__li">Способ потребления</li>
            <? } ?>
            <? if (!empty($arResult["PROPERTIES"]["USLOVIA_TEXT"]["VALUE"]['TEXT'])) { ?>
                <li class="tabs-card__li">Условия хранения</li>
            <? } ?>
            <li class="tabs-card__li">Отзывы</li>
        </ul>
        <? if (!empty($arResult["PROPERTIES"]["SOSTAV_FULL"]["VALUE"])) { ?>
            <div class="tabs-box">
                <div class="tabs-box__text">
                    <? foreach ($arResult["PROPERTIES"]["SOSTAV_FULL"]["VALUE"] as $sostav) { ?>
                        <div style="text-align: center" class="consist-card__item"><?= $sostav["UF_NAME"] ?></div>
                    <? } ?>
                </div>
            </div>
        <? } ?>
        <? if (!empty($arResult["PROPERTIES"]["VLIYANIYE_TEXT"]["VALUE"]['TEXT'])) { ?>
            <div class="tabs-box visib">
                <div class="tabs-box__text">
                    <?= html_entity_decode($arResult["PROPERTIES"]["VLIYANIYE_TEXT"]["VALUE"]['TEXT']) ?>
                </div>
            </div>
        <? } ?>
        <? if (!empty($arResult["PROPERTIES"]["SPOSOB_TEXT"]["VALUE"]['TEXT'])) { ?>
            <div class="tabs-box">
                <div class="tabs-box__text">
                    <?= html_entity_decode($arResult["PROPERTIES"]["SPOSOB_TEXT"]["VALUE"]['TEXT']) ?>
                </div>
            </div>
        <? } ?>
        <? if (!empty($arResult["PROPERTIES"]["USLOVIA_TEXT"]["VALUE"]['TEXT'])) { ?>
            <div class="tabs-box">
                <div class="tabs-box__text">
                    <?= html_entity_decode($arResult["PROPERTIES"]["USLOVIA_TEXT"]["VALUE"]['TEXT']) ?>
                </div>
            </div>
        <? } ?>
        <div class="tabs-box">
            <div class="reviews-wrap">
                <div class="row">
                    <div class="col-xl-7 col-lg-7 col-md-6 col-sm-6 col-12">
                        <div class="reviews-simple">
                            <div class="reviews-simple__list">

                                <? foreach ($arResult["PROPERTIES"]["OTZUVU"]["VALUE"] as $OTZYV) { ?>


                                    <div class="reviews-simple__item">
                                        <div class="reviews-simple__title"><?= $OTZYV["UF_NAME"] ?></div>
                                        <div class="reviews-simple__date"><?= $OTZYV["UF_DATE"] ?></div>
                                        <div class="reviews-simple__text">
                                            <p><?= $OTZYV["UF_TEXT"] ?></p>
                                        </div>
                                        <div class="rating-info">
                                            <? for ($i = 1; $i <= 5; $i++) { ?>
                                                <div class="rating-info__item <?
                                                if ($i <= $OTZYV["UF_STARS"]) {
                                                    ?>
                                            active
                                            <? } ?>">
                                                </div>
                                            <? } ?>
                                        </div>
                                    </div>
                                <? } ?>

                            </div>
                            <? /* <div class="pagination">
                                <a href="#" class="pagination__prev"></a>
                                <a href="#" class="pagination__number">1</a>
                                <a href="#" class="pagination__number current">2</a>
                                <a href="#" class="pagination__number">3</a>
                                <a href="#" class="pagination__next"></a>
                            </div>
                                */ ?>
                        </div>
                    </div>
                    <div class="col-xl-5 col-lg-5 col-md-6 col-sm-6 col-12">
                        <div class="feedback-box">
                            <form method="POST" id="rewiews">
                                <input name="UF_TOVAR" type="hidden" value="<?= $arResult["ID"] ?>">
                                <div class="feedback-box__title">Оставьте ваш отзыв</div>
                                <div class="feedback-box__form">
                                    <input required class="feedback-box__control" placeholder="Имя" type="text"
                                           name="UF_NAME"/>
                                    <input required class="feedback-box__control" placeholder="Mail" type="email"
                                           name="UF_MAIL"/>
                                    <input required class="feedback-box__control" placeholder="Ваш отзыв" type="text"
                                           name="UF_TEXT"/>
                                    <div class="rating">
                                        <div class="rating__caption">Оценка</div>
                                        <div class="rating__content">
                                            <div class="simple-rating">
                                                <div class="simple-rating__items">
                                                    <input id="simple-rating__5" class="simple-rating__item"
                                                           name="UF_STARS" type="radio" value="5">
                                                    <label for="simple-rating__5"
                                                           class="simple-rating__label"></label>
                                                    <input id="simple-rating__4" class="simple-rating__item"
                                                           name="UF_STARS" type="radio" value="4">
                                                    <label for="simple-rating__4"
                                                           class="simple-rating__label"></label>
                                                    <input id="simple-rating__3" class="simple-rating__item"
                                                           name="UF_STARS" type="radio" value="3">
                                                    <label for="simple-rating__3"
                                                           class="simple-rating__label"></label>
                                                    <input id="simple-rating__2" class="simple-rating__item"
                                                           name="UF_STARS" type="radio" value="2">
                                                    <label for="simple-rating__2"
                                                           class="simple-rating__label"></label>
                                                    <input id="UF_STARS" class="simple-rating__item"
                                                           name="simple-rating" type="radio" value="1">
                                                    <label for="simple-rating__1"
                                                           class="simple-rating__label"></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="check-item">
                                    <input class="check-item__input" type="checkbox" id="check1" required checked/>
                                    <label for="check1" class="check-item__label">Согласен с <a href="#">условиями
                                            обработки персональных данных, пользовательского соглашения и публичной
                                            оферты</a></label>
                                </div>
                                <button class="feedback-box__submit">Оставить отзыв</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $('#rewiews').submit(function (e) {
        var $form = $(this);
        $.ajax({
            type: $form.attr('method'),
            url: '<?=$component->__template->GetFolder()?>/setreview.php',
            data: $form.serialize()
        }).done(function () {
            $('#rewiews').html('<h2>Спасибо, Ваш отзыв получен!</h2>')
        }).fail(function () {
            console.log('fail');
        });
        //отмена действия по умолчанию для кнопки submit
        e.preventDefault();
    });
</script>


<? if (!empty($arResult["PROPERTIES"]["RECOMMENDED_WITH_IT"]["VALUE"])) { ?>
    <div class="card-page__recommend recommend-card">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-lg-6 col-md-6 co-sm-6 col-12">
                    <picture>
                        <source srcset="<?= CFile::GetPath($arResult["PROPERTIES"]["RECOMMENDED_WITH_IT"]["VALUE"]["DETAIL_PICTURE"]) ?>"
                                type="image/webp">
                        <img class="recommend-card__img"
                             src="<?= CFile::GetPath($arResult["PROPERTIES"]["RECOMMENDED_WITH_IT"]["VALUE"]["DETAIL_PICTURE"]) ?>"
                             alt=""/></picture>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 co-sm-6 col-12">
                    <div class="recommend-card__content">
                        <div class="recommend-card__caption">Рекомендуем использовать вместе</div>
                        <div class="recommend-card__title"><?= $arResult["PROPERTIES"]["RECOMMENDED_WITH_IT"]["VALUE"]["NAME"] ?></div>
                        <div class="recommend-card__text"><?= $arResult["PROPERTIES"]["RECOMMENDED_WITH_IT"]["VALUE"]["PREVIEW_TEXT"] ?>
                        </div>
                        <div class="recommend-card__btn"><a
                                    href="<?= $arResult["PROPERTIES"]["RECOMMENDED_WITH_IT"]["VALUE"]["DETAIL_PAGE_URL"] ?>"
                                    class="btn-brown">Подробнее</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<? } ?>


<?

global $recommendenFilter;
$recommendenFilter = array("!ID" => $arResult["ID"], "IBLOCK_SECTION_ID" => $arResult["IBLOCK_SECTION_ID"]);

$intSectionID = $APPLICATION->IncludeComponent(
    "bitrix:catalog.section",
    "recommended",
    array(
        "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
        "IBLOCK_ID" => $arParams["IBLOCK_ID"],
        "ELEMENT_SORT_FIELD" => $arParams["ELEMENT_SORT_FIELD"],
        "ELEMENT_SORT_ORDER" => $arParams["ELEMENT_SORT_ORDER"],
        "ELEMENT_SORT_FIELD2" => $arParams["ELEMENT_SORT_FIELD2"],
        "ELEMENT_SORT_ORDER2" => $arParams["ELEMENT_SORT_ORDER2"],
        "PROPERTY_CODE" => $arParams["LIST_PROPERTY_CODE"],
        "PROPERTY_CODE_MOBILE" => $arParams["LIST_PROPERTY_CODE_MOBILE"],
        "META_KEYWORDS" => $arParams["LIST_META_KEYWORDS"],
        "META_DESCRIPTION" => $arParams["LIST_META_DESCRIPTION"],
        "BROWSER_TITLE" => $arParams["LIST_BROWSER_TITLE"],
        "SET_LAST_MODIFIED" => $arParams["SET_LAST_MODIFIED"],
        "INCLUDE_SUBSECTIONS" => $arParams["INCLUDE_SUBSECTIONS"],
        "BASKET_URL" => $arParams["BASKET_URL"],
        "ACTION_VARIABLE" => $arParams["ACTION_VARIABLE"],
        "PRODUCT_ID_VARIABLE" => $arParams["PRODUCT_ID_VARIABLE"],
        "SECTION_ID_VARIABLE" => $arParams["SECTION_ID_VARIABLE"],
        "PRODUCT_QUANTITY_VARIABLE" => $arParams["PRODUCT_QUANTITY_VARIABLE"],
        "PRODUCT_PROPS_VARIABLE" => $arParams["PRODUCT_PROPS_VARIABLE"],
        "FILTER_NAME" => 'recommendenFilter',
        "CACHE_TYPE" => $arParams["CACHE_TYPE"],
        "CACHE_TIME" => $arParams["CACHE_TIME"],
        "CACHE_FILTER" => $arParams["CACHE_FILTER"],
        "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
        "SET_TITLE" => $arParams["SET_TITLE"],
        "MESSAGE_404" => $arParams["~MESSAGE_404"],
        "SET_STATUS_404" => $arParams["SET_STATUS_404"],
        "SHOW_404" => $arParams["SHOW_404"],
        "FILE_404" => $arParams["FILE_404"],
        "DISPLAY_COMPARE" => $arParams["USE_COMPARE"],
        "PAGE_ELEMENT_COUNT" => $arParams["PAGE_ELEMENT_COUNT"],
        "LINE_ELEMENT_COUNT" => $arParams["LINE_ELEMENT_COUNT"],
        "PRICE_CODE" => $arParams["~PRICE_CODE"],
        "USE_PRICE_COUNT" => $arParams["USE_PRICE_COUNT"],
        "SHOW_PRICE_COUNT" => $arParams["SHOW_PRICE_COUNT"],

        "PRICE_VAT_INCLUDE" => $arParams["PRICE_VAT_INCLUDE"],
        "USE_PRODUCT_QUANTITY" => $arParams['USE_PRODUCT_QUANTITY'],
        "ADD_PROPERTIES_TO_BASKET" => (isset($arParams["ADD_PROPERTIES_TO_BASKET"]) ? $arParams["ADD_PROPERTIES_TO_BASKET"] : ''),
        "PARTIAL_PRODUCT_PROPERTIES" => (isset($arParams["PARTIAL_PRODUCT_PROPERTIES"]) ? $arParams["PARTIAL_PRODUCT_PROPERTIES"] : ''),
        "PRODUCT_PROPERTIES" => (isset($arParams["PRODUCT_PROPERTIES"]) ? $arParams["PRODUCT_PROPERTIES"] : []),

        "DISPLAY_TOP_PAGER" => $arParams["DISPLAY_TOP_PAGER"],
        "DISPLAY_BOTTOM_PAGER" => $arParams["DISPLAY_BOTTOM_PAGER"],
        "PAGER_TITLE" => $arParams["PAGER_TITLE"],
        "PAGER_SHOW_ALWAYS" => $arParams["PAGER_SHOW_ALWAYS"],
        "PAGER_TEMPLATE" => $arParams["PAGER_TEMPLATE"],
        "PAGER_DESC_NUMBERING" => $arParams["PAGER_DESC_NUMBERING"],
        "PAGER_DESC_NUMBERING_CACHE_TIME" => $arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
        "PAGER_SHOW_ALL" => $arParams["PAGER_SHOW_ALL"],
        "PAGER_BASE_LINK_ENABLE" => $arParams["PAGER_BASE_LINK_ENABLE"],
        "PAGER_BASE_LINK" => $arParams["PAGER_BASE_LINK"],
        "PAGER_PARAMS_NAME" => $arParams["PAGER_PARAMS_NAME"],
        "LAZY_LOAD" => $arParams["LAZY_LOAD"],
        "MESS_BTN_LAZY_LOAD" => $arParams["~MESS_BTN_LAZY_LOAD"],
        "LOAD_ON_SCROLL" => $arParams["LOAD_ON_SCROLL"],

        "OFFERS_CART_PROPERTIES" => (isset($arParams["OFFERS_CART_PROPERTIES"]) ? $arParams["OFFERS_CART_PROPERTIES"] : []),
        "OFFERS_FIELD_CODE" => $arParams["LIST_OFFERS_FIELD_CODE"],
        "OFFERS_PROPERTY_CODE" => (isset($arParams["LIST_OFFERS_PROPERTY_CODE"]) ? $arParams["LIST_OFFERS_PROPERTY_CODE"] : []),
        "OFFERS_SORT_FIELD" => $arParams["OFFERS_SORT_FIELD"],
        "OFFERS_SORT_ORDER" => $arParams["OFFERS_SORT_ORDER"],
        "OFFERS_SORT_FIELD2" => $arParams["OFFERS_SORT_FIELD2"],
        "OFFERS_SORT_ORDER2" => $arParams["OFFERS_SORT_ORDER2"],
        "OFFERS_LIMIT" => (isset($arParams["LIST_OFFERS_LIMIT"]) ? $arParams["LIST_OFFERS_LIMIT"] : 0),

        "SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
        "SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
        "SECTION_URL" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["section"],
        "DETAIL_URL" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["element"],
        "USE_MAIN_ELEMENT_SECTION" => $arParams["USE_MAIN_ELEMENT_SECTION"],
        'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
        'CURRENCY_ID' => $arParams['CURRENCY_ID'],
        'HIDE_NOT_AVAILABLE' => $arParams["HIDE_NOT_AVAILABLE"],
        'HIDE_NOT_AVAILABLE_OFFERS' => $arParams["HIDE_NOT_AVAILABLE_OFFERS"],

        'LABEL_PROP' => $arParams['LABEL_PROP'],
        'LABEL_PROP_MOBILE' => $arParams['LABEL_PROP_MOBILE'],
        'LABEL_PROP_POSITION' => $arParams['LABEL_PROP_POSITION'],
        'ADD_PICT_PROP' => $arParams['ADD_PICT_PROP'],
        'PRODUCT_DISPLAY_MODE' => $arParams['PRODUCT_DISPLAY_MODE'],
        'PRODUCT_BLOCKS_ORDER' => $arParams['LIST_PRODUCT_BLOCKS_ORDER'],
        'PRODUCT_ROW_VARIANTS' => $arParams['LIST_PRODUCT_ROW_VARIANTS'],
        'ENLARGE_PRODUCT' => $arParams['LIST_ENLARGE_PRODUCT'],
        'ENLARGE_PROP' => isset($arParams['LIST_ENLARGE_PROP']) ? $arParams['LIST_ENLARGE_PROP'] : '',
        'SHOW_SLIDER' => $arParams['LIST_SHOW_SLIDER'],
        'SLIDER_INTERVAL' => isset($arParams['LIST_SLIDER_INTERVAL']) ? $arParams['LIST_SLIDER_INTERVAL'] : '',
        'SLIDER_PROGRESS' => isset($arParams['LIST_SLIDER_PROGRESS']) ? $arParams['LIST_SLIDER_PROGRESS'] : '',

        'OFFER_ADD_PICT_PROP' => $arParams['OFFER_ADD_PICT_PROP'],
        'OFFER_TREE_PROPS' => (isset($arParams['OFFER_TREE_PROPS']) ? $arParams['OFFER_TREE_PROPS'] : []),
        'PRODUCT_SUBSCRIPTION' => $arParams['PRODUCT_SUBSCRIPTION'],
        'SHOW_DISCOUNT_PERCENT' => $arParams['SHOW_DISCOUNT_PERCENT'],
        'DISCOUNT_PERCENT_POSITION' => $arParams['DISCOUNT_PERCENT_POSITION'],
        'SHOW_OLD_PRICE' => $arParams['SHOW_OLD_PRICE'],
        'SHOW_MAX_QUANTITY' => $arParams['SHOW_MAX_QUANTITY'],
        'MESS_SHOW_MAX_QUANTITY' => (isset($arParams['~MESS_SHOW_MAX_QUANTITY']) ? $arParams['~MESS_SHOW_MAX_QUANTITY'] : ''),
        'RELATIVE_QUANTITY_FACTOR' => (isset($arParams['RELATIVE_QUANTITY_FACTOR']) ? $arParams['RELATIVE_QUANTITY_FACTOR'] : ''),
        'MESS_RELATIVE_QUANTITY_MANY' => (isset($arParams['~MESS_RELATIVE_QUANTITY_MANY']) ? $arParams['~MESS_RELATIVE_QUANTITY_MANY'] : ''),
        'MESS_RELATIVE_QUANTITY_FEW' => (isset($arParams['~MESS_RELATIVE_QUANTITY_FEW']) ? $arParams['~MESS_RELATIVE_QUANTITY_FEW'] : ''),
        'MESS_BTN_BUY' => (isset($arParams['~MESS_BTN_BUY']) ? $arParams['~MESS_BTN_BUY'] : ''),
        'MESS_BTN_ADD_TO_BASKET' => (isset($arParams['~MESS_BTN_ADD_TO_BASKET']) ? $arParams['~MESS_BTN_ADD_TO_BASKET'] : ''),
        'MESS_BTN_SUBSCRIBE' => (isset($arParams['~MESS_BTN_SUBSCRIBE']) ? $arParams['~MESS_BTN_SUBSCRIBE'] : ''),
        'MESS_BTN_DETAIL' => (isset($arParams['~MESS_BTN_DETAIL']) ? $arParams['~MESS_BTN_DETAIL'] : ''),
        'MESS_NOT_AVAILABLE' => (isset($arParams['~MESS_NOT_AVAILABLE']) ? $arParams['~MESS_NOT_AVAILABLE'] : ''),
        'MESS_BTN_COMPARE' => (isset($arParams['~MESS_BTN_COMPARE']) ? $arParams['~MESS_BTN_COMPARE'] : ''),

        'USE_ENHANCED_ECOMMERCE' => (isset($arParams['USE_ENHANCED_ECOMMERCE']) ? $arParams['USE_ENHANCED_ECOMMERCE'] : ''),
        'DATA_LAYER_NAME' => (isset($arParams['DATA_LAYER_NAME']) ? $arParams['DATA_LAYER_NAME'] : ''),
        'BRAND_PROPERTY' => (isset($arParams['BRAND_PROPERTY']) ? $arParams['BRAND_PROPERTY'] : ''),

        'TEMPLATE_THEME' => (isset($arParams['TEMPLATE_THEME']) ? $arParams['TEMPLATE_THEME'] : ''),
        "ADD_SECTIONS_CHAIN" => "N",
        'ADD_TO_BASKET_ACTION' => $basketAction,
        'SHOW_CLOSE_POPUP' => isset($arParams['COMMON_SHOW_CLOSE_POPUP']) ? $arParams['COMMON_SHOW_CLOSE_POPUP'] : '',
        'COMPARE_PATH' => $arResult['FOLDER'] . $arResult['URL_TEMPLATES']['compare'],
        'COMPARE_NAME' => $arParams['COMPARE_NAME'],
        'USE_COMPARE_LIST' => 'Y',
        'BACKGROUND_IMAGE' => (isset($arParams['SECTION_BACKGROUND_IMAGE']) ? $arParams['SECTION_BACKGROUND_IMAGE'] : ''),
        'COMPATIBLE_MODE' => (isset($arParams['COMPATIBLE_MODE']) ? $arParams['COMPATIBLE_MODE'] : ''),
        'DISABLE_INIT_JS_IN_COMPONENT' => (isset($arParams['DISABLE_INIT_JS_IN_COMPONENT']) ? $arParams['DISABLE_INIT_JS_IN_COMPONENT'] : '')
    ),
    false
);
?>

