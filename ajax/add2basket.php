<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

CModule::IncludeModule("catalog");
CModule::IncludeModule("sale");
//print_r($_POST);
if (!empty($_POST["ELEMENT_ID"])) {
    Add2BasketByProductID($_POST["OFFER_ID"], $QUANTITY = $_POST["QUANTITY"], $arRewriteFields = array(), $arProductParams = false);
    if ($ex = $APPLICATION->GetException()) {
        echo '<br>' . $ex->GetString();
    }


    echo  $cntBasketItems = CSaleBasket::GetList(
        array(),
        array(
            "FUSER_ID" => CSaleBasket::GetBasketUserID(),
            "LID" => SITE_ID,
            "ORDER_ID" => "NULL"
        ),
        array()
    );


}



