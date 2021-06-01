<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Main\Localization\Loc;

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CatalogSectionComponent $component
 * @var CBitrixComponentTemplate $this
 * @var string $templateName
 * @var string $componentPath
 *
 *  _________________________________________________________________________
 * |    Attention!
 * |    The following comments are for system use
 * |    and are required for the component to work correctly in ajax mode:
 * |    <!-- items-container -->
 * |    <!-- pagination-container -->
 * |    <!-- component-end -->
 */

$this->setFrameMode(true);


if (!empty($arResult['NAV_RESULT'])) {
    $navParams = array(
        'NavPageCount' => $arResult['NAV_RESULT']->NavPageCount,
        'NavPageNomer' => $arResult['NAV_RESULT']->NavPageNomer,
        'NavNum' => $arResult['NAV_RESULT']->NavNum
    );
} else {
    $navParams = array(
        'NavPageCount' => 1,
        'NavPageNomer' => 1,
        'NavNum' => $this->randString()
    );
}

$showTopPager = false;
$showBottomPager = false;
$showLazyLoad = false;

if ($arParams['PAGE_ELEMENT_COUNT'] > 0 && $navParams['NavPageCount'] > 1) {
    $showTopPager = $arParams['DISPLAY_TOP_PAGER'];
    $showBottomPager = $arParams['DISPLAY_BOTTOM_PAGER'];
    $showLazyLoad = $arParams['LAZY_LOAD'] === 'Y' && $navParams['NavPageNomer'] != $navParams['NavPageCount'];
}

$templateLibrary = array('popup', 'ajax', 'fx');
$currencyList = '';

if (!empty($arResult['CURRENCIES'])) {
    $templateLibrary[] = 'currency';
    $currencyList = CUtil::PhpToJSObject($arResult['CURRENCIES'], false, true, true);
}

$templateData = array(
    'TEMPLATE_THEME' => $arParams['TEMPLATE_THEME'],
    'TEMPLATE_LIBRARY' => $templateLibrary,
    'CURRENCIES' => $currencyList
);
unset($currencyList, $templateLibrary);

$elementEdit = CIBlock::GetArrayByID($arParams['IBLOCK_ID'], 'ELEMENT_EDIT');
$elementDelete = CIBlock::GetArrayByID($arParams['IBLOCK_ID'], 'ELEMENT_DELETE');
$elementDeleteParams = array('CONFIRM' => GetMessage('CT_BCS_TPL_ELEMENT_DELETE_CONFIRM'));


if (!empty($arResult['ITEMS'])) {
?>

<div class="recommend-catalog recommend-catalog--basket">
    <div class="recommend-catalog__img"
         style="background-image: url('<?= SITE_TEMPLATE_PATH ?>/img/basket-bg.png')"></div>
    <div class="container">
        <h2 class="caption-section">Популярные сборы</h2>
        <div class="catalog-list catalog-list--thour">

<?


            $i = 0;
            foreach ($arResult['ITEMS'] as  $arItem) {
            $i++;
            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));


            ?>

            <div class="catalog-list__item" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
                <div class="products-card">
                    <div class="products-card__inner">
                        <div class="products-card__img">
                            <a href="<?= $arItem["DETAIL_PAGE_URL"] ?>">
                                <picture>
                                    <source srcset="<?= $arItem["DETAIL_PICTURE"]["SRC"] ?>" type="image/webp">
                                    <img src="<?= $arItem["DETAIL_PICTURE"]["SRC"] ?>" alt=""/></picture>
                            </a>
                        </div>
                        <a style="text-decoration: none !important;" href="<?= $arItem["DETAIL_PAGE_URL"] ?>">
                            <div class="products-card__title"><?= $arItem["NAME"] ?></div>
                            <div class="products-card__text"><?= $arItem["PREVIEW_TEXT"] ?></div>
                        </a>
                        <? if (!empty($arItem["OFFERS"])) { ?>
                            <div class="products-card__select">
                                <div class="select-b select-b--gray">
                                    <div class="select-b__heading">

                                        <div class="select-b__name"><?= $arItem["OFFERS"][0]['CATALOG_WEIGHT'] ?> гр</div>

                                    </div>
                                    <div class="select-b__body">
                                        <?
                                        foreach ($arItem["OFFERS"] as $OFFER) { ?>
                                            <li data-offer-id="<?= $OFFER['ID'] ?>"
                                                onclick="setOffer(`<?= $OFFER['ID'] ?>`,`<?= $arItem["ID"] ?>`,`<?= $OFFER['MIN_PRICE']["DISCOUNT_VALUE"] ?>`);"
                                                class="select-b__item"><?= $OFFER["CATALOG_WEIGHT"] ?> гр
                                            </li>
                                            <?
                                        } ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="products-card__price">
                                    <span class="price"
                                          id="<?= $arItem["ID"] ?>_PRICE_BLOCK"><?= $arItem["OFFERS"][0]['MIN_PRICE']["DISCOUNT_VALUE"] ?></span>
                                <a href="#" id="<?= $arItem["ID"] ?>_BY_BUTTON"
                                   onclick='add2basket(`<?= $arItem["ID"] ?>`,`<?= $arItem["OFFERS"][0]['ID'] ?>`);return false;'
                                   class="pay-btn pay-btn--light">Купить</a>
                            </div>
                            <?
                        } else { ?>
                            <div class="products-card__select">
                                <div class="select-b select-b--gray">
                                    <div class="">
                                        <div class="select-b__name"><?= $arItem["PRODUCT"]["WEIGHT"] ?> гр</div>

                                    </div>

                                </div>
                            </div>
                            <div class="products-card__price">
                                    <span class="price"
                                          id="<?= $arItem["ID"] ?>_PRICE_BLOCK"><?= $arItem['MIN_PRICE']["DISCOUNT_VALUE"] ?></span>
                                <a href="#" id="<?= $arItem["ID"] ?>_BY_BUTTON"
                                   onclick='add2basket(`<?= $arItem["ID"] ?>`,`<?= $arItem["ID"] ?>`);return false;'
                                   class="pay-btn pay-btn--light">Купить</a>
                            </div>

                            <?
                        } ?>
                    </div>
                </div>
            </div>


            <?

            if ($i ==4){
            ?>
        </div>
        <div class="catalog-list">
            <?
            $i = 0;
            }
            }?>



        </div>
    </div>
</div>
<?}
?>

<?
if ($showLazyLoad) {
    ?>
    <div class="row bx-<?= $arParams['TEMPLATE_THEME'] ?>">
        <div class="btn btn-default btn-lg center-block" style="margin: 15px;"
             data-use="show-more-<?= $navParams['NavNum'] ?>">
            <?= $arParams['MESS_BTN_LAZY_LOAD'] ?>
        </div>
    </div>
    <?
}

if ($showBottomPager) {
    ?>
    <div data-pagination-num="<?= $navParams['NavNum'] ?>">
        <!-- pagination-container -->
        <?= $arResult['NAV_STRING'] ?>
        <!-- pagination-container -->
    </div>
    <?
}


?>
