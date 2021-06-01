<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main;
use Bitrix\Main\Localization\Loc;

/**
 * @var array $arParams
 * @var array $arResult
 * @var CMain $APPLICATION
 * @var CUser $USER
 * @var SaleOrderAjax $component
 * @var string $templateFolder
 */

global $USER;
$isAdmin = $USER->isAdmin();
$APPLICATION->AddChainItem("Оформлние заказа");
$context = Main\Application::getInstance()->getContext();
$request = $context->getRequest();


$isPickup = false;
$pickupDelivKey = 0;
$delivName = '';
$delivPrice = 0;
$limitPrice = $arParams["MIN_DEL_PRICE"]; //минимальная сумма для бесплатной доставки
$relatedProps = ['ORDER_PROP_10', 'ORDER_PROP_11', 'ORDER_PROP_12', 'ORDER_PROP_13', 'ORDER_PROP_14', 'ORDER_PROP_15', 'ORDER_PROP_16'];
// радиус доставки


if ($_GET['ORDER_ID'] || $arResult["USER_VALS"]["CONFIRM_ORDER"] == "Y" || $arResult["NEED_REDIRECT"] == "Y") {
    include($_SERVER["DOCUMENT_ROOT"] . $templateFolder . "/confirm.php");
} else {

    ?>


    <?
    $APPLICATION->IncludeComponent("bitrix:breadcrumb", "breadcrumbs", array(
        "START_FROM" => "0",    // Номер пункта, начиная с которого будет построена навигационная цепочка
        "PATH" => "",    // Путь, для которого будет построена навигационная цепочка (по умолчанию, текущий путь)
        "SITE_ID" => "s1",    // Cайт (устанавливается в случае многосайтовой версии, когда DOCUMENT_ROOT у сайтов разный)
    ),
        false
    );
    ?>


    <div class="container">
        <div class="order">


            <? if ($_POST["is_ajax_post"] != "Y")
            {
            ?>
            <form class="order__form" action="<?= $APPLICATION->GetCurPage(); ?>" method="POST"
                  name="ORDER_FORM"
                  id="ORDER_FORM" enctype="multipart/form-data">
                <?= bitrix_sessid_post() ?>
                <!--                НАЧАЛО ФОРМЫ ЗАКАЗА-->
                <div id="order_form_content" class="order__form-content">

                    <?
                    }
                    else {
                        $APPLICATION->RestartBuffer();
                    }
                    ?>
                    <?
                    $isAgree = $request->getPost('agreeCheck') == 'on';
                    $postVars = $request->getPostList()->getValues();
                    if (empty($arResult['ORDER_PROP']['RELATED']) && is_array($postVars)) {
                        foreach ($postVars as $key => $val) {
                            if (in_array($key, $relatedProps)) {
                                ?>
                                <input type="hidden" name="<?= $key ?>" value="<?= $val ?>"/>
                                <?
                            }
                        }
                    }
                    if ($USER->IsAdmin()) {
                        //echo "<pre>"; var_dump($request->getPostList()); echo "</pre>";
                    }
                    ?>
                    <input type="hidden" id="totalprice" value="<?= $arResult['ORDER_TOTAL_PRICE'] ?>">

                    <!--div class="order__heading">

                        <div class="order__caption">В товаров в корзине -
                            <a style="text-decoration: none; color: black"
                               href="/basket/"><span><?= count($arResult["BASKET_ITEMS"]) ?></span></a>
                        </div>
                        <div class="order__price">
                            <span class="order__label">К оплате:</span>
                            <span class="price"><?= $arResult['ORDER_TOTAL_PRICE'] ?></span>
                        </div>
                    </div-->

                    <div class="order__body">
                        <div class="order__item">
                            <h2 class="title-section">Контакты</h2>
                            <div class="row">
                                <? foreach ($arResult["JS_DATA"]["ORDER_PROP"]["properties"] as $ORDER_PROPERTY) {
                                    if ($ORDER_PROPERTY["PROPS_GROUP_ID"] == '1') {
                                        ?>
                                        <div class="col-12">
                                            <div class="input-control-box">
                                            <input class="feedback-box__control
                                              <? if ($ORDER_PROPERTY["REQUIRED"] == "Y") { ?>
                                                    prop-required
                                                <? } ?>
                                                      "
                                                   placeholder="<?= $ORDER_PROPERTY["NAME"] ?>"
                                                   value="<?= $ORDER_PROPERTY["VALUE"]['0'] ?>"
                                                <? switch ($ORDER_PROPERTY["CODE"]) {
                                                    case'EMAIL':
                                                        $TYPE = 'email';
                                                        break;
                                                    case'PHONE':
                                                        $TYPE = 'tel';
                                                        break;
                                                    default:
                                                        $TYPE = 'text';
                                                        break ?>

                                                    <? } ?>
                                                   type="<?= $TYPE ?>"

                                                   name="ORDER_PROP_<?= $ORDER_PROPERTY["ID"] ?>">
                                                   <span class="required-item">Поле обязательно для заполнения</span>
                                            </div>
                                        </div>
                                    <? } ?>
                                <? } ?>
                                <div class="col-12">
                                    <div class="select-city">
                                        <select class="select-item">
                                            <option value="">Город</option>
                                            <option value="Москва">Москва</option>
                                            <option value="Химки">Химки</option>
                                            <option value="Краснодар">Краснодар</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <? // print_r($arResult) ?>

                        <div class="order-next-first no-active">
                            <div class="order__item">
                            <h2 class="title-page title-page--no_bg">Доставка</h2>

                            <div class="delivery-wrap">

                                <? foreach ($arResult['DELIVERY'] as $k => $item) {

                                    if ($item['CHECKED'] == 'Y') {
                                        $delivName = $item['NAME'];
                                    }
                                    ?>
                                    <!--div class="radio-item">
                                        <input class="radio-item__input" id="ID_DELIVERY_ID_<?= $item['ID'] ?>"
                                               type="radio"
                                               value="<?= $item['ID'] ?>" name="DELIVERY_ID"
                                               <? if ($item['CHECKED'] == 'Y'){ ?>checked=""<? } ?>
                                               onclick="submitForm('')"/>

                                        <label class="radio-item__label" for="ID_DELIVERY_ID_<?= $item['ID'] ?>">
                                            <div class="radio-item__name"><?= $item['NAME'] ?></div>

                                            <? if (!empty($item['PRICE'])) { ?>
                                                <div class="radio-item__price">
                                                <span class="price"><?= $item['PRICE'] ?></span>
                                                </div><? } ?>
                                        </label>
                                    </div-->
                                <? if ($item['CHECKED'] == 'Y'){ ?>
                                    <script>
                                        var selectedDeliveryId = '<?= $item['ID'] ?>';
                                    </script>
                                <? } ?>
                                <? } ?>

                                <div class="radio-item">
                                    <input class="radio-item__input" id="deliv_1" type="radio" value="" name="DELIVERY_ID"/>
                                    <label class="radio-item__label" for="deliv_1">
                                        <div class="radio-item__caption">
                                            <div class="radio-item__name">Пункт выдачи (от 5000 бесплатно)</div>
                                            <div class="radio-item__text">Срок доставки указан в рабочих днях, отображается при выборе пункта на карте</div>
                                            <div class="radio-item__link-wrap">
                                                <a href="" class="link-map">Выбрать на карте</a>
                                            </div>
                                        </div>
                                        <div class="radio-item__price">
                                            <span class="price">300</span>
                                        </div>
                                    </label>
                                </div>
                                <div class="radio-item">
                                    <input class="radio-item__input" id="deliv_2" type="radio" value="" name="DELIVERY_ID"/>
                                    <label class="radio-item__label" for="deliv_2">
                                        <div class="radio-item__caption">
                                            <div class="radio-item__name">Курьером (бесплатно от 5500)</div>
                                            <div class="radio-item__text">Курьерская доставка Боксбери. Бесплатно от 5500, 2 рабочих дня Внутри МКАД</div>
                                        </div>
                                        <div class="radio-item__price">
                                            <span class="price">300</span>
                                        </div>
                                    </label>
                                </div>
                                <div class="radio-item">
                                    <input class="radio-item__input" id="deliv_3" type="radio" value="" name="DELIVERY_ID"/>
                                    <label class="radio-item__label" for="deliv_3">
                                        <div class="radio-item__caption">
                                            <div class="radio-item__name">Почта России (с предоплатой)</div>
                                            <div class="radio-item__text">Срок доставки указан в рабочих днях, отображается при выборе пункта на карте</div>
                                            <div class="radio-item__link-wrap">
                                                <a href="" class="link-map">Выбрать отделение на карте</a>
                                            </div>
                                        </div>
                                        <div class="radio-item__price">
                                            <span class="price">300</span>
                                        </div>
                                    </label>
                                </div>
                                <div class="radio-item">
                                    <input class="radio-item__input" id="deliv_4" type="radio" value="" name="DELIVERY_ID"/>
                                    <label class="radio-item__label" for="deliv_4">
                                        <div class="radio-item__caption">
                                            <div class="radio-item__name">Помогите мне с выбором доставки</div>
                                            <div class="radio-item__text">Отметьте это пункт, если у вас возникли сложности или вопросы при выборе варианта доставки. Мы перезвоним вам и все расскажем</div>
                                        </div>
                                    </label>
                                </div>

                            </div>

                            </div>
                        </div>

                        <div class="order-next-two no-active">

                            <div class="order__item order__item--adress">
                            <h2 class="title-page title-page--no_bg">Адрес доставки</h2>
                            <div class="row">
                                <? foreach ($arResult["JS_DATA"]["ORDER_PROP"]["properties"] as $ORDER_PROPERTY) {
                                    if ($ORDER_PROPERTY["PROPS_GROUP_ID"] == '2') {

                                        switch ($ORDER_PROPERTY["CODE"]) {
                                            case'STREET':
                                                $block = '12';
                                                break;

                                            default:
                                                $block = '4';
                                                break ?>

                                            <? }
                                        ?>
                                        <div class="col-xl-<?= $block ?> col-lg-<?= $block ?> col-md-6 col-sm-12 col-12">
                                            <div class="input-control-box">
                                            <input class="feedback-box__control
                                            <? if ($ORDER_PROPERTY["REQUIRED"] == "Y") { ?>
                                                    prop-required
                                                <? } ?>
                                                       "
                                                   placeholder="<?= $ORDER_PROPERTY["NAME"] ?>"
                                                   value="<?= $ORDER_PROPERTY["VALUE"]['0'] ?>"
                                                   type="text"
                                                <? if ($ORDER_PROPERTY["REQUIRED"] == "Y") { ?>
                                                <? } ?>
                                                   name="ORDER_PROP_<?= $ORDER_PROPERTY["ID"] ?>">
                                                   <span class="required-item">Поле обязательно для заполнения</span>
                                            </div>
                                        </div>
                                    <? } ?>
                                <? } ?>


                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <input class="feedback-box__control" placeholder="Комментарий" type="text"
                                           id="orderDescription"
                                           value="<?= $arResult['JS_DATA']['ORDER_DESCRIPTION']; ?>"
                                           name="ORDER_DESCRIPTION">
                                </div>
                            </div>
                            </div>

                            <div class="order__item">
                            <h2 class="title-page title-page--no_bg">Комментарий к заказу</h2>
                            <div class="row">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <input class="feedback-box__control" placeholder="Комментарий" type="text"
                                           id="orderComment"
                                           value="<?= $arResult['JS_DATA']['ORDER_DESCRIPTION']; ?>"
                                           name="ORDER_DESCRIPTION">
                                </div>
                            </div>
                            </div>

                            <div class="order__item">
                            <h2 class="title-page title-page--no_bg">Оплата</h2>
                            <div class="delivery-wrap">

                                <div class="delivering-form__radio-group">
                                    <? foreach ($arResult['PAY_SYSTEM'] as $item) {
                                        ?>
                                        <div class="radio-item">
                                            <input id="ID_PAY_SYSTEM_ID_<?= $item['ID'] ?>" type="radio"
                                                   class="radio-item__input"
                                                   name="PAY_SYSTEM_ID"
                                                   value="<?= $item['ID'] ?>" <?
                                                   if ($item['CHECKED'] == 'Y'){
                                                   ?>checked=""<? } ?> onclick="submitForm()">
                                            <label class="radio-item__label" for="ID_PAY_SYSTEM_ID_<?= $item['ID'] ?>">
                                                <div class="radio-item__name"><?= $item['NAME'] ?></div>
                                            </label>
                                        </div>
                                    <? } ?>
                                </div>
                            </div>
                            </div>

                        </div>


                        <!-- !!!!delivering-form__order-list -->
                        <div class="delivering-form__order-list" style="display: none">
                            <? foreach ($arResult['BASKET_ITEMS'] as $item) {
                                ?>

                                <div class="delivering-form__order-list-item-wrap">
                                    <div class="delivering-form__order-list-item"><span
                                                class="delivering-form__name"><?= $item['NAME'] ?></span>
                                        <div class="delivering-form__optional">
                                            <? foreach ($item["PROPS"] as $prop) {
                                                if ($prop["CODE"] != "PARENT_1ST_LEVEL_SECTION") {
                                                    ?>
                                                    <?= $prop["VALUE"] ?>
                                                    <br>
                                                <? } ?>
                                            <? } ?>
                                        </div>
                                    </div>
                                    <div class="delivering-form__order-list-item-amount"><?= $item['QUANTITY'] ?></div>
                                    <div class="delivering-form__order-list-line">x</div>
                                    <div class="delivering-form__order-list-item-price"><?= $item['PRICE'] ?>
                                        <span>&nbsp;Р</span>
                                    </div>
                                    <? $countPrice += $item['PRICE'] * $item['QUANTITY'] ?>
                                </div>

                            <? } ?>
                            <div class="delivering-form-p-table">
                                <div class="delivering-form-p-table__label">Итого без доставки</div>
                                <div class="delivering-form-p-table__count"><? echo $countPrice ?>
                                    <span>&nbsp;Р</span></div>
                            </div>
                        </div>
                        <!-- delivering-form__order-list -->


                        <!-- delivering-form__delivery-price-wrap -->
                        <div class="delivering-form__delivery-price-wrap" style="display: none">
                            <div class="delivering-form__delivery-price">
                                Доставка
                                <div class="delivering-form__delivery-price-block"><?= $arResult['ORDER_DATA']['PRICE_DELIVERY'] ?>
                                    <span class="delivery-price-warning-currency-span"> Р</span></div>
                            </div>
                            <? if (!$isPickup && $arResult['ORDER_PRICE'] < $limitPrice) {
                                ?>
                                <div class="delivering-form__delivery-price-warning">
                                    <img src="/bitrix/templates/version2/assets/img/warning-delivery-icon.png"
                                         class="delivery-price-warning-img">
                                    <p><? $pricerep = $limitPrice - $arResult['ORDER_PRICE'] ?>
                                        <? echo str_replace("#PRICE#", ' <span class="delivery-price-warning-red-span">' . $pricerep . '</span> <span class="delivery-price-warning-currency-span">Р</span>', $arParams["MIN_DEL_PRICE_TEXT"]) ?>

                                        <!--                                            <span class="delivery-price-warning-red-span">-->
                                        <? //= $limitPrice - $arResult['ORDER_PRICE'] ?><!--</span>-->
                                        <!--                                            <span class="delivery-price-warning-currency-span">Р</span>-->

                                    </p>
                                </div><!-- delivering-form__delivery-price-warning -->
                            <? } ?>
                        </div>


                        <!-- delivering-form__delivery-price-wrap -->
						<div class="delivering-form__coupon-wrap" style="display:none;">

                            <input type="text" placeholder="Купон" class="couponValue">
                            <button class="applyDiscount">Применить</button>

                            <div class="delivering-form__order-list-wrap couponinner">
                                <div class="delivering-form__order-list">
                                    <? if (!empty($arResult["JS_DATA"]["COUPON_LIST"])) {

                                        //print_r($arResult)?>
                                        <?
                                        foreach ($arResult["JS_DATA"]["COUPON_LIST"] as $key => $coupon) { ?>
                                            <div class="delivering-form__order-list-item-wrap coupon">
                                                <div class="delivering-form__order-list-item">   <?= $coupon["COUPON"] ?>  </div>
                                                <div class="delivering-form__order-list-item-price ">   <?= $coupon["STATUS_TEXT"] ?> </div>
                                            </div>

                                            <?
                                        } ?>
                                        <?
                                    } else { ?>
                                        <div class="delivering-form__order-list-item-wrap">

                                            <div class="delivering-form__order-list-item"> нет активных купонов.
                                            </div>
                                        </div>

                                    <? }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <!-- delivering-form__coupon-wrap -->


                        <!-- delivering-main -->
                    </div>

                    <div class="order__sidebar sidebar-order">
                        <div class="sidebar-order__content">
                            <div class="sidebar-order__top">
                                <a href="/basket/" class="sidebar-order__caption">В корзине <span><?= count($arResult["BASKET_ITEMS"]) ?></span> товара</a>
                                <div class="sidebar-order__catalog catalog-order">
                                    <div class="catalog-order__content">
                                        <div class="swiper-container productsSwiper">
                                            <div class="swiper-wrapper">
                                                <div class="swiper-slide">
                                            <? foreach ($arResult['BASKET_ITEMS'] as $item) {
                                                ?>

                                                <div class="catalog-order__item">
                                                    <div class="catalog-order__img-wrap">
                                                        <a href="#">
                                                            <img src="/upload/resize_cache/iblock/763/160_160_1/763204149766322e8decea2f9c7070cc.png" alt="<?= $item['NAME'] ?>"/>
                                                        </a>
                                                    </div>
                                                    <div class="catalog-order__holder">
                                                        <div class="catalog-order__top">
                                                            <div class="catalog-order__name"><a href=""><?= $item['NAME'] ?></a></div>
                                                            <div class="catalog-order__price"><?= $item['PRICE'] ?><span>₽</span></div>
                                                        </div>
                                                        <div class="catalog-order__bottom">
                                                            <div class="catalog-order__weight"><?= $item['WEIGHT_FORMATED'] ?></div>
                                                            <div class="catalog-order__quantity"><?= $item['QUANTITY'] ?> шт</div>
                                                        </div>
                                                    </div>  
                                                </div>

                                            <? } ?>
                                                </div>
                                            </div>
                                            <div class="swiper-scrollbar"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="sidebar-order__bottom">

                                <div class="coupon-wrap">
                                    <div class="coupon-wrap__control">
                                        <input type="text" placeholder="Промокод" class="coupon-wrap__value">
                                        <button class="coupon-wrap__btn">Применить</button>
                                    </div>
                                </div>

                                <div class="order__price">
                                    <span class="order__label">К оплате:</span>
                                    <span class="price"><?= $arResult['ORDER_TOTAL_PRICE'] ?></span>
                                </div>
                                <div class="check-order-wrap">
                                    <div class="check-item check-item--call">
                                        <input class="check-item__input" type="checkbox" id="agreeCheck1" name="agreeCheck1" checked/>      
                                        <label for="agreeCheck1" class="check-item__label">Позвоните мне для уточнения деталей заказа</label>
                                    </div>
                                    <div class="check-item">
                                        <input class="check-item__input" type="checkbox" id="agreeCheck2" name="agreeCheck2" checked/>
                                        <label for="agreeCheck2" id="agreeCheckLabel" class="check-item__label">Подтверждая заказ, вы соглашаетесь на обработку персональных данных в соответствии с <a href="/privacy-policy/">политикой конфиденциальности</a></label>
                                    </div>
                                </div>

                                <button type="submit" class="pay-btn pay-btn--order" id="but">Подтвердить заказ</button>
                                
                            </div>
                        </div>
                    </div>


                    <!--div class="order__footer">
                        <div class="check-item">
                            <input class="check-item__input" type="checkbox" name="" id="agreeCheck" name="agreeCheck"
                                   <? if ($isAgree){ ?>checked=""<? } ?>>
                            <label for="agreeCheck" id="agreeCheckLabel" class="check-item__label">Согласен с <a href="/privacy-policy/">условиями обработки
                                    персональных данных, пользовательского соглашения и публичной оферты</a></label>
                        </div>


                        <div style="color: red" id="errorOrder"></div>


                        <button type="submit" id="but" data-save-button="true" class="feedback-box__submit">
                            Оплатить<span
                                    class="price"><?= $arResult['ORDER_TOTAL_PRICE'] ?></span>
                        </button>
                    </div-->


                    <? if ($_POST["is_ajax_post"] != "Y")
                    {
                    ?>
                </div>
                <!--               ФОРМА ИННЕР КОНЕЦ -->
                <input type="hidden" name="is_ajax_post" id="is_ajax_post" value="Y">
                <input type="hidden" name="confirmorder" id="confirmorder" value="Y">
                <input type="hidden" name="profile_change" id="profile_change" value="N">
                <input type="hidden" name="json" value="Y">


            </form>
        </div>
    </div>

    <?
}
else {
    ?>
    <script type="text/javascript">
        top.BX('confirmorder').value = 'Y';
        top.BX('profile_change').value = 'N';
    </script>
    <?
    die();
} ?>

<? } ?>






