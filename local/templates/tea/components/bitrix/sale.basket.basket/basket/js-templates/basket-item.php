<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;

/**
 * @var array $mobileColumns
 * @var array $arParams
 * @var string $templateFolder
 */

$usePriceInAdditionalColumn = in_array('PRICE', $arParams['COLUMNS_LIST']) && $arParams['PRICE_DISPLAY_MODE'] === 'Y';
$useSumColumn = in_array('SUM', $arParams['COLUMNS_LIST']);
$useActionColumn = in_array('DELETE', $arParams['COLUMNS_LIST']);

$restoreColSpan = 2 + $usePriceInAdditionalColumn + $useSumColumn + $useActionColumn;

?>
<script id="basket-item-template" type="text/html">


    <!--   Корзина итем-->

    <div class="basket-items-list-item-container{{#SHOW_RESTORE}} basket-items-list-item-container-expend{{/SHOW_RESTORE}} basket-t-body__row"
         id="basket-item-{{ID}}" data-entity="basket-item" data-id="{{ID}}">
        {{#SHOW_RESTORE}}

        <div class="basket-items-list-item-notification-inner basket-items-list-item-notification-removed"
             id="basket-item-height-aligner-{{ID}}">
            {{#SHOW_LOADING}}
            <div class="basket-items-list-item-overlay"></div>
            {{/SHOW_LOADING}}
            <div class="basket-items-list-item-removed-container">
                <div>
                    <?= Loc::getMessage('SBB_GOOD_CAP') ?>
                    <strong>{{NAME}}</strong> <?= Loc::getMessage('SBB_BASKET_ITEM_DELETED') ?>.
                </div>
                <div class="basket-items-list-item-removed-block">
                    <a href="javascript:void(0)" data-entity="basket-item-restore-button">
                        <?= Loc::getMessage('SBB_BASKET_ITEM_RESTORE') ?>
                    </a>
                    <span class="basket-items-list-item-clear-btn"
                          data-entity="basket-item-close-restore-button"></span>
                </div>
            </div>
        </div>
        {{/SHOW_RESTORE}}
        {{^SHOW_RESTORE}}

        <?
        if (in_array('PREVIEW_PICTURE', $arParams['COLUMNS_LIST'])) {
            ?>
            {{#DETAIL_PAGE_URL}}

            <div class="basket-t-body__item basket-t-body__item--img">
                <a href="{{DETAIL_PAGE_URL}}" class="basket-item-image-link">
                    <picture>
                        <source srcset="<?= SITE_TEMPLATE_PATH ?>/img/product-im1.webp" type="image/webp">
                        <img alt="{{NAME}}"
                             src="{{{IMAGE_URL}}}{{^IMAGE_URL}}<?= $templateFolder ?>/images/no_photo.png{{/IMAGE_URL}}">
                </a>
            </div>


            {{/DETAIL_PAGE_URL}}


            <div id="basket-item-height-aligner-{{ID}}" class="basket-t-body__item basket-t-body__item--name">

                <a href="{{DETAIL_PAGE_URL}}">{{NAME}}</a>

            </div>


            {{#NOT_AVAILABLE}}
            <div class="basket-items-list-item-warning-container">
                <div class="alert alert-warning text-center">
                    <?= Loc::getMessage('SBB_BASKET_ITEM_NOT_AVAILABLE') ?>.
                </div>
            </div>
            {{/NOT_AVAILABLE}}
            {{#DELAYED}}
            <div class="basket-items-list-item-warning-container">
                <div class="alert alert-warning text-center">
                    <?= Loc::getMessage('SBB_BASKET_ITEM_DELAYED') ?>.
                    <a href="javascript:void(0)" data-entity="basket-item-remove-delayed">
                        <?= Loc::getMessage('SBB_BASKET_ITEM_REMOVE_DELAYED') ?>
                    </a>
                </div>
            </div>
            {{/DELAYED}}

            {{#WARNINGS.length}}
            <div class="basket-items-list-item-warning-container">
                <div class="alert alert-warning alert-dismissable" data-entity="basket-item-warning-node">
                    <span class="close" data-entity="basket-item-warning-close">&times;</span>
                    {{#WARNINGS}}
                    <div data-entity="basket-item-warning-text">{{{.}}}</div>
                    {{/WARNINGS}}
                </div>
            </div>
            {{/WARNINGS.length}}


            <?
            if ($arParams['SHOW_DISCOUNT_PERCENT'] === 'Y') {
                ?>
                {{#DISCOUNT_PRICE_PERCENT}}
                <div class="basket-item-label-ring basket-item-label-small <?= $discountPositionClass ?>">
                    -{{DISCOUNT_PRICE_PERCENT_FORMATED}}
                </div>
                {{/DISCOUNT_PRICE_PERCENT}}
                <?
            }
            ?>

            {{#DETAIL_PAGE_URL}}

            {{/DETAIL_PAGE_URL}}

            <?
        }
        ?>


        <div class="basket-t-body__item basket-t-body__item--weight">

            <div class="basket-item-block-properties">
                <?
                if (!empty($arParams['PRODUCT_BLOCKS_ORDER'])) {

                    foreach ($arParams['PRODUCT_BLOCKS_ORDER'] as $blockName) {
                        switch (trim((string)$blockName)) {
                            case 'props':
                                if (in_array('PROPS', $arParams['COLUMNS_LIST'])) {
                                    ?>
                                    {{#PROPS}}
                                    <div class="basket-item-property<?= (!isset($mobileColumns['PROPS']) ? ' hidden-xs' : '') ?>">
                                        <div class="basket-item-property-name">
                                            {{{NAME}}}
                                        </div>
                                        <div class="basket-item-property-value"
                                             data-entity="basket-item-property-value" data-property-code="{{CODE}}">
                                            {{{VALUE}}}
                                        </div>
                                    </div>
                                    {{/PROPS}}
                                    <?
                                }

                                break;
                            case 'sku':
                                ?>

                                <?
                                break;
                            case 'columns':
                                ?>
                                {{#COLUMN_LIST}}
                                {{#IS_TEXT}}
                                <div class="bselect-b"
                                     data-entity="basket-item-property">
                                    <div class="select-b__heading">
                                    <div class="select-b__name"
                                         data-column-property-code="{{CODE}}"
                                         data-entity="basket-item-property-column-value">
                                        {{VALUE}}
                                    </div>
                                    </div>
                                </div>
                                {{/IS_TEXT}}

                                {{#IS_HTML}}
                                <div class="basket-item-property-custom basket-item-property-custom-text
														{{#HIDE_MOBILE}}hidden-xs{{/HIDE_MOBILE}}"
                                     data-entity="basket-item-property">
                                    <div class="basket-item-property-custom-name">{{NAME}}</div>
                                    <div class="basket-item-property-custom-value"
                                         data-column-property-code="{{CODE}}"
                                         data-entity="basket-item-property-column-value">
                                        {{{VALUE}}}
                                    </div>
                                </div>
                                {{/IS_HTML}}

                                {{#IS_LINK}}
                                <div class="basket-item-property-custom basket-item-property-custom-text
														{{#HIDE_MOBILE}}hidden-xs{{/HIDE_MOBILE}}"
                                     data-entity="basket-item-property">
                                    <div class="basket-item-property-custom-name">{{NAME}}</div>
                                    <div class="basket-item-property-custom-value"
                                         data-column-property-code="{{CODE}}"
                                         data-entity="basket-item-property-column-value">
                                        {{#VALUE}}
                                        {{{LINK}}}{{^IS_LAST}}<br>{{/IS_LAST}}
                                        {{/VALUE}}
                                    </div>
                                </div>
                                {{/IS_LINK}}
                                {{/COLUMN_LIST}}
                                <?
                                break;
                        }

                    }
                }
                ?>
            </div>

        </div>

        <div class="basket-t-body__item basket-t-body__item--count {{#NOT_AVAILABLE}} disabled{{/NOT_AVAILABLE}}"
             data-entity="basket-item-quantity-block">
            <div class="counter">
                <span class="counter__minus" data-entity="basket-item-quantity-minus"></span>
                <input type="text" class="counter__input" value="{{QUANTITY}}"
                       {{#NOT_AVAILABLE}} disabled="disabled" {{/NOT_AVAILABLE}}
                data-value="{{QUANTITY}}" data-entity="basket-item-quantity-field"
                id="basket-item-quantity-{{ID}}">
                <span class="counter__plus" data-entity="basket-item-quantity-plus"></span>

            </div>
        </div>


        <? /*
        if ($usePriceInAdditionalColumn) {
            ?>


            {{#SHOW_DISCOUNT_PRICE}}

            <span class="basket-item-price-old-text">
									{{{FULL_PRICE_FORMATED}}}
								</span>

            {{/SHOW_DISCOUNT_PRICE}}


            <div class="basket-t-body__item basket-t-body__item--price">
                <span class="price" id="basket-item-price-{{ID}}">{{{PRICE}}}</span>
            </div>



            {{#SHOW_LOADING}}
            <div class="basket-items-list-item-overlay"></div>
            {{/SHOW_LOADING}}

            <?
        }
 */
        ?>


        <?
        if ($useSumColumn) {
            ?>
            {{#SHOW_DISCOUNT_PRICE}}

            <span class="basket-item-price-old-text" id="basket-item-sum-price-old-{{ID}}">
									{{{SUM_FULL_PRICE_FORMATED}}}
								</span>

            {{/SHOW_DISCOUNT_PRICE}}


            <div class="basket-t-body__item basket-t-body__item--price">
                <span class="price" id="basket-item-sum-price-{{ID}}">{{{SUM_PRICE_FORMATED}}}</span>
            </div>
            {{#SHOW_DISCOUNT_PRICE}}


            <?= Loc::getMessage('SBB_BASKET_ITEM_ECONOMY') ?>
            <span id="basket-item-sum-price-difference-{{ID}}" style="white-space: nowrap;">
									{{{SUM_DISCOUNT_PRICE_FORMATED}}}
								</span>

            {{/SHOW_DISCOUNT_PRICE}}

            {{#SHOW_LOADING}}
            <div class="basket-items-list-item-overlay"></div>
            {{/SHOW_LOADING}}


            <?
        }
        ?>


        <div class="basket-t-body__item basket-t-body__item--del">
            <?
            if (isset($mobileColumns['DELETE'])) {
                ?>
                <a style="cursor: pointer" class="del-link" data-entity="basket-item-delete">Удалить</a>
                <?
            }
            ?>
        </div>


        <!--   Корзина итем-->
        {{/SHOW_RESTORE}}

    </div>
</script>










