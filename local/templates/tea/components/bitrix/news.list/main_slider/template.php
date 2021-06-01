<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>


<div class="main-slider-wrap">
    <div class="slider-controls container" id="slider-controls-js"></div>


    <div class="main-slider main-slider-js">

        <? foreach ($arResult["ITEMS"] as $arItem): ?>
            <?
            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
            ?>


            <div class="slide" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">

                <? switch ($arItem["PROPERTIES"]["TYPE"]["VALUE_ENUM_ID"]) {

                    case "1";
                        ?>

                        <div class="slide__container">
                            <div class="slide-img">
                                <picture>
                                    <source srcset="<?= $arItem["DETAIL_PICTURE"]["SRC"] ?>" type="image/webp">
                                    <img src="<?= $arItem["DETAIL_PICTURE"]["SRC"] ?>" alt=""/></picture>
                            </div>
                        </div>

                        <?
                        break;

                    case "2";
                        ?>

                        <div class="slide__container">
                            <div class="slide__img">
                                <picture>
                                    <source srcset="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>" type="image/webp">
                                    <img src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>" alt=""/></picture>
                            </div>
                            <div class="slide__products products-slide">
                                <div class="products-slide__img">
                                    <picture>
                                        <source srcset="<?= $arItem["DETAIL_PICTURE"]["SRC"] ?>"
                                                type="image/webp">
                                        <img src="<?= $arItem["DETAIL_PICTURE"]["SRC"] ?>" alt=""/></picture>
                                </div>
                                <div class="products-slide__content">
                                    <div class="products-slide__title"><?= $arItem['NAME'] ?></div>
                                    <div class="products-slide__text">
                                        <?= $arItem['DETAIL_TEXT'] ?>
                                    </div>
                                    <div class="products-slide__price">
                                        <a href="<?= $arItem["PROPERTIES"]["HREF"]["VALUE"] ?>"
                                           class="pay-btn"><?= $arItem["PROPERTIES"]["BUTTON_TEXT"]["VALUE"] ?></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <? break;

                    case "3";
                        ?>

                        <div class="slide__container">
                            <div class="slide__products products-slide">
                                <div class="products-slide__img">
                                    <picture>
                                        <source srcset="<?= CFile::GetPath($arItem["PROPERTIES"]["TOVAR"]["VALUE"]["DETAIL_PICTURE"]) ?>"
                                                type="image/webp">
                                        <img src="<?= CFile::GetPath($arItem["PROPERTIES"]["TOVAR"]["VALUE"]["DETAIL_PICTURE"]) ?>"
                                             alt=""/></picture>
                                </div>
                                <div class="products-slide__content">
                                    <div class="products-slide__title"><?= $arItem["PROPERTIES"]["TOVAR"]["VALUE"]["NAME"] ?></div>
                                    <div class="products-slide__subtitle"><?= $arItem["DETAIL_TEXT"] ?></div>
                                    <div class="products-slide__text">
                                        <?= $arItem["PROPERTIES"]["TOVAR"]["VALUE"]["PREVIEW_TEXT"] ?>
                                    </div>
                                    <div class="products-slide__price">
                                        <span class="price">от <?= $arItem["MIN_PRICE"] ?></span>
                                        <a href="<?= $arItem["PROPERTIES"]["TOVAR"]["VALUE"]["DETAIL_PAGE_URL"] ?>"
                                           class="pay-btn"><?= $arItem["PROPERTIES"]["BUTTON_TEXT"]["VALUE"] ?></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                        <?
                        break;

                } ?>

            </div>


        <? endforeach; ?>


    </div>
</div>
