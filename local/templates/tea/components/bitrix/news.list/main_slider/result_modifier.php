<?

if (CModule::IncludeModule("catalog")) {
    foreach ($arResult["ITEMS"] as &$arItem) {

        if ($arItem["PROPERTIES"]["TYPE"]["VALUE_ENUM_ID"] == "3") {

            if (!empty($arItem["PROPERTIES"]["TOVAR"]["VALUE"])) {
                $arSelect = Array("ID", "NAME", "DATE_ACTIVE_FROM", "CATALOG_PRICE_BASE", "DETAIL_PAGE_URL", "PREVIEW_TEXT", "DETAIL_PICTURE");
                $arFilter = Array("IBLOCK_ID" => IntVal(1), "ID" => $arItem["PROPERTIES"]["TOVAR"]["VALUE"]);
                $res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nTopCount" => 1), $arSelect);
                while ($ob = $res->GetNextElement()) {
                    $arFields = $ob->GetFields();
                    $res2 = CCatalogSKU::getOffersList(
                        $arFields["ID"], // массив ID товаров
                        $iblockID = false, // указываете ID инфоблока только в том случае, когда ВЕСЬ массив товаров из одного инфоблока и он известен
                        $skuFilter = array(), // дополнительный фильтр предложений. по умолчанию пуст.
                        $fields = array("ID",),  // массив полей предложений. даже если пуст - вернет ID и IBLOCK_ID
                        $propertyFilter = array() /* свойства предложений. имеет 2 ключа:
                               ID - массив ID свойств предложений
                                      либо
                               CODE - массив символьных кодов свойств предложений
                                     если указаны оба ключа, приоритет имеет ID*/
                    );

                    foreach ($res2 as $sky){
                        foreach ($sky as $sky2) {

                            $arPrice = CCatalogProduct::GetOptimalPrice($sky2["ID"], '1', $USER->GetUserGroupArray(), false);
                            if(!empty($arPrice["RESULT_PRICE"]["DISCOUNT_PRICE"])){
                                $arItem["MIN_PRICE"]=$arPrice["RESULT_PRICE"]["DISCOUNT_PRICE"];
                                break;
                            }
                        }
                    }
                    $arItem["PROPERTIES"]["TOVAR"]["VALUE"] = $arFields;

                }
            }


        }


    }   //здесь можно использовать функции модуля
}